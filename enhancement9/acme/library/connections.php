<?php
/*
 * Database Connection File
 */

 function acmeConnect(){
    
    $server = 'localhost';
    $dbname= 'acme';
    $username = 'iClient';
    $password = 'nLWpOFr1eKzPUmPj';
    $dsn = "mysql:host=$server; dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // Create the actual connection object and assign it to a variable
        try {
            $acmeLink = new PDO($dsn, $username, $password, $options);
            return $acmeLink;
            } 
        catch(PDOException $e) 
        {
            header('Location: /acme/view/500.php');
            exit;
        }
}

//acmeConnect();
