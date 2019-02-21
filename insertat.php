<!DOCTYPE html>
<html lang="en">
<head>
    <title>Access a Value of JSON Object in PHP</title>
</head>
<body>

<?php
#error_reporting(0);
require 'vendor/autoload.php';
use Aws\CloudWatch\CloudWatchClient;
use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Aws\Exception\AwsException;

$servername = "localhost";
$username = "root";
$password = "Lyca1018#";
$dbname = "log";
$region='eu-central-1';
$endtime = round(microtime(true) * 1000);
$starttime = $endtime-300000;
echo $starttime;
echo $endtime;
$allerrors='{$.HEADER.ERROR_CODE!=0&&$.HEADER.ERROR_CODE!=20032&&$.HEADER.ERROR_CODE!=20021&&$.HEADER.ERROR_CODE!=1&&$.HEADER.ERROR_CODE!=2&&$.HEADER.ERROR_CODE!=3&&$.HEADER.ERROR_CODE!=1064&&$.HEADER.ERROR_CODE!=503&&$.HEADER.ERROR_CODE!=1190&&$.HEADER.ERROR_CODE!=4&&$.HEADER.ERROR_CODE!=1157&&$.HEADER.ERROR_CODE!=10525&&$.HEADER.ERROR_CODE!=47&&$.HEADER.ERROR_CODE!=20035&&$.HEADER.ERROR_CODE!=1010&&$.HEADER.ERROR_CODE!=1101&&$.HEADER.ERROR_CODE!=172&&$.HEADER.ERROR_CODE!=22&&$.HEADER.ERROR_CODE!=1295&&$.HEADER.ERROR_CODE!=6&&$.HEADER.ERROR_CODE!=5&&$.HEADER.ERROR_CODE!=140&&$.HEADER.ERROR_CODE!=1001&&$.HEADER.ERROR_CODE!=24&&$.HEADER.ERROR_CODE!=45&&$.HEADER.ERROR_CODE!=1262}';
$loggroup='Austria-Platform-Log';
$topuperror='{$.HEADER.ERROR_CODE!=0||$.HEADER.ERROR_CODE=0}';
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
$topfile = fopen( '/var/www/html/statistics/at_out.json', 'w' );
fclose($topfile);
$topfile = fopen("/var/www/html/statistics/at_out.json", "a+") or die("Unable to open file!");


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


/*date_default_timezone_set("Europe/London");
$from = date("Y-m-d H:i:s");
$to = date("Y-m-d H:i:s", time() - 60 * 5); */


foreach(file('/var/www/html/statistics/at_out.json') as $line) 
{


#$jsonnew=json_decode($line,true);
#$test=file_get_contents("test1.json");
#echo '<pre>';
//echo $line;
	
echo '<pre>';

#print_r(substr($line,7,20));
//echo $time;
echo '<pre>';
$jsonnew = substr(strstr($line,'ITG :'), strlen('ITG :'));
//echo $jsonnew;
echo '<pre>';
$jsonnew1=json_decode($jsonnew,true);
#echo '<pre>';
#print_r(key($jsonnew1["BODY"]));
$t = key($jsonnew1["BODY"]);
//print_r($string[2]);
//print_r($jsonnew[0]);
#print_r($jsonnew1["HEADER"]["ERROR_CODE"]);
#$t= $jsonnew1["HEADER"]["ERROR_CODE"];
#echo '<pre>';
#print_r($jsonnew1["HEADER"]["ERROR_DESC"]);
#echo '<pre>';
#print_r($jsonnew1["BODY"][$t]["CHANNEL_TRANSACTION_ID"]);
$time = substr($line,7,20);
$api = key($jsonnew1["BODY"]);
$error_c = $jsonnew1["HEADER"]["ERROR_CODE"];
$error_d = mysqli_real_escape_string($conn,$jsonnew1["HEADER"]["ERROR_DESC"]);
$transaction = $jsonnew1["BODY"][$t]["CHANNEL_TRANSACTION_ID"];
#print_r($jsonnew1);
/*foreach($jsonnew as $key=>$val){
	$jsonnew[] = $val;
}
$arr = array();*/

$sql = "INSERT INTO `log_at`(`Time_stamp`,`API`,`Error_code`,`Error_desc`,`Transaction_id`) VALUES ('$time','$api', '$error_c', '$error_d', '$transaction')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    #echo "Error: " . $sql . "<br>" . $conn->error;
}

}
