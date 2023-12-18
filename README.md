This is a Assignment to make vulnerable SQL Injection app, just a simple App i make.

The app Login now is not vulnerable, but if u want to make it vulnerable just remove the


    // Prepare and bind parameters to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();
 

and

$stmt->close();
    $conn->close();

on the login.php, but before that you can import the sql to ur phpmyadmin.
then try to insert the actual Username field (in the sql file i provided, it has "nasabah" value on username, you
can just enter nasabah on the username and ' OR 'a'='a on the password field
![Screenshot 2023-12-19 020257](https://github.com/YouKeyys/SQL-APP/assets/121857349/000ea690-155c-4ed4-94cd-cb4634665cd6)
