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

<body>


<form name="add_item_form" action="edit.php" method="post">
  <input type="text" name="title" id="title" value="Title"><br>
  <input type="text" name="description" id="title" value="Description"><br>
  <div>
    <input type="radio" id="noPriority" name="priority" value="noPriority" checked>
    <label for="noPriority">None</label>

    <input type="radio" id="lowPriority" name="priority" value="lowPriority">
    <label for="lowPriority">Low</label>

    <input type="radio" id="medPriority" name="priority" value="medPriority">
    <label for="medPriority">Med</label>

    <input type="radio" id="highPriority" name="priority" value="highPriority">
    <label for="highPriority">High</label>
  </div>
  <input type="number" name="deadline" id="deadline" value="99999999"><br>
  <button type="submit" name="submit">Add Item</button>
</form>

</body>
</html>