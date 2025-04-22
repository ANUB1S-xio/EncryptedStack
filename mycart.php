<?php
 session_start();
 
 // clear the cart and reload mycart.php
 if ( $_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['empty']) ) 
 {
     //clear the mycart
     $_SESSION['mycart'] = [];
     //refresh the mycart page
     header("Location: mycart.php");
 
     exit;
 }
 
 // load the cart as cleared
 $mycart = $_SESSION['mycart'] ?? [];
 ?>
 
 
 
 <!DOCTYPE html>
 <html lang="en">
 
 <html>
 
 <head>
     <meta charset="UTF-8">
     <meta name="viewpoint" content= "width=device-width, initial-scale=1.0">
 
     <title>My Cart - Checkout</title>
     <link rel="stylesheet" href="styles.css">
 </head>
 
 
 <body>
 
 <!-- nav bar pointing to home and contact keeping styles consistent -->
 <nav>
     <div class="logo">TheEncryptedStack</div>
     <div class="nav-links">
         <a href="index.php">Home</a>
         <a href="#">Contact</a>
     </div>
 </nav>
 
 <main>
     <div class="content-box">
 
         <h1>My Cart</h1>
 
         <!-- check if cart is empty -->
         <?php if (empty($c)): ?>
             <p>Cart is Empty...</p>
         <?php else: ?>
 
             <!-- dummy db items set as $0.01 for POC -->
             <ul> <?php foreach ($c as $i): ?>
 
                 <li><?= htmlspecialchars($i) ?> — $0.01</li>
 
             <?php endforeach; ?> </ul>
 
             <!-- load book into cart -->
             <form action="checkout.php" method="POST" style="margin-top: 18px;">
                 <button type="submit">Proceed to Checkout</button>
             </form>
 
             <!-- button color, and reset the cart -->
             <form action="mycart.php" method="POST" style="margin-top: 8px;">
                 <input type="hidden" name="empty" value="true">
                 <button type="submit" style="background:rgb(81, 170, 121); color: white;">Empty</button>
             </form>
 
         <?php endif; ?>
     
     </div>
 </main>


  <!-- Footer -->
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
             color: #fff;
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
