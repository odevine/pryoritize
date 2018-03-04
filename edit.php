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
    print_r($_SESSION['user_session']);
    print_r($_POST['title']);
    print_r($_POST['description']);
    print_r($_POST['priority']);
    print_r($_POST['deadline']);
    add_item();
  }
?>

<body>

<?php print_r($_SESSION) ?>

<form name="add_item_form" action="edit.php" method="post">
  <input type="text" name="title" id="title" value="Title"><br>
  <input type="text" name="description" id="title" value="Description"><br>
  <input type="number" name="priority" id="priority" value="0"><br>
  <input type="number" name="deadline" id="deadline" value="99999999"><br>
  <button type="submit" name="submit">Add Item</button>
</form>

</body>
</html>