<?php


@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select = "SELECT * FROM register WHERE email = '$email' AND password = '$pass'";
   $result = mysqli_query($conn, $select);
   $count = mysqli_num_rows($result);

   if ($count > 0) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['email'] = $row['email'];
      $_SESSION['user_type'] = $row['user_type'];

      if ($row['user_type'] == 'admin') {
         header('Location: ad.html');
         exit();
      } elseif ($row['user_type'] == 'user') {
         header('Location: home.php');
         exit();
      }
   } else {
      echo '<script>alert("Incorrect user details! Please enter correct credentials.");</script>';
   }
}
?>

 




<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap"
      rel="stylesheet"
    />
    <title>Login Page </title>
    <link rel="stylesheet" href="login.css" />
   
  </head>
  <body>
    <div class="maincontainer">
      <img src="download.jpg" alt="" />
    </div>
     
    <div class="imgcontainer">
      <p
        style="
          font-family: 'Ubuntu-Bold', sans-serif;
          color: white;
          font-size: 30px;
        "
      >
         Login Page
      </p>
       <div class="line"></div>
    </div>
     
    
     
    
    <form action=""  method="post">
     
      </div>
     
      <div class="divcontainer">
        <div class="container">

          <input
            type="email"
            placeholder="Enter Email ID"
            name="email"
            required
          />
          
          <input
            type="password"
            id="pass"
           
            placeholder="Enter Password"
            name="password"
            required
          />
          

          <button type="submit" name="submit" ><span></span>Login</button>
          

          <a
            href="register.php"
            style="color: white; font-family: 'Ubuntu-Bold', sans-serif"
            >Not yet registered?</a>

            <a
            href="forgot.php"
            style="color: white; font-family: 'Ubuntu-Bold', sans-serif"
            >Forgot Password?</a>
        </div>
        
      
      </div>
    </form>
  </body>
</html>



