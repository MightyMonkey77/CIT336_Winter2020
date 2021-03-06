<?php
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /acme/index.php'); 
        exit;
    }    
?>
<?php
echo '<div class="select">';
$catList = "<select name='categoryId' id='categoryId' required>";
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
echo '</div>';    
?>
<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme | Add Category</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
            <h1>Add the new Category below!</h1>
            
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
            
                <p>Use the form below to add a new category.</p>
                <p>Once finished it should show up in the selection bar above.</p>
                
        <div class="spaceBetween">
            
                        
            <form action="/acme/products/index.php" method="post">
                
                <label id="categoryName">Add new Category:</label><br>
                <input name="categoryName" id="categoryName" type="text" <?php if(isset($categoryName)){echo "value='$categoryName'";}?> required>
                
                <input name="submit" type="submit" value="Add New Category">
                <input name="action" type="hidden" value="addCategory">
                
            </form>
                    
            
        </div>    
            
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
        <?php unset($_SESSION['message']); ?>
        
    </body>
    
</html>
