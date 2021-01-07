<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
  <h1>javascript</h1>
  <ul>
    <script>
      list = new Array("ㅎㅇ","ㅇㅅㅇ","헬로우","하이","안녕");
      i=0;
      while(i<list.length){
        document.write("<li>" + list[i], + "</li>");
        i++;
      }
      </script>
  </ul>

  <h1>php</h1>
  <ul>
    <?php
        $i = 0;
        $list = array("안녕", "헬로우", "ㅎㅇ", "ㅇㅅㅇ", "하이");
        while($i < count($list)){
          echo "<li>".$list[$i]."</li>";
          $i++;
        }
     ?>
  </ul>
</body>
</html>
