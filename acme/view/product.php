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
            
            <hr>
            
            <?php
                if(isset($thumbnailDisplay)) {
                    echo $thumbnailDisplay;
                }
            ?>
            
            <hr>
           
          <?php
            
            if(!isset($_SESSION['loggedin'])) {
                    echo '<div class="spaceBetween"><p>You must be logged in to add a review. </p> '
                . '<div class="addCatProd"><a href="/acme/accounts/index.php?action=login">Login</a><br><hr></div>'; 
                }
                else
                { 
             
                echo "<div class='spaceBetween'>";                
                echo "<form method='post' action='/acme/reviews/index.php'>";
		echo "<h2>Add a Review</h2>";
                echo chunk_split(substr($_SESSION['clientData']['clientFirstname'],0,1),1) .  $_SESSION['clientData']['clientLastname'];
                echo "<br>";
		echo "<textarea name='reviewText' id='reviewText' placeholder='Your Review Here!' required></textarea>";
                echo "<br>"; ?>
                <input class='link' type='submit' value='Submit Review'>
                <input type='hidden' name='action' value='addUserReview'>
		<input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                    elseif(isset($clientId)){ echo $clientId; } ?>">
                <input type="hidden" name="invId"  value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>">     
		<?php 
                echo "</form>";
                echo"</div>";
                } ?>
          
            <br>
            <h2>Customer Reviews</h2>
            <h4>Below are the reviews that have been made for this product.</h4>
            <?php 
                if(isset($reviewsByInvItem)) {
                    echo $reviewsByInvItem;
                }
            ?>
            
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>
