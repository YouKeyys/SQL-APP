<?php
require_once 'connection.php';

// Check if the ID parameter is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record from the database based on the ID
    $query = "DELETE FROM banking_records WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // Check if the record was successfully deleted
    if ($result) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    echo "ID parameter not provided.";
}

// Close the database connection
mysqli_close($connection);
?>