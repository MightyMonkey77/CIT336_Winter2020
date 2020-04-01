<?php

/* 
 * Reviews Controller
 */

session_start();

require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';
require_once '../model/accounts-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

    $categories = getCategories();

    $navList = navList();
    
    if (isset($_SESSION['loggedin'])) {
        $clientData = getClient($_SESSION['clientData']['clientEmail']);
        array_pop($clientData);
    }
    
   
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
        if ($action == NULL) {
     $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        }

    switch ($action) {
        
        case 'addUserReview':
            
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
 
         
                if(empty($reviewText)) {
                    $_SESSION['message'] = "<p>Sorry, review no accepted. Please write a review.</p>";
                    include '../view/product.php';
                    exit;
                }
            
            $reviewAdd = insertReview($invId, $clientId, $reviewText);
            
                if($reviewAdd === 1) {
                    $_SESSION['message'] = '<p>Your review is saved.</p>';
                    header('location: /acme/accounts/index.php');
                    exit;
            }
            else
            {
                $_SESSION['message'] = "<p>Error. The review failed.</p>";
                    include '../view/product.php';
                    exit;
            }
            break;
        
        case 'editRev':
            
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $reviewInfo = getReviewsCurrent($reviewId);
            
            if(empty($reviewId)) {
                $_SESSION['message'] = '<p>Sorry, the review was not found.</p>';
                header('location: /acme/accounts');
                exit;
            }
            
            $reviews = getReview($reviewId);
            
            if(empty($reviews)) {
                $_SESSION['message'] = '<p>Sorry, the review was not found.</p>';
                header('location: /acme/accounts');
                exit;
            }
            
            include '../view/editReview.php';
            break;
        
        case 'editReview':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
            
            $review = getReview($reviewId);
           
            if(empty($review)) {
                $_SESSION['message'] = "Sorry, review could not be found";
                header('location: /acme/accounts/index.php');
                exit;
            }
            
            if(empty($reviewText)){
                $_SESSION['message'] = '<p>The review cannot be empty.</p>';
                include '/view/editReview.php';
                exit;
            }
            
            $editResult = updateReview($reviewText, $reviewId);
            
                if ($editResult < 1) {
                    
                    $_SESSION['message'] = "<p>Sorry, but your review wasn't updated. Please try again.</p>";
                    include '../view/editReview.php';
                    
                    }
                    else
                    {
                    $_SESSION['message'] = "<p>Your review was updated successfully.</p>";
                    header('location: /acme/accounts/index.php');
                    exit;
                    }
                            
            break;
        
        case 'delRev':
            
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $reviewInfo = getReviewsCurrent($reviewId);
            
		if (empty($reviewId)) {
                    $_SESSION['message'] = "Sorry, review could not be found";
                    header('location: /acme/accounts');
                    exit;
		}
                
            $review = getReview($reviewId);
            
		if (empty($review)) {
                    $_SESSION['message'] = "Sorry, review could not be found";
                    header('location: /acme/accounts');
                    exit;
                    }
				
                    include '../view/delReview.php';
            break;
        
        case 'deleteReview':
            
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $review = getReview($reviewId);
            
                if (empty($review)) {
                    $_SESSION['message'] = "Sorry, review could not be found";
                    header('location: /acme/accounts/index.php');
                    exit;
                    }
				
            $delResult = deleteReview($reviewId);
						
		if ($delResult < 1) {
                    
                    $_SESSION['message'] = "<p>Sorry, but your review wasn't deleted. Please try again.</p>";
                    include '../view/admin.php';                            
                    }
                    else
                    {
                    $_SESSION['message'] = "<p>Your review was deleted successfully.</p>";
                    header('location: /acme/accounts/index.php');
                    exit;
                    }
                    
                break;    
            
        default:
           
           $reviews = getReview();
            
                if($reviews > 0) {
                    $revDisplay = buildReview($reviews);
                }
            $reviewInfo = getReview();

}                
                