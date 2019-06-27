<?php
namespace Somewhere\Persistence;

use \FormsEngine\Answers\Persistence\Persistence;

class DBPersistence implements Persistence {

  public static function persist($data){
    $mysqli = DBPersistence::connect();
    if (!$mysqli){
      echo 'ERROR Connect to DB.';
    }
    else {
      $query = "INSERT INTO myCity VALUES (NULL, 'Stuttgart', 'DEU', 'Stuttgart', 617000)";
      $mysqli->query($query);
      if (!$mysqli->insert_id){
        echo 'ERROR Could not Insert Data: '.\implode(',',$data);;
      }
    }
  }

  private static function connect(){
    $mysqli = new mysqli('127.0.0.1', 'your_user', 'your_pass', 'sakila');
    if ($mysqli->connect_errno) {
        // The connection failed. What do you want to do?
        // You could contact yourself (email?), log the error, show a nice page, etc.
        // You do not want to reveal sensitive information

        // Let's try this:
        echo "Sorry, this website is experiencing problems.";

        // Something you should not do on a public site, but this example will show you
        // anyways, is print out MySQL error related information -- you might log this
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";

        // You might want to show them something nice, but we will simply exit
        return false;
    }
    else {
      return $mysqli;
    }
  }
}
?>
