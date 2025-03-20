<?php 

require_once 'middleware.php';

Middleware::auth();
Middleware::admin();

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&family=Rouge+Script&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5.0.0/themes.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

  <html data-theme="cupcake"></html>
  <title>dashboard</title>
</head>
<body>

  <style>

    .title {
      font-family: "Imperial Script", cursive;
      font-weight: 400;
      font-style: normal;
      font-size: 4vmin;
      margin: 5px 0;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #f2e8df;
      color: black;
      position: fixed;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .logo {
      width: 100%;
      text-align: center;
      padding: 20px 0;
      background-color: #f2e8df;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    .logo img {
      max-width: 80%;
      padding-left: 5vh;
    }
    .menu {
      width: 100%;
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .menu li {
      width: 100%;
      padding-top: 10px;
    }
    .menu li a {
      display: block;
      padding: 15px;
      color: black;
      text-decoration: none;
    }
    .menu li a:hover {
      background-color: #555;
    }
    
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-left: 250px; /* Adjust for sidebar width */
    }

    .content {
      width: 100%;
      padding: 20px;
      flex-grow: 1;
    }

    .logout {
      padding: 10px 20px;
      border: none;
      background-color: #f2e8df;
      color: black;
      cursor: pointer;
      border-radius: 5px;
    }
  </style>

<div class="container">
    <div class="sidebar">
      <div class="logo">
        <img src="assets/images/Logo.jpg" alt="Logo">
        <h1 class="title">Miss Crafts</h1>
        <h1><?= $_SESSION['user']; ?></h1>

      </div>
      <ul class="menu">
        <li><a href="dashboard.php">🏠 Dashboard</a></li>
      </ul>
      <ul class="menu">
          <li><a href="product_sales_inventory.php">💲 Product Sales Inventory</a></li>
      </ul>
      <ul class="menu">
        <li>
          <a href="#">💼 Product Inventory</a>
          <ul class="submenu">
            <li><a href="products.php">✔ Products</a></li>
            <li><a href="packages.php">✔ Packages</a></li>
            <li><a href="materials.php">✔ Raw Materials</a></li>
            <li><a href="package_materials.php">✔ Package Materials</a></li>
          </ul>
        </li>
      </ul>
      <form action="functions/logout.php" method="POST">
          <button class="logout btn btn-primary mt-4">Logout</button>
        </form>
    </div>

    <div class="content">
    
      <?php 
          include $content; 
      ?>

    </div>

</div>


</body>
</html>