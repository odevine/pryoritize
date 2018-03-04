<?php
  $title = "Pryoritize";
  $description = "The best god damn list-maker you've ever seen";
  $cssPath = "css/index.css";
  include ('includes/header.php');
  require ('includes/functions.php');

  session_start();

  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: ./login.php");
    exit;
  }
?>
    
  <body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>
    </div>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
  </body>
</html>