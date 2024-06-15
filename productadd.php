
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap"
      rel="stylesheet"
    />
    <title>Add Products</title>
    <link rel="stylesheet" href="padd.css" />
  </head>
  <body>
    <div class="maincontainer">
      <img src="home.jfif" alt="" />
    </div>
    <div class="imgcontainer">
      <p
        style="
          font-family: 'Ubuntu-Bold', sans-serif;
          color: white;
          font-size: 30px;
        "
      >
        Add Products
      </p>
    </div>
    <div class="imgcontainer1">
      <p
        style="
          font-family: 'Ubuntu-Bold', sans-serif;
          color: white;
          font-size: 20px;
        "
      >
        ***Please Enter all the product details here***
      </p>
    </div>
    <form action="productadd.php"  method="post" enctype="multipart/form-data">
      <div class="divcontainer">
        <div class="container">
          <input
            type="text"
            placeholder="Enter Product Name"
            name="pname"
            required
          />
        </div>
        <div class="container">
          <textarea
            name="pdescript"
            id=""
            cols="50"
            rows="5"
            placeholder="Enter Product Description"
          ></textarea>
        </div>
        <div class="container">
          <label style="color: white; font-size: large; padding-right: 10px"
            >Choose Category</label
          >
          <select name="pcat" id="select1">
            <option value="Racquet">Racquets</option>
            <option value="Shuttle">Shuttle</option>
            <option value="Shoes">Shoes</option>
            <option value="Gripper">Grippers</option>
          </select>
        </div>
        <div class="container">
          <input
            type="number"
            placeholder="Enter the cost in INR"
            name="pcost"
            required
          />
          <div class="container">
          <input
            type="number"
            placeholder="Enter the Quantity"
            name="pquantity"
            required
          />
        </div>
         <div class="container">
          <label
            for="img"
            style="color: white; font-size: large; padding-right: 10px"
            >Select image:</label
          >
          <input type="file" id="imgg" name="imgg" accept="image/*" />
        </div>
          <button type="submit" name="upload"><span></span>Add</button>
          <a
            href="ad.html"
            style="color: white; font-family: 'Ubuntu-Bold', sans-serif"
            >Back</a
          >
          <!--<% if(msg!=''){ %>
          <script>
            alert("Product added Successfully!!");
          </script>
          <% } %>-->
        </div>
      </div>
    </form>
  </body>
</html>








<?php
error_reporting(0);
@include 'config.php';

// Check if the form is submitted
    // Validate and process the form data
    if (isset($_POST['upload'])) {
    $name = $_POST["pname"];
    $descript = $_POST["pdescript"];
    $cost = $_POST["pcost"];
    $quantity = $_POST["pquantity"];

    $category = $_POST["pcat"];
    $filename = $_FILES["imgg"]["name"];
    $tempname = $_FILES["imgg"]["tmp_name"];
    $folder = "./image/" . $filename;


  //   // IMAGE
  //  // $files = $_FILES['file'];
  //   $filename = $files['name'];$update_image = $_FILES['update_image']['name'];
  //  $update_image_size = $_FILES['update_image']['size'];
  //  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  //  $update_image_folder = 'uploaded_img/'.$update_image;
  //   $filererror = $files['error'];
  //   $filetemp = $files['tmp_name'];
  //   $fileext = explode('.', $filename);
  //   $filecheck = strtolower(end($fileext));
  //   $fileextstored = array('png', 'jpg', 'jpeg');

    // if (in_array($filecheck, $fileextstored) && $filererror === 0) {
    //     $destinationfile = "image/*" . $filename;
    //    move_uploaded_file($filetemp, $destinationfile);

    if (move_uploaded_file($tempname, $folder)) {

        $ins = "INSERT INTO products (pname, pdescript, pcost, pcat, imgg,pquantity) VALUES ('$name', '$descript', '$cost', '$category', '$filename','$quantity')";
        mysqli_query($conn, $ins);
        echo '<script>alert("Product Added Successfully!!!")
              window.location = "ad.html";
               </script>';

  
   } else {
         echo '<script>alert("Failed to insert image. Only PNG, JPG, and JPEG files are allowed.")
              window.location = "ad.html";
                </script>';
     }
  }
?>
