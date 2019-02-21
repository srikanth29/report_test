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
if($startd!=null&&$endd!=null)
{
    $from=$startd;
    $to=$endd;
}
elseif($interval!=null)
{
	date_default_timezone_set("Europe/London");
	$to = date("Y-m-d H:i:s");
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


}
else
{
echo "Select valid date";

}

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


$sql_f = "SELECT API, COUNT(*) AS freq FROM `log` WHERE Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";
$result_f = $conn->query($sql_f);

$api_name = array();
$j=0;
?>


<div class="container">
 <div class="row">
 	 <div class="col-sm-6">

<?php
if ($result_f->num_rows > 0) {

	echo "<table class=table table-bordered border=1 >";
            echo "<tr>";
            echo "<h2>Total Number of API calls</h2>";
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
	$sql_api_s = "SELECT API,COUNT(*) as freq FROM `log` WHERE API='$ss' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
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

echo "<table  class=table table-bordered border =1>";

echo "<tr>";
            echo "<h2>Total Success</h2>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>API</th>";
                echo "<th>Count</th>";
                
            echo "</tr>";	
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

	
	$sql_api = "SELECT API,COUNT(*) as freq FROM `log` WHERE API='$api_name[$k]' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";

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
echo "<table  class=table table-bordered border =1 >";

echo "<tr>";
            echo "<h2>Total Errors</h2>";
            echo "</tr>";
            echo "<tr>";
                echo "<th>API</th>";
                echo "<th>Count</th>";
                
            echo "</tr>";	
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



echo "<table class=table table-bordered border=1>";
           

echo "<tr>";
            echo "<h2>API-wise Error and Count</h2>";
            echo "</tr>";
for($m=0;$m<$l;$m++)
{
	
#echo $api_name_error[$m];
	#echo '<pre>';
	$aaaa = $api_name_error[$m];
	#echo $aaaa; 
	#echo "dddd";
	

            $query_api_error = "SELECT Error_desc,COUNT(*) as freq FROM `log` WHERE API='$aaaa' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY Error_desc ASC " ; 
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

$query_api_error1 = "SELECT Error_desc,COUNT(*) as freq FROM `log` WHERE API='DO_ONLINE_TOPUP_RESPONSE' && Error_code!='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY Error_desc ASC " ; 
             $result_api_error1 = $conn->query($query_api_error1);

             $sql_f = "SELECT API, COUNT(*) AS freq FROM `log` WHERE Time_stamp BETWEEN '$from' AND '$to' GROUP BY API";
$result_f = $conn->query($sql_f);
$sql_api_s = "SELECT API,COUNT(*) as freq FROM `log` WHERE API='$ss' && Error_code='0' && Time_stamp BETWEEN '$from' AND '$to' GROUP BY API" ;
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
           </script>  


      </head>  
      
 </html>  


                              		
