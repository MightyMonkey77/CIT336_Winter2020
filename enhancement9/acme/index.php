<?php

/* 
 * Home Controller
 */

// Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 //Call the functions Controller
 require_once 'library/functions.php';
  //Get products model
 require_once 'model/products-model.php';
 // Accounts model
 require_once 'model/accounts-model.php';
 
 
    // Create or access a Session 
    session_start();
    
    $categoriesAndIds = getCategoriesAndIds();
  
    $categories = getCategories();
    
    $recipe = getRecipeIds();
    
    if (isset($_SESSION['loggedin'])) {
    $clientData = getClient($_SESSION['clientData']['clientEmail']);
    array_pop($clientData);
    }

    
    // Builds the Nav List via a created function
    $navList = navList();
    
    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
     $action = filter_input(INPUT_GET, 'action');
     }


    switch ($action){
        case 'something':
  
        break;
 
        default:
            
            include 'view/home.php';
    }