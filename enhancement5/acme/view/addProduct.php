<?php
$catList = "<select name='categoryId' id='categoryId' class='list' required>";
    $catList .= '<option value ="">Select Your Category</option>';
    foreach ($categoriesAndIds as $catAndId) {
       $catList .= "<option value='$catAndId[categoryId] . '";
       if(isset($categoryId)){
           if($catAndId['categoryId'] === $categoryId) {
               $catList .= ' selected ';
           }
       }
       $catList .= ">$catAndId[categoryName]</option>";
    }
    $catList .= "</select>";
?>
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
                <input type='text' name='invName' id="invName" <?php if(isset($invName)){echo "value='$invName'";}?> required>
               <br>
               <label>Description:</label>
               <br>
               <textarea class="textarea" rows="4" cols="50" name="invDescription" id="invDescription" required <?php if(isset($invDescription)){echo "value='$invDescription'";}?>></textarea> 
               <br>
               <label>Image:</label>
               <br>
                <input type="text" name="invImage" id="invImage" value="/acme/images/products/no-image.png" <?php if(isset($invImage)){echo "value='$invImage'";}?> required>
               <br>
               <label>Thumbnail:</label>
               <br>
                <input type="text" name="invThumbnail" id="invThumbnail" value="/acme/images/products/no-image.png" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}?> required>
               <br>
               <label>Price:</label>
               <br>
                <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" <?php if(isset($invPrice)){echo "value='$invPrice'";}?> required>
               <br>
               <label>Stock:</label>
               <br>
                <input type="number" name="invStock" id="invStock" min="0" <?php if(isset($invStock)){echo "value='$invStock'";}?> required>
               <br>
               <label>Size:</label>
               <br>
                <input type="number" name="invSize" id="invSize" min="0" placeholder="Whole Numbers" <?php if(isset($invSize)){echo "value='$invSize'";}?> required>
               <br>
               <label>Weight:</label>
               <br>
                <input type="number" name="invWeight" id="invWeight" min="0" step="0.01" <?php if(isset($invWeight)){echo "value='$invWeight'";}?> required>
               <br>
               <label>Location:</label>
               <br>
                <input type="text" name="invLocation" id="invLocation" placeholder="City in which it is produced?" <?php if(isset($invLocation)){echo "value='$invLocation'";}?> required>
               <br>
               <label>Vendor:</label>
               <br>
                <input type="text" name="invVendor" id="invVendor" placeholder="Vendor Name" <?php if(isset($invVendor)){echo "value='$invVendor'";}?> required>
               <br>
               <label>Style:</label>
               <br>
                <input type="text" name="invStyle" id="invStyle" placeholder="Main building material?" <?php if(isset($invStyle)){echo "value='$invStyle'";}?> required>
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

