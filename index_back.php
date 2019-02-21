<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lycamobile API statistics</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<!--===============================================================================================-->
</head>
<script LANGUAGE="JavaScript">
function validation()
{


if(document.login.country.selectedIndex==0)
{ 
//document.getElementsByName("abc").innerHTML = "Paragraph changed!";
document.getElementById("co").innerHTML = "Please select Country";
//alert("Please select your member type");
document.login.country.focus();
return false;
}
if(document.login.startd.value=="" && document.login.endd.value=="")
{

if(document.login.interval.selectedIndex==0)
{
//document.getElementsByName("abc").innerHTML = "Paragraph changed!";
document.getElementById("in").innerHTML = "Please select Interval";
//alert("Please select your member type");
document.login.interval.focus();
return false;
}
else
{
return true;
}

}

return true;	
}
</script>
<?php
   
?>
<body>

 <form method="post" name="login" action="results_back.php"  onsubmit="return validation();">
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form">
				<span class="contact100-form-title">
					API Statistics </span> 

				<div class="wrap-input100 input100-select">
					<span class="label-input100" id="co">Select country</span>
					<div>
						<select class="selection-2" name="country" required="required" data-error="Please specify your need.">
							<option>Choose Country</option>
							<option value="UK">UK</option>
                            <option value="US">US</option>
                            <option value="AU">Australia</option>
                            <option value="ES">Spain</option>
                            <option value="FR">France</option>
                            <option value="DE">Germany</option>
                            <option value="AT">Austria</option>
                            <option value="DK">Denmark</option>
                            <option value="IT">Italy</option>
                            <option value="NO">Norway</option>
                            <option value="SW">Sweden</option>
			    <option value="SWI">Swiss</option>
			    <option value="PL">Poland</option>
			 
                            <option value="others">Others</option>
						</select>
					</div>
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 input100-select">
					<span class="label-input100" id="in">Starting date(YYYY-MM-DD HH:MM:SS) </span>
					<div>
						<input class="input100" name="startd" type="text" data-error="Please specify your need."/>
							
					
					</div>
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 input100-select">
					<span class="label-input100">Ending date(YYYY-MM-DD HH:MM:SS) </span>
					<div>
						<input class="input100" name="endd" type="text" data-error="Please specify your need."/>
							
					
					</div>
					<span class="focus-input100"></span>
				</div>
				<div class="wrap-input100 input100-select " style="text-align: center;text-decoration-style: solid;">
				<b>	OR </b>
				</div>
				<div>
						<select class="selection-2" name="interval" required="required" data-error="Please specify your need.">
							<option>Select Interval</option>
							<option value="-5 mins">Last 5 mins</option>
							<option value="-10 mins">Last 10 mins</option>
							<option value="-15 mins">Last 15 mins</option>
							<option value="-30 mins">Last 30 mins</option>
							<option value="-1 hours">Last 1 hour</option>
							<option value="-2 hours">Last 2 hour</option>
							<option value="-4 hours">Last 4 hour</option>
							<option value="-6 hours">Last 6 hour</option>
							<option value="-12 hours">Last 12 hour</option>
							<option value="-24 hours">Last 24 hour</option>
                            <option value="-2 days">Last 2 days</option>              
                            <option value="-3 days">Last 3 days</option>

                            <option value="-5 days">Last 5 days</option>

                            <option value="-7 days">Last 7 days</option>
                            <option value="-14 days">Last 14 days</option>
                            <option value="-30 days">Last 1 month</option>
						</select>
					</div>
				<!-- <div class="wrap-input100 input100-select">
					<span class="label-input100">Select item</span>
					<div>
						<label class="checkbox-inline">
      						<input type="checkbox" value="">Quick Topup Success
    					</label>
    					<label class="checkbox-inline">
      						<input type="checkbox" value="">Purchase free sim Success with credit
    					</label>
    					<label class="checkbox-inline">
      						<input type="checkbox" value="">Option 3
    					</label>
					</div>
					<span class="focus-input100"></span>
				</div>
 -->
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							<span>
								<input type="Submit">
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
				<div class="w-full text-center p-t-55">
						<span class="txt2">
				
						</span>

						<a href="logout.php" class="txt2 bo1">
						Hi <?php echo $login_session; ?> Click here to logout
						</a>
					</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});



	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
  
</script>

</body>
</html>
