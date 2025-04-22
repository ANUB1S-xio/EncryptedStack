<?php
  session_start(); // This will start the session, which leads to accessing the cart data.
  
  // This will redirect the user if they attempt to go to the cart with it being empty.
  if (empty($_SESSION['cart'])) {
      $_SESSION['message'] = "Your cart is currently empty. Please add something before checking out.";
      header("Location: cart.php");
      exit;
  }
  ?>
  
  <!DOCTYPE html>
  <html>
  <head>
      <title>Checkout</title>
  <!-- Customization. This applies the Poppins font style to make the site look more approachable. -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <nav>
  <!-- This is the site title, along with the logo. -->
      <div class="logo">Sec-Reads</div>
      <div class="nav-links">
          <a href="index.php">Home Page</a>
          <a href="cart.php">Cart</a>
          <a href="#">About Us</a>
          <a href="#">Contact Us</a>
      </div>
  </nav>
  <main>
  <!-- These are the navigation links to main parts of the website. -->
      <div class="content-box">
          <h1>Checkout</h1>
          <p>Total: $0.00</p>
          <form action="charge.php" method="POST">
              <button type="submit">Secure Checkout with Stripe</button>
          </form>
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
  </body>
  </html>
