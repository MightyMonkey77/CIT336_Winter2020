<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/styles.css" type="text/css" rel="stylesheet" media="screen">
        <title><?php if(isset($clientData['clientFirstname'])){ echo "Change $clientData[clientFirstname] ";} 
                    elseif(isset($clientFirstname)) { echo $clientFirstname; }?> Customer Update</title>
    </head>
    <body>
        <header>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';
            ?>
        </header>
      
        <main>
             
            <h1>Customer Update</h1>
            <h2>Hello, <?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname']; ?> welcome!</h2>
            <h3>Below edit your information.</h3>
            
                
                <?php
                if(isset($_SESSION['message'])) {
                 echo "<div class='message'>";   
                 echo  $_SESSION['message'];
                 echo "</div>";
                 unset($_SESSION['message']);
                }
                ?>
            
            <div class="updateAcc">
            
            <form action="/acme/accounts/index.php" method="post">
                         
                <label>First Name: <br></label>
                <input name="clientFirstname" id="clientFirstname" type="text" placeholder="First Name"  
                    <?php if(isset($clientFirstname)) {echo "value='$clientFirstname'";} 
                    elseif(isset($_SESSION['clientData']['clientFirstname'])) {echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'"; }?> required>
                <br>
                        
                <label>Last Name: <br></label>
                <input name="clientLastname" id="clientLastname"  type="text" placeholder="Last Name"  
                    <?php if(isset($clientLastname)) {echo "value='$clientLastname'";} 
                    elseif(isset($_SESSION['clientData']['clientLastname'])) {echo "value='" . $_SESSION['clientData']['clientLastname'] . "'"; }?> required>
                <br>
                        
                <label>Email: <br></label>
                <input name="clientEmail" id="clientEmail" type="email" placeholder="email@example.com" 
                   <?php if(isset($clientEmail)) {echo "value='$clientEmail'";} 
                   elseif(isset($_SESSION['clientData']['clientEmail'])) {echo "value='" . $_SESSION['clientData']['clientEmail'] . "'"; }?> required>
                <br>
                
                
                    <input type="submit" name="submit" value="Account Update">
                    <input type="hidden" name="action" value="updateAccount">   
                    <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                          elseif(isset($clientId)){ echo $clientId; } ?>"> 
             
            </form>
            
            <br>
            <br>
            
            <form action="/acme/accounts/index.php" method="post">
                
                <label>New Password:</label>
                <br>
                <input name="clientPassword" id="clientPassword" type="password" required>
                <br>
                <span class="pwText">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
                <br>
                <input type="submit" name="submit" value="Password Update">
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                          elseif(isset($clientId)){ echo $clientId; } ?>">
                
                
            </form>
            
            
            
                
                
            </div>
        </main>
        
        <footer>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';
            ?>
        </footer>
        
    </body>
    
</html>        
