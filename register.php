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
        <div class="welcome" style="height:24rem margin-top:4rem">
            <form action="register.php" method="POST">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="e.g. ananya tiwari" required><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="e.g. ananyatiwari23@gmail.com" required><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="....." required><br>
                
                <label for="amount">Amount:</label>
                <input type="password" id="amount" name="amount" value="....." required><br>
                
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="e.g. 342154768" required><br>
                                
                <input type="submit" value="Register">
            </form>
        </div><!--welcome-->
    </div><!--container-->
</body>
</html>