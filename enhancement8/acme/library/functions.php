<?php

/*
 * Functions 
*/


//Validation for Email
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

// Build a navigation bar using the $categories array dynamically
function navList() {
    $categories = getCategories();
    $navList = '<ul>';
    $navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category) {
     $navList .= "<li><a href='/acme/products/index.php?action=category&categoryName=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the categories select list 
function buildCategoryList($categoriesAndIds){ 
    //$categories = getCategories();
    $catList = '<select name="categoryId" id="categoryList" class="list2">'; 
    $catList .= "<option>Choose a Category</option>"; 
    foreach ($categoriesAndIds as $category) { 
     $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $catList .= '</select>'; 
    return $catList; 
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
     $pd .= '<li>';
     $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
     $pd .= '<hr>';
     $pd .= "<h2>$product[invName]</h2>";
     $pd .= "<h3>$product[invPrice]</h3>";
     $pd .= "<span><a href='/acme/products/?action=productDetails&invName=" . urlencode($product['invName']) . "'>Click to learn more!</a></span>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function buildProduct($product){
    $pd = '<ul id="productDisplay">';
    foreach ($product as $product) {
     $pd .= '<li>';
     $pd .= "<img src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
     $pd .= '<hr>';
     $pd .= "<h3>Price: $$product[invPrice]</h3><br>";
     $pd .= "<span>Decription: $product[invDescription]</span><br>";
     $pd .= "<span>Stock: $product[invStock] </span><br>";
     $pd .= "<span>Item Size: $product[invSize]</span><br>";
     $pd .= "<span>Item Weight: $product[invWeight]</span><br>";
     $pd .= "<span>Vendor: $product[invVendor]</span><br>";
     $pd .= "<span>Primary Material: $product[invStyle]</span><br>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}