<?php
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /acme/index.php'); 
        exit;
    }

    // Build the categories option list
        echo '<div class="select">';
        $catList = '<select name="categoryId" id="categoryId">';
        $catList .= "<option>Choose a Category</option>";
        echo '<div class="listFont">';
        foreach ($categoriesAndIds as $category) {
         $catList .= "<option value='$category[categoryId]'";
         if(isset($categoryId)){
          if($category['categoryId'] === $categoryId){
           $catList .= ' selected ';
          }
         } elseif(isset($prodInfo['categoryId'])){
          if($category['categoryId'] === $prodInfo['categoryId']){
           $catList .= ' selected ';
          }
         }
        $catList .= ">$category[categoryName]</option>";
        }
        $catList .= '</select>';
        echo '</div>';
        echo '</div>';
    ?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title><?php if(isset($prodInfo['invName']))
                { echo "Modify $prodInfo[invName] ";} 
                elseif(isset($invName)) 
                { echo $invName; }?>
        | Acme, Inc.</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} 
                    elseif(isset($invName)) { echo $invName; }?></h1>
            
            <p>Using the inputs below please add the new product.</p>
            
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
            
            <div class="spaceBetween">
            
            <form action="/acme/products/index.php" method="post">
            
                <label>Category</label>
                <br>
                <div class="listModify">
                <?php echo $catList; ?> 
                </div>    
                <br>
                <label>Product Name:</label>
                <br>
                <input type='text' name='invName' id="invName" <?php if(isset($invName)){ echo "value='$invName'"; }  
                    elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?> required>
                <br>
                <label>Description:</label>
                <br>
                <textarea class="textarea" name="invDescription" id="invDescription" required><?php if(isset($invDescription)){ echo $invDescription; }
                    elseif(isset($prodInfo['invDescription'])) { echo $prodInfo['invDescription']; } ?>
                </textarea> 
                <br>
                <label>Image:</label>
                <br>
                <input type="text" name="invImage" id="invImage" value="/acme/images/products/no-image.png" <?php if(isset($invImage)){ echo "value='$invImage'"; }  
                    elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?> required>
                <br>
                <label>Thumbnail:</label>
                <br>
                <input type="text" name="invThumbnail" id="invThumbnail" value="/acme/images/products/no-image.png" <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; }  
                    elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?> required>
                <br>
                <label>Price:</label>
                <br>
                <input type="number" name="invPrice" id="invPrice" min="0" step="0.01" <?php if(isset($invPrice)){ echo "value='$invPrice'"; }  
                    elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?> required>
                <br>
                <label>Stock:</label>
                <br>
                <input type="number" name="invStock" id="invStock" min="0" <?php if(isset($invStock)){ echo "value='$invStock'"; }  
                    elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?> required>
                <br>
                <label>Size:</label>
                <br>
                <input type="number" name="invSize" id="invSize" min="0" placeholder="Whole Numbers" <?php if(isset($invSize)){ echo "value='$invSize'"; }  
                    elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?> required>
                <br>
                <label>Weight:</label>
                <br>
                <input type="number" name="invWeight" id="invWeight" min="0" step="0.01" <?php if(isset($invWeight)){ echo "value='$invWeight'"; }  
                    elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> required>
                <br>
                <label>Location:</label>
                <br>
                <input type="text" name="invLocation" id="invLocation" placeholder="City in which it is produced?" <?php if(isset($invLocation)){ echo "value='$invLocation'"; }  
                    elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?> required>
                <br>
                <label>Vendor:</label>
                <br>
                <input type="text" name="invVendor" id="invVendor" placeholder="Vendor Name" <?php if(isset($invVendor)){ echo "value='$invVendor'"; }  
                    elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> required>
                <br>
                <label>Style:</label>
                <br>
                <input type="text" name="invStyle" id="invStyle" placeholder="Main building material?" <?php if(isset($invStyle)){ echo "value='$invStyle'"; }  
                    elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?> required>
                <br>
                <br> 
               
                <input type="submit" name="submit" value="Update Product">
                <input type="hidden" name="action" value="updateProduct">
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

<?php unset($_SESSION['message']); ?>

