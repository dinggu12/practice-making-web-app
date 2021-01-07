<?php
  // write.php에서 받아온 데이터를 데이터베이스에 삽입.
  // user테이블에 해당 유저가 없으면 만들어준다. 
  require("lib/db.php");
  require("config/config.php");
  $conn = db_init($config["host"], $config["user"], $config["pw"], $config["dbname"]);
  $sql = "SELECT * FROM user WHERE name='".$_POST['author']."'";
  $result = mysqli_query($conn, $sql);
  if($result-> num_rows == 0){
    $sql = "INSERT INTO user (name, password) VALUES('".$_POST['author']."', '111111')";
    mysqli_query($conn, $sql);
    $user_id = mysqli_insert_id($conn);
  }
  else{
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
  }
  $sql = "INSERT INTO topic (title, description, author, created)
          VALUES('".$_POST['title']."', '".$_POST['description']."', '".$user_id."', now())";
  $result = mysqli_query($conn, $sql);
  header('location: http://localhost/index.php');
?>
