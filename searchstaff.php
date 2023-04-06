<?php
session_start();
require 'configure.php';
if (strlen($_SESSION['staffid']==0)) {
  header('location:labtech.php');
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korle Bu Information System | Technician Search</title>
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
		  	<input type="text" name="k" placeholder="search consultation id..." autocomplete="off">
            <input type="submit" name="submit" value="search">
		</form>
		</div>
		<div class="search-area">
			<?php

					// CHECK TO SEE IF THE KEYWORDS WERE PROVIDED
					if (isset($_GET['k']) && $_GET['k'] != ''){
						
						// save the keywords from the url
						$k = trim($_GET['k']);

						// create a base query and words string
						$query_string = "select * from staff where";
						$display_words = "";

						// seperate each of the keywords
						$keywords = explode(' ', $k); 
						foreach($keywords as $word){
							$query_string .= " staff_id LIKE '%".$word."%' OR ";
							$display_words .= $word." ";
						}
						$query_string = substr($query_string, 0, strlen($query_string) - 3);

						// connect to the database
						$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

						$query = mysqli_query($conn, $query_string);
						$result_count = mysqli_num_rows($query);

						// check to see if any results were returned
						if ($result_count > 0){
                            ?>
 <div class="rslt">
                            <?php
                            echo '<b><u>'.$result_count.'</u></b>&nbsp; results found';
                            echo '<div class="rst">Your search for &nbsp;<i>'.$display_words.'</i></div> <hr /><br />';
                            ?>
    </div>
<div id="search">
    <?php
							
							// display search result count to user
                            
							// display all the search results to the user
							while ($row = mysqli_fetch_assoc($query)){
   ?>
   <div class="reslt">
   	<table>
   		<tr>
    <th>Sid id</th>
    <th>Title</th>
    <th>Name</th> 
    <th>DOB</th>
    <th>Gender</th>
    <th>Contact</th>
    <th>Role</th>

  </tr>
   		<tr>
<td><?php  echo $row['staff_id'];?></td>
<td><?php  echo $row['title'];?></td>
<td><?php  echo $row['staff_name'];?></td>
<td><?php  echo $row['dob'];?></td>
<td><?php  echo $row['gender'];?></td>
<td><?php  echo $row['contact'];?></td>
<td><?php  echo $row['role'];?></td>
<td><a id='anch' href="editstaff.php?stfid=<?php echo $row["staff_id"]; ?>">Edit</a></td>
<td><a id='del' href="delstaff.php?stfid=<?php echo $row["staff_id"]; ?>">Delete</a></td>
  </tr>
   	</table> 
   </div>
    <?php
							}?>
    </div>
<?php
						}
						else
							echo 'No results found. Please search something else.';
					}
					else
						echo '';
                 ?>
		</div>
</body>
</html>
