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

?>