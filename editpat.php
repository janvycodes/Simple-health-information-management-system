<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:nurse.php');
  } 

$pddd="";
$patname = "";
$dob = "";
$gender="";
$address="";
$parguardr="";
$parguardn = "";
$parguardc = "";

if (isset($_POST['submit'])) {

	$pddd = $_POST['pddd'];
	$patname = $_POST['patname'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
    $address = $_POST['address'];
	$parguardr = $_POST['parguardr'];
    $parguardn= $_POST['parguardn'];
    $parguardc = $_POST['parguardc'];


	$database = "kbth_db";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {		
			$SQL = $db_found->prepare("UPDATE PATIENT SET patient_name='$patname', dob='$dob', gender='$gender', address='$address', parguard='$parguardr', parguard_name='$parguardn', parguard_contact='$parguardc' WHERE patient_id='$pddd' ");
			$SQL->execute();
			$_SESSION['error'] = "Patient added successfully";
			header ("Location: nurse-home.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add staff";
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
			<h3>Add New Patient</h3>
			<form method="POST" action="editpat.php">
				<?php
$nurseid=$_SESSION['staffid'];
$sql= "select * from patient where patient_id='" . $_GET["pattid"] . "'";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$paidd=$row['patient_id'];
$pname=$row['patient_name'];
$db=$row['dob'];
$gder=$row['gender'];
$ads=$row['address'];
$parg=$row['parguard'];
$pargn=$row['parguard_name'];
$pargc=$row['parguard_contact'];
            }
?> 
			<div class="crept">
				<div class="crept1">
					<h3>Personal Details</h3>
					<h4>Patient id:</h4>
				<input type="text" name="pddd" value="<?php  echo $paidd?>" required="">
					<h4>Patient name:</h4>
				<input type="text" name="patname" value="<?php  echo $pname?>" required="">
					<h4>Date of birth:</h4>
				<input type="date" name="dob" required="" value="<?php  echo $db?>"  >
					<h4>Gender:</h4>
				<select name="gender" >
				<option ><?php  echo $gder?></option>
                <option >Male</option>
                <option >Female</option>
                <option >Other</option>
                </select>
								</div>
				<div class="crept2">
					<h3>Parent/Guardian Details</h3>
					<h4>Address:</h4>
				<input type="text" name="address" value="<?php  echo $ads?>" required="">
					<h4>Parent/Guardian:</h4>
				<select name="parguardr" >
				<option ><?php  echo $parg?></option>
                <option >Mother</option>
                <option >Father</option>
                <option >Guardian</option>
                </select>
					<h4>Parent/Guardian name:</h4>
				<input type="text" name="parguardn" value="<?php  echo $pargn?>"required="">
					<h4>Parent/Guardian contact:</h4>
					<input type="text" name="parguardc" value="<?php  echo $pargc?>" required="">
					<?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php
					}
					?>

				</div>
			</div>
			<input type="submit" name="submit" value="Update patient details">
			</form>
		</div>

</body>
</html>