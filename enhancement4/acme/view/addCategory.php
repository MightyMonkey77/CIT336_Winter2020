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
        
            <nav>
                <?php echo $navList;?>
            </nav>

        <main>
            
            <h1>Add the new Category below!</h1>
            
            <?php
                if (isset($message)) {
                    echo "<span class='message'> $message </span>";
                }
                ?>
            
        <div class="spaceBetween">
            
            <p>Use the form below to add a new category.</p>
            <p>Once finished it should show up in the selection bar above.</p>
            
            <form action="/acme/products/index.php" method="post">
                
                <label id="categoryName">Add new Category:</label><br>
                <input name="categoryName" id="categoryName" type="text">
                
                <input name="submit" type="submit" value="Add New Category">
                <input name="action" type="hidden" value="addCategory">
                
            </form>
            
        </div>    
            
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>
