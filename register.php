<?php
function generateAccountNumber($name, $email, $password, $amount) 
{
    // Connect to the database
    $hostname = 'localhost';    // Replace with your database hostname
    $username = 'root';         // Replace with your database username
    $db_password = '';          // Replace with your database password
    $database = 'banking_tsf';  // Replace with your database name
    
    // Create a new MySQLi instance
    $mysqli = new mysqli($hostname, $username, $db_password, $database);
    
    // Check if the email already exists in the database
    $query = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Email already registered
        echo '<script>alert("Error: This email is already registered.");</script>';
        return;
    }

    // Generate a unique account number
    $accountNumber = generateUniqueAccountNumber($mysqli);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the data into the table
    $query = "INSERT INTO users (name, email, password, amount, account_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssi", $name, $email, $hashedPassword, $amount, $accountNumber);
    
    if ($stmt->execute()) {
        // Data inserted successfully
        echo '<script>alert("Data inserted successfully. Account number: ' . $accountNumber . '");</script>';
    } else {
        // Error occurred while inserting data
        echo '<script>alert("Error: Failed to insert data.");</script>';
    }

    // Close the statement and database connection
    $stmt->close();
    $mysqli->close();
}

function generateUniqueAccountNumber($mysqli) {
    $accountNumber = uniqid();

    $query = "SELECT COUNT(*) FROM users WHERE account_number = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $accountNumber);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Duplicate account number found, regenerate a new one
        $accountNumber = generateUniqueAccountNumber($mysqli);
    }

    return $accountNumber;
}

// Usage example:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $amount = $_POST['amount'];

    // Call the function to generate account number and store the data
    generateAccountNumber($name, $email, $password, $amount);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="register.css">
    <title> BANK</title>
    <link rel="icon" type="image/x-icon" href="images/tsflogo.png">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo">
            <img src="images/tsflogo.png" width="50" >
        </div>
        <a href="index.php" >HOME</a> 
        <a href="register.php"><div class="active">REGISTER</div></a>
        <a href="transaction.php">TRANSACTION</a>
        <a href="customer.php">CUSTOMERS</a>
    </div><!--navbar-->
    <div class="container">
        <div class="welcome">
            <form action="register.php" method="POST">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="e.g. ananya tiwari" required><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="e.g. ananyatiwari23@gmail.com" required><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="....." required><br>
                
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" placeholder="....." required><br>
                
                <input type="submit" value="Register">
            </form>
        </div><!--welcome-->
    </div><!--container-->
</body>
</html>
