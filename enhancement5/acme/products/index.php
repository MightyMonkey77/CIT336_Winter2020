<?php

/* 
 * Product Controller
 */

// Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
 //Get products model
 require_once '../model/products-model.php';
 //Call the functions.php
 require_once '../library/functions.php';
 
    $categories = getCategories();
    
    $categoriesAndIds = getCategoriesAndIds();
    
    $navList = navList();
   
    
    
    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
     }


    switch ($action){
        
        case 'category':
            
            include '../view/addCategory.php';
            
            break;
        
        
        case 'addCategory':
            
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        
                if (empty($categoryName)) {
                    $message = '<p>Warning: Provide the name below.</p>';
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
                    $message = "<p>Sorry but the new cat $categoryName has failed to be added. Please try again.</p>";
                    include '../view/addCategory.php';
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
                    include '../view/product_management.php';
                }
                else
                {
                    $message = "<p>Sorry but the new product $invName has failed to be added. Please try again.</p>";
                }

                    include '../view/addProduct.php';

                    exit;

                    break;
 
        default:
            include '../view/product_management.php';
    }

