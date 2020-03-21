<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
            <nav>
                <?php echo $navList;?>
            </nav>

        <main>
            
            <h1>Please Register to obtain an Account</h1>
            <p>ALL FIELDS ARE REQUIRED!</p>
            
            
                <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                }
                ?>
            
            
        <div class='login'> 
            
            <form action='/acme/accounts/index.php' method='post'>
            
            <section>
                
                <label id='clientFirstname'> First Name: </label> <br>
                <input name="clientFirstname" id="clientFirstname" type="text">
                <br>
                
                <label id='clientLastname'> Last Name: </label><br>
                <input name="clientLastname" id="clientLastname" type="text">
                <br>
                
                <label id='clientEmail'> Email: </label><br>
                <input name="clientEmail" id="clientFirstEmail" type="email">
                <br>
                
                <label id='clientPassword'> Password: </label><br>
                <input name="clientPassword" id="clientPassword" type="password">
                
                <br>
                
                <input type='submit' name='submit' value='Register'>
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="registration">
                
            </section>
                
            </form>    
            
        </div>    
           
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>