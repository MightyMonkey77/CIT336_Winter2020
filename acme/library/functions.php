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
     $pd .= "<img src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
     $pd .= '<hr>';
     $pd .= "<h2>$product[invName]</h2>";
     $pd .= "<h3>$product[invPrice]</h3>";
     $pd .= "<span><a href='/acme/products/?action=productDetails&invId=" . urlencode($product['invId']) . "'>Click to learn more!</a></span>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function buildProduct($product){
    $pd = '<ul id="productDisplay">';
     $pd .= '<li>';
     $pd .= "<img src='$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
     $pd .= "<hr>";
     $pd .= "<h3 class='price'>Price: $$product[invPrice]</h3><br>";
     $pd .= "<span>Decription: $product[invDescription]</span><br>";
     $pd .= "<span class='stock'>Inventory: $product[invStock] </span><br>";
     $pd .= "<span>Item Size: $product[invSize]</span><br>";
     $pd .= "<span>Item Weight: $product[invWeight]</span><br>";
     $pd .= "<span>Vendor: $product[invVendor]</span><br>";
     $pd .= "<span>Primary Material: $product[invStyle]</span><br>";
     $pd .= "<span><a href='/acme/products/?action=buyMe'></a></span>";
     $pd .= '</li>';
    
    $pd .= '</ul>';
    return $pd;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
     $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
     $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
 }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the resizeImage function

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
        if ($width_ratio > 1 || $height_ratio > 1) {

            // Calculate height and width for the new image
            $ratio = max($width_ratio, $height_ratio);
            $new_height = round($old_height / $ratio);
            $new_width = round($old_width / $ratio);

            // Create the new image
            $new_image = imagecreatetruecolor($new_width, $new_height);

            // Set transparency according to image type
                if ($image_type == IMAGETYPE_GIF) {
                    $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                    imagecolortransparent($new_image, $alpha);
               }

                if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
                    imagealphablending($new_image, false);
                    imagesavealpha($new_image, true);
                }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
        } 
        else
        {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends the if - else began on line 36

function buildThumbnailDisplay($imageTN){
    $tn = '<ul id="image_thumbnail">';
    foreach ($imageTN as $image) {
        $tn .= '<li>';
        $tn .= "<img src='$image[imgPath]' title='$image[imgName] image on Acme.com' alt='$image[imgName] image on Acme.com'>";
        $tn .= '</li>';
    }
    $tn .= '</ul>';
    return $tn;
}

function buildReview($reviews) {
    $rn = '<ul id="reviews">';
    foreach ($reviews as $review) {
        $rn .= '<li>';
        $rn .= "<span>". chunk_split(substr($review['clientFirstname'],0,1),1).$review['clientLastname']."</span>";
        $rn .= " - <span>".date('j F, Y', strtotime($review['reviewDate']))."</span>";
        $rn .= "<p>\"$review[reviewText]\"</p>";
        $rn .= '</li>';
    }
        $rn .= '</ul><br><hr>';
    return $rn;
}

function adminReview($reviews){
    $ar = '<ul id="reviews">';
    foreach ($reviews as $review) {
        $ar .= '<li>';
        $ar .= "<span>".$review['invName']." </span>";
        $ar .= "<span>".date('j F, Y', strtotime($review['reviewDate']))."</span> ";
        $ar .= "<br>".substr($review['reviewText'],0,320). " ";
        $ar .= "<br>";
        $ar .= "<a href='/acme/reviews?action=editRev&reviewId=" . urlencode($review['reviewId']) . " title='Edit your $review[invName] review'>Edit</a> ";
        $ar .= "<a href='/acme/reviews?action=delRev&reviewId=" . urlencode($review['reviewId']) . " title='Delete your $review[invName] review'>Delete</a>";
        $ar .= '</li>';
    }
        $ar .= '</ul>';
        return $ar;
}