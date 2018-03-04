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


<script>
  var date = new Date();

  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();

  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  var today = year + "-" + month + "-" + day;       
  document.getElementById("theDate").value = today;
</script>


<body>


<form name="add_item_form" action="edit.php" method="post">
  <p>Title</p>
  <input type="text" name="title" id="title"><br>

  <p>Description</p>
  <input type="text" name="description" id="title"><br>
  
  <p>Priority</p>
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

  <p>Deadline</p>
  <div>
    <input type="radio" id="noDeadline" name="deadlineOption" value="none" checked>
    <label for="noDeadline">No Deadline</label>

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