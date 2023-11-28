 <!-- To initialize Database Connection -->
<?php
    $host='localhost';
    $username='root';
    $password='';
    $dbname = "engage";
    $mysqli=mysqli_connect($host,$username,$password,"$dbname");
    if ($mysqli->connect_error) {
      die('Connect Error (' .
          $mysqli->connect_errno . ') ' .
          $mysqli->connect_error);
  }
  $filename = "id.txt";
  $file = fopen( $filename, "r" );
  $filesize = filesize( $filename );
  $slno = fread( $file, $filesize);
?>