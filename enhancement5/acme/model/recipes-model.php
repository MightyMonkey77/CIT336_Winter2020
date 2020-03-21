<?php

//Inserting data to the recipes table
function addRecipe($recipeName, $recipeImage, $recipeThumbnail, $recipeIngredients, $recipeInstructions, $recipeAuthor) {
    
    $db = acmeConnect();
    
    $sql = 'INSERT INTO recipes (recipeName, recipeImage, recipeThumbnail, recipeIngredients, recipeInstructions, recipeAuthor) 
            VALUES (:recipeName, :recipeImage, :recipeThumbnail, :recipeIngredients, :recipeInstructions, :recipeAuthor)';
    
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':recipeName', $recipeName, PDO::PARAM_STR);
    $stmt->bindValue(':recipeImage', $recipeImage, PDO::PARAM_STR);
    $stmt->bindValue(':recipeThumbnail', $recipeThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':recipeIngredients', $recipeIngredients, PDO::PARAM_STR);
    $stmt->bindValue(':recipeInstructions', $recipeInstructions, PDO::PARAM_STR);
    $stmt->bindValue(':recipeAuthor', $recipeAuthor, PDO::PARAM_STR);

    $stmt->execute();
    
    $rowsChanged = $stmt->rowCount();
    
    $stmt->closeCursor();
    
    return $rowsChanged;
}


//selecting data from the recipes table
function getRecipes() {
    
    $db = acmeConnect();
    
    $sql = 'SELECT * FROM recipes ORDER BY ASC';
     
    $stmt = $db->prepare($sql);
    
    $stmt->execute();
    
    $getRecipes = $stmt->rowCount();
    
    $stmt->closeCursor();
    
    return $getRecipes;
}