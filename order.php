<?php require_once('init.php') ?>


<!DOCTYPE html>
<html lang="en">        <!--defining language (english) -->

<head> 
    <meta charset="UTF-8">        <!--setting character encoding to UTF-8 -->
    <meta name="viewpoint" content= "width=device-width, initial-scale=1.0">        <!-- setting the viewport to ensure the website is responsive on mobile devices -->

     <!-- title of the page shown in the encryption stack -->
    <title>Thank You For Choosing EncryptedStack!</title>       
    <!-- link to external CSS file we created for styling -->
    <link rel="stylesheet" href="styles.css">        
</head>

<body>
    <nav>
        <!-- adding logo/brand name -->
        <div class="logo">TheEncryptedStack</div>   

         <!-- navigation links. Crucial for the ability to go around the website -->
        <div class="nav-links">   
            <!-- links back to the home page -->
            <a href="index.php">Home</a> 

            <a href="#">Contact</a>        <!-- acts as a placeholder link for the contact page -->
        </div>
</nav>

<main>
    <h1>Order Successful</h1>        <!-- heading to indicate the order was successful -->
    <p>Your payment was successful.</p>      

    <a href="index.php">
        <button type="button">Continue Browsing</button>        <!-- button to return to the homepage or to continue browsing -->
    </a>
</main>



<!-- Footer. Essential for letting users know who we are -->
 <footer class="site-footer" id="main-footer">
     <style>

         .site-footer {
             background-color: #61c8cb;
             color: #000;
             padding: 30px 20px;
             font-family: Arial, sans-serif;
         }
 
         .footer-content {
             max-width: 800px;
             margin: 0 auto;
         }
 
         .footer-content h3 {
             margin-bottom: 20px;
             font-size: 1.5em;
             color: #000;
             border-bottom: 1px solid #444;
             padding-bottom: 10px;
         }
 
         .contact-list {
             list-style: none;
             padding: 0;
             margin: 0;
         }
 
         .contact-item {
             margin-bottom: 20px;
             line-height: 1.6;
         }
 
         .contact-item a {
             color: #000;
             text-decoration: none;
         }
 
         .contact-item a:hover {
             text-decoration: underline;
             color: #000;
         }
     </style>
 
     <div class="footer-content">
         <h3>Contact Our Team</h3>
         <ul class="contact-list">
             <li class="contact-item">
                 <strong>Tanner Lancaster</strong><br>
                 <a href="mailto:tannerlancaster@my.unt.edu">tannerlancaster@my.unt.edu</a><br>
                 <span>(123) 123-1234</span>
             </li>
             <li class="contact-item">
                 <strong>William Woods</strong><br>
                 <a href="mailto:williamwoods@my.unt.edu">williamwoods@my.unt.edu</a><br>
                 <span>(123) 123-1234</span>
             </li>
             <li class="contact-item">
                 <strong>Sheldon Ballard</strong><br>
                 <a href="mailto:sheldonballard@my.unt.edu">sheldonballard@my.unt.edu</a><br>
                 <span>(123) 123-1234</span>
             </li>
         </ul>
     </div>
 </footer>
</body>
</html>
