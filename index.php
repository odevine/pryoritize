<?php
  $title = "Bookstore";
  $description = "This is a description";
  $cssPath = "css/index.css";
  include ('includes/header.php');
  require ('includes/functions.php');

  session_start();

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  if (isset($_POST['add_to_cart'])){
    $_SESSION['cart'][] = $_POST['add_to_cart'];
    unset($_POST['add_to_cart']);
  }

  if (isset($_POST['clear_cart'])){
    unset($_SESSION['cart']);
    unset($_POST['clear_cart']);
  }

  if (isset($_POST['order_made'])){
    unset($_SESSION['cart']);
    unset($_POST['clear_cart']);
  }
?>
    

  <body>
    <header>
      <h1>Generic Bookstore</h1>
    </header>

    <div id="cart">
      <a href="cart.php"><img src="images/cart.png"></a>
    </div>
    
    <main>
      <?php    
        $inventory = get_inventory();
        $_SESSION['inventory'] = $inventory;
        foreach ($inventory as $book) { ?> 
          <figure>
            <img src="./images/<?php echo $book['isbn']?>.jpg">
            <figcaption><p id="title"><?php echo $book['title']?></p>
              <p>by <?php echo $book['author']?></p>
              <p>$<?php echo $book['price']?></p>
              <form method="post">
                <input type="hidden" name="add_to_cart" value="<?php echo $book['isbn']; ?>">
                <button type="submit" value="Add to Cart">Add to Cart</button>
              </form>
            </figcaption>
          </figure>
        <?php 
        }          
        ?> 
    </main>
    <?php include ('includes/footer.html');?>
  </body>
</html>