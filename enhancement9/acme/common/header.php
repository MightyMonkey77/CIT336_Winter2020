<title>
    <?php if (isset($pageTitle)) {echo $pageTitle;} ?>
</title>

<header>
    
   <div class='header'> 
    <a href='/acme/index.php' title='Return to home page'><img src='/acme/images/site/logo.jpg' alt='Site Logo'></a>
    
        <div class="welcome">            
        <?php
                if(isset($_SESSION['loggedin'])){
                     echo "<span><a href='/acme/accounts'>Welcome, " . $clientData['clientFirstname'] . " " . $clientData['clientLastname'] . "</a></span>";             
            } 
        ?>
        
        </div>    
            
        <?php 
            if(isset($_SESSION['loggedin'])) { ?>
            
            <div class="logout">
                <a href='/acme/accounts/index.php?action=logout' title='logout user' class="loginLink">Logout</a>
            </div>
    
       <?php 
        } 
        else 
        { 
        ?>
            <div class="myAccount">    
                <a href='/acme/accounts/index.php?action=login' title='myAccount' class='accountText'>My Account</a>
            </div>
                
       <?php }
        ?> 
     </div>
    
    <nav>
        <?php echo $navList;?>
    </nav>
    
</header>