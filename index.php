
<?php
  //starts the session
  session_start();        
  //creating an empty cart if one doesn't exist yet
  if (!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];        
  
  //handling form submission in order to add the book to the cart
  //created variable to store user-facing message regarding added items
  $m = null;        
    //google books API
  $apiKey = 'AIzaSyDOQBJkg0s-IiuupraVuhIg_YXngwYmpa4';

  //array of categories to search books, using Google Books API
  $subjects = ['Ethical Hacking', 'Digital Forensics', 'Python Coding', 'C Programming', 'Threat Intelligence'];
  
  //function to fetch up to four books from the Google Books API by category
  function fetchBooks($subject, $apiKey) {
      //encoding the subject for safe URL usage
      $grab = urlencode($subject);
      //building the API URL
      $url = "https://www.googleapis.com/books/v1/volumes?q=" . $grab . "&maxResults=12&key=$apiKey";
      //making GET request (@ suppresses errors)
      $response = @file_get_contents($url);
      //returns empty array if the request fails
      if (!$response) return [];
      //decoding JSON into array
      $d = json_decode($response, true);
      //returns items or empty array if not found
      return $d['items'] ?? [];
  }

  ?>

  <!DOCTYPE html>
  <html>
      
  <head>
      <!--creating title of the webpage-->
      <title>The Encrypted Stack - Cybersecurity Bookstore</title>
      <!--linking external styles sheet (CSS) for personalization-->
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
          <a href="#main-footer">Contact</a>
          <a href="mycart.php">Cart</a>
          <a href="/.auth/login/github/callback">Login</a>

      </div>
  </nav>
  <main>
      <!--shows book added message if available/applicable-->
      <?php if ($m): ?>
      <!--display message indicating book was added to cart-->
          <div class="added-message"><?= $m ?></div>
      <?php endif; ?>
  
      
<!-- About us section -->

    <div class="about-container">
  <section class="about-section" id="about">
    <div class="about-inner">
      <div class="about-text">
        <h2>About Us</h2>
        <p>
          We believe that knowing how to look after yourself and others online shouldn't be the reserve of experts or those with expensive training. So, we offer a wide selection of well researched cybersecurity books that condense complicated topics into helpful, entry level material; perfect for self learners, students, and aspiring professionals alike. Our website aims to deliver excellent cybersecurity knowledge to whoever wants to learn it.
        </p>
        <p>
          Our goal is to bridge the knowledge gap through providing accessible and reliable resources empowering people to take control of their own cybersecurity education. Whether you're researching basics or diving into advanced topics, our library is intended to support your journey each step of the way . While dangers on the internet grow, so does the requirement for cyber literacy and awareness.
        </p>
      </div>
      <div class="about-image">
        <img src="https://www.elewayte.com/public/uploads/courses/dashboard/209874360464aac927d0187.png" alt="Team working together">
      </div>
    </div>
  </section>

  <style>
    .about-container {
      display: flex;
      justify-content: center;
      padding: 2rem 1rem;
      margin-top: 2rem;
    }

    .about-section {
      background: #444;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      max-width: 1000px;
      width: 100%;
      padding: 2rem;
      color: #f0f0f0;
      font-family: Arial, sans-serif;
    }

    .about-inner {
      display: flex;
      gap: 2rem;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .about-text {
      flex: 1;
      min-width: 280px;
    }

    .about-text h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
      font-weight: bold;
    }

    .about-text p {
      font-size: 1.1rem;
      color: #ccc;
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    .about-image {
      flex: 1;
      min-width: 280px;
      display: flex;
      justify-content: center;
    }

    .about-image img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .about-inner {
        flex-direction: column;
        text-align: center;
      }

      .about-image {
        margin-top: 1.5rem;
      }
    }
  </style>
</div>

    
    
    
    <h1>Explore Your Favorite Cybersecurity Books</h1>
  
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
          <div class="scroll">
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
                  ?>
  
                      <!--rendering the individual book card-->
                      <div class="bookbox">
                          <!--adding the book cover image-->
                          <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($title) ?>">
                          <!--adding the book title-->
                          <!-- set cap count to 10 words -->
                          <h3><?= htmlspecialchars(substr($title, 0, 10)) ?></h3>
                          <!--adding a link to the book's info-->
                          <a href="<?= htmlspecialchars($link) ?>" target="_blank">
                              <!--adding a button for the book's full info-->
                              <button type="button">Buy</button>
                          </a>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>

    
          <?php endif; ?>
      <?php endforeach; ?>
  </main>

  <div class="login-container">
    <div class="login-box" id="log">
      <h2>Login</h2>
      <form method="POST" action="">
        <label for="userlog">Username</label>
        <input type="text" name="userlog" placeholder equals="enter Username" required>
        <label for="passlog">Password</label>
        <input type="password" name="passlog" placeholder equals="enter Password" required>
        <button type="submit" name="logbutton">Login</button>
      </form>
    </div>
    <div class="sign-box" id="sign">
      <h2>Sign Up!</h2>
      <form method="POST" action="">
        <label for="signuser">Create Username</label>
        <input type="text" name="signuser" placeholder equals="Create Username" required>
        <label for="signpass">Create Password</label>
        <input type="password" name="signpass" placeholder equals="Create Password" required>
        <label for="verify">confirm Password</label>
        <input type="password" name="verify" placeholder equals="Verify Password" required>
        <button type="submit" name="signbutton">Sign Up</button>
      </form>
    </div>
  </div>

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
