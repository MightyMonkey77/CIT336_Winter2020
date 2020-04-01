<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Add Review | Acme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h1>Welcome, here you can add your review of the product selected.</h1>
            
            <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                }
                ?>
            
            <?php 
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
            ?>
        
        <div class="spaceBetween">    
            
        <form action="/acme/reviews/index.php" method="post"> 
            
            <label>Your Review:</label><br>
            <textarea name="reviewText" id="reviewText" <?php if(isset($reviewText)){echo "value='$reviewText'";}?> required></textarea>
            
            <hr>
            
            <input type="submit" name="submit" value="Add Review">
            <input type="hidden" name="action" value="addReview">   
            <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                elseif(isset($clientId)){ echo $clientId; } ?>">
            <input type="hidden" name="invId"  value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>">
        </form>    
           
        </div>    
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>