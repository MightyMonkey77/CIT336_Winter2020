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
    
    // Create or access a Session 
    session_start();
 
    $categories = getCategories();
    
    $navList = navList();
    
     if (isset($_SESSION['loggedin'])) {
    $clientData = getClient($_SESSION['clientData']['clientEmail']);
    // Remove the password from the array
    array_pop($clientData);
}
    
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
            
            //Look for double emails
            $existingEmail = checkExistingEmail($clientEmail);

            // Check for existing email address in the table
            if($existingEmail){
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }
            
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
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                header ('location: /acme/accounts/?action=login');
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
            
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
            
            $clientEmail = checkEmail($clientEmail);
            
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            
            $passwordCheck = checkPassword($clientPassword);

            // Run basic checks, return if errors
            if (empty($clientEmail) || empty($passwordCheck)) {
             $message = '<p>Please provide a valid email address and password.</p>';
             include '../view/login.php';
             exit; 
            }

            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
                        
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
             $message = '<p>Please check your password and try again.</p>';
             include '../view/login.php';
             exit; 
            }

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;
            break;
            
        case 'logout':
            session_destroy();
            header('location: /acme/index.php');
            break;
        
        case 'updateAcc':
            include '../view/update_account.php';
            break;
        
        case 'updateAccount':
            
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
            $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
            $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

            $clientEmail = checkEmail($clientEmail);
                      
                if($_SESSION['clientData']['clientEmail'] <> $clientEmail) {
                    $existingEmail = checkExistingEmail($clientEmail);
                }   
                else { $existingEmail = FALSE; }

              if($existingEmail){
                    $_SESSION['message'] = '<p>That email address already exists. enter new Email and try again.</p>';
                    include '../view/update_account.php';
                    exit;
               }

                if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                    $_SESSION['message'] = '<p>Please enter all the information.</p> ';
                    include '../view/update_account.php';
                    exit; 
                }

            $userChange = accountUpdate($clientFirstname, $clientLastname, $clientEmail, $clientId);

                if($userChange === 1) {
                   setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                   $clientData = getClient($_SESSION['clientData']['clientEmail']);
                   $_SESSION['message'] = "<p>Congratulations, $clientFirstname $clientLastname was sucessfully updated.</p>";
                   header('location:/acme/accounts/index.php');
                  // include '../view/admin.php';
                      exit;
                  } 
                  else 
                  {
                      $_SESSION['message'] = "<p>Sorry $clientFirstname $clientLastname, but the update failed. Check that a change was made in the fields below. Please try again.</p>";
                    //  $clientData = getClient($_SESSION['clientData']['clientEmail']);
                      include '../view/update_account.php';
                      exit;
                  }
                  include '../view/update_account.php';
                  exit;
                  break;
            
            
        case 'updatePassword':
            
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            
            $checkPassword = checkPassword($clientPassword);
       
                if(empty($checkPassword)) {
                    $_SESSION['message']= '<p>Please enter all the information.</p> ';
                    include '../view/update_account.php';
                    exit; 
          }
          
          $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
              
          $userChange = passwordUpdate ($hashedPassword, $clientId);
          
          if($userChange === 1) {
            
             $_SESSION['message'] = "<p>Congratulations, $clientFirstname your password has been updated.</p>";
           
             header('location:/acme/accounts/index.php');
             //include '../view/admin.php';
             exit;
            } 
            else 
            {
                $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
                $clientData = getClient($_SESSION['clientData']['clientEmail']);
                include '../view/update_account.php';
                exit;
            }
            include '../view/update_account.php';
            exit;
            break;    
 
        default:
            include '../view/admin.php';
            break;
    }