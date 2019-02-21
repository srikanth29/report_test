<!DOCTYPE html>
<html lang="en">
<head>
    <title>Access a Value of JSON Object in PHP</title>
</head>
<body>

<?php

require 'vendor/autoload.php';
use Aws\CloudWatch\CloudWatchClient;
use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Aws\Exception\AwsException;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "log";
$region='eu-west-2';
$endtime = round(microtime(true) * 1000);
$starttime = $endtime-60000;

$allerrors='{$.HEADER.ERROR_CODE!=0&&$.HEADER.ERROR_CODE!=20032&&$.HEADER.ERROR_CODE!=20021&&$.HEADER.ERROR_CODE!=1&&$.HEADER.ERROR_CODE!=2&&$.HEADER.ERROR_CODE!=3&&$.HEADER.ERROR_CODE!=1064&&$.HEADER.ERROR_CODE!=503&&$.HEADER.ERROR_CODE!=1190&&$.HEADER.ERROR_CODE!=4&&$.HEADER.ERROR_CODE!=1157&&$.HEADER.ERROR_CODE!=10525&&$.HEADER.ERROR_CODE!=47&&$.HEADER.ERROR_CODE!=20035&&$.HEADER.ERROR_CODE!=1010&&$.HEADER.ERROR_CODE!=1101&&$.HEADER.ERROR_CODE!=172&&$.HEADER.ERROR_CODE!=22&&$.HEADER.ERROR_CODE!=1295&&$.HEADER.ERROR_CODE!=6&&$.HEADER.ERROR_CODE!=5&&$.HEADER.ERROR_CODE!=140&&$.HEADER.ERROR_CODE!=1001&&$.HEADER.ERROR_CODE!=24&&$.HEADER.ERROR_CODE!=45&&$.HEADER.ERROR_CODE!=1262}';
$loggroup='UK-Platform-OldCode-Log';
$topuperror='[api=*ENVELOPE*]';
$simerror='{$.HEADER.ERROR_CODE!=0&&$.BODY.PURCHASE_FREE_SIM_RESPONSE.TOTAL_PAYMENT_AMOUNT!=0&&$.HEADER.ERROR_CODE!=20032}';


$client = new CloudWatchClient([
    #'profile' => 'default',
    'region' => $region,
    'version' => '2010-08-01',
    'credentials' => [
        'key'    => 'AKIAJ7Y7R6HICHLVFIHQ',
        'secret' => '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'
    ]
]);
$client1 = new CloudWatchLogsClient([
    #'profile' => 'default',
    'region' => $region,
    'version' => 'latest',
    'credentials' => [
        'key'    => 'AKIAJ7Y7R6HICHLVFIHQ',
        'secret' => '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'
    ]
]);




$nextTokentopup='';
$topfile = fopen( 'request.txt', 'w' );
fclose($topfile);
$topfile = fopen("request.txt", "a+") or die("Unable to open file!");


do
{
  if($nextTokentopup) 
  {
        $topuperror1 = $client1->filterLogEvents([
        
        'filterPattern' => $topuperror,
        'startTime' => $starttime,
        'logGroupName' => $loggroup,
        //StartTime : mixed type: string (date format)|int (unix timestamp)|\DateTime
         //'interleaved' => true,
        //EndTime : mixed type: string (date format)|int (unix timestamp)|\DateTime
        'endTime' => $endtime,
        'nextToken' => $nextTokentopup,

        //The granularity, in seconds, of the returned datapoints. Period must be at least 60 seconds and must be a multiple of 60. The default value is 60
        
       
        ]);


        $topuperrors2= $topuperror1['events'];
        $t =0;
        $top =array();

              foreach($topuperrors2 as $v2)  
                {
                  $top = $topuperrors2[$t]['message']."\r\n";
                  fwrite($topfile, $top);
                  $t++;
                }
  }
  else
  {
        $topuperror1 = $client1->filterLogEvents([
        
        'filterPattern' => $topuperror,
        'startTime' => $starttime,
        'logGroupName' => $loggroup,
        //StartTime : mixed type: string (date format)|int (unix timestamp)|\DateTime
         //'interleaved' => true,
        //EndTime : mixed type: string (date format)|int (unix timestamp)|\DateTime
        'endTime' => $endtime,
        
        ]);

        $topuperrors2= $topuperror1['events'];

        $t =0;
        $top =array();
                foreach($topuperrors2 as $v2)
                  {
        //fputcsv($myfile, $vl);
                    $top = $topuperrors2[$t]['message']."\r\n";
                    fwrite($topfile, $top);
                    $t++;
                  }

  }
  $nextTokentopup= $topuperror1['nextToken'];


} while ($nextTokentopup);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Assign JSON encoded string to a PHP variable
$xmlDoc = new DOMDocument();
$xmlDoc->load("request.xml");
$xml = simplexml_load_file('request.xml');
var_dump($xml);
$jsonnew1=json_decode($xml,true);
var_dump($jsonnew1);
$api = $jsonnew1["BODY"];
echo $api;
$xmlObject = $xmlDoc->getElementsByTagName('GET_AUTO_TOPUP_SETTINGS_REQUEST');
$itemCount = $xmlObject->length;

for ($i=0; $i < $itemCount; $i++){

  $title = $xmlObject->item($i)->getElementsByTagName('MSISDN')->item(0)->childNodes->item(0)->nodeValue;
  echo $title;
  #$link  = $xmlObject->item($i)->getElementsByTagName('url')->item(0)->childNodes->item(0)->nodeValue;
}
/*foreach(file('request.txt') as $line) 
{


#$jsonnew=json_decode($line,true);
#$test=file_get_contents("test1.json");
#echo '<pre>';
//echo $line;
	
echo '<pre>';

print_r(substr($line,7,20));
//echo $time;
echo '<pre>';
$jsonnew = substr(strstr($line,'REQUEST :'), strlen('REQUEST :'));
//echo $jsonnew;
$xml = SimpleXMLElement($line,null,true) or die("ERROR: Cannot create SimpleXML object");
$movie_name= $xml->column->attributes()->name;

echo $movie_name;
echo '<pre>';

echo '<pre>';
$size = sizeOf($xml->id);
echo $size;
$i = 0; //index
while($i != $size) 
{
  print_r($xml->id[$i]);
} //Test
/*$jsonnew1=json_decode($jsonnew,true);
echo '<pre>';
print_r(key($jsonnew1["BODY"]));
$t = key($jsonnew1["BODY"]);
//print_r($string[2]);
//print_r($jsonnew[0]);
print_r($jsonnew1["HEADER"]["ERROR_CODE"]);
#$t= $jsonnew1["HEADER"]["ERROR_CODE"];
echo '<pre>';
print_r($jsonnew1["HEADER"]["ERROR_DESC"]);
echo '<pre>';
print_r($jsonnew1["BODY"][$t]["CHANNEL_TRANSACTION_ID"]);
$time = substr($line,7,20);
$api = key($jsonnew1["BODY"]);
$error_c = $jsonnew1["HEADER"]["ERROR_CODE"];
$error_d = $jsonnew1["HEADER"]["ERROR_DESC"];
$transaction = $jsonnew1["BODY"][$t]["CHANNEL_TRANSACTION_ID"];
#print_r($jsonnew1);
/*foreach($jsonnew as $key=>$val){
	$jsonnew[] = $val;
}
$arr = array();*/

/*$sql = "INSERT INTO `log`(`Time`,`API`,`Error_code`,`Error_desc`,`Transaction_id`) VALUES ('$time','$api', '$error_c', '$error_d', '$transaction')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 

} */

//print_r(strstr($test, 'ITG :'));


//echo($jsonnew->HEADER);
/*$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($string, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {


    	echo '<pre>';
        echo "$key:\n";
        
        echo '</pre>';
    } else {
    	echo '<pre>';
  		echo "$key";
  		echo '</pre>';
        echo "$key => $val\n";
    }
}*/

?>

</body>
</html>                                		