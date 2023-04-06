<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:nurse.php');
  } 

$ptid="";
$docid = "";
$temperature = "";
$pulse="";
$respiration="";
$weight="";
$systolic = "";
$diastolic = "";
$lab = "";
$prescription = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$ptid = $_POST['ptid'];
	$docid = $_POST['docid'];
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
			$SQL = $db_found->prepare("INSERT INTO consultation (patient_id, staff_id, temperature, pulse_rate, respiration, weight, systolic_pressure, diastolic_pressure, lab_result, prescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$SQL->bind_param('ssssssssss', $ptid, $docid, $temperature, $pulse, $respiration, $weight, $systolic, $diastolic, $lab, $prescription);
			$SQL->execute();
			$_SESSION['error'] = "Consultation created successfully";
			header ("Location: nurse-home.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add consultation";
	}
}
?>
<script>
	function myFunction(){
		alert("the consultation id is <?php $sql= "select * from consultation order by consultation_id desc limit 1";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$maxcon=$row['consultation_id'] + 1;
echo $maxcon;
            } ?>")
	}
</script>
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
$nurseid=$_SESSION['staffid'];
$sql= "select * from staff where staff_id='$nurseid' and role='nurse'";
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
		 <?php echo $role; ?> .  <?php echo $nurseid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="nurse-search.php">
		  	<input type="text" name="k" placeholder="search patient id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
		<div class="crepat">
			<h3>Create new consultation</h3>
			<form method="POST" action="createcon.php">
				<?php
$nurseid=$_SESSION['staffid'];
$sql= "select * from patient where patient_id='" . $_GET["pattid"] . "'";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$paidd=$row['patient_id'];
            }
?> 
			<div class="crept">
				<div class="crept1">
					<h4>Patient id:</h4>
				<input type="text" name="ptid" value="<?php  echo $paidd?>" required="">
				<h4>Assign Doctor:</h4>
				<select name="docid" required="">
				<option >Choose doctor id</option>
					<?php
$sql= "select * from staff where role='doctor'";
$query = $conn->query($sql);
				while ($row = mysqli_fetch_assoc($query)){
?> 
				<option ><?php  echo $row['staff_id'];?></option>
                <?php }?>
                </select>
					<h4>Temperature:</h4>
				<input type="text" name="temperature" placeholder="Enter patient temperature" required="">
					<h4>Pulse:</h4>
				<input type="text" name="pulse" placeholder="Enter patient pulse rate" required="">
					<h4>Respiration:</h4>
				<input type="text" name="respiration" placeholder="Enter patient respiration data" required="">
								</div>
				<div class="crept2">
					<h4>Weight:</h4>
				<input type="text" name="weight" placeholder="Enter patient weight" required="">
					<h4>Systolic pressure:</h4>
				<input type="text" name="systolic" placeholder="Enter patient systolic pressure" required="">
					<h4>Diastolic pressure:</h4>
				<input type="text" name="diastolic" placeholder="Enter patient diastolic pressure" required="">
					<h4>Lab results:</h4>
				<input type="text" name="lab" value="not applicable" required="">
				<h4>Prescription:</h4>
				<input type="text" name="prescription" value="not applicable" required="">
					
				</div>
			</div>
			<input type="submit" name="submit" value="Create new consultation" onclick="myFunction()">
			</form>
		</div>

</body>
</html>