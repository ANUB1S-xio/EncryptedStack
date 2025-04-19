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
</body>
</html>

