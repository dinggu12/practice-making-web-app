
<?php
  function db_init($host, $user, $pw, $dbname){
    $conn  = mysqli_connect($host, $user, $pw, $dbname);
    mysqli_select_db($conn, $dbname);
    return $conn;
  }
?>
