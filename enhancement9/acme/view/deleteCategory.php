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
        <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?> | Acme, Inc.</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName]";} ?></h1>
            
            <p>Confirm Product Deletion. The delete is permanent.</p>
            
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
                <br> 
               
                <input type="submit" name="submit" value="Delete Category">
                <input type="hidden" name="action" value="deleteCategory">
                <input type="hidden" name="categoryId"  value="<?php if(isset($catInfo['categoryId'])){ echo $catInfo['categoryId'];} 
                    elseif(isset($categoryId)){ echo $categoryId; } ?>">
	       
               
            </form>
                
            </div>    
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
                
    </body>
    
</html>

<?php unset($_SESSION['message']); ?>