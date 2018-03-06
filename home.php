<?php
  $cssPath = "css/index.css";
	require_once("session.php");
  require_once("class.user.php");
  require("functions.php");
  $auth_user = new USER();
  $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $title = 'pryoritize';
  $description = 'please just work';
  $cssPath = '../css/index.css';

  $auth_user->closeConnection();

  if(isset($_POST['submit'])) {
    remove_item($_SESSION['maxItem']); //ayy
  }
  $description="";    
  require("includes/header.php");
?>
    <div class="nav">
<a href="home.php">Home |</a>
<a href="edit.php">Add Items |</a>
<a href="list.php">View List</a>
</div>  
<body>
<div class="centerme">
<?php 
  $items = get_user_items($_SESSION['user_session']);
  $maxPriority = 0;
  $maxItem = 0;
  foreach($items as $item) { 
    $realPriority = calculatePriority($item['priority'], $item['created_at'], $item['deadline']);
    if($realPriority > $maxPriority){
      $maxPriority = $realPriority;
      $maxItem = $item['item_id'];
    }
  }
  echo access_item($maxItem)[0]['title'];
  $_SESSION['maxItem'] = $maxItem;
?>
</div>

<form class="alicent" name="add_item_form" action="home.php" method="post">
  <button class="btn btn-success" type="submit" name="submit">Done!</button>
</form>



<form action="logout.php?logout=true" method="post" enctype="multipart/form-data">
  <button class="btn btn-failure" type="submit">Log Out</button>
</form>

</body>
</html>