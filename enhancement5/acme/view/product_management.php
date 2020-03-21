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
        
            <nav>
                <?php echo $navList;?>
            </nav>

        <main>
            
                       
            <h1>Product Management</h1>
            <p>Use selections below to add NEW products and/or categories. Thank you!</p>
            
            <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                }
                ?>
            
            <div class="addCatProd"> 
                
                <section>
                                                 
                    <a href="../products/index.php?action=category" title="add category">Add new Category</a>
                    <br>
                    <a href="../products/index.php?action=product" title="add a new product">Add new Product</a> 
                                 
                </section>    
                              
            </div> 
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>