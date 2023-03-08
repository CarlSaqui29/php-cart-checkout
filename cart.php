<!-- connect to database -->
<?php include("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }
    .nav {
      background-color: #000;
      padding: 15px 10px;
      margin-bottom: 20px;
    }
    .nav a {
      color: #fff;
      text-decoration: none;
      margin-right: 15px;
    }
  </style>
</head>
<body>
  <?php
    // get the user id after user is login and display its cart if user has
    $q1 = "SELECT * FROM users WHERE id=13";
    $res1 = mysqli_query($conn, $q1);
    $r1 = mysqli_fetch_array($res1);
    $b = $r1['user_cart'];
    $arr = unserialize($b);
    // var_dump($arr);
    // echo gettype($arr[0][0]);
  ?>

  <div class="nav">
    <a href="index.php">Home</a>
    <a href="cart.php">My Cart</a>
  </div>
  <div class="cart container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Product Name</th>
        <th scope="col">QTY</th>
        <th scope="col">Price</th>
        <th scope="col">Total</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($arr); $i++) {
        $total += $arr[$i][2]*$arr[$i][3];
        
      ?>
      
        <tr>
          <th scope="row"><?php echo $arr[$i][1]; ?></th>
          <td>
            <?php 
              // get the updated stock quantity of the product on the database
              $product_id = $arr[$i][0];
              $query_getUpdated_qty = "SELECT * FROM products WHERE id=$product_id"; 
              $query_getUpdated_qty_result = mysqli_query($conn, $query_getUpdated_qty);
              $updated_product_fetch = mysqli_fetch_array($query_getUpdated_qty_result);
              $updated_product_qty = $updated_product_fetch['product_qty'];
            ?>
            <input id="qty<?php echo $product_id; ?>"type="hidden" value="<?php echo $updated_product_qty; ?>">
            <button onclick="decrementItem(<?php echo $product_id; ?>,<?php echo $arr[$i][3];?>)">-</button>
            <input id="<?php echo $product_id; ?>" value="<?php echo $arr[$i][2]; ?>" type="number" disabled>
            <button onclick="incrementItem(<?php echo $product_id; ?>,<?php echo $arr[$i][3];?>)">+</button>
          </td>
          <td><?php echo $arr[$i][3]; ?></td>
          <td id="total<?php echo $product_id; ?>"><?php echo $arr[$i][2]*$arr[$i][3]; ?></td>
          <form action="functions.php" method="POST">
            <input type="hidden" name="prod_id" value=<?php echo $product_id; ?>>
            <td><input type="submit" name="delete_item" value="Delete" /></td>
          </form>
        </tr>
      
      <?php } ?>
    </tbody>
  </table>
  <h3 id="cart_total_text">Total: <?php echo $total ?></h3>
  <input type="hidden" id="cart_total" value=<?php echo $total ?>/>
  </div>
  <script>
    decrementItem = (id,price) => {
      let value = parseInt(document.getElementById(id).value);
      if (value === 1) {
        alert('Must Have atleast 1 item.')
      } else {
        document.getElementById(id).value = value - 1;
        computeCartTotalCost('decrement',price);
      }
    }

    incrementItem = (id,price) => {
      let product_stock = parseInt(document.getElementById('qty' + id).value);
      let value = parseInt(document.getElementById(id).value);
      if (value === product_stock) {
        alert('Out of Stock')
      } else {
        let totalValue = value + 1;
        document.getElementById(id).value = totalValue;
        document.getElementById('total' + id).innerHTML = totalValue * price;
        computeCartTotalCost('increment',price);
      }
    }

    computeCartTotalCost = (func,price) => {
      console.log('here')
      let cart_total = parseInt(document.getElementById('cart_total').value);
      cart_total = func === "increment" ? cart_total += price : cart_total -= price;
      document.getElementById('cart_total_text').innerHTML = 'Total: ' +  cart_total;
      document.getElementById('cart_total').value = cart_total;
    }

  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>
</html>