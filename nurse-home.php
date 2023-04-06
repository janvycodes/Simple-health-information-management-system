<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:nurse.php');
  } 
$patname = "";
$dob = "";
$gender="";
$address="";
$parguardr="";
$parguardn = "";
$parguardc = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
			$SQL = $db_found->prepare("INSERT INTO patient (patient_name, dob, gender, address, parguard, parguard_name, parguard_contact) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$SQL->bind_param('sssssss', $patname, $dob, $gender, $address, $parguardr, $parguardn, $parguardc);
			$SQL->execute();
			$_SESSION['error'] = "Patient added successfully";
			header ("Location: nurse-home.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add staff";
	}
}
?>
<script>
	function myFunction(){
		alert("the new patient id is <?php $sql= "select * from patient order by patient_id desc limit 1";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$maxrole=$row['patient_id'] + 1;
echo $maxrole;
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
			<h3>Add New Patient</h3>
			<form method="POST" action="nurse-home.php">
			<div class="crept">
				<div class="crept1">
					<h3>Personal Details</h3>
					<h4>Patient name:</h4>
				<input type="text" name="patname" placeholder="Enter patient name.." required="">
					<h4>Date of birth:</h4>
				<input type="date" name="dob" required="">
					<h4>Gender:</h4>
				<select name="gender" >
				<option >-select gender-</option>
                <option >Male</option>
                <option >Female</option>
                <option >Other</option>
                </select>
					<h4>Address:</h4>
				<input type="text" name="address" placeholder="Enter patient address.." required="">
				</div>
				<div class="crept2">
					<h3>Parent/Guardian Details</h3>
					<h4>Parent/Guardian:</h4>
				<select name="parguardr">
				<option >-select relation-</option>
                <option >Mother</option>
                <option >Father</option>
                <option >Guardian</option>
                </select>
					<h4>Parent/Guardian name:</h4>
				<input type="text" name="parguardn" placeholder="Enter parent/guardian name.." required="">
					<h4>Parent/Guardian contact:</h4>
					<input type="text" name="parguardc" placeholder="Enter parent/guardian contact.." required="">
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
			<input type="submit" name="submit" value="Add patient" onclick="myFunction()">
			</form>
		</div>

</body>
</html>