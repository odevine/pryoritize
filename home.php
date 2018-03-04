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
  $description = 'dashboard';
  $cssPath = '../css/index.css';

  $auth_user->closeConnection();

  if(isset($_POST['submit'])) {
    removeTop($_SESSION['pq']); //ayy
  }
?>


<body>
<?php 
  $items = get_user_items($_SESSION['user_session']);
  $pq = new SplPriorityQueue();
  print_r($items);
  foreach($items as $item) { 
    $realPriority = calculatePriority($item['priority'], $item['created_at'], $item['deadline']);
    $pq->insert($item['title'].' - '.$realPriority, $realPriority);    
  }
  $_SESSION['pq'] = $pq; 
  echo '<div>'.$pq->current().'</div>';
?>

<form name="add_item_form" action="home.php" method="post">
  <button type="submit" name="submit">Done</button>
</form>



<form action="logout.php?logout=true" method="post" enctype="multipart/form-data">
  <button type="submit">Log Out</button>
</form>


</body>
</html>