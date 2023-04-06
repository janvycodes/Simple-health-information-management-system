<?php
require 'configure.php';

$sql = "DELETE FROM staff WHERE staff_id='" . $_GET["stfid"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header ('location: allstaff.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>