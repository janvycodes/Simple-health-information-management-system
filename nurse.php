 <?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'configure.php';

	    $staffid = $_POST['staffid'];
		if(!isset($_SESSION['attempt'])){
			$_SESSION['attempt'] = 0;
		}
		if($_SESSION['attempt'] == 3){
			$_SESSION['error'] = 'Attempt limit reached, try again after 10 minutes';
		}
		else{
			$sql = "SELECT * FROM staff WHERE staff_id = '$staffid' AND role='nurse'";
			$query = $conn->query($sql);
			if($query->num_rows > 0){
				$row = $query->fetch_assoc();
				if(password_verify($_POST['password'], $row['password'])){
					$_SESSION['staffid']=$row['staff_id'];
                    $_SESSION["loggedin"] = true;
					$_SESSION["staff_id"] = $staffid;
					$_SESSION['success'] = 'Login successful';
					header ('location: nurse-home.php');
                    unset($_SESSION['attempt']);
				}
				else{
					$_SESSION['error'] = '*Password incorrect, try again';
					$_SESSION['attempt'] += 1;
					if($_SESSION['attempt'] == 3){
						$_SESSION['attempt_again'] = time() + (10*60);
					}
				}
			}
			else{
				$_SESSION['error'] = 'Incorrect staff Id';
				$_SESSION['attempt'] += 1;
					if($_SESSION['attempt'] == 3){
						$_SESSION['attempt_again'] = time() + (10*60);
					}
			}

		}

	}
	else{
		$_SESSION['error'] = '';
	}

	if(isset($_SESSION['attempt_again'])){
		$now = time();
		if($now >= $_SESSION['attempt_again']){
			unset($_SESSION['attempt']);
			unset($_SESSION['attempt_again']);
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Nurse Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
	<Div class="nurse">
		<form method="POST" action="nurse.php" >
			<h3>NURSE LOGIN</h3>
			<input type="text" name="staffid" placeholder="Nurse Id" required="required"><br>
			<input type="password" name="password" placeholder="Password" required="required"><br>
			<?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php
					}
					?>
			<input type="submit" name="submit" value="LOG IN">
			<a href="index.php">Back to home</a>
		</form>
	</Div>
</body>
</html>