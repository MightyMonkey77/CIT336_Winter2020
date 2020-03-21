<!DOCTYPE html>

<html lang="en">
    
    <head>
        <title>Home Page Acme</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/acme/css/styles.css" media="screen"/>
    </head>
    
    <body>
        
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php';?>
        </header>
        
            <nav>
                <?php echo $navList;?>
            </nav>

        <main>
            
         <div class='textandpicture'>
             
            <h1>Welcome to Acme!</h1>
            
            <section class="rocket">
                
                <img src="/acme/images/site/rocketfeature.jpg" alt="Acme Rocket with Coyote">
                
                <div class='centerright'>
                    <ul>
                        <li><h2>Acme Rocket</h2></li>
                        <li>Quick Lighting Fuse</li>
                        <li>NHTSA approved seat belts</li>
                        <li>Mobile launch stand included</li>
                        <li><a href="/acme/cart/"><img id="actionbtn" alt="Add this item to cart" src="/acme/images/site/iwantit.gif"></a></li>
                    </ul>
                </div>    
                                        
            </section>
            
            <section class="recipes">
                <h3>Featured Recipes</h3>
                <table>
                    <tbody>
                        <tr>
                            <td><img src="/acme/images/recipes/bbqsand.jpg" alt="picture of roadrunner bbq sandwich"></td>
                             <td><a href='/acme/recipes/index.php?action=getRecipe&recipeId'>Pulled Roadrunner BBQ</a></td>
                        </tr>
                        <tr>
                            <td><img src="/acme/images/recipes/potpie.jpg" alt="picture of roadrunner potpie"></td>
                            <td><a href='#'>Roadrunner Pot Pie</a></td>
                        </tr>
                        <tr>
                            <td><img src="/acme/images/recipes/soup.jpg" alt="picture of roadrunner soup"></td>
                            <td><a href='#'>Roadrunner Soup</a></td>
                        </tr>
                        <tr>
                            <td><img src="/acme/images/recipes/taco.jpg" alt="picture of roadrunner tacos"></td>
                            <td><a href='#'>Roadrunner Tacos</a></td>
                        </tr>
                    </tbody>
                </table>
            </section>
            
            <section class='reviews'>
                <h4>Acme Rocket Reviews</h4>
                <ul>
                    <li>"I don't know how I ever caught roadrunners before this."(4/5)</li>
                    <li>"That thing was fast! But not as fast as this rocket.:)"(4/5)</li>
                    <li>"Talk about fast delivery.(5/5)"</li>
                    <li>"I did not even have to pull apart the meat. So tender, delicious!"(4.5/5)</li>
                    <li>"I am on my thirteenth one. I love these things!"(5/5)</li>
                </ul>
            </section>    
            
          </div> 
            
        </main>
        
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php';?>
        </footer>
        
    </body>
    
</html>