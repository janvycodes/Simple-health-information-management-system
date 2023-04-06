<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:labtech.php');
  } 

$consultid = "";
$result = "";

if (isset($_POST['submit'])) {

	$consultid = $_POST['consultid'];
	$result = $_POST['result'];


	$database = "kbth_db";

	$db_found = new mysqli(DB_SERVER, DB_USER, DB_PASS, $database );

	if ($db_found) {		
			$SQL = $db_found->prepare("UPDATE consultation SET lab_result='$result' WHERE consultation_id='$consultid' ");
			$SQL->execute();
			$_SESSION['error'] = "result updated successfully successfully";
			header ("Location: labtech-home.php");
		
	}
	else {
		$_SESSION['error'] = "Unable to add staff";
	}
}
?>
<script>
	function myFunction(){
		alert("result updated successfully")
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
$techid=$_SESSION['staffid'];
$sql= "select * from staff where staff_id='$techid' and role='lab technician'";
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
		 <?php echo $role; ?> .  <?php echo $techid; ?> .  <?php echo $title; ?>  <?php echo $name; ?> <a href="logout.php">Logout</a>
		</div>
	</header>
	<div class="search">
		<form method="GET" action="lab-search.php">
		  	<input type="text" name="k" placeholder="search consultation id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
<div class="crepat">
			<h3>Enter lab report</h3>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'kbth_db');
$ret=mysqli_query($conn,"select * from consultation where date(condate)=current_date and lab_result not in('non applicable')");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<table class="tbl">
							<tr>
    <th>Consultation id</th>
    <th>Patient id</th> 
    <th>Lab request</th>
    <th>Lab result</th>

  </tr>
  <tr>
 <form method="POST" action="labresult.php" id="resf">
<td><input type="text" name="consultid" value="<?php  echo $row['consultation_id'];?>" required=""></td>
<td><?php  echo $row['patient_id'];?></td>
<td><?php  echo $row['lab_result'];?></td>
<td><textarea name="result" placeholder="enter patient lab result" required=""></textarea></td>
<td><input type="submit" name="submit" value="Save result" onclick="myFunction()"></td>
<td><a id='anch' href="labtech-home.php" ?>Home</a></td>
</form>
  </tr>
<?php }?>
						</table>
</div>
</body>
</html>