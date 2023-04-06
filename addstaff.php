<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:admin.php');
  } 

$title = "";
$staffname = "";
$dob="";
$gender="";
$address="";
$contact = "";
$role = "";
$department = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$title = $_POST['title'];
	$staffname = $_POST['staffname'];
	$dob = $_POST['dob'];
    $gender = $_POST['gender'];
	$address = $_POST['address'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $password = $_POST['password'];


	$database = "kbth_db";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {		
			$phash = password_hash($password, PASSWORD_DEFAULT);
			$SQL = $db_found->prepare("INSERT INTO staff (title, staff_name, dob, gender, address, contact, role, department, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$SQL->bind_param('sssssssss', $title, $staffname, $dob, $gender, $address, $contact, $role, $department, $phash);
			$SQL->execute();
			$_SESSION['error'] = "User created successfully";
			header ("Location: allstaff.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add staff";
	}
}
?>
<script>
	function myFunction(){
		alert("the staff id is <?php $sql= "select * from staff order by staff_id desc limit 1";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$maxcon=$row['staff_id'] + 1;
echo $maxcon;
            } ?>")
	}
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Add staff Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
	<header>
		<?php
$adminid=$_SESSION['staffid'];
$sql= "select * from staff where staff_id='$adminid' and role='administrator'";
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
		 <?php echo $role; ?> .  <?php echo $adminid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a> <a href="admin-home.php">Home</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="searchstaff.php">
		  	<input type="text" name="k" placeholder="search patient id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
		<div class="crepat">
			<h3>Add new staff</h3>
			<form method="POST" action="addstaff.php">
			<div class="crept">
				<div class="crept1">
					<h4>Title:</h4>
				<select name="title" >
				<option >-select title-</option>
                <option >Mr.</option>
                <option >Mrs.</option>
                <option >Ms.</option>
                 </select>
				<h4>Staff name:</h4>
				<input type="text" name="staffname" placeholder="enter name" required="required">
					<h4>Date of birth:</h4>
				<input type="date" name="dob" required="required">
					<h4>Gender:</h4>
				<select name="gender" >
				<option >-select gender-</option>
                <option >Male</option>
                <option >Female</option>
                <option >Other</option>
                </select>
					<h4>Address:</h4>
				<input type="text" name="address" placeholder="address" required="required">
								</div>
				<div class="crept2">
					<h4>Contact:</h4>
				<input type="text" name="contact" placeholder="enter contact" required="required">
					<h4>Job role:</h4>
				<select name="role"  >
				<option >-select staff role-</option>
				<option >Administrator</option>
                <option >Nurse</option>
                <option >Doctor</option>
                <option >Lab Technician</option>
                <option >Pharmacist</option>
                </select>
					<h4>Department:</h4>
				<select name="department">
	            <option >-select staff department-</option>
	            <option >Administration</option>
                <option >Child department</option>
                <option >Haematic department</option>
                <option >Laboraory department</option>
                <option >Dispensory department</option>
                </select>
					<h4>Create password:</h4>
				<input type="password" name="password" placeholder="Password" required="required">
					
				</div>
			</div>
			<?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php
					unset($_SESSION['error']);
					}
					?>
			<input type="submit" name="submit" value="Create new staff" onclick="myFunction()">
			</form>
		</div>

</body>
</html>