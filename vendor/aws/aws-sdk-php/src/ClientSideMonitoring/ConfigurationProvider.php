<?php
namespace Aws\ClientSideMonitoring;

use Aws\CacheInterface;
use Aws\ClientSideMonitoring\Exception\ConfigurationException;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\PromiseInterface;

/**
 * A configuration provider is a function that accepts no arguments and returns
 * a promise that is fulfilled with a {@see \Aws\ClientSideMonitoring\ConfigurationInterface}
 * or rejected with an {@see \Aws\ClientSideMonitoring\Exception\ConfigurationException}.
 *
 * <code>
 * use Aws\ClientSideMonitoring\ConfigurationProvider;
 * $provider = ConfigurationProvider::defaultProvider();
 * // Returns a ConfigurationInterface or throws.
 * $config = $provider()->wait();
 * </code>
 *
 * Configuration providers can be composed to create configuration using
 * conditional logic that can create different configurations in different
 * environments. You can compose multiple providers into a single provider using
 * {@see Aws\ClientSideMonitoring\ConfigurationProvider::chain}. This function
 * accepts providers as variadic arguments and returns a new function that will
 * invoke each provider until a successful configuration is returned.
 *
 * <code>
 * // First try an INI file at this location.
 * $a = ConfigurationProvider::ini(null, '/path/to/file.ini');
 * // Then try an INI file at this location.
 * $b = ConfigurationProvider::ini(null, '/path/to/other-file.ini');
 * // Then try loading from environment variables.
 * $c = ConfigurationProvider::env();
 * // Combine the three providers together.
 * $composed = ConfigurationProvider::chain($a, $b, $c);
 * // Returns a promise that is fulfilled with a configuration or throws.
 * $promise = $composed();
 * // Wait on the configuration to resolve.
 * $config = $promise->wait();
 * </code>
 */
class ConfigurationProvider
{

    const CACHE_KEY = 'aws_cached_csm_config';
    const DEFAULT_CLIENT_ID = '';
    const DEFAULT_ENABLED = false;
    const DEFAULT_PORT = 31000;
    const ENV_CLIENT_ID = 'AWS_CSM_CLIENT_ID';
    const ENV_ENABLED = 'AWS_CSM_ENABLED';
    const ENV_PORT = 'AWS_CSM_PORT';
    const ENV_PROFILE = 'AWS_PROFILE';

    /**
     * Wraps a credential provider and saves provided credentials in an
     * instance of Aws\CacheInterface. Forwards calls when no credentials found
     * in cache and updates cache with the results.
     *
     * @param callable $provider Credentials provider function to wrap
     * @param CacheInterface $cache Cache to store credentials
     * @param string|null $cacheKey (optional) Cache key to use
     *
     * @return callable
     */
    public static function cache(
        callable $provider,
        CacheInterface $cache,
        $cacheKey = null
    ) {
        $cacheKey = $cacheKey ?: self::CACHE_KEY;

        return function () use ($provider, $cache, $cacheKey) {
            $found = $cache->get($cacheKey);
            if ($found instanceof ConfigurationInterface) {
                return Promise\promise_for($found);
            }

            return $provider()
                ->then(function (ConfigurationInterface $config) use (
                    $cache,
                    $cacheKey
                ) {
                    $cache->set(
                        $cacheKey,
                        $config
                    );

                    return $config;
                });
        };
    }

    /**
     * Creates an aggregate credentials provider that invokes the provided
     * variadic providers one after the other until a provider returns
     * credentials.
     *
     * @return callable
     */
    public static function chain()
    {
        $links = func_get_args();
        if (empty($links)) {
            throw new \InvalidArgumentException('No providers in chain');
        }

        return function () use ($links) {
            /** @var callable $parent */
            $parent = array_shift($links);
            $promise = $parent();
            while ($next = array_shift($links)) {
                $promise = $promise->otherwise($next);
            }
            return $promise;
        };
    }

    /**
     * Create a default CSM config provider that first checks for environment
     * variables, then checks for a specified profile in ~/.aws/config, then
     * checks for the "aws_csm" profile in ~/.aws/config, and failing those uses
     * a default fallback set of configuration options.
     *
     * This provider is automatically wrapped in a memoize function that caches
     * previously provided config options.
     *
     * @param array $config Optional array of ecs/instance profile credentials
     *                      provider options.
     *
     * @return callable
     */
    public static function defaultProvider(array $config = [])
    {
        $configProviders = [
            self::env(),
            self::ini(),
            self::fallback()
        ];

        $memo = self::memoize(
            call_user_func_array('self::chain', $configProviders)
        );

        if (isset($config['csm']) && $config['csm'] instanceof CacheInterface) {
            return self::cache($memo, $config['csm'], self::CACHE_KEY);
        }

        return $memo;
    }

    /**
     * Provider that creates CSM config from environment variables.
     *
     * @return callable
     */
    public static function env()
    {
        return function () {
            // Use credentials from environment variables, if available
            $enabled = getenv(self::ENV_ENABLED);
            if ($enabled !== false) {
                return Promise\promise_for(
                    new Configuration(
                        $enabled,
                        getenv(self::ENV_PORT) ?: self::DEFAULT_PORT,
                        getenv(self:: ENV_CLIENT_ID) ?: self::DEFAULT_CLIENT_ID
                     )
                );
            }

            return self::reject('Could not find environment variable CSM config'
                . ' in ' . self::ENV_ENABLED. '/' . self::ENV_PORT . '/'
                . self::ENV_CLIENT_ID);
        };
    }

    /**
     * Fallback config options when other sources are not set.
     *
     * @return callable
     */
    public static function fallback()
    {
        return function() {
            return Promise\promise_for(
                new Configuration(
                    self::DEFAULT_ENABLED,
                    self::DEFAULT_PORT,
                    self::DEFAULT_CLIENT_ID
                )
            );
        };
    }

    /**
     * Gets the environment's HOME directory if available.
     *
     * @return null|string
     */
    private static function getHomeDir()
    {
        // On Linux/Unix-like systems, use the HOME environment variable
        if ($homeDir = getenv('HOME')) {
            return $homeDir;
        }

        // Get the HOMEDRIVE and HOMEPATH values for Windows hosts
        $homeDrive = getenv('HOMEDRIVE');
        $homePath = getenv('HOMEPATH');

        return ($homeDrive && $homePath) ? $homeDrive . $homePath : null;
    }

    /**
     * CSM config provider that creates CSM config using an ini file stored
     * in the current user's home directory.
     *
     * @param string|null $profile  Profile to use. If not specified will use
     *                              the "aws_csm" profile in "~/.aws/config".
     * @param string|null $filename If provided, uses a custom filename rather
     *                              than looking in the home directory.
     *
     * @return callable
     */
    public static function ini($profile = null, $filename = null)
    {
        $filename = $filename ?: (self::getHomeDir() . '/.aws/config');
        $profile = $profile ?: (getenv(self::ENV_PROFILE) ?: 'aws_csm');

        return function () use ($profile, $filename) {
            if (!is_readable($filename)) {
                return self::reject("Cannot read CSM config from $filename");
            }
            $data = parse_ini_file($filename, true);
            if ($data === false) {
                return self::reject("Invalid config file: $filename");
            }
            if (!isset($data[$profile])) {
                return self::reject("'$profile' not found in config file");
            }
            if (!isset($data[$profile]['csm_enabled'])) {
                return self::reject("Required CSM config values not present in 
                    INI profile '{$profile}' ({$filename})");
            }

            // port is optional
            if (empty($data[$profile]['csm_port'])) {
                $data[$profile]['csm_port'] = self::DEFAULT_PORT;
            }

            // client_id is optional
            if (empty($data[$profile]['csm_clientid'])) {
                $data[$profile]['csm_clientid'] = self::DEFAULT_CLIENT_ID;
            }

            return Promise\promise_for(
                new Configuration(
                    $data[$profile]['csm_enabled'],
                    $data[$profile]['csm_port'],
                    $data[$profile]['csm_clientid']
                )
            );
        };
    }

    /**
     * Wraps a CSM config provider and caches previously provided configuration.
     *
     * Ensures that cached configuration is refreshed when it expires.
     *
     * @param callable $provider CSM config provider function to wrap.
     *
     * @return callable
     */
    public static function memoize(callable $provider)
    {
        return function () use ($provider) {
            static $result;
            static $isConstant;

            // Constant config will be returned constantly.
            if ($isConstant) {
                return $result;
            }

            // Create the initial promise that will be used as the cached value
            // until it expires.
            if (null === $result) {
                $result = $provider();
            }

            // Return config and set flag that provider is already set
            return $result
                ->then(function (ConfigurationInterface $config) use (&$isConstant) {
                    $isConstant = true;
                    return $config;
                });
        };
    }

    /**
     * Reject promise with standardized exception.
     * 
     * @param $msg
     * @return Promise\RejectedPromise
     */
    private static function reject($msg)
    {
        return new Promise\RejectedPromise(new ConfigurationException($msg));
    }

    /**
     * Unwraps a configuration object in whatever valid form it is in,
     * always returning a ConfigurationInterface object.
     *
     * @param  mixed $config
     * @return ConfigurationInterface
     * @throws \InvalidArgumentException
     */
    public static function unwrap($config)
    {
        if (is_callable($config)) {
            $config = $config();
        }
        if ($config instanceof PromiseInterface) {
            $config = $config->wait();
        }
        if ($config instanceof ConfigurationInterface) {
            return $config;
        } elseif (is_array($config) && isset($config['enabled'])) {
            $client_id = isset($config['client_id']) ? $config['client_id']
                : self::DEFAULT_CLIENT_ID;
            $port = isset($config['port']) ? $config['port']
                : self::DEFAULT_PORT;
            return new Configuration($config['enabled'], $port, $client_id);
        }

        throw new \InvalidArgumentException('Not a valid CSM configuration '
            . 'argument.');
    }
}