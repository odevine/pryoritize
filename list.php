<?php
	require_once("session.php");
  require_once("class.user.php");
  require("functions.php");
  
  $auth_user = new USER();
  $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $title = 'pryoritize';
  $description = 'view notes';
  $cssPath = 'css/index.css';

  $auth_user->closeConnection();
  require("includes/header.php");
?>
<div class="nav">
<a href="home.php">Home |</a>
<a href="edit.php">Add Items |</a>
<a href="list.php">View List</a>
</div>  
  <body>
  <div class="list">
    <?php 
    $items = get_user_items($_SESSION['user_session']);
    $pq = new SplPriorityQueue();
    foreach($items as $item) { 
      $realPriority = calculatePriority($item['priority'], $item['created_at'], $item['deadline']);
      $pq->insert($item['title'].' - '.$item['description'], $realPriority);    
    }
    $_SESSION['pq'] = $pq;
    // Iterate the queue (by priority) and display each element
    while ($pq->valid()) {
      print_r($pq->current());
      echo '<br>';
      echo PHP_EOL;
      $pq->next();
    } ?>
    </div>
  </body>
</html>