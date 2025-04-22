<?php //working databse mysql
$connect = mysqli_conect("localhost", "root", "", "userdb");

if (!$connect) {
  die("Connection to db failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST["username"];
  $password = $_POST["password"];
}

// sanatize the username
$u_san = mysqli_real_escape_string($connect, $username);

//cehck if the user already exists
$check = "SELECT * FROM userdb WHERE username = '$u_san'";
$confirm = mysqli_query($connect, $check);

if (mysqli_num_rows($confirm) == 0) {
  echo "User or Password is Incorrect or does not exist. Please try again.";
  return;
}
// verify that the password exists and matches 
$fetch = mysqli_fetch_assoc($confirm);
//fetch the password
$obf = $fetch["password"];

// prompt a message if login fails
if (!password_verify($password, $obf)) {
  echo "User or Password is Incorrect or does not exist. Please try again."; return;
}

//we have to start the sesssion php
session start();
$_SESSION['username'] = $username;

//if login was successful, print message
echo "Login Successful! Redirecting...";
//add the user into the databse
$add_user = "INSERT INTO userdb (username, password) VALUES ('$u_san', '$pass_obf')";
echo "Thank you for Joining The Community!";

?>

<!DOCTYPE html>
<html lang="en">
 
<html>
 
<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content= "width=device-width, initial-scale=1.0">
    <title>Signup with TheEncryptedStack!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hack-font/3.3.0/web/hack.min.css">
    <link rel="stylesheet" href="styles.css">
</head> 
<body>

   <nav>
      <!--importing website logo-->
      <div class="logo">TheEncryptedStack</div>
      <!--navigation menu-->
      <div class="nav-links">
          <a href="index.php">Home</a>
          <a href="#About">About</a>
          <a href="#c">Contact</a>
          <a href="mycart.php">Cart</a>
          <a href="login.php">Login/Signup</a>
      </div>
  </nav>
  
  <div class="form-box">
    <div class="auth-wrap">
      <!-- sign up form -->
      <form method="POST" action="auth.php">
        <div class="input-group">
          <input type="text" name="username" placeholder equals="Create Username" required>
        </div>
        <div class="input-group">
          <input type="password" name="password" placeholder equals="Create Password" required>
        </div>
        <button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>



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
