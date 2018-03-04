<?php
  $cssPath = "css/index.css";
	require_once("session.php");
  require_once("class.user.php");
  
  $auth_user = new USER();
  $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $title = 'pryoritize';
  $description = 'please just work';
  $cssPath = '../css/index.css'

<<<<<<< HEAD
=======
  $auth_user->closeConnection();

  if(isset($_POST['submit'])) {
    removeTop($_SESSION['pq']); //ayy
  }
>>>>>>> 65a40b0cdb2dd58d243776a9672242024572df47
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



<<<<<<< HEAD
hi there
<?php print_r($_SESSION) ?>
<a href="logout.php?logout=true">log out</a>
=======
<form action="logout.php?logout=true" method="post" enctype="multipart/form-data">
  <button type="submit">Log Out</button>
</form>
>>>>>>> 65a40b0cdb2dd58d243776a9672242024572df47

</body>
</html>