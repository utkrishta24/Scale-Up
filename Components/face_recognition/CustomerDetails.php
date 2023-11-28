<?php
include_once 'db.php';
$result = mysqli_query($mysqli, "SELECT * FROM facerecog where slno={$slno}");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/13f8fb2909.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./formcss.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
  
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>MS Engage Project-Customer</title>
</head>

<body>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
                                <script type='text/javascript' src='#'></script>
                                <script type='text/javascript' src='#'></script>
                                <script type='text/javascript'>#</script>
                                <script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
                                myLink.addEventListener('click', function(e) {
                                  e.preventDefault();
                                });</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <nav class="navbar navbar-expand-lg navbar-red navbar-dark">
    <div class="wrapper">

    </div>
    <div class="container-fluid all-show">
      <a class="navbar-brand" href="#">Scale-Up <i class="fa fa-shopping-cart fa-regular" aria-hidden="true"></i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/index.php" target="_blank" >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:5000" target="_blank" >Customer Recognition</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:5000" target="_blank" >Product Recognition</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.figma.com/file/RDyyznQDQkaj9PuPMeQdrb/Microsoft-Engage--2022?node-id=0%3A1" target="_blank" >How it works?</a>
          </li>
        </ul>
<div class="d-flex flex-column sim">

      </div>
    </div>
      </div>
  </nav>

    <?php
    // LOOP TILL END OF DATA
    while ($rows = $result->fetch_assoc()) {
    ?>

        <div class="container">
            <div class="card">
                <div class="info">
                    <span>Customer Number: <?php echo $rows['slno']; ?></span>

                </div>

                <div class="forms">
                    <div class="text-center img-customer">
                        <div class="profile-img">
                            <img src=" <?php echo $rows['image']; ?>" alt="" />
                        </div>
                    </div>
                    <div class="inputs">
                        <span>Name</span>
                        <input type="text" name="name" readonly value="<?php echo $rows['name']; ?>">
                    </div>
                    <div class="inputs">
                        <span>Budget Slab</span>
                        <input type="text" name="budget_slab" readonly value="<?php echo $rows['budget_slab']; ?>">
                    </div>
                    <div class="inputs">
                        <span>Contact Number</span>
                        <input type="text" name="contact_number" readonly value="<?php echo $rows['contact_number']; ?>">
                    </div>
                    <div class="inputs">
                        <span>Email</span>
                        <input type="text" name="email" readonly value="<?php echo $rows['email']; ?>">
                    </div>
                    <div class="inputs">
                        <span class="title">Premium Produts</span>
                        <input type="text" name="premium_products " readonly value=" <?php echo $rows['premium_products']; ?>">
                    </div>
                    <div class="inputs">
                        <span class="title">Average Product</span>
                        <input type="text" name="average_product" readonly value="<?php echo $rows['average_product']; ?>">
                    </div>
                    <div class="inputs">
                        <span class="title">Additional Details</span>
                        <input type="text" name="additional" readonly value="<?php echo $rows['additional']; ?>">
                    </div>
                </div>
                <div class="text-center mb-2 mt-2">
                    <button class="btn btn-primary text-center"><a href="./edit.php" style="text-decoration:none; color:white;">Edit Details</a></button>
                </div>
            </div>
        </div>
        <div class="">
            <footer class="flex-wrap justify-content-between align-items-center py-3 my-2 border-top">
                <div class="text-center">
                    <a href="https://www.linkedin.com/in/isha-rastogi-5957a51b7/" target="_blank">
                        <h5>Made by Isha Rastogi</h5>
                        <h6>Connect with me: <i class="fab fa-linkedin"></i></h6>
                    </a>
                </div>
            </footer>
        </div>
    <?php
    }
    ?>






</body>

</html>