<?php
  require_once('dbconfig.php');

  function get_user_id($username) {
    $query = "SELECT id FROM users 
              WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
  }

<<<<<<< HEAD
=======
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
    if($deadline == null) {
      return $priority;
    } else {
      $time_until_completion = $deadline - $created_at;
      return $priority * (1 - ($time_until_completion / $created_at)) * (100 - $priority);
    }
  }

  function removeTop($pq) {
    if($pq->isEmpty()) {
      return;
    } else {
      $pq->extract();
    }
  }

>>>>>>> 65a40b0cdb2dd58d243776a9672242024572df47
?>