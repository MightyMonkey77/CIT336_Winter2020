<?php

/* 
 * Product Controller
 */

 // Create or access a Session 
    session_start();
    
// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
 //Get products model
 require_once '../model/products-model.php';
 //Call to uploads model
 require_once '../model/uploads-model.php';
 //Call the functions.php
 require_once '../library/functions.php';
 //Call to reviews model
 require_once '../model/reviews-model.php';

    $categoriesAndIds = getCategoriesAndIds();
    
    $categories = getCategories();
    
    $navList = navList(); 
    
    if (isset($_SESSION['loggedin'])) {
    $clientData = getClient($_SESSION['clientData']['clientEmail']);
    array_pop($clientData);
    }
    
    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
     }


    switch ($action){
        
        case 'catAdd':
            
            include '../view/addCategory.php';
            
            break;
        
        
        case 'addCategory':
            
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        
                if (empty($categoryName)) {
                    $_SESSION['message'] = '<p>Warning: Provide the name below.</p>';
                    include '../view/addCategory.php';
                    exit;
                }
                
            $newCategoryAdd = addCategory($categoryName);
        
                if ($newCategoryAdd === 1) {
                  
//                    header("location:index.php?action=addCategory");
                    header("location:/acme/products/index.php");
                } 
                else
                {
                    $_SESSION['message'] = "<p>Sorry but the new cat $categoryName has failed to be added. Please try again.</p>";
                    include '../view/addCategory.php';
                    exit;
                }
                break;
                
        case 'delCategory':
            
            $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
            
                $catInfo = getCategoryInfo($categoryId);
                
                    include '../view/deleteCategory.php';
                    exit;
                    break;
                
        case 'deleteCategory':
            
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
            
                $deleteResult = deleteCategory($categoryName) ;
                    if ($deleteResult) {
                     $_SESSION['message'] = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
                     header('location: /acme/products/');
                     exit;
                    } 
                    else
                    {
                     $_SESSION['message'] = "<p class='notice'>Error: $invName was not deleted.</p>";
                     header('location: /acme/products/');
                     exit;
                    }
                    break;
 
                
        case 'product':
            
            include '../view/addProduct.php';
            
            break;
    
        case 'addProduct':
            
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT );
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING );
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING );
            
            
                if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
                    $message = '<p>Warning: Please provide information for all empty form fields.</p>';
                    include '../view/addProduct.php';
                    exit;
                }
                
            $newProductAdd = addProduct($invName, $invDescription,$invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
        
                if ($newProductAdd === 1) {
                    $message = "<p>Thanks for adding the new product - $invName - to the inventory.</p>";
                    header('location: /acme/products/index.php');
                }
                else
                {
                    $message = "<p>Sorry but the new product $invName has failed to be added. Please try again.</p>";
                }

                    include '../view/addProduct.php';

                    exit;

                    break;
                    
        case 'getInventoryItems': 
            // Get the categoryId 
            $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT); 
            
            // Fetch the products by categoryId from the DB 
            $productsArray = getProductsByCategory($categoryId);
            
            // Convert the array to a JSON object and send it back 
            echo json_encode($productsArray); 
            
            break;
        
        case 'mod':
            //call the invid from the view using the category select
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            //contact the model for this
            $prodInfo = getProductInfo($invId);
            
                if(count($prodInfo) <1 ){
                    
                    $_SESSION['message'] = 'Sorry, no product information could be found.';
            }
                include '../view/product_update.php';
                exit;
                break;
                
        case 'updateProduct':
            $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
            $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
            $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
            $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
            $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
            $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

                if (empty($categoryId) || empty($invName) || empty($invDescription) 
                || empty($invImage) || empty($invThumbnail) || empty($invPrice) 
                || empty($invStock) || empty($invSize) || empty($invWeight) 
                || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
                 $_SESSION['message'] = '<p>Please complete all information for the updated item! Double check the category of the item.</p>';
                 include '../view/product_update.php';
                 exit;
            }
            $insertResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
                if ($insertResult) {
                    $_SESSION['message'] = "<p>Congratulations, $invName was successfully updated.</p>";
                    header('location: /acme/products/index.php');
                    exit;
                } 
                else
                {
                    $_SESSION['message'] = "<p>Error. The updated failed.</p>";
                    include '../view/product_update.php';
                    exit;
                }
                break; 
                
                
            case 'del':
                $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
                $prodInfo = getProductInfo($invId);
                    if (count($prodInfo) < 1) {
                     $message = 'Sorry, no product information could be found.';
                   }
                    include '../view/product_delete.php';
                    exit;
                    break;
                    
            
            case 'deleteProduct':
                $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
                $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

                $deleteResult = deleteProduct($invId);
                    if ($deleteResult) {
                     $_SESSION['message'] = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
                     header('location: /acme/products/');
                     exit;
                    } 
                    else
                    {
                     $_SESSION['message'] = "<p class='notice'>Error: $invName was not deleted.</p>";
                     header('location: /acme/products/');
                     exit;
                    }
                    break;
                    
        case 'category':
        
            $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
                
            $products = getProductsByCategoryName($categoryName);

                if(!count($products)){
                     $message = "<p>Sorry, no $categoryName products could be found.</p>";

                }
                else 
                {
                     $prodDisplay = buildProductsDisplay($products);
                }

                    include '../view/category.php';
                    break;
                    
        case 'productDetails':
            
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
          
            $product = getProductInfo($invId);
            $imageTN = getThumbnails($invId);
            $reviews = getReviewInvItem($invId);
            
                if(empty($product)) {
                    $message = "<p>Sorry, no product was found. Try again.</p>";
                }
                else
                {
                    $productDisplay = buildProduct($product);
                    $thumbnailDisplay = buildThumbnailDisplay($imageTN);
                    $reviewsByInvItem = buildReview($reviews);
                }
               
                include '../view/product.php';
                break;
                

        default:
            
            $categoryList = buildCategoryList($categoriesAndIds);
            
            include '../view/product_management.php';
            break;
    }

    