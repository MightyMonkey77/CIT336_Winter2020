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
            
        <div class='login'> 
            
            
            <form action='/acme/accounts/' method='post'> 
                
            <section>
                
               <label id="email">Email:</label><br>
               <input name='clientEmail' id='clientEmail' type='email'>
               <br>
               
               <label id="password">Password: </label><br>
               <input name='clientPassword' id='clientPassword' type='password'>
               
               <br>
               
               <input type='submit' name='submit' value='Login'>
               
               
                
            </section>
                
                <br>
                <br>
                
            <section>
                
                <h3>If you would like an account, please click the link below. Have a wonderful day! </h3>
                
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