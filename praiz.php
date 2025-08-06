<?php

include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Praiz Shopping</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .product-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      margin-top: 1rem;
    }
    .product {
      background-color: white;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
    }
    .product img {
      max-width: 100%;
      border-radius: 4px;
    }
    .product h3 {
      margin: 0.5rem 0;
    }
    .product a {
      display: inline-block;
      margin-top: 0.5rem;
      padding: 0.5rem 1rem;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
    .product a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <h1>Featured Products</h1>
  <div class="product-grid">
    <?php
    $result = $conn->query("SELECT * FROM products");
    if ($result && $result->num_rows > 0):
      while ($row = $result->fetch_assoc()):
    ?>
      <div class="product">
        <img src="<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">
        <h3><?= htmlspecialchars($row['name']); ?></h3>
        <p>$<?= htmlspecialchars($row['price']); ?></p>
        <a href="checkout.php?product=<?= urlencode($row['id']); ?>">View</a>
      </div>
    <?php
      endwhile;
    else:
      echo "<p>No products found.</p>";
    endif;
    $conn->close();
    ?>
  </div>
</body>
</html>