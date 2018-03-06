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

    switch ($_POST['priority']) {
      case 'lowPriority':
        $priority = 25;
        break;
      case 'medPriority':
        $priority = 50;
        break;
      case 'highPriority':
        $priority = 75;
        break;
      default:
        $priority = 0;
        break;
    }

    if ($_POST['deadlineOption'] == 'none') {
      $deadline = null;
    } else {
      $deadline = strtotime($_POST['deadline_date'].' '.$_POST['deadline_time']);
    }
    
    $data = [
      'user_id' => $_SESSION['user_session'],
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'priority' => $priority,
      'deadline' => $deadline,
      'created_at' => $d1->format('U')
    ];
    $query = "INSERT INTO list_item (item_id, user_id, title, description, priority, deadline, created_at) 
              VALUES (NULL, :user_id, :title, :description, :priority, :deadline, :created_at)";
    $stmt= $db->prepare($query);
    $stmt->execute($data);
  }

  function calculatePriority($priority, $created_at, $deadline) {
    $d2 = new Datetime();
    if($deadline == null) {
      return $priority;
    } else {
      (int)$current = $d2->format('U');
      (int)$time_until_completion = $deadline - $current;  //time until deadline when checked
      (int)$maxTime = $created_at - $deadline;   //time until deadline when task created
      return $priority + ((1 - ($time_until_completion / $maxTime)) * (100 - $priority));
    }
  }

  function removeTop($pq) {
    if($pq->isEmpty()) {
      return;
    } else {
      $pq->extract();
    }
  }

  function remove_item($item_id) {
    global $db;
    echo $item_id;
    $query = "DELETE FROM list_item WHERE item_id=:item_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':item_id', $item_id);
    $stmt->execute();
    $stmt->closeCursor();
  }

  function access_item($item_id) {
    global $db;
    $query = "SELECT title FROM list_item WHERE item_id=:item_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':item_id', $item_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result;
  }

?>