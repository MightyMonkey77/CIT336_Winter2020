<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Product | Acme, Inc.</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
          
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
            
            <?php if(isset($productDisplay)){ 
                echo $productDisplay;                
            } 
            ?>
            
            <?php
                if(isset($thumbnailDisplay)) {
                    echo $thumbnailDisplay;
                }
            ?>
            
            <hr>
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>
