<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['email'])) {
    $userId = $_SESSION['email'];
    if ($_SERVER['PHP_SELF'] == 'login.php') { // Check if the current page is not login.php
        header('Location: home.php');
        exit();
    }
} else {
   
        header('Location: login.php');
        exit();
    }

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="home.css" />
<style>  .Button {
  border-radius: 25px;
  width: 150px;
  padding: 15px 0;
  margin: 20px 10px;
  font-weight: bold;
  border: 1px solid black;
  background-color: white;
  color: black;
  position: relative;
  overflow: hidden;
  transition: 0.5s;
  text-align: center;
  text-decoration: none;
}

.Button:hover {
  color: #fff;
  background-color: black;
}
body {
  background-color: #F2F2F2; /* Dull cement white */
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

.navbar-container {
  background-color: #333;
  color: white;
  height: 80px; /* Decreased height */
}

.logo {
  font-size: 36px;
  margin: 0;
}

.highlight {
  color: #FFD700; /* Change this to the desired highlight color */
}

nav ul {
  list-style: none;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  padding: 0;
  margin: 0;
}

nav ul li {
  margin-right: 15px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
}

nav ul li a:hover {
  color: #ccc;
}
.profile-button {
  position: absolute;
  left: 90%;
  background-color: white;
  border-radius: 25px;
  padding: 10px;
}

.profile-button a {
  color: black;
  margin-bottom: 10px;
  text-align: center;
  font-size: 17px;
  font-weight: bold;
}
.navbar-container header {
  padding: 20px;
  text-align: center;
}

.navbar-container header p {
  margin: -14px 0 0; /* Adjust the margin-top value as needed */
  font-size: 24px;
  font-weight: bold;
  text-decoration: underline;
  transition: color 0.5s ease;
}

.navbar-container header:hover p {
  color: #FFD700;
}
 </style>
    <script></script>
    <title>Welcome</title>
  </head>
  <body>
  <div class="navbar-container">
  <header>
    <p>Badminton Hub</p>
  </header>
  <header>
    <p>  </p>
  </header>
  <nav>
    <ul id="mainMenu">
    <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
  <li><a href="services.php"><i class="fas fa-cogs"></i> Services</a></li>
  <li><a href="x2.php"><i class="fas fa-shopping-bag"></i> Products</a></li>
  <li><a href="orders.php"><i class="fas fa-clipboard-list"></i> Orders</a></li>
  
      <li><a href="cart.php"><strong><i class="fas fa-shopping-cart"></i> Cart</strong></a></li>
      <li class="profile-button"><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
    </ul>
  </nav>
</div>
    <div
      id="carouselExampleCaptions"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
    >
      <div class="carousel-indicators">
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="0"
          class="active"
          aria-current="true"
          aria-label="Slide 1"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="1"
          aria-label="Slide 2"
        ></button>
        <button
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide-to="2"
          aria-label="Slide 3"
        ></button>
      </div>
      <div class="carousel-inner"> 
        <div class="carousel-item active">
          <img src="ss1.jpg" height="500" class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h2>Welcome to Badminton Hub</h2>
            <p>
              I love winning more than I love playing badminton. Winning is
              everything.<strong>-Saina Nehwal</strong>
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="ss.jpg" height="500"class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h2>Shop for Products</h2>
            <p>
              There will be many obstacles in the pursuit of your dreams. I had
              long hours of training, balancing studies and badminton.
              <strong>-P V Sindhu</strong>
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="ss2.jpg"height="500" class="d-block w-100" alt="..." />
          <div class="carousel-caption d-none d-md-block">
            <h2 >Book Services</h2>
            <!-- <p style="color: rgb(104, 104, 104); display: inline"> -->
              Badminton is not only about winning. What is important to me is
              about playing hard, doing my best and putting up a good show for
              the spectators.<strong>-Lin Dan</strong>
            </p>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="products-container">
      <div class="line"></div>
      <p style="font-size: 25px; color: white; position: absolute; left: 110px">
        Shop By category
      </p>
      <div class="products">
        <div class="card" style="width: 18rem">
          <img src="b1.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Rackets</h5>
            <p class="card-text">
              Shop for various Brands of rcakets such as YONEX,APACS,ASHWAY..
            </p>
            
            <form  id="productForm"action="x2.php" method="get">
  <input type="hidden" name="select_product" value="Racquet">
  <button class="Button" type="submit">Shop Now</button>
</form>

          </div>
        </div>
        <div class="card" style="width: 18rem">
          <img src="s1.jpg" class="card-img-top" alt="..." height="160px" />
          <div class="card-body">
            <h5 class="card-title">Shuttles</h5>
            <p class="card-text">
              Shop for varois Shuttle cocks Feather cocks or plastic cocks
            </p>
          
            <form action="x2.php" method="get">
  <input type="hidden" name="select_product" value="Shuttle">
  <button class="Button" type="submit">Shop Now</button>
</form>
          </div>
        </div>
        <div class="card" style="width: 18rem">
          <img src="sh1.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">Shoes</h5>
            <p class="card-text">Shop for varoius Brands of Badminton Shoes</p>
           
            <form action="x2.php" method="get">
  <input type="hidden" name="select_product" value="Shoes">
  <button class="Button" type="submit">Shop Now</button>
</form>
          </div>
        </div>
        <div class="card" style="width: 18rem">
          <img src="ac1.jpg" class="card-img-top" alt="..." height="160px" />
          <div class="card-body">
            <h5 class="card-title">Others Accessories</h5>
            <p class="card-text">
              Shop for other Accesories such as grippers,strings,kit-bags
            </p>
            
            <form action="x2.php" method="get">
  <input type="hidden" name="select_product" value="Gripper">
  <button class="Button" type="submit">Shop Now</button>
</form>
          </div>
        </div>
      </div>
    </div>
    <div class="service-container">
      <img src="st11.jpg" height="300" width="1000" alt="Snow"  />

      <div class="top-right">
        <p style="font-size: 30px; font-weight: 400">
          Looking for Stringing For your rackets??
        </p>
        <button class="Button"onclick="window.location.href = 'servicebooking.php'"><span></span>Book Now</button>
      </div>
    </div>
    <!-- <div class="gallery">
      <img src="logo1.png" alt="Cinque Terre"  />
    </div>

    <div class="gallery">
      <img src="logo2.png" alt="Forest"  />
    </div>

    <div class="gallery">
      <img src="logo3.png" alt="Northern Lights"  />
    </div>

    <div class="gallery">
      <img src="logo4.jpg" alt="Mountains"  />
    </div>
    <div class="gallery">
      <img src="logo5.png" alt="Mountains"  />
    </div>
    <div class="gallery">
      <img src="logo6.png" alt="Mountains"  />
    </div> -->
    <footer class="footer">
      <div class="about">
        <p><strong>About</strong></p>
        <p><a href="contact.php">Contact Us</p>
        <p><a href="about.php">About us</p>
        <p>Our Social Media Handles:</p>
        <div class="icons">
          <a href="#"
            ><img src="whatsapp1.png" alt="" width="20" height="20"
          /></a>
          <a href="#"
            ><img src="facebook1.png" alt="" width="20" height="20"
          /></a>
          <a href="#"
            ><img src="instagram.png" alt="" width="20" height="20"
          /></a>
        </div>
      </div>

      <div class="help">
        <p><strong>Help</strong></p>
        <p><a href="payments.php">Payments</p>
        <p><a href="shipping.php">Shipping</p>
      </div>
      <div class="address">
        <p><strong>Visit our Shop:</strong></p>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3884.197886376466!2d75.00047231461471!3d13.212889390697955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbb57ccb46f93fd%3A0x5463a907579f060!2sThribhuvan%20badminton%20Hub%20and%20Gutting%20centre!5e0!3m2!1sen!2sin!4v1640965345331!5m2!1sen!2sin"
          width="200"
          height="200"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
        ></iframe>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>