<?php
// Include the connection.php file
require_once 'connection.php';

// Check if the ID parameter is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record from the database based on the ID
    $query = "SELECT * FROM banking_records WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $record = mysqli_fetch_assoc($result);

    // Check if the record exists
    if ($record) {
        // Display the edit form with the pre-filled data
        ?>
       <!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Record</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
        <label for="nasabah">Nasabah:</label>
        <input type="text" name="nasabah" value="<?php echo $record['nasabah']; ?>"><br>
        <label for="balance">Balance:</label>
        <input type="text" name="balance" value="<?php echo $record['balance']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

        <?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "ID parameter not provided.";
}

// Close the database connection (if necessary)
mysqli_close($connection);
?>