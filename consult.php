<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:doctor.php');
  } 

$consid="";
$temperature = "";
$pulse="";
$respiration="";
$weight="";
$systolic = "";
$diastolic = "";
$lab = "";
$prescription = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$consid = $_POST['consid'];
	$temperature = $_POST['temperature'];
	$pulse = $_POST['pulse'];
    $respiration = $_POST['respiration'];
	$weight = $_POST['weight'];
    $systolic= $_POST['systolic'];
    $diastolic = $_POST['diastolic'];
    $lab = $_POST['lab'];
    $prescription = $_POST['prescription'];


	$database = "kbth_db";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {		
			$SQL = $db_found->prepare("UPDATE consultation SET temperature='$temperature', pulse_rate='$pulse', respiration='$respiration', weight='$weight', systolic_pressure='$systolic', diastolic_pressure='$diastolic', lab_result='$lab', prescription='$prescription' WHERE consultation_id='$consid'");
			$SQL->execute();
			$_SESSION['error'] = "Consultation complete";
			header ("Location: doctor-home.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add consultation";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Nurse Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
	<header>
		<?php
$doctorid=$_SESSION['staffid'];
$sql= "select * from staff where staff_id='$doctorid' and role='doctor'";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$role=$row['role'];
$nurid=$row['staff_id'];
$title=$row['title'];
$name=$row['staff_name'];
            }
?> 
		<div id="logo"><img src="media/logo.jpg" alt="logo"><h1>HAEMATOLOGY INFORMATION SYSTEM</h1></div>
		<div class="userr">
		 <?php echo $role; ?> .  <?php echo $doctorid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="doctor-search.php">
		  	<input type="text" name="k" placeholder="search consultation id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
		<div class="crepat">
			<h3>Consultation slip   *  <a href="doctor-home.php" class="gtd">Go to Dashboard</a></h3> 
			<form method="POST" action="consult.php">
				<?php
$doctorid=$_SESSION['staffid'];
$sql= "select * from consultation where consultation_id='" . $_GET["conid"] . "' and prescription_status='pending'";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$conid=$row['consultation_id'];
$patid=$row['patient_id'];
$staffid=$row['staff_id'];
$temp=$row['temperature'];
$pulse=$row['pulse_rate'];
$resp=$row['respiration'];
$weight=$row['weight'];
$systolic=$row['systolic_pressure'];
$diastolic=$row['diastolic_pressure'];
$lab=$row['lab_result'];
$pres=$row['prescription'];
            }
?> 
			<div class="crept">
				<div class="crept1">
					<h4>Consultation id:</h4>
				<input type="text" name="consid" value="<?php  echo $conid?>" required="">
					<h4>Patient id:</h4>
				<input type="text" name="ptid" value="<?php  echo $patid?>" required="">
				<h4>Doctor id:</h4>
				<input type="text" name="stid" value="<?php  echo $staffid?>" required="">
					<h4>Temperature:</h4>
				<input type="text" name="temperature" value="<?php  echo $temp?>" required="">
					<h4>Pulse:</h4>
				<input type="text" name="pulse" value="<?php  echo $pulse?>" required="">
					<h4>Respiration:</h4>
				<input type="text" name="respiration" value="<?php  echo $resp?>" required="">
								</div>
				<div class="crept2">
					<h4>Weight:</h4>
				<input type="text" name="weight" value="<?php  echo $weight?>" required="">
					<h4>Systolic pressure:</h4>
				<input type="text" name="systolic" value="<?php  echo $systolic?>" required="">
					<h4>Diastolic pressure:</h4>
				<input type="text" name="diastolic" value="diastolic" required="">
					<h4>Lab results:</h4>
				<input type="text" name="lab" value="<?php  echo $lab?>">
				<h4>Prescription:</h4>
				<textarea name="prescription" required=""><?php  echo $pres?></textarea>
					
				</div>
			</div>
			<input type="submit" name="submit" value="Save and return to home">
			</form>
		</div>

</body>
</html>