
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
  $subjects = ['Ethical Hacking', 'Network Administration', 'Digital Forensics', 'Cyber Crime', 'Information Technology'];
  
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
      <!--linking external styles sheet (CSS) for personalization-->
      <link rel="stylesheet" href="styles.css">
  </head>
      
  <body>
  <nav>
      <!--importing website logo-->
      <div class="logo">TheEncryptedStack</div>
      <!--navigation menu-->
      <div class="nav-links">
          <a href="index.php">Home</a>
          <a href="#">About</a>
          <a href="#">Contact</a>
          <a href="mycart.php">Cart</a>
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
      <?php foreach ($subjects as $s): ?>
          <?php
          //fetch boooks for the selected/current category
          $books = fetchBooks($s, $apiKey);
          //only continues if the book is found
          if (!empty($books)):
          ?>
              <h2><?= htmlspecialchars($s) ?></h2>
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


<!-- Contact Form -->
 <div class="contact-wrapper">
  <section class="contact" id="c">
      <h2 class="contact-title">Got Questions? We're Here to Help!</h2>
      <p class="contact-description">Fill out the form below, and we'll get back to you as soon as possible.</p>
      
      <form autocomplete="off" id="form-comp" class="contact-form">
          <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="Your email address" required>
          </div>
          
          <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" name="subject" placeholder="Subject of your message" required>
          </div>
          
          <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" name="message" placeholder="Your message here..." required></textarea>
          </div>
          
          <button class="button-sub" type="submit">Send Message</button>
      </form>

      <style>
          /* Wrapper that centers the entire contact section */
          .contact-wrapper {
              display: flex;
              justify-content: center;
              align-items: center;
              margin-top: 2rem;
              margin-bottom: 2rem;
              padding: 0 1rem;
          }

          .contact {
              background-color: #444;
              padding: 2rem;
              border-radius: 8px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
              width: 100%;
              max-width: 600px;
              text-align: center;
              font-family: 'Arial', sans-serif;
          }

          .contact-title {
              font-size: 2rem;
              margin-bottom: 1rem;
              color: #f9f9f9;
              font-weight: 700;
          }

          .contact-description {
              font-size: 1.1rem;
              color: #ccc;
              margin-bottom: 2rem;
          }

          .contact-form {
              display: flex;
              flex-direction: column;
              align-items: center;
              gap: 1.5rem;
          }

          .form-group {
              width: 100%;
              text-align: left;
          }

          label {
              font-size: 1rem;
              color: #f9f9f9;
              margin-bottom: 0.5rem;
              display: block;
          }

          input, textarea {
              width: 100%;
              padding: 0.8rem;
              margin-bottom: 1rem;
              border: 1px solid #666;
              border-radius: 5px;
              font-size: 1rem;
              background-color: #555;
              color: #f9f9f9;
              transition: border-color 0.3s ease;
          }

          input:focus, textarea:focus {
              border-color: #5B8DF9;
              outline: none;
          }

          textarea {
              resize: vertical;
              height: 150px;
          }

          .button-sub {
              background-color: #5B8DF9;
              color: #fff;
              border: none;
              padding: 1rem 2rem;
              font-size: 1.1rem;
              font-weight: 600;
              border-radius: 5px;
              cursor: pointer;
              transition: background-color 0.3s ease;
          }

          .button-sub:hover {
              background-color: #4787d4;
          }
      </style>
  </section>
</div>



<!-- Footer -->
 <footer class="site-footer" id="main-footer">
     <style>
         .site-footer {
             background-color: #000;
             color: #fff;
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
             color: #f0f0f0;
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
             color: #ccc;
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
