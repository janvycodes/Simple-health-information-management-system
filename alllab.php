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
    <title>Korle Bu Information System | administrator</title>
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
$pharid=$row['staff_id'];
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
		<form method="GET" action="searchconsult.php">
		  	<input type="text" name="k" placeholder="search patient id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
<div class="crepat">
			<h3>All Staff</h3>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$ret=mysqli_query($conn,"select * from consultation");
$cnt=1;
?>
<table class="tbl">
							<tr>
    <th>Consultation id</th>
    <th>Patient id</th> 
    <th>Staff id</th>
    <th>Temperature</th>
    <th>Pulse</th>
    <th>Weight</th>
    <th>Lab result</th>
    <th>Prescription</th>

  </tr>
  <?php
while ($row=mysqli_fetch_array($ret)) {

?>
  <tr>
<td><?php  echo $row['consultation_id'];?></td>
<td><?php  echo $row['patient_id'];?></td>
<td><?php  echo $row['staff_id'];?></td>
<td><?php  echo $row['temperature'];?></td>
<td><?php  echo $row['pulse_rate'];?></td>
<td><?php  echo $row['weight'];?></td>
<td><?php  echo $row['lab_result'];?></td>
<td><?php  echo $row['prescription'];?></td>
  </tr>
<?php }?>
						</table>
</div>
</body>
</html>