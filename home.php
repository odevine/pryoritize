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

?>


<body>

hi there
<?php print_r($_SESSION) ?>
<a href="logout.php?logout=true">log out</a>

</body>
</html>