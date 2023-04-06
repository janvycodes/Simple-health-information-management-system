<?php
require 'configure.php';

$sql = "DELETE FROM patient WHERE patient_id='" . $_GET["patid"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    header ('location: allpatient.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>