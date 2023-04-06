<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:pharmacist.php');
  } 

$consultid = "";
$dispense = "";

if (isset($_POST['submit'])) {

	$consultid = $_POST['consultid'];
	$dispense = $_POST['dispense'];


	$database = "kbth_db";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {		
			$SQL = $db_found->prepare("UPDATE consultation SET prescription_status='$dispense' WHERE consultation_id='$consultid' ");
			$SQL->execute();
			$_SESSION['error'] = "result updated successfully successfully";
			header ("Location: pharmacist-home.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add staff";
	}
}
?>
<script>
	function myFunction(){
		alert("Drugs dispensed successfully")
	}
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Technician Home</title>
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
$techid=$row['staff_id'];
$title=$row['title'];
$name=$row['staff_name'];
            }
?> 
		<div id="logo"><img src="media/logo.jpg" alt="logo"><h1>HAEMATOLOGY INFORMATION SYSTEM</h1></div>
		<div class="userr">
		 <?php echo $role; ?> .  <?php echo $pharmid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="pharma-search.php">
		  	<input type="text" name="k" placeholder="search consultation id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
<div class="crepat">
			<h3>Enter lab report</h3>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$ret=mysqli_query($conn,"select * from consultation where prescription_status='pending' and prescription not in('not applicable')");
$cnt=1;?>
<table class="tbl">
							<tr>
    <th>Consultation id</th>
    <th>Patient id</th> 
    <th>Prescription</th>
    <th>Lab result</th>

  </tr><?php 
while ($row=mysqli_fetch_array($ret)) {

?>
  <tr>
 <form method="POST" action="prescribe.php" id="resf">
<td><input type="text" name="consultid" value="<?php  echo $row['consultation_id'];?>" required=""></td>
<td><?php  echo $row['patient_id'];?></td>
<td><?php  echo $row['prescription'];?></td>
<td><input type="text" name="dispense" value="dispensed" required=""></td>
<td><input type="submit" name="submit" value="Dispense" onclick="myFunction()"></td>
<td><a id='anch' href="pharmacist-home.php" ?>Home</a></td>
</form>
  </tr>
<?php }?>
						</table>
</div>
</body>
</html>