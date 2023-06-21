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
       <div class="welcome">
         <form action="transaction.php" method="POST">
                <label for="name">Transfer from :</label>
                <input type="text" id="name" name="name" value="Account number."required><br>
                
                <label for="name" >Transfer to  :</label>
                <input type="text" id="transaction" name="transaction" value="Account number."required><br>
                
                <label for="name">Amount : </label>
                <input type="password" id="confirm-password" name="confirm-password" value="......." required><br>
                
                <input type="submit" value="CONFIRM">
          </form>
       </div><!--welcome-->
    </div><!--container-->
</body>
</html>