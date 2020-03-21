<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme | Add Product</title>
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
            
            <h1>Add the new Product below!</h1>
            <p>Using the inputs below please add the new product.</p>
            
            <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                 }
               ?>
            
            <div class="spaceBetween">
            
            <form action="/acme/products/index.php" method="post">
            
               <label>Category</label>
               <br>
               <div class="list">
               <?php echo $catList; ?> 
               </div>    
               <br>
               <label>Product Name:</label>
               <br>
                <input type='text' name='invName' id="invName" required>
               <br>
               <label>Description:</label>
               <br>
               <textarea class="textarea" rows="4" cols="50" name="invDescription" id="invDescription" placeholder="" required ></textarea> 
               <br>
               <label>Image:</label>
               <br>
                <input type="text" name="invImage" id="invImage" value="/acme/images/products/no-image.png" required>
               <br>
               <label>Thumbnail:</label>
               <br>
                <input type="text" name="invThumbnail" id="invThumbnail" value="/acme/images/products/no-image.png" required>
               <br>
               <label>Price:</label>
               <br>
                <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" required>
               <br>
               <label>Stock:</label>
               <br>
                <input type="number" name="invStock" id="invStock" min="0" required>
               <br>
               <label>Size:</label>
               <br>
                <input type="number" name="invSize" id="invSize" min="0" step="0.01" placeholder="Whole Numbers" required>
               <br>
               <label>Weight:</label>
               <br>
                <input type="number" name="invWeight" id="invWeight" min="0" step="0.01" required>
               <br>
               <label>Location:</label>
               <br>
                <input type="text" name="invLocation" id="invLocation" placeholder="City in which it is produced?" required>
               <br>
               <label>Vendor:</label>
               <br>
                <input type="text" name="invVendor" id="invVendor" placeholder="Vendor Name" required>
               <br>
               <label>Style:</label>
               <br>
                <input type="text" name="invStyle" id="invStyle" placeholder="Main building material?" required>
               <br>
               <br> 
               
               <input type="submit" name="submit" value="Add Product">
               <input type="hidden" name="action" value="addProduct" >
	       
               
            </form>
                
            </div>    
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>

