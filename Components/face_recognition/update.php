<?php include "db.php"; ?>
<?php
//Updating changes content
$name=$_POST['name'];
$sql="UPDATE facerecog set name='$name' where slno='{$slno}'";
$result=$mysqli->query($sql);
$budget_slab=$_POST['budget_slab'];
$sql="UPDATE facerecog set budget_slab='$budget_slab' where slno='{$slno}'";
$result=$mysqli->query($sql);
$contact_number=$_POST['contact_number'];
$sql="UPDATE facerecog set contact_number='$contact_number' where slno='{$slno}'";
$result=$mysqli->query($sql);
$email=$_POST['email'];
$sql="UPDATE facerecog set email='$email' where slno='{$slno}'";
$result=$mysqli->query($sql);
$premium_products=$_POST['premium_products'];
$sql="UPDATE facerecog set premium_products='$premium_products' where slno='{$slno}'";
$result=$mysqli->query($sql);
$average_product=$_POST['average_product'];
$sql="UPDATE facerecog set average_product='$average_product' where slno='{$slno}'";
$result=$mysqli->query($sql);
$additional=$_POST['additional'];
$sql="UPDATE facerecog set additional='$additional' where slno='{$slno}'";
$result=$mysqli->query($sql);

header("Location:./CustomerDetails.php");
?>



