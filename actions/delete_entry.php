<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hamlog";
$del_id = $_GET['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM logbook" . " WHERE id='" . $del_id . "'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php"); /* Redirect browser */
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>
