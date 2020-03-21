<?php

/* 
 * Accounts Controller
 */

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the acme model for use as needed
    require_once '../model/acme-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    //Call the functions Controller
    require_once '../library/functions.php';
 
    $categories = getCategories();
//    var_dump($categories);
//	exit;
    
    $navList = navList();
    

    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
      
     }


    switch ($action){
        
                
        case 'register':
            
            include '../view/registration.php';
            
            break;
                      
        case 'registration':
            
            // Filter inputs
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            
            //Check for valid email
            $clientEmail = checkEmail($clientEmail);
            
            //Check for valid password pattern
            $checkPassword = checkPassword($clientPassword);
            
            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
             $message = '<p>Please provide information for all empty form fields.</p>';
             include '../view/registration.php';
             exit; 
            }
            
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
            
            // Check and report the result
            if($regOutcome === 1){
             $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
             include '../view/login.php';
             exit;
            } else {
             $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
             include '../view/registration.php';
             exit;
            }
                       
            include '../view/registration.php';
  
        break;
        
        case 'login':
            include '../view/login.php';
            break;
            
        case 'login_user':
            
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');
            
            $clientEmail = checkEmail($clientEmail);
            
            $checkPassword = checkPassword($clientPassword);
            
            if(empty($clientEmail) || empty($checkPassword)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit;
            }
            
            echo $clientEmail;
                    exit;
            
            include '../view/login.php';
            break;
 
        default:
                    
    }