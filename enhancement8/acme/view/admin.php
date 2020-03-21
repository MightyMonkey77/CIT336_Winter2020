<?php
    if(!$_SESSION['loggedin']) {
        header('location: /acme/index.php');
        exit;
        }
?>
<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>ACME | Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h1>Admin Page</h1>
            
            <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                }
                if(isset($_SESSION['message'])) {
                 echo "<div class='message'>";   
                 echo  $_SESSION['message'];
                 echo "</div>";
                 unset($_SESSION['message']);
                } 
                ?>   
            
        <div class="adminData">
         
            
            <h1 class="textColor">Welcome, <?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname']; ?> to the Administration Page</h1>
            <h3 class="textColor">Here you will be able to change your account information.</h3>
            
            <?php 
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
            ?>
                        
            <div class="boxData">
            
            <ul>
                
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                
                <li>Email: <?php echo  $_SESSION['clientData']['clientEmail']; ?></li>
                
            </ul>
                
                <p>You are currently logged in.</p>
               
                <a href=" ../accounts/index.php?action=updateAcc" title="Update User Account">Update Account</a>
            
            <?php 
                if($_SESSION['clientData']['clientLevel'] > 1) { ?>
                    <h1>Product Management</h1>
                    <h3>Below you can make changes to the Products database. Tread carefully!</h3>
                    <a href="../products/index.php" title="Products Management">Product Management</a>
                <?php } ?>
                    
            </div>
        </div>     
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
        <?php unset($_SESSION['message']); ?>
        
    </body>
    
</html>

<?php unset($_SESSION['message']);?>