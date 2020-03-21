<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme | Recipe Management</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
        <main>
            
                       
            <h1>Recipe Management</h1>
            <p>Use selections below to add NEW recipe. Thank you!</p>
            
            <?php
                if (isset($message)) {
                 echo "<span class='message'> $message </span>";
                }
                ?>
            
            <div class="addCatProd"> 
                
                <section>
                                                 
                    <a href="../recipes/index.php?action=addRecipe" title="add category">Add new Recipe</a>
                  
                                 
                </section>    
                              
            </div> 
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>