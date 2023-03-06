<!-- connect to database -->
<?php include("connect.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>index</title>
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
    .itemCard {
      border: 1px solid grey;
      display: inline-flex;
      flex-direction: column;
      padding: 12px
    }
    .itemCard img {
      width: 200px;
    }

  </style>
</head>
<body>
  <div class="nav">
    <a href="index.php">Home</a>
    <a href="cart.php">My Cart</a>
  </div>
  <div class="container">
    <?php
      $query = "SELECT * FROM products";
      $result = mysqli_query($conn, $query);

      $query = "SELECT * FROM users";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result)) {
        $b = $row['user_cart'];
      }
      $b = unserialize($b);
      
    
      print_r($b);
      
    ?>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
    <div class="itemCard">
      <form action="functions.php" method="POST">
        <!-- values to get -->
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
        <input type="hidden" name="product_qty" value="<?php echo $row['product_qty']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

        <!-- for display  -->
        <img src="https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png" alt="">
        <h3><?php echo $row['product_name']; ?></h3>
        <p>QTY: <?php echo $row['product_qty']; ?></p>
        <p>₱ <?php echo $row['product_price']; ?></p>
        <input type="submit" name="add_to_cart" value="Add to cart" />
      </form>
    </div>
    <?php }; ?>
  </div>
  
  
</body>
</html>