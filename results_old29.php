<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lycamobile API statistics</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 


</head>
<body>
<?php
   include('session.php');
?>

<?php
error_reporting(0);
require 'vendor/autoload.php';
use Aws\CloudWatch\CloudWatchClient;
use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Aws\Exception\AwsException;

$servername = "localhost";
$username = "root";
$password = "Lyca1018#";
$dbname = "log";
$region='eu-west-2';
$endtime = round(microtime(true) * 1000);
$starttime = $endtime-60000;

$allerrors='{$.HEADER.ERROR_CODE!=0&&$.HEADER.ERROR_CODE!=20032&&$.HEADER.ERROR_CODE!=20021&&$.HEADER.ERROR_CODE!=1&&$.HEADER.ERROR_CODE!=2&&$.HEADER.ERROR_CODE!=3&&$.HEADER.ERROR_CODE!=1064&&$.HEADER.ERROR_CODE!=503&&$.HEADER.ERROR_CODE!=1190&&$.HEADER.ERROR_CODE!=4&&$.HEADER.ERROR_CODE!=1157&&$.HEADER.ERROR_CODE!=10525&&$.HEADER.ERROR_CODE!=47&&$.HEADER.ERROR_CODE!=20035&&$.HEADER.ERROR_CODE!=1010&&$.HEADER.ERROR_CODE!=1101&&$.HEADER.ERROR_CODE!=172&&$.HEADER.ERROR_CODE!=22&&$.HEADER.ERROR_CODE!=1295&&$.HEADER.ERROR_CODE!=6&&$.HEADER.ERROR_CODE!=5&&$.HEADER.ERROR_CODE!=140&&$.HEADER.ERROR_CODE!=1001&&$.HEADER.ERROR_CODE!=24&&$.HEADER.ERROR_CODE!=45&&$.HEADER.ERROR_CODE!=1262}';
$loggroup='UK-Platform-OldCode-Log';
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


$interval = $_POST['interval'];
$startd = $_POST['startd'];
$endd = $_POST['endd'];
$country= $_POST['country'];
$from =null;
$to = null;
if($country=='UK')
{
    date_default_timezone_set("Europe/London");
    $table_log = "log";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='US')
{
  
 date_default_timezone_set("America/New_York");
    $table_log = "logus";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='AU')
{
  
 date_default_timezone_set("Australia/Sydney");
    $table_log = "log_au";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='DE')
{
  
 date_default_timezone_set("Europe/Berlin");
    $table_log = "log_de";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='DK')
{
  
 date_default_timezone_set("Europe/Berlin");
    $table_log = "log_dk";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='ES')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_es";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='FR')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_fr";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='IT')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_it";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='NO')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_no";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='PL')
{
  
 date_default_timezone_set("Europe/Berlin");
    $table_log = "log_pl";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='SW')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_sw";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='SWI')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_swi";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
elseif($country=='AT')
{
  
 date_default_timezone_set("UTC");
    $table_log = "log_at";
   $to = date("Y-m-d H:i:s");

   if ( $startd!=null&&$endd!=null )
   {
    $from=$startd;
    $to=$endd;
   }
   elseif($startd==null&&$endd==null&&$interval!=null)
   {

      if ($interval=='-5 mins')
  {

  $from = date("Y-m-d H:i:s", time() - 60 * 5);
}
elseif($interval=='-10 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10);

}
elseif($interval=='-15 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 15);

}
elseif($interval=='-30 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 30);

}
elseif($interval=='-45 mins')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 45);

}
elseif($interval=='-1 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 60);

}
elseif($interval=='-2 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 120);

}
elseif($interval=='-4 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 240);

}

elseif($interval=='-6 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 360);

}

elseif($interval=='-12 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 720);

}

elseif($interval=='-24 hours')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 1440);

}
else
{

}


   }

   else{


   }

}
else
{
echo "please select valid country";
exit;
}
#echo $from;
#echo $to;

/*if($country == 'UK')
{
$dbtable = "log";
}
elseif($country == 'US')
{
$dbtable = "logus";
}
else
{
  echo "valid" ;
}*/
#echo $from;
#echo $to;

$lastweek_from = date("Y-m-d H:i:s", strtotime("-1 week", strtotime($from)));
#echo $lastweek_from;
$lastweek_to = date("Y-m-d H:i:s", strtotime("-1 week", strtotime($to)));
#echo $lastweek_to;
/*date_default_timezone_set("Europe/London");
	$to = date("Y-m-d H:i:s");
	$from = date("Y-m-d H:i:s", time() - 60 * 5);*/
#echo $from;
#echo $to;


/*$nextTokentopup='';
$topfile = fopen( 'test1.json', 'w' );
fclose($topfile);
$topfile = fopen("test1.json", "a+") or die("Unable to open file!");


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

*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Assign JSON encoded string to a PHP variable





/*foreach(file('test1.json') as $line) 
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
$error_d = $jsonnew1["HEADER"]["ERROR_DESC"];
$transaction = $jsonnew1["BODY"][$t]["CHANNEL_TRANSACTION_ID"];
#print_r($jsonnew1);
/*foreach($jsonnew as $key=>$val){
	$jsonnew[] = $val;
}
$arr = array();*/

/*$sql = "INSERT INTO `log`(`Time_stamp`,`API`,`Error_code`,`Error_desc`,`Transaction_id`) VALUES ('$time','$api', '$error_c', '$error_d', '$transaction')";

if ($conn->query($sql) === TRUE) {
    #echo "New record created successfully";
} else {
    #echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
//}
#echo $from;
#echo $to;
$quick_count=0;
$purchase_count=0;
$get_count=0;

$sql_f = "SELECT API, COUNT(*) AS freq FROM `$table_log` WHERE Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";
$result_f = $conn->query($sql_f);
#echo $sql_f;
$api_name = array();
$j=0;

$sql_api_quick = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_QUICK_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
$result_api_quick= $conn->query($sql_api_quick);
if ($result_api_quick->num_rows > 0) {
  
  
while($row = $result_api_quick->fetch_assoc()) {
$quick_count = $row['freq'] ;

}
 } 


 $sql_api_quicklast = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_QUICK_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' GROUP BY API" ;
$result_api_quicklast= $conn->query($sql_api_quicklast);
if ($result_api_quicklast->num_rows > 0) {
  
  
while($row = $result_api_quicklast->fetch_assoc()) {
$topuplast = $row['freq'] ;

}
 } 
#echo $topuplast;

$sql_api_purchase = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='PURCHASE_FREE_SIM_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
$result_api_purchase= $conn->query($sql_api_purchase);
if ($result_api_purchase->num_rows > 0) {
  
  
while($row = $result_api_purchase->fetch_assoc()) {
$purchase_count = $row['freq'] ;

}
 } 

 $sql_api_purchaselast = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='PURCHASE_FREE_SIM_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' GROUP BY API" ;
$result_api_purchaselast= $conn->query($sql_api_purchaselast);
if ($result_api_purchaselast->num_rows > 0) {
  
  
while($row = $result_api_purchaselast->fetch_assoc()) {
$purchaselast = $row['freq'] ;

}
 } 
$sql_api_get = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='GET_ACCOUNT_DETAILS_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
$result_api_get= $conn->query($sql_api_get);
if ($result_api_get->num_rows > 0) {
  
  
while($row = $result_api_get->fetch_assoc()) {
$get_count = $row['freq'] ;

}
 } 
 $sql_api_getlast = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='GET_ACCOUNT_DETAILS_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' GROUP BY API" ;
$result_api_getlast= $conn->query($sql_api_getlast);
if ($result_api_getlast->num_rows > 0) {
  
  
while($row = $result_api_getlast->fetch_assoc()) {
$getlast = $row['freq'] ;

}
 } 


 $sql_api_bundle = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_BUNDLE_TOPUP_RESPONSE' && Error_code='0' &&  Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
$result_api_bundle= $conn->query($sql_api_bundle);
if ($result_api_bundle->num_rows > 0) {
  
  
while($row = $result_api_bundle->fetch_assoc()) {
$bundle_count = $row['freq'] ;

}
 } 
  $sql_api_bundlelast = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_BUNDLE_TOPUP_RESPONSE' && Error_code='0' &&  Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' GROUP BY API" ;
$result_api_bundlelast= $conn->query($sql_api_bundlelast);
if ($result_api_bundlelast->num_rows > 0) {
  
  
while($row = $result_api_bundlelast->fetch_assoc()) {
$bundlelast = $row['freq'] ;

}
 } 

 $sql_api_online = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_ONLINE_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
$result_api_online= $conn->query($sql_api_online);
if ($result_api_online->num_rows > 0) {
  
  
while($row = $result_api_online->fetch_assoc()) {
$online_count = $row['freq'] ;

}
 } 
  $sql_api_onlinelast = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_ONLINE_TOPUP_RESPONSE' && Error_code='0'  && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' GROUP BY API" ;
$result_api_onlinelast= $conn->query($sql_api_onlinelast);
if ($result_api_onlinelast->num_rows > 0) {
  
  
while($row = $result_api_onlinelast->fetch_assoc()) {
$onlinelast = $row['freq'] ;

}
 } 

 $sql_api_auto = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_AUTO_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
$result_api_auto= $conn->query($sql_api_auto);
if ($result_api_auto->num_rows > 0) {
  
  
while($row = $result_api_auto->fetch_assoc()) {
$auto_count = $row['freq'] ;

}
 } 
 $sql_api_autolast = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_AUTO_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' GROUP BY API" ;
$result_api_autolast= $conn->query($sql_api_autolast);
if ($result_api_autolast->num_rows > 0) {
  
  
while($row = $result_api_autolast->fetch_assoc()) {
$autolast = $row['freq'] ;

}
 } 
?>


<div class="container">
 <div class="row ">
   <div class="col-sm-12">
    <div class="well well-lg"><h3 style="text-align: center;">Lycamobile API statistics(<?php echo $country;?>)</h3></div>
    </div>
  </div>
</div>
<div class="container">

 <div class="row">
   <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg">Quick Topup success <span class="badge"><?php echo $quick_count;?></span></button>

   </div>
   <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg">Purchase free sim success <span class="badge"><?php echo $purchase_count;?></span></button>

   </div>
   <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg">Get Account details success <span class="badge"><?php echo $get_count;?></span></button>

   </div>
 </div>
</div>
<div class="container">
<h2><div class="well well-sm">Comparison over last week</div></h2>
 <div class="row">
   <div class="col-sm-4"> 
    <h3 class="display-3"><span class="label label-primary">Quick topups</span></h3>
   <div id="piechart3" ></div>  

   </div>
   <div class="col-sm-4">
    <h3 class="display-3"><span class="label label-primary">Purchase free sim</span></h3>
   <div id="piechart4" ></div>  

   </div>
   <div class="col-sm-4">
     <h3 class="display-3"><span class="label label-primary">Get account details</span></h3>
   <div id="piechart5" ></div>  

   </div>
 </div>
 <div class="row">
   <div class="col-sm-4"> 
    <h3 class="display-3"><span class="label label-primary">Online topups</span></h3>
   <div id="piechart6" ></div>  

   </div>
   <div class="col-sm-4">
    <h3 class="display-3"><span class="label label-primary">Bundle topups</span></h3>
   <div id="piechart7" ></div>  

   </div>
   <div class="col-sm-4">
     <h3 class="display-3"><span class="label label-primary">Auto topups</span></h3>
   <div id="piechart8" ></div>  

   </div>
 </div>
</div>
<div class="container">
 <div class="row">
 	 <div class="col-sm-6">

<?php
if ($result_f->num_rows > 0) {

	echo "<table class=table table-bordered border=1 >";
            echo "<tr>";
            echo "<h2><div class=well well-sm>Total Number of API calls</div></h2>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>API</th>";
                echo "<th>Count</th>";
                
            echo "</tr>";

	while($row = $result_f->fetch_assoc()) {
		$api_name[$j]=$row['API'];
		$j++;

		echo "<tr>";
                echo "<td>" . $row['API'] . "</td>";
                echo "<td>" . $row['freq'] . "</td>";
                
            echo "</tr>";

	}
	echo "</table>";
	?>

	 </div> 
<div class="col-sm-6">
   

   


           <div id="piechart" style="width: 600px; height: 700px;"></div>  
    </div>
	</div>

</div>


	<?php
}



$api_name_success = array();
$api_success_count = array();
$s=0;
for ($s=0;$s<$j;$s++)
{
	#echo $from;
	#echo $to;

	$ss=$api_name[$s];
	$sql_api_s = "SELECT API,COUNT(*) as freq FROM `$table_log` WHERE API='$ss' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
	#echo $sql_api_s;
	$result_api_s= $conn->query($sql_api_s);
	if ($result_api_s->num_rows > 0) {
	
	
while($row = $result_api_s->fetch_assoc()) {
	
$api_name_success[$s] = $row['API'];
$api_success_count[$s] = $row['freq'];
$z++;			
     
       

}
#echo "</table>";
	}	


}

?>

<div class="container">
 <div class="row">
 	 <div class="col-sm-6">

 	 <?php

echo "<table  class=table table-bordered table-striped border =1>";

echo "<tr>";
            echo "<h2><div class=well well-sm>Total Success</div></h2>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>API</th>";
                echo "<th>Count</th>";
                
            echo "</tr>";	
             ?> <input class="form-control" id="myInput2" type="text" placeholder="Search.."><?php
            echo "<tbody id=myTable2>" ;
for ($l=0;$l<$s;$l++)

{

	if($api_name_success[$l] !=null && $api_success_count[$l] !=null )
	{
echo "<tr>";
                echo "<td>" . $api_name_success[$l] . "</td>";
                echo "<td>" . $api_success_count[$l] . "</td>";
                
            echo "</tr>";

        }

}
echo "</tbody>";
echo "</table>";

?>
</div>

<div class="col-sm-6">
   

   


           <div id="piechart1" style="width: 600px; height: 700px;"></div>  
    </div>
</div>
</div>

<?php


$api_name_error = array();
$api_error_count = array();
$z=0;
for ($k=0;$k<$j;$k++)
{

	
	$sql_api = "SELECT API,COUNT(*) as freq FROM `$table_log` WHERE API='$api_name[$k]' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";

	$result_api = $conn->query($sql_api);
	if ($result_api->num_rows > 0) {
	
	
while($row = $result_api->fetch_assoc()) {
	
$api_name_error[$k] = $row['API'];
$api_error_count[$k] = $row['freq'];
			
     
       

}
#echo "</table>";
	}	


}

?>
<div class="container">
 <div class="row">
 	 <div class="col-sm-6 col-md-6">
    
<?php
echo "<table  class=table table-bordered table-striped border =1 >";

echo "<tr>";
            echo "<h2><div class=well well-sm>Total Errors</div></h2>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>API</th>";
                echo "<th>Count</th>";
                
            echo "</tr>";	

            ?> <input class="form-control" id="myInput1" type="text" placeholder="Search.."><?php
            echo "<tbody id=myTable1>" ;
for ($l=0;$l<$k;$l++)

{

	if($api_name_error[$l] !=null || $api_error_count[$l] !=null )
	{
echo "<tr>";
                echo "<td>" . $api_name_error[$l] . "</td>";
                echo "<td>" . $api_error_count[$l] . "</td>";
                
            echo "</tr>";
        }
       

        
}
echo "</tbody>";
echo "</table>";
//print_r(strstr($test, 'ITG :'));
#echo $api_name_error[1];

?>
</div>

<div class="col-sm-6">
           <div id="piechart2" style="width: 600px; height: 700px;"></div>  
    </div>
</div>
</div>
<div class="container">
 <div class="row">
 	 <div class="col-sm-6">
    
<?php



echo "<table class=table table-bordered table-striped border=1>";
           
  
echo "<tr>";
            echo "<h2><div class=well well-sm>API-wise Error and Count</div></h2>";
            echo "</tr>";

            ?> <input class="form-control" id="myInput" type="text" placeholder="Search.."> <?php
echo "<tbody id=myTable>" ;
for($m=0;$m<$l;$m++)
{
	
#echo $api_name_error[$m];
	#echo '<pre>';
	$aaaa = $api_name_error[$m];
	#echo $aaaa; 
	#echo "dddd";
	

            $query_api_error = "SELECT Error_desc,COUNT(*) as freq FROM `$table_log` WHERE API='$aaaa' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY Error_desc ASC " ; 
            $result_api_error = $conn->query($query_api_error);


            if ($result_api_error->num_rows > 0) {

  
echo "<tr>";
echo "<td><font color=red>" . $api_name_error[$m]."</td>";
echo"</tr>";


 echo "<tr>";
                echo "<th>Error</th>";
            
                echo "<th>Count</th>";
            echo "</tr>";	
 
	while($row = $result_api_error->fetch_assoc()) {
	
	echo "<tr>";
                echo "<td>" . $row['Error_desc'] . "</td>";
                echo "<td>" . $row['freq'] . "</td>";
                
            echo "</tr>";


   
	}

echo "</tbody>";
	
}

}

echo "</table>";


?>

</div>
<div class="col-sm-6">
   

   


           <div id="piechart3 style="width: 600px; height: 700px;"></div>  
    </div>
</div>
</div>
<?php

$query_api_error1 = "SELECT Error_desc,COUNT(*) as freq FROM `$table_log` WHERE API='DO_ONLINE_TOPUP_RESPONSE' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY Error_desc ASC " ; 
             $result_api_error1 = $conn->query($query_api_error1);

             $sql_f = "SELECT API, COUNT(*) AS freq FROM `$table_log` WHERE Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";
$result_f = $conn->query($sql_f);
$sql_api_s = "SELECT API,COUNT(*) as freq FROM `$table_log` WHERE API='$ss' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
	#echo $sql_api_s;
	$result_api_s= $conn->query($sql_api_s);
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           
           
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           google.charts.setOnLoadCallback(drawChart1);
           google.charts.setOnLoadCallback(drawChart2);
           google.charts.setOnLoadCallback(drawChart3);
           google.charts.setOnLoadCallback(drawChart4);
           google.charts.setOnLoadCallback(drawChart5);
           google.charts.setOnLoadCallback(drawChart6);
           google.charts.setOnLoadCallback(drawChart7);
           google.charts.setOnLoadCallback(drawChart8);

           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result_f))  
                          {  
                               echo "['".$row["API"]."', ".$row["freq"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Total number of API responses',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  

           function drawChart1()  
           {  
                var data1 = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          for ($l=0;$l<$s;$l++)

							{	
								if($api_name_success[$l] !=null && $api_success_count[$l] !=null )
	{

                               echo "['".$api_name_success[$l]."', ".$api_success_count[$l]."],";  
                           }
                          }  
                          ?>  
                     ]);  
                var options1 = {  
                      title: 'Number of API Success',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart1 = new google.visualization.PieChart(document.getElementById('piechart1'));  
                chart1.draw(data1, options1);  
           } 

            function drawChart2()  
           {  
                var data2 = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                        for ($l=0;$l<$k;$l++)

{	
								if($api_name_error[$l] !=null || $api_error_count[$l] !=null )
	{

                               echo "['".$api_name_error[$l]."', ".$api_error_count[$l]."],";  
                           }
                          }  
                          ?>  
                     ]);  
                var options2 = {  
                      title: 'Number of API failures',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));  
                chart2.draw(data2, options2);  
           } 
            function drawChart3()  
           {  
                var data3 = google.visualization.arrayToDataTable([  
                          ['Week', 'Count',{ role: 'style' } ],  
                          <?php  
                    

                               echo "['last week', ".$topuplast." , 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'], ";  
                               echo "['this week', ".$quick_count." , 'stroke-color: #008080; stroke-width: 4; fill-color:  #00CED1'],"; 
                          
                          ?>  
                     ]);  
                var options3 = {  
                      title: 'Quick topups',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart3 = new google.visualization.ColumnChart(document.getElementById('piechart3'));  
                chart3.draw(data3, options3);  
           } 
            function drawChart4()  
           {  
                var data4 = google.visualization.arrayToDataTable([  
                          ['Week', 'Count',{ role: 'style' } ],  
                          <?php  
                    

                               echo "['last week', ".$purchaselast." , 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'], ";  
                               echo "['this week', ".$purchase_count." , 'stroke-color: #008080; stroke-width: 4; fill-color:  #00CED1'],"; 
                          
                          ?>  
                     ]);  
                var options4 = {  
                      title: 'Purchase free sim',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart4 = new google.visualization.ColumnChart(document.getElementById('piechart4'));  
                chart4.draw(data4, options4);  
           } 
           function drawChart5()  
           {  
                var data5 = google.visualization.arrayToDataTable([  
                          ['Week', 'Count',{ role: 'style' } ],  
                          <?php  
                    

                               echo "['last week', ".$getlast." , 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'], ";  
                               echo "['this week', ".$get_count." , 'stroke-color: #008080; stroke-width: 4; fill-color:  #00CED1'],"; 
                          
                          ?>  
                     ]);  
                var options5 = {  
                      title: 'Get account details',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart5 = new google.visualization.ColumnChart(document.getElementById('piechart5'));  
                chart5.draw(data5, options5);  
           } 
            function drawChart6()  
           {  
                var data6 = google.visualization.arrayToDataTable([  
                          ['Week', 'Count',{ role: 'style' } ],  
                          <?php  
                    

                               echo "['last week', ".$onlinelast." , 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'], ";  
                               echo "['this week', ".$online_count." , 'stroke-color: #008080; stroke-width: 4; fill-color:  #00CED1'],"; 
                          
                          ?>  
                     ]);  
                var options6 = {  
                      title: 'Online topups',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart6 = new google.visualization.ColumnChart(document.getElementById('piechart6'));  
                chart6.draw(data6, options6);  
           } 
            function drawChart7()  
           {  
                var data7 = google.visualization.arrayToDataTable([  
                          ['Week', 'Count',{ role: 'style' } ],  
                          <?php  
                    

                               echo "['last week', ".$bundlelast." , 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'], ";  
                               echo "['this week', ".$bundle_count." , 'stroke-color: #008080; stroke-width: 4; fill-color:  #00CED1'],"; 
                          
                          ?>  
                     ]);  
                var options7 = {  
                      title: 'Bundle topups',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart7 = new google.visualization.ColumnChart(document.getElementById('piechart7'));  
                chart7.draw(data7, options7);  
           } 
            function drawChart8()  
           {  
                var data8 = google.visualization.arrayToDataTable([  
                          ['Week', 'Count',{ role: 'style' } ],  
                          <?php  
                    

                               echo "['last week', ".$autolast." , 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF'], ";  
                               echo "['this week', ".$auto_count." , 'stroke-color: #008080; stroke-width: 4; fill-color:  #00CED1'],"; 
                          
                          ?>  
                     ]);  
                var options8 = {  
                      title: 'Auto topups',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart8 = new google.visualization.ColumnChart(document.getElementById('piechart8'));  
                chart8.draw(data8, options8);  
           } 

           </script>  


      </head>  
    <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInput1").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
  $("#myInput2").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable2 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>  
 </html>  


                              		
