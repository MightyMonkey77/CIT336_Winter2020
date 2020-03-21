<?php
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
        header('location: /acme/index.php'); 
        exit;
    }
    
    $clientData = getClient($_SESSION['clientData']['clientEmail']); 
    if(!$_SESSION['loggedin']) {
        header('Location: /acme/');
        exit;
 }
?>
<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme | Product Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        
        <main>
            
                       
            <h1>Product Management</h1>
            <p>Use selections below to add NEW products and/or categories. Thank you!</p>
            
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
            
            <div class="addCatProd"> 
                
                <section class="sectionBox">
                                                 
                    <a href="../products/index.php?action=catAdd" title="add category">Add new Category</a>
                    <br>
                    <a href="../products/index.php?action=product" title="add a new product">Add new Product</a> 
                                 
                </section>    
                              
            </div>
            
            <div class="center">
            <?php              
                if (isset($categoryList)) { 
            ?>
            
            <div class="prodModDel">
                 <h2>Products By Category</h2> 
                 <p>Choose a category to Modify or Delete a product!</p> 
                 <div class="list">
            <?php echo $categoryList; 
                }
            ?>
                 </div>
            </div>              
                <br> 
            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table class="prodModDelList" id="productsDisplay"></table>
     
            </div> 
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
        <script src="../js/products.js"></script> 
            
          
    </body>
    
</html>

<?php unset($_SESSION['message']); ?>