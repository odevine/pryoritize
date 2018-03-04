<?php
  require_once('dbconfig.php');

  $database = new Database();
  $db = $database->dbConnection();

  function get_user_items($user_id) {
    global $db;
    $query = "SELECT * FROM list_item 
              WHERE user_id = :user_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
  }

  function add_item() {
    $d1 = new Datetime();
    global $db;
    
    $data = [
      'user_id' => $_SESSION['user_session'],
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'priority' => $_POST['priority'],
      'deadline' => $_POST['deadline'],
      'created_at' => $d1->format('U')
    ];
    $query = "INSERT INTO list_item (item_id, user_id, title, description, priority, deadline, created_at) 
              VALUES (NULL, :user_id, :title, :description, :priority, :deadline, :created_at)";
    $stmt= $db->prepare($query);
    $stmt->execute($data);
  }

?>