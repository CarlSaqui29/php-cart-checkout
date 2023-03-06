<?php
include("connect.php");

if (isset($_POST['add_to_cart'])) {
  // init is_on_cart to false
  $is_on_cart = false;
  // getting the details of the item that user has clicked
  $product_id = $_POST['id'];
  $product_name = $_POST['product_name'];
  $product_qty = $_POST['product_qty'];
  $product_price = $_POST['product_price'];

  // get all the current items of the cart of user then add the new one if does not exist else do not add
  $add_item_query = "SELECT * FROM users WHERE id=13";
  $add_item_query_result = mysqli_query($conn, $add_item_query);
  $cart_data = mysqli_fetch_array($add_item_query_result);
  $user_cart = $cart_data['user_cart'];

  // if the user's cart is empty then create new cart/array then add the item that user has clicked
  // else just add the item that user select to existing cart/array
  // array structure: product_id, product_name, initial_quantity, product_price, product_stock_quantity
  if ($user_cart == '' || $user_cart == null) {
    $arr = array(
      array($product_id, $product_name, 1, $product_price, $product_qty)
    );
    // serialize the array
    $serialize_arr = serialize($arr);
    // update the cart/array of user to the database
    $conn->query("UPDATE users SET name='$id', user_cart='$serialize_arr' WHERE id=13") or die($conn->error);
    header("Location: index.php");
  } else {
    // search if the item is on the cart
    $arr = unserialize($user_cart);
    for ($i = 0; $i <= count($arr); $i++) {
      if ($product_id == $arr[$i][0]) {
        $is_on_cart = true;
        break;
      }
    }

    // check if the item is already in the cart
    if ($is_on_cart) {
      // then prompt user that the item is already in the cart
      echo "<script> 
            alert('This item is already on your cart')
            window.location.href='index.php';
          </script>";
    } else {
      // add the item to the array/cart
      array_push($arr, array($product_id, $product_name, 1, $product_price, $product_qty));
      // serialize the array
      $serialize_arr = serialize($arr);
      // update the cart/array of user to the database
      $conn->query("UPDATE users SET name='$id', user_cart='$serialize_arr' WHERE id=13") or die($conn->error);
      header("Location: index.php");
    }
  }
  
  
}

?>