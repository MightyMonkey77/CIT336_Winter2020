<?php

/* 
 * Accounts Controller
 */

// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 
    $categories = getCategories();
//    var_dump($categories);
//	exit;
    
    // Build a navigation bar using the $categories array
    $navList = '<ul>';
    $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
     $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
//    echo $navList;
//    exit;
    

    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
      
     }


    switch ($action){
        
        case 'login':
            include '../view/login.php';
            break;
            
        case 'login_user':
            
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');
            
            echo $clientEmail;
                    exit;
            
            include '../view/login.php';
            break;
            
        case 'register':
            include '../view/registration.php';
            break;
                
        case 'registration':
            
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
            $clientLastname = filter_input(INPUT_POST, 'clientLastname');
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');
            
            include '../view/registration.php';
  
        break;
 
        default:
            
            
    }