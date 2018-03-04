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
  $cssPath = '../css/index.css';

  $auth_user->closeConnection();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css" type="text/css"  />
		<link rel="stylesheet" href="css/material-kit.css">
		<link rel="stylesheet" href="css/material-kit.css.map">
		<link rel="stylesheet" href="css/material-kit.min.css">
    <link rel="stylesheet" href="css/index.css">
    
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
		<link rel="stylesheet" href="./assets/css/material-kit.css?v=2.0.2">

		<img src="images/pryoritize.png">
</head>
<body>
  <?php 
  $items = get_user_items($_SESSION['user_session']);
  $pq = new SplPriorityQueue();
  foreach($items as $item) { 
    $pq->insert($item['title'].' - '.$item['priority'], $item['priority']);    
  }
  // Iterate the queue (by priority) and display each element
  while ($pq->valid()) {
  print_r($pq->current());
  echo '<br>';
  echo PHP_EOL;
  $pq->next();
}
  ?>

</body>
</html>