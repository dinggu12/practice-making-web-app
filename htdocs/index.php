<?php
  require("lib/db.php");
  require("config/config.php");
  $conn = db_init($config["host"], $config["user"], $config["pw"], $config["dbname"]);
  $result = mysqli_query($conn, "SELECT * FROM topic");
?>
﻿<!DOCTYPE html>
<html>
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="/style.css">
    </head>
    <body id="target">
        <div class="container">
          <header class="jumbotron text-center">
              <img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png" alt="생활코딩" id="logo">
              <h1><a href="/index.php">JavaScript</a></h1>
          </header>
          <div class="row">
            <nav class = "col-md-3"><!-- nav안에 있는 부분이 옆에 카테고리를 나타낸다. --><!-- htmlspecialchars함수는 문자열에서 특수한 문자들을 html엔티티로 변환하여 xss를 방지한다. -->
                <ol class="nav flex-column">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                      echo '<li class="nav-item"><a class="nav-link active" href = "/index.php?id='.$row['id'].' ">'.htmlspecialchars($row['title']).'</a></li>'."\n";
                    }
                    ?>
                </ol>
            </nav>
            <div class="col-md-9">
              <article><!-- atticle안에 있는 것들이 각 카테고리마다의 본분을 나타냄 -->
                <?php
                  if(empty($_GET['id']) == false){
                    $sql = "SELECT topic.id, title, name, description FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id=".$_GET['id'];
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
                    echo '<p>'.htmlspecialchars($row['name']).'</P>';
                    echo strip_tags($row['description'], '<a><h1><h2><h3><h4><ul><ol>');
                  }
                ?>
              </article>
              <hr>
              <div id="hello">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <input type="button" value="white" id="white_btn" class="btn btn-outline-secondary"/><!-- script.js와 관련이 있다 -->
                  <input type="button" value="black" id="black_btn" class="btn btn-outline-secondary"/><!-- script.js와 관련이 있다 -->
                </div>
                <a href="/write.php" class="btn btn-info">쓰기</a><!-- 쓰기 버튼을 누르면 write.php페이지로 넘어감 -->
              </div>
              <script src="/script.js"></script>
            </div>
          </div>
        </div>
        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
