<?php
include('db2.php');
$query = "SELECT * FROM objects";
$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="icon" href="data:;base64,iVBORw0KGgo=">
       <link rel="stylesheet" href="./table.css">
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css'>
       <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css'>
       <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'>
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
       <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
       <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <title>MS Engage Project-Object Recognition</title>

</head>

<body>

       <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
       <script type='text/javascript' src='#'></script>
       <script type='text/javascript' src='#'></script>
       <script type='text/javascript'>
              #
       </script>
       <script type='text/javascript'>
              var myLink = document.querySelector('a[href="#"]');
              myLink.addEventListener('click', function(e) {
                     e.preventDefault();
              });
       </script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
       <nav class="navbar navbar-expand-lg navbar-red navbar-dark">
              <div class="wrapper">

              </div>
              <div class="container-fluid all-show">
                     <a class="navbar-brand" href="#">Scale-Up <i class="fa fa-shopping-cart fa-regular" aria-hidden="true"></i></a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navi navbar-collapse" id="navbarSupportedContent">
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

       <div class="row justify-content-center">
              <div class="col-auto" style="margin:auto">
                     <!-- table -->
                     <table class="table table-responsive rounded" style="border:1; height:400px !important">
                            <thead class="table-primary">
                                   <th>Product id</th>
                                   <th>Product name</th>
                                   <th>Product Count</th>
                            </thead>
                            <?php
                            if ($result->num_rows > 0) {
                                   $sn = 1;
                                   while ($data = $result->fetch_assoc()) {
                            ?>
                                          <tr>

                                                 <td class="table-warning"><?php echo $data['id']; ?> </td>
                                                 <td class="table-info"><?php echo $data['name']; ?> </td>
                                                 <td class="table-warning"><?php echo $data['count']; ?> </td>

                                          <tr>
                                          <?php
                                          $sn++;
                                   }
                            } else { ?>
                                          <tr>
                                                 <td colspan="8">No data found</td>
                                          </tr>
                     </table>
              </div>
       </div>
       <!-- footer -->
       <div class="container">
              <footer>
                     <div class="text-center">
                            <a href="https://www.linkedin.com/in/isha-rastogi-5957a51b7/" target="_blank">
                                   <h5>Made by Isha Rastogi</h5>
                                   <h6>Connect with me: <i class="fab fa-linkedin"></i></h6>
                            </a>
                     </div>
              </footer>
       </div>
</body>

</html>
<?php } ?>