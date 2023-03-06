<?php
include("connect.php");

if (isset($_POST['add_to_cart'])) {
  $id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $product_qty = $_POST['product_qty'];
  $product_price = $_POST['product_price'];

  $array = array(
    array('name', 'age', 'gender' ),
    array('Ian', 24, 'male'),
    array('Janice', 21, 'female')
  );
  $a = serialize($array);


  $conn->query("INSERT INTO users (name, user_cart) VALUES('$id','$a')") or die($conn->error);
  header("Location: functions.php");

 
}




?>