<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:pharmacist.php');
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
$pharmid=$_SESSION['staffid'];
$sql= "select * from staff where staff_id='$pharmid' and role='pharmacist'";
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
		 <?php echo $role; ?> .  <?php echo $pharid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="pharma-search.php">
		  	<input type="text" name="k" placeholder="search consultation id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
<div class="crepat">
			<h3>New Prescriptions</h3>

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
    <th>Prescription</th>

  </tr>
  <tr>
<td><?php  echo $row['consultation_id'];?></td>
<td><?php  echo $row['patient_id'];?></td>
<td><?php  echo $row['prescription'];?></td>
<td><a id='anch' href="prescribe.php?presid=<?php echo $row["consultation_id"]; ?>">Prescribe</a></td>
  </tr>
<?php }?>
						</table>
</div>
</body>
</html>