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
    <tr>
      <th scope="row">1</th>
      <td>Shoes 1</td>
      <td>1</td>
      <td>100</td>
      <td><button>Delete</button></td>
    </tr>
  </tbody>
</table>
  </div>
</body>
</html>