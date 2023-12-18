<?php
include 'connection.php';
// Start the session
session_start();

if(!isset($_SESSION['username'])){
    header('Location: login.php');
}

// Create connection
$conn = new mysqli('localhost', 'root', '', 'banking_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"]. "<br>";// Create connection
        $connection = new mysqli('localhost', 'root', '', 'banking_system');
        
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
    }
} else {
    echo "No user found";
}
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
        a {
            text-decoration: none;
            color: #007bff;
        }
        h2 {
            margin-top: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .action-column a {
            margin-right: 5px;
        }
        
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>

    <h2>CRUD Table</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nasabah</th>
                <th>Balance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Add your database connection code here

            // Fetch data from the database
            $query = "SELECT * FROM banking_records";
            $result = mysqli_query($connection, $query);

            // Loop through the fetched data and display it in the table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nasabah'] . "</td>";
                echo "<td>" . $row['balance'] . "</td>";
                echo "<td class='action-column'>";
                echo "<a href='edit.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a href='delete.php?id=" . $row['id'] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </tbody>
    </table>
</body>
</html>

