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
  </body>
  </html>
