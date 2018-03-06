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
  $cssPath = 'css/index.css';

  $auth_user->closeConnection();

  if(isset($_POST['submit'])) {
    echo ('<p>successfully added note</p>');
    add_item();
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

<form name="add_item_form" action="edit.php" method="post">
  <p>Title</p>
  <input type="text" name="title" id="title"><br>

  <p>Description</p>
  <input type="text" name="description" id="title"><br>
  
  <p>Priority</p>
  <div class="leftali">
    <input type="radio" id="noPriority" name="priority" value="noPriority" checked>
    <label for="noPriority">None</label>
    <div></div>
    <input type="radio" id="lowPriority" name="priority" value="lowPriority">
    <label for="lowPriority">Low</label>
    <div></div>
    <input type="radio" id="medPriority" name="priority" value="medPriority">
    <label for="medPriority">Med</label>
    <div></div>
    <input type="radio" id="highPriority" name="priority" value="highPriority">
    <label for="highPriority">High</label>
  </div>

  <p>Deadline</p>
  <div>
    <input type="radio" id="noDeadline" name="deadlineOption" value="none" checked>
    <label for="noDeadline">No Deadline</label>
    <div></div>
    <input type="radio" id="deadline" name="deadlineOption" value="yes">
    <label for="noPriority">
      <input type="date" name="deadline_date" id="deadline_date" value="<?php echo date("Y-m-d"); ?>">
      <input type="time" name="deadline_time" id="deadline_time" value="12:00"><br>
    </label>
  </div>

  <button type="submit" name="submit">Add Item</button>
</form>

</body>
</html>