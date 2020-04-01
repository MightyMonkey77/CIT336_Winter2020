<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Edit Review | Acme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h2>Welcome, delete your review below.</h2>
            
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
            
        <form  action="/acme/reviews/index.php" method="post">
		
                   		
                <textarea name="reviewText" id="reviewText" required><?php if(isset($reviewText)){echo $reviewText;} else { echo $reviewInfo['reviewText']; } ?></textarea>
                
		<input type="submit" value="Delete Review">
		<input type="hidden" name="action" value="deleteReview" >
		<input type="hidden" name="reviewId" value="<?php if (isset($reviewId)) { echo $reviewId; } ?>">
		
                <div class="addCatProd">
		<a href="/acme/accounts/index.php?action=admin">Return to Profile</a>
                </div>
                
        </form>   
           
        </div>    
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>