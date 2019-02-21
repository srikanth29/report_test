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
 
?>

<?php
error_reporting(0);


$servername = "localhost";
$username = "root";
$password = "Lyca1018#";
$dbname = "log";
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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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
elseif($interval=='-2 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 2880);

}
elseif($interval=='-3 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 4320);

}
elseif($interval=='-5 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 7200);

}
elseif($interval=='-7 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 10080);

}
elseif($interval=='-14 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 20160);

}
elseif($interval=='-30 days')
{
  $from = date("Y-m-d H:i:s", time() - 60 * 43200);

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

$sql_new="SELECT
    COUNT(CASE WHEN `API`='DO_QUICK_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' THEN 1 END) AS quickc,
    COUNT(CASE WHEN `API`='PURCHASE_FREE_SIM_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' THEN 1 END) AS purc,
    COUNT(CASE WHEN `API`='GET_ACCOUNT_DETAILS_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' THEN 1 END) AS getc,
    COUNT(CASE WHEN `API`='DO_BUNDLE_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' THEN 1 END) AS bundlec,
    COUNT(CASE WHEN `API`='DO_ONLINE_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' THEN 1 END) AS onlinec,
    COUNT(CASE WHEN `API`='DO_AUTO_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' THEN 1 END) AS autoc
FROM `$table_log`";
$result_new = $conn->query($sql_new);
if ($result_new->num_rows > 0) {

  while($row = $result_new->fetch_assoc()) {
    $quick_count=$row['quickc'];
    $purchase_count=$row['purc'];
    $get_count=$row['getc'];
    $bundle_count=$row['bundlec'];
    $online_count=$row['onlinec'];
    $auto_count=$row['autoc'];
  }
  }
$sql_new_old="SELECT
    COUNT(CASE WHEN `API`='DO_QUICK_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' THEN 1 END) AS quickcl,
    COUNT(CASE WHEN `API`='PURCHASE_FREE_SIM_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' THEN 1 END) AS purcl,
    COUNT(CASE WHEN `API`='GET_ACCOUNT_DETAILS_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' THEN 1 END) AS getcl,
    COUNT(CASE WHEN `API`='DO_BUNDLE_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' THEN 1 END) AS bundlecl,
    COUNT(CASE WHEN `API`='DO_ONLINE_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' THEN 1 END) AS onlinecl,
    COUNT(CASE WHEN `API`='DO_AUTO_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$lastweek_from' AND '$lastweek_to' THEN 1 END) AS autocl
FROM `$table_log`";
$result_new_old = $conn->query($sql_new_old);
if ($result_new_old->num_rows > 0) {

  while($row = $result_new_old->fetch_assoc()) {
    $topuplast=$row['quickcl'];
    $purchaselast=$row['purcl'];
    $getlast=$row['getcl'];
    $bundlelast=$row['bundlecl'];
    $onlinelast=$row['onlinecl'];
    $autolast=$row['autocl'];
  }
  }

#echo $sql_f;
$api_name = array();
$j=0;

/*$sql_api_quick = "SELECT COUNT(*) as freq FROM `$table_log` WHERE API='DO_QUICK_TOPUP_RESPONSE' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
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
 } */
?>




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


	<?php
}




?>
</div>


</div>

<?php





?>
</div>


</div>
<div class="container">
 <div class="row">
 	 <div class="col-sm-6">
    
<?php




?>

</div>
<
</div>
<?php

/*$query_api_error1 = "SELECT Error_desc,COUNT(*) as freq FROM `$table_log` WHERE API='DO_ONLINE_TOPUP_RESPONSE' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY Error_desc ASC " ; 
             $result_api_error1 = $conn->query($query_api_error1);

             $sql_f = "SELECT API, COUNT(*) AS freq FROM `$table_log` WHERE Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";
$result_f = $conn->query($sql_f);
$sql_api_s = "SELECT API,COUNT(*) as freq FROM `$table_log` WHERE API='$ss' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
	#echo $sql_api_s;
	$result_api_s= $conn->query($sql_api_s);*/
  $result_f = $conn->query($sql_f);
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           
           
           

 </html>  


                              		
