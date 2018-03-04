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
  $description = 'add notes';
  $cssPath = '../css/index.css';

  $auth_user->closeConnection();

  if(isset($_POST['submit'])) {
    echo ('<p>successfully added note</p>');
    add_item();
  }
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


<form name="add_item_form" action="edit.php" method="post">
  <input type="text" name="title" id="title" value="Title"><br>
  <input type="text" name="description" id="title" value="Description"><br>
  <input type="number" name="priority" id="priority" value="0"><br>
  <input type="number" name="deadline" id="deadline" value="99999999"><br>
  <button type="submit" name="submit">Add Item</button>
</form>

</body>
</html>