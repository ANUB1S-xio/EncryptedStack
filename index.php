<?php
 //starts the session
 session_start();   


 //creating an empty cart if one doesn't exist yet
 if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];        
 
 //handling form submission in order to add the book to the cart
 //created variable to store user-facing message regarding added items
 $m = null;        
 
 //handling POST requests for adding a book to the cart
 if ($_SERVER['REQUEST_METHOD'] === 'POST')
{  
    //get "book" from POST data, fallback to null
    $b = $_POST['book'] ?? null;        
    if ($b) {
         
    //adding the book to the cart array in the session
        $_SESSION['cart'][] = $b;        
        //redirecting user to avoid form resubmission
        header("Location: index.php?added=" . urlencode($b));        
        exit;
    }
}
 //if redirected in URL, display a confirmation message
 if (isset($_GET['added'])) {   
     //cleaning up message
     $m = htmlspecialchars($_GET['added']) . ' added to cart.';
 }
 
 //google books API
 $k = 'AIzaSyBX1edPcWsv8ed-x4gpmcLXlQ-0l4EDqNE';
 
 //array of categories to search books, using Google Books API
 $topics = ['Ethical Hacking', 'Network Administration', 'Digital Forensics', 'Cyber Crime', 'Information Technology'];
 
 //function to fetch up to four books from the Google Books API by category
 function apiGrab($s, $k) {
     //encoding the subject for safe URL usage
     $grab = urlencode($s);


     //building the API URL
     $l = "https://www.googleapis.com/books/v1/volumes?q=" . $grab . "&maxResults=4&key=$k";
     //making GET request (@ suppresses errors)
     $r = @file_get_contents($l);



     //returns empty array if the request fails
     if (!$r) return [];
     //decoding JSON into array
     $d = json_decode($r, true);
     //returns items or empty array if not found
     return $d['items'] ?? [];
 } ?>

 <!-- html front end --> 
 <!DOCTYPE html>
 <html>

 <body>
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="xUA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,0">
     <!--creating title of the webpage-->
     <title>The Encrypted Stack - Cybersecurity Bookstore</title>
     <!--linking external styles sheet (CSS) for personalization-->
     <link rel="stylesheet" href="styles.css">
 </head>


<!-- project header -->
<header>
    <!-- interactive logo title -->
    <a href='index.php' class="nav-logo">TheEncryptedStack</a>

        <!-- nav bar --> 
        <div class="nav">
            <a href="index.php">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="mycart.php" class="cart-logo"><img src="logos/shopping-cart.svg" alt="cart logo" class="cart"></a>
            <a href="auth.php">Login/Signup</a>
        </div>

        <!-- search feature -->
    <form action="" class="book-search"> 
        <label for="s" class=""></label>
        <input type="query" name="" placeholder="Something more specific?"></form>

</header>


 <!-- sub title for the web page -->
<section id="hero" class="hero-container">
    <div class="hero-cont">
        <h1>Intelligence = Cybersecurity.</h1>
        <p>"If you think you know-it-all all about cybersecurity, this discipline was probably ill-explained to you..." -Stephane Nappo</p>
    </div>
</section>

 <main>
     <!--add message -->
     <?php 
        if ($m): 
     ?>

     <!--display message indicating book was added to cart-->
         <div class="added-message">
            <?= $m ?></div>
     <?php 
        endif; 
     ?>
 
     <h1>Find Your Books Here!</h1>
 
     <!--form to add static book to the cart-->
     <form class="test" method="POST">
        <!-- simple test --> 
         <h3>Book Test 1</h3>
         <input name="book" type="hidden" value="Test-Book">

         <p>test $0.01</p>
         <!--adding a submit button-->
         <button type="buy">$0.01</button>
     </form>
 
    <!--looping through all categories to fetch and showcase the books-->
    <?php 
        foreach ($topics as $sub): 
    ?>
         <?php
         //fetch boooks for the selected/current category
         $b = fetchBooks($sub, $k);
         //only continues if the book is found
         if (!empty($b)):
         ?>
            <h2><?= htmlspecialchars($sub) ?></h2>
            <!--creating grid container for book cards-->
            <div class="book-container">
                <!--looping through each book-->
                <?php foreach ($b as $bo):
                    //shortcut to volumeInfo array
                    $in = $bo['volumeInfo'];
                    //get book title 
                    $t = $in['title'];
                    //getting description
                    $d = $in['description'];
                    //get image URL or fallback to the placeholder image

                    $i = $in['imageLinks']['small'] ??
                            $in['imageLinks']['medium'] ??
                            $in['imageLinks']['large'] ??
                            $in['imageLinks']['thumbnail'] ??
                            'https://via.placeholder.com/128x195?text=No+Image';

                     //link to the book's info page
                     $l = $in['infoLink'] ?? 'index.php';
                 ?>
 
                     <!--rendering the individual book card-->
                     <div class="block">
                         <!--adding the book cover image-->
                         <img src="<?= htmlspecialchars($i) ?>" alt="<?= htmlspecialchars($t) ?>">
                         <!--adding the book title-->
                         <h3>
                            <?= htmlspecialchars($t) ?>
                        </h3>
                         <!--adding the display rating-->
                         <!--adding a shortened description of the book-->
                         <p>
                            <?= htmlspecialchars(substr($d, 0, 50)) ?>...</p>
                         <!--adding a link to the book's info-->
                         <a href="<?= htmlspecialchars($l) ?>" target="_blank"><button type="button">Buy</button></a>
                     </div>
                 <?php endforeach; ?>
             </div>
         <?php endif; ?>
     <?php endforeach; ?>
 </main>

 <!-- simple contact form page -->
<section class="contact" id="c">
    <h2 class="contact-title">Have Questions? Please Contact Us!</h2>
    <form autocomplete="off" id="form-comp">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="subject" placeholder="Subject"required>
        <textarea>
            <input type="message" placeholder="Message" required>
        </textarea>

        <button class="button-sub" type="submit">Send</button>
    </form>
</section>

<footer class="footer" id="foot">
    <div class="col">
        <div class="contacts-foot" id="contact-f">
            <p id="contact-email" class="contact-e">Email: tannerlancaster@my.unt.edu</p>
            <p id="phone" class="phone-num">Number: 123.123.1234</p>
            <p id="contact-email" class="contact-e">Email: williamwoods@my.unt.edu</p>
            <p id="phone" class="phone-num">Number: 123.123.1234</p>
            <p id="contact-email" class="contact-e">Email: sheldonballard@my.unt.edu</p>
            <p id="phone" class="phone-num">Number: 123.123.1234</p>
        </div>
    </div>
</footer>

 </body>
 </html>
