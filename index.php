<?php
//starts the session
session_start();        
//creating an empty cart if one doesn't exist yet
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];        

//handling form submission in order to add the book to the cart
//created variable to store user-facing message regarding added items
$addedMessage = null;        

//handling POST requests for adding a book to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    //get "book" from POST data, fallback to null
    $book = $_POST['book'] ?? null;        
    if ($book) {
        //adding the book to the cart array in the session
        $_SESSION['cart'][] = $book;        
        //redirecting user to avoid form resubmission
        header("Location: index.php?added=" . urlencode($book));        
        exit;
    }
}
//if redirected in URL, display a confirmation message
if (isset($_GET['added'])) {   
    //cleaning up message
    $addedMessage = htmlspecialchars($_GET['added']) . ' added to cart.';
}

//google books API
$apiKey = 'AIzaSyBX1edPcWsv8ed-x4gpmcLXlQ-0l4EDqNE';

//array of categories to search books, using Google Books API
$categories = [
    'Cybersecurity',
    'Network Security',
    'Information Security',
    'Computer Security',
    'Cryptography',
    'Digital Forensics',
    'Penetration Testing',
    'Hacking',
    'Cyber Law',
    'Cybercrime',
    'Cloud Security',
    'Security Engineering',
    'Malware Analysis',
    'Incident Response'
];

//function to fetch up to four books from the Google Books API by category
function fetchBooks($subject, $apiKey) {
    //encoding the subject for safe URL usage
    $query = urlencode($subject);
    //building the API URL
    $url = "https://www.googleapis.com/books/v1/volumes?q=" . $query . "&maxResults=4&key=$apiKey";
    //making GET request (@ suppresses errors)
    $response = @file_get_contents($url);
    //returns empty array if the request fails
    if (!$response) return [];
    //decoding JSON into array
    $data = json_decode($response, true);
    //returns items or empty array if not found
    return $data['items'] ?? [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--creating title of the webpage-->
    <title>Sec-Reads Cyber Bookstore</title>
    <!--importing font-->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <!--linking external styles sheet (CSS) for personalization-->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav>
    <!--importing website logo-->
    <div class="logo">Sec-Reads</div>
    <!--navigation menu-->
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </div>
</nav>
<main>
    <!--shows book added message if available/applicable-->
    <?php if ($addedMessage): ?>
    <!--display message indicating book was added to cart-->
        <div class="added-message"><?= $addedMessage ?></div>
    <?php endif; ?>

    <h1>Explore Cybersecurity Books</h1>

    <!--form to add static book to the cart-->
    <form method="POST" class="book-card">
        <h3>The Cyber Dummy Guide</h3>
        <!--hidden field to pass the book name-->
        <input type="hidden" name="book" value="The Cyber Dummy Guide">
        <!--description of a static book-->
        <p>Used to test cart functionality with $0.01 purchase.</p>
        <!--adding a submit button-->
        <button type="submit">Add to Cart - $0.01</button>
    </form>

    <!--looping through all categories to fetch and showcase the books-->
    <?php foreach ($categories as $category): ?>
        <?php
        //fetch boooks for the selected/current category
        $books = fetchBooks($category, $apiKey);
        //only continues if the book is found
        if (!empty($books)):
        ?>
            <h2><?= htmlspecialchars($category) ?></h2>
            <!--creating grid container for book cards-->
            <div class="book-grid">
                <!--looping through each book-->
                <?php foreach ($books as $bookItem):
                    //shortcut to volumeInfo array
                    $info = $bookItem['volumeInfo'];
                    //get book title or else it is defaulted to "untitled"
                    $title = $info['title'] ?? 'Untitled';
                    //getting description or else defaulted to an empty string
                    $desc = $info['description'] ?? '';
                    //get image URL or fallback to the placeholder image
                    $img = $info['imageLinks']['small'] ??
                           $info['imageLinks']['medium'] ??
                           $info['imageLinks']['large'] ??
                           $info['imageLinks']['thumbnail'] ??
                           'https://via.placeholder.com/128x195?text=No+Image';
                    //link to the book's info page
                    $link = $info['infoLink'] ?? '#';
                    //getting the book's rating or else defaulted to "N/A"
                    $rating = $info['averageRating'] ?? 'N/A';
                ?>

                    <!--rendering the individual book card-->
                    <div class="book-card">
                        <!--adding the book cover image-->
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($title) ?>">
                        <!--adding the book title-->
                        <h3><?= htmlspecialchars($title) ?></h3>
                        <!--adding the display rating-->
                        <p>Rating: <?= $rating ?></p>
                        <!--adding a shortened description of the book-->
                        <p><?= htmlspecialchars(substr($desc, 0, 100)) ?>...</p>
                        <!--adding a link to the book's info-->
                        <a href="<?= htmlspecialchars($link) ?>" target="_blank">
                            <!--adding a button for the book's full info-->
                            <button type="button">View Book</button>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</main>
</body>
</html>
