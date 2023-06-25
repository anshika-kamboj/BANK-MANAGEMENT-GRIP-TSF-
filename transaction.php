<?php
// ...

function transferFunds($senderEmail, $receiverEmail, $transfer, $password) 
{
    global $mysqli;

    // Prepare and execute query to retrieve sender's account information
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $senderEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        // Verify if password matches
        if (password_verify($password, $row['password'])) {
            // Password matches, proceed with the transfer
            
            // Check if sender has sufficient balance
            if ($row['amount'] >= $transfer) {
                // Check if receiver's email exists
                $receiverQuery = "SELECT * FROM users WHERE email = ?";
                $receiverStmt = $mysqli->prepare($receiverQuery);
                $receiverStmt->bind_param("s", $receiverEmail);
                $receiverStmt->execute();
                $receiverResult = $receiverStmt->get_result();

                if ($receiverResult->num_rows === 1) {
                    // Prepare and execute query to update sender's amount
                    $updateSenderQuery = "UPDATE users SET amount = amount - ? WHERE email = ?";
                    $updateSenderStmt = $mysqli->prepare($updateSenderQuery);
                    $updateSenderStmt->bind_param("ds", $transfer, $senderEmail);
                    $updateSenderStmt->execute();

                    // Prepare and execute query to update receiver's amount
                    $updateReceiverQuery = "UPDATE users SET amount = amount + ? WHERE email = ?";
                    $updateReceiverStmt = $mysqli->prepare($updateReceiverQuery);
                    $updateReceiverStmt->bind_param("ds", $transfer, $receiverEmail);
                    $updateReceiverStmt->execute();

                    echo '<script>alert("Funds transferred successfully!" );</script>';
                } else {
                    echo '<script>alert("Receiver\'s account not found!" );</script>';
                }
            } else {
                echo '<script>alert("Insufficient balance!" );</script>';
            }
        } else {
            echo '<script>alert("Invalid password!" );</script>';
        }
    } else {
        echo '<script>alert("Sender\'s account not found!" );</script>';
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $hostname = 'localhost';    // database hostname
    $username = 'root';     //  database username
    $password = '';     // database password
    $database = 'banking_tsf';     //  database name

     // Create a new MySQLi instance
    $mysqli = new mysqli($hostname, $username, $password, $database);

    // Check if the connection was successful
    if ($mysqli->connect_errno) 
    {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }
     $senderEmail=$_POST['sender'];
     $receiverEmail=$_POST['receiver'];
     $transfer=$_POST['amount'];
     $password=$_POST['password'];

     transferFunds($senderEmail, $receiverEmail, $transfer, $password);
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
    <link rel="stylesheet" href="transaction.css">
    <title> BANK</title>
    <link rel="icon" type="image/x-icon" href="images/tsflogo.png">
</head>
<body>
    <div class="navbar">
        <div class="nav-logo">
            <img src="images/tsflogo.png" width="50" >
        </div>
          <a href="index.php" >HOME</a> 
        <a href="register.php">REGISTER</a>
        <a href="transaction.php"><div class="active">TRANSACTION</div> </a>
       <a href="customer.php">CUSTOMERS</a>
    </div><!--navbar-->
    <div class="container">
       <div class="welcome" style="height:27.5rem">
         <form action="transaction.php" method="POST">
                <label for="name">Transfer from :</label>
                <input type="text" id="sender" name="sender" placeholder="Senders Email"required><br>
                
                <label for="name" >Transfer to :</label>
                <input type="text" id="receiver" name="receiver" placeholder="Receivers Email "required><br>
                
                <label for="name">Amount : </label>
                <input type="text" id="amount" name="amount" placeholder="......." required><br>

                <label for="name">Sender's Password : </label>
                <input type="password" id="password" name="password" placeholder="......." required><br>
                
                <input type="submit" value="CONFIRM">
          </form>
       </div><!--welcome-->
    </div><!--container-->
</body>
</html>
