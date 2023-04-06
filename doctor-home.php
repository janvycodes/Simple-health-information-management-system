<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:doctor.php');
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Doctor Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
	<header>
		<?php
$docid=$_SESSION['staffid'];
$sql= "select * from staff where staff_id='$docid' and role='doctor'";
$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
$role=$row['role'];
$doctid=$row['staff_id'];
$title=$row['title'];
$name=$row['staff_name'];
            }
?> 
		<div id="logo"><img src="media/logo.jpg" alt="logo"><h1>HAEMATOLOGY INFORMATION SYSTEM</h1></div>
		<div class="userr">
		 <?php echo $role; ?> .  <?php echo $docid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="doctor-search.php">
		  	<input type="text" name="k" placeholder="search consultation id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
<div class="crepat">
			<h3>New Consultations</h3>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$ret=mysqli_query($conn,"select * from consultation where date(condate)=current_date and prescription_status='pending'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<table class="tbl">
							<tr>
    <th>Consultation id</th>
    <th>Patient id</th> 
    <th>Staff id</th>
    <th>Temperature</th>
    <th>Weight</th>
    <th>Pulse rate</th>

  </tr>
  <tr>
<td><?php  echo $row['consultation_id'];?></td>
<td><?php  echo $row['patient_id'];?></td>
<td><?php  echo $row['staff_id'];?></td>
<td><?php  echo $row['temperature'];?></td>
<td><?php  echo $row['weight'];?></td>
<td><?php  echo $row['pulse_rate'];?></td>
<td><a id='anch' href="consult.php?conid=<?php echo $row["consultation_id"]; ?>">Begin Consultation</a></td>
  </tr>
<?php }?>
						</table>
</div>
</body>
</html>