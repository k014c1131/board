<!DOCTYPE HTML>
<html>
    <head>
        <title>掲示板</title>
        <style>
        .log{


        }

        </style>
    </head>
    <body>

        <?php
        if(isset($_GET['ToDoname'])&&""!=$_GET['ToDoname']){
          $ToDoname = $_GET['ToDoname'];

          $ToDoname = htmlspecialchars($ToDoname,ENT_QUOTES);


        $dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        try {
          $dsn = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));

          //$dbn->query('SET NAMES utf8');

          $sql = 'INSERT INTO list (item) VALUES(:ToDoname)';
          $stmt = $dsn->prepare($sql);
          $stmt->bindParam(':ToDoname',$ToDoname);
          $stmt->execute();

          $dsn=NULL;
        } catch (Exception $e) {
          print('データの追加に失敗しました<br>');
        }
      }else if(isset($_GET['delete'])){
        $deleteNo = $_GET['delete'];

        $deleteNo = htmlspecialchars($deleteNo,ENT_QUOTES);


      $dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      try {
        $dsn = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));
        //$dbn->query('SET NAMES utf8');

        $sql = 'DELETE FROM  list WHERE id = :delete';
        $stmt = $dsn->prepare($sql);
        $stmt->bindParam(':delete',$deleteNo);
        $stmt->execute();

        $dsn=NULL;
      } catch (Exception $e) {
        print('データの追加に失敗しました!!<br>');
      }
      }


        ?>
          <form  action="index.php" method="get">
            <h2>掲示板</h2>
            <div align="right">
            <a href="" >ログアウト</a></br>
            </div>
            <?php
            $dsn ='mysql:dbname=todolist;host=localhost;charset=utf8';
            $user='root';
            $password ='';
            try {
              $dsn= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));

              //$dbn->query('SET NAMES utf8')
              $sql = 'SELECT * FROM list';
              $stmt = $dsn->prepare($sql);
              $stmt->execute();
              $task = $stmt->fetch(PDO::FETCH_ASSOC);
                echo''.$task['id'].'<br>';
            } catch (Exception $ex) {
              print('データの追加に失敗しました<br>');
            }
            $dsn=NULL;
            ?>
          <input type="text" id="ToDoname" name="ToDoname" style="float:left">
          <input type="submit" name="add" value="add"><br>

          <?php
          $dsn ='mysql:dbname=todolist;host=localhost;charset=utf8';
          $user='root';
          $password ='';
          try {
            $dsn= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));

            //$dbn->query('SET NAMES utf8')
            $sql = 'SELECT * FROM list';
            $stmt = $dsn->prepare($sql);
            $stmt->execute();
            while($task = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo'<div class="log" style="float:left">'.$task['id'].'  '.date('Y年m月d日').'</div>';
              echo'<form method="get" class="log" action="index.php" >';
              echo'<input type="image" class="log" src="./gomibako.png" alt="削除ボタン" width="20" height="20" name="delete" value="'.$task['id'].'"><br>';
              echo'<label class="log" style="float:left">'.$task['item'].'</label></br>';
              echo'</form></br>';

            }
          } catch (Exception $ex) {
            print('データの追加に失敗しました<br>');
          }
          $dsn=NULL;
           ?>
            </form>
          </body>
</html>
