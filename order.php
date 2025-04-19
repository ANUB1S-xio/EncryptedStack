<?php require_once('init.php') ?>


<!DOCTYPE html>
<html lang="en">        //defining language (english)

<head> 
    <meta charset="UTF-8">        //setting character encoding to UTF-8
    <meta name="viewpoint" content= "width=device-width, initial-scale=1.0">        //setting the viewport to ensure the website is responsive on mobile devices

    <title>Thank You For Choosing EncryptedStack!</title>        //title of the page shown in the encryption stack
    <link rel="stylesheet" href="styles.css">        //link to external CSS file we created for styling
</head>

<body>
    <nav>
        <div class="logo">TheEncryptedStack</div>        //adding logo/brand name

        <div class="nav-links">        //navigation links
            <a href="index.php">Home</a>        //links back to the home page
            <a href="#">Contact</a>        //acts as a placeholder link for the contact page
        </div>
</nav>

<main>
    <h1>Order Successful</h1>        //heading to indicate the order was successful
    <p>Your payment was successful.</p>      

    <a href="index.php">
        <button type="button">Continue Browsing</button>        //button to return to the homepage or to continue browsing
    </a>
</main>

</body>
</html>
