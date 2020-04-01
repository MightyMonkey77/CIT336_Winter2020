<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Acme | Add Recipe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
      
        <main>
            
            <h1>Add the new Recipe below!</h1>
            
            <?php
                if (isset($message)) {
                    echo "<span class='message'> $message </span>";
                }
                ?>
            
                <p>Use the form below to add a new recipe.</p>
                
                
        <div class="spaceBetween">
            
                        
            <form action="/acme/recipes/index.php" method="post">
                
                <label>Recipe Name:</label><br>
                <input name="recipeName" id="recipeName" type="text" <?php if(isset($recipeName)){echo "value='$recipeName'";}?> required>
                <br>
                 <input type="text" name="recipeImage" id="recipeImage" value="/acme/images/recipes/no-image.png" <?php if(isset($recipeImage)){echo "value='$recipeImage'";}?> required>
                <br>
                <label>Thumbnail:</label>
                <br>
                <input type="text" name="recipeThumbnail" id="recipeThumbnail" value="/acme/images/recipes/no-image.png" <?php if(isset($recipeThumbnail)){echo "value='$recipeThumbnail'";}?> required>
                <br>
                <label>Ingredients:</label><br>
                <textarea class="textarea" rows="4" cols="50" name="recipeIngredients" id="recipeIngredients" required <?php if(isset($recipeIngredients)){echo "value='$recipeIngredients'";}?>></textarea>
                <br>
                <label>Instructions:</label><br>
                <textarea class="textarea" rows="4" cols="50" name="recipeInstructions" id="recipeInstructions" required <?php if(isset($recipeInstructions)){echo "value='$recipeInstructions'";}?>></textarea>
                <br>
                <label>Author:</label><br>
                <input name="recipeAuthor" id="recipeAuthor" type="text" <?php if(isset($recipeName)){echo "value='$recipeName'";}?> required>
                <br>
                <input name="submit" type="submit" value="Add Recipe">
                <input name="action" type="hidden" value="newRecipe">
                
            </form>
            
        </div>    
            
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
        <?php unset($_SESSION['message']); ?>
        
    </body>
    
</html>
