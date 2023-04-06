<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:admin.php');
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Administrator Home</title>
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
$admid=$row['staff_id'];
$title=$row['title'];
$name=$row['staff_name'];
            }
?> 
		<div id="logo"><img src="media/logo.jpg" alt="logo"><h1>HAEMATOLOGY INFORMATION SYSTEM</h1></div>
		<div class="userr">
		 <?php echo $role; ?> .  <?php echo $admid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
<div class="stats">
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from staff");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="allstaff.php">STAFF</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from staff where role='administrator'");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="alladmin.php">ADMINISTRATORS</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from staff where role='nurse'");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="allnurse.php">NURSES</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from staff where role='doctor'");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="alldoctor.php">DOCTORS</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from staff where role='lab technician'");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="alltech.php">TECHNICIANS</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from staff where role='pharmacist'");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="allpharma.php">PHARMACISTS</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from consultation where lab_result not in ('non applicable')");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="alllab.php">LAB RESULTS</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from consultation where prescription_status not in ('pending')");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="alldisp.php">DISPENSED</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from consultation");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="allconsult.php">CONSULTATIONS</a></div>
	</div>
	<div class="stat-main">
		<div id="stat1">
			<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$query1=mysqli_query($conn,"Select * from patient");
$result = mysqli_num_rows($query1);
    echo $result;?>
		</div>
		<div id="stat2"><a href="allpatient.php">PATIENTS</a></div>
	</div>
</div>
<a href="addstaff.php" class="addit">Add new staff</a><a class="dddd">*Click on category name to visit category.</a>
</body>
</html>