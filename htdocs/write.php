
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
        <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
    </head>
    <body id="target">
        <div class="container">
          <header class="jumbotron text-center">  <!-- header부분은 index.php와 똑같다. -->
              <img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png" alt="생활코딩" id="logo">
              <h1><a href="http://localhost/index.php">JavaScript</a></h1>
          </header>
          <div class="row">
            <nav class = "col-md-3">  <!-- nav부분도 index.php와 같다. -->
                <ol class="nav flex-column">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                      echo '<li class="nav-item"><a class="nav-link active" href = "http://localhost/index.php?id='.$row['id'].' ">'.htmlspecialchars($row['title']).'</a></li>'."\n";
                    }
                    ?>
                </ol>
            </nav>
            <div class="col-md-9">
              <article>
                <form action="process.php" method="post" class="form-horizontal">

                  <div class="form-group">
                    <label for="form-title" class="col-sm-2 control-label">제목</label>
                    <div class="col-sm-10">
                      <input type ="text" name="title" class="form-control" id="form-title" placeholder="제목을 적어주세요.">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="form-author" class="col-sm-2 control-label">작성자</label>
                    <div class="col-sm-10">
                      <input type="text" name="author" class="form-control" id="form-author" placeholder="작성자를 적어주세요.">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="form-author" class="col-sm-2 control-label">본문</label>
                    <div class="col-sm-10">
                      <textarea name="description" rows="7" class="form-control" id="form-author" placeholder="본문을 적어주세요."></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-outline-success">제출</button>
                    </div>

                  </div>
                </form>
              </article>
              <hr>
              <div id="hello">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <input type="button" value="white" id="white_btn" class="btn btn-outline-secondary"/>
                  <input type="button" value="black" id="black_btn" class="btn btn-outline-secondary"/>
                </div>
                <a href="http://localhost/write.php" class="btn btn-info">쓰기</a>
              </div>
              <script src="http://localhost/script.js"></script>
            </div>
          </div>
        </div>
        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>
