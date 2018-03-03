<?php

function get_inventory() {
  @ $fp = fopen("inventory/book_list.txt", 'r');
  if (!$fp) {
    echo "<p>No books found</p>";
  } else {
    $book = fgets($fp, 999);
    while (!feof($fp)) {
      $book_title = strtok($book, "/");
      $book_author = strtok("/");
      $book_isbn = strtok("/");
      $book_price = strtok("/");
      $book_quantity = strtok("/");

      if ($book_quantity == 0) {
        
      } else {
        $inventory[] = array(
          'title' => $book_title,
          'author' => $book_author,
          'isbn' => $book_isbn,
          'price' => $book_price,
          'quantity' => $book_quantity);
      }
      $book = fgets($fp, 999); 
    }
    fclose($fp);
  }
  return $inventory;
}

function update_inventory($array) {
  file_put_contents('inventory/book_list.txt', implode(PHP_EOL, $array));
}

function searchForId($id, $array) {
  foreach ($array as $key => $val) {
      if ($val['isbn'] === $id) {
          return $key;
      }
  }
  return null;
}

?>