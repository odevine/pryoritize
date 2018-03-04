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

  function add_item($user_id, $title, $description, $priority, $deadline) {
    $d1 = new Datetime();
    global $db;
    $query = "INSERT INTO `list_item` (`item_id`, `user_id`, `title`, `description`, `priority`, `deadline`, `created_at`) 
              VALUES (NULL, ':user_id', ':title', ':description', ':priority', ':deadline', ':created_at')";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':priority', $priority);
    $stmt->bindValue(':deadline', $deadline);
    $stmt->bindValue(':created_at', $d1->format('U'));
    $stmt->execute();
  }

?>