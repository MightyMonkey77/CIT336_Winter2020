<?php
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /acme/index.php'); 
        exit;
    }    
?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Image Management | Acme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h1>Image Management</h1>
            
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
            
            <h2>Add New Product Image</h2>
            <?php
             if (isset($message)) {
              echo $message;
             } ?>
            
            <div class="upload">
                
            <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
                
                <label for="invItem">Product</label><br>
                
                <?php echo $prodSelect; ?><br><br>
                
                <label>Upload Image:</label><br>
                                                              
                <input type="file" name="file1" id="file" class="file"><br>
                <input type="submit" class="regbtn" value="Upload Image">
                <input type="hidden" name="action" value="upload">
                
            </form>
            
            </div>
            
            <hr>
            
            <h2>Existing Images</h2>
                <p>If deleting an image, delete the thumbnail too and vice versa.</p>
                <?php
                    if (isset($imageDisplay)) {
                    echo $imageDisplay;
                } ?>
                
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>

<?php unset($_SESSION['message']); ?>