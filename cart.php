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
  if ($b == '' || $b == null) {
    // echo "wtf";
  }
  // echo count($arr);

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
            <button>-</button>
            <input value="<?php echo $arr[$i][2]; ?>" type="number" max="<?php echo $arr[$i][4] ?>" min="1" disabled>
            <button>+</button>
          </td>
          <td><?php echo $arr[$i][3]; ?></td>
          <td><?php echo $arr[$i][2]*$arr[$i][3]; ?></td>
          <td><button>Delete</button></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <h3>Total: <?php echo $total ?></h3>
    
  </div>
</body>
</html>