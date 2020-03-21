<?php

/* 
 * Recipes Controller
 */

 // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the accounts model
    require_once '../model/recipes-model.php';
    //Call the functions Controller
    require_once '../library/functions.php';
    //Call the accounts model
    require_once '../model/accounts-model.php';
    
    // Create or access a Session 
    session_start();
 
    $categories = getCategories();
//    var_dump($categories);
//	exit;
    $recipes = getRecipeIds();
    
    $navList = navList();
      

    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
      
     }


    switch ($action){
        
                
        case 'addRecipe':
            
            include '../view/addRecipe.php';
            
            break;
                      
        case 'newRecipe':
            
            // Filter inputs
            $recipeName = filter_input(INPUT_POST, 'recipeName', FILTER_SANITIZE_STRING);
            $recipeImage = filter_input(INPUT_POST, 'recipeImage', FILTER_SANITIZE_STRING);
            $recipeThumbnail = filter_input(INPUT_POST, 'recipeThumbnail', FILTER_SANITIZE_STRING);
            $recipeIngredients = filter_input(INPUT_POST, 'recipeIngredients', FILTER_SANITIZE_STRING);
            $recipeInstructions = filter_input(INPUT_POST, 'recipeInstructions', FILTER_SANITIZE_STRING);
            $recipeAuthor = filter_input(INPUT_POST, 'recipeAuthor', FILTER_SANITIZE_STRING);
           
            
            // Check for missing data
            if(empty($recipeName) || empty($recipeImage) || empty($recipeThumbnail) || empty($recipeIngredients) || empty($recipeInstructions) || empty($recipeAuthor)){
             $message = '<p>Please provide information for all empty form fields.</p>';
             include '../view/addRecipe.php';
             exit; 
            }
                        
            $recOutcome = addRecipe($recipeName, $recipeImage, $recipeThumbnail, $recipeIngredients, $recipeInstructions, $recipeAuthor);
            
            // Check and report the result
            if($recOutcome === 1){
                
             $message = "<p>Thanks for adding $recipeName.</p>";
             include '../view/recipe_management.php'; 
             exit;
             }
             else
             {
             $message = "<p>Sorry, $recipeName could not be added.</p>";
             include '../view/addRecipe.php';
             exit;
            }
                       
            include '../view/addRecipe.php';
  
        break;
        
        case 'getRecipe':
            
            $recipeId = filter_input(INPUT_GET, 'recipeId', FILTER_SANITIZE_NUMBER_INT);
            echo $recipeId;
            exit;
            //showRecipe = showRecipe($recipeId);
            
            include '../view/seeRecipe.php';
            break;
            
        case 'login_user':
            
        default:
            
            include '../view/recipe_management.php';
                    
    }