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
 
    $categories = getCategories();
    
    $categoriesAndIds = getCategoriesAndIds();
    
    $navList = '<ul>';
    $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
     $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    
    
    $catList = "<select name='categoryId' id='categoryId' class='list'>";
    $catList .= '<option value ="">Select Your Category</option>';
    foreach ($categoriesAndIds as $catAndId) {
       $catList .= "<option value='$catAndId[categoryId]'";
       if(isset($categoryId)){

       if($catAndId['categoryId'] === $categoryId){
         $catList .= ' selected ';
     }
    }   
       $catList .= ">$catAndId[categoryName]</option>";
    }
    $catList .= "</select>";
    
    
    
    $action = filter_input(INPUT_POST, 'action');
     if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
     }


    switch ($action){
        
        case 'category':
            
            include '../view/addCategory.php';
            
            break;
        
        
        case 'addCategory':
            
            $categoryName = filter_input(INPUT_POST, 'categoryName');
        
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
            
            $invName = filter_input(INPUT_POST, 'invName');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
            $invPrice = filter_input(INPUT_POST, 'invPrice');
            $invStock = filter_input(INPUT_POST, 'invStock');
            $invSize = filter_input(INPUT_POST, 'invSize');
            $invWeight = filter_input(INPUT_POST, 'invWeight');
            $invLocation = filter_input(INPUT_POST, 'invLocation');
            $categoryId = filter_input(INPUT_POST, 'categoryId');
            $invVendor = filter_input(INPUT_POST, 'invVendor' );
            $invStyle = filter_input(INPUT_POST, 'invStyle' );
            
            
                if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
                    $message = '<p>Warning: Please provide information for all empty form fields.</p>';
                    include '../view/addProduct.php';
                    exit;
                }
                
            $newProductAdd = addProduct($invName, $invDescription,$invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId,$invVendor, $invStyle);
        
                if ($newProductAdd === 1) {
                    $message = "<p>Thanks for adding the new product $invName to the inventory.</p>";
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

