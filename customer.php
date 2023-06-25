
<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="customer.css">
    <title> BANK</title>
    <link rel="icon" type="image/x-icon" href="images/tsflogo.png">
</head>
<body>
    <div class="navbar" style="min-width:670px">
        <div class="nav-logo">
            <img src="images/tsflogo.png" width="50" >
        </div>
          <a href="index.php" >HOME</a> 
        <a href="register.php">REGISTER</a>
        <a href="transaction.php">TRANSACTION</a>
       <a href="customer.php"><div class="active">CUSTOMERS</div></a>
    </div><!--navbar-->
    <h1>Database Table</h1>

    <?php
    // Replace with your actual database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "banking_tsf";

    // Create a connection
    $mysqli = new mysqli($servername, $username, $password, $database);

    // Check for connection errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Fetch data from the database
    $query = "SELECT * FROM users";
    $result = $mysqli->query($query);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Start creating the HTML table
        echo '<table>';
        echo '<tr><th>Serial Number</th><th>Account Number</th><th>Name</th><th>Email Address</th><th>Amount</th></tr>';

        // Counter for serial number
        $serialNumber = 1;

        // Loop through each row of data
        while ($row = $result->fetch_assoc()) {
            // Display the data in table rows
            echo '<tr>';
            echo '<td>' . $serialNumber . '</td>';
            echo '<td>' . $row['account_number'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['amount'] . '</td>';
            echo '</tr>';

            // Increment the serial number
            $serialNumber++;
        }

        // Close the table
        echo '</table>';
    } else {
        // No rows found in the database
        echo 'No data found.';
    }

    // Close the database connection
    $mysqli->close();
    ?>
</body>
</html>

 