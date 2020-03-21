<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme Login</title>
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
            
            <h1>Please Login to your Account</h1>
            
             <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                }
                ?>
            
        <div class='login'> 
            
            
            <form action='/acme/accounts/index.php' method='post'> 
                
            <section>
                
               <label id="email">Email:</label><br>
               <input name='clientEmail' id='clientEmail' type='email' <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> required>
               <br>
               
               <label id="password">Password: </label><br>
               <input name='clientPassword' id='clientPassword' type='password' pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
               <br>
               <span class="pwText">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character.</span>
               
               <br>
               
               <input type='submit' name='submit' value='Login'>
               <input type="hidden" name="action" value="login_user">
               
                
            </section>
                
            </form>     
            
            
                <br>
                <br>
            
            <form action='/acme/accounts/index.php' method='post'>   
            <section>
                
                <h4>If you would like an account, please click the link below. Have a wonderful day! </h4>
                
                <input type='submit' name='register user' value='Register'>
                <input type='hidden' name='action' value='register'>
                
            </section>
            </form>    
            
        </div>    
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>