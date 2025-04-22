<?php //working databse mysql
$connect = mysqli_conect("localhost", "root", "", "userdb");

if (!$connect) {
  die("Connection to db failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $verify = $_POST["verify"];
}

//check fo the password matches reconfirm
if ($password != $verify) {
  echo "Passwords do not match. Recheck";
  return;
}

// sanatize the username
$u_san = mysqli_real_escape_string($connect, $username);
//hash the password
$pass_obf = password_hash($password, PASSWORD_DEFAULT);  

//cehck if the user already exists
$check = "SELECT * FROM userdb WHERE username = '$u_san'";
$confirm = mysqli_query($connect, $check);

//check if the username is already taken
if (mysqli_num_rows($confirm)>0)
{
  echo "Username is already taken. Please choose another";
  return;
}
//add the user into the databse
$add_user = "INSERT INTO userdb (username, password) VALUES ('$u_san', '$pass_obf')";
echo "Thank you for Joining The Community!";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">        <!--setting character encoding to UTF-8 -->
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

  <!-- sign up form -->
  <form method="POST" action="signup.php">
    <input type="text" name="username" placeholder equals="Create Username" required>
    <input type="password" name="password" placeholder equals="Create Password" required>
        <input type="password" name="verify" placeholder equals="Verify Password" required>
    <button type="submit" name="submit">Submit</button>
  </form>

  
</body>
</html>
