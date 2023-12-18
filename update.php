<?php
// Include the connection.php file
require_once 'connection.php';

// Check if the ID parameter and form data are provided
if (isset($_POST['id']) && isset($_POST['nasabah']) && isset($_POST['balance'])) {
    $id = $_POST['id'];
    $nasabah = $_POST['nasabah'];
    $balance = $_POST['balance'];

    // Update the record in the database based on the ID
    $query = "UPDATE banking_records SET nasabah = '$nasabah', balance = '$balance' WHERE id = $id";
    $result = mysqli_query($connection, $query);

    // Check if the record was successfully updated
    if ($result) {
        // Display success message using JavaScript alert
        echo '<script>alert("Record updated successfully.");</script>';
        // Redirect back to the dashboard
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
} else {
    echo "ID parameter or form data not provided.";
}

// Close the database connection
mysqli_close($connection);
?>