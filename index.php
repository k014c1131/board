<!DOCTYPE HTML>
<html>
    <head>
        <title>掲示板</title>
        <style>
        </style>
    </head>
    <body>

        <?php
        if(isset($_GET['message'])&&""!=$_GET['message']){//データ追加部分
          $message = $_GET['message'];
          $message = htmlspecialchars($message,ENT_QUOTES);
          if(isset($_GET['username'])&&""!=$_GET['username']){
          $username = $_GET['username'];

          $username = htmlspecialchars($username,ENT_QUOTES);
        }else{
          $username = "名無し";

          $username = htmlspecialchars($username,ENT_QUOTES);
        }

        $dsn ='mysql:dbname=board;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        try {
          $dsn = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));
          $sdate=''.date('Y年m月d日');
          $sql = 'INSERT INTO log (username,sdate,message) VALUES(:username,:sdate,:message)';
          $stmt = $dsn->prepare($sql);
          $stmt->bindParam(':username',$username);
          $stmt->bindParam(':sdate',$sdate);
          $stmt->bindParam(':message',$message);
          $stmt->execute();

          $dsn=NULL;
          header("Location: index.php");
          exit();


        } catch (Exception $e) {
          print('データの追加に失敗しました<br>');
        }
      }else if(isset($_GET['delete'])){//デリート部分
        $deleteNo = $_GET['delete'];

        $deleteNo = htmlspecialchars($deleteNo,ENT_QUOTES);


      $dsn ='mysql:dbname=board;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      try {
        $dsn = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));
        //$dbn->query('SET NAMES utf8');

        $sql = 'DELETE FROM  log WHERE id = :delete';
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
            <a href="login.php" >ログアウト</a></br>
            </div>
            <?php
            $dsn ='mysql:dbname=board;host=localhost;charset=utf8';// ユーザー名表示
            $user='root';
            $password ='';

            try {
              $dsn= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));

              //$dbn->query('SET NAMES utf8')
              $sql = 'SELECT * FROM list';
              $stmt = $dsn->prepare($sql);
              $stmt->execute();
              if(isset($_GET['username'])&&""!=$_GET['username']){
              $username = $_GET['username'];

              $username = htmlspecialchars($username,ENT_QUOTES);

              echo'<label >'.$username.'</label>さん<br>';
              echo'<input type="hidden" id="username" name="username" value="'.$username.'">';
            }else{
              $username = "名無し";

              $username = htmlspecialchars($username,ENT_QUOTES);

              echo'<label id="username" name="username"　value="'.$username.'">'.$username.'</label>さん<br>';
              echo'<input type="hidden" id="username" name="username" value="'.$username.'">';
            }
            } catch (Exception $ex) {
              print('データの追加に失敗しました<br>');
            }
            $dsn=NULL;
            ?>
          <input type="text" id="message" name="message" style="float:left">
          <input type="submit" ><br>

          <?php
          $dsn ='mysql:dbname=board;host=localhost;charset=utf8';//項目の表示
          $user='root';
          $password ='';
          try {
            $dsn= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));

            $sql = 'SELECT * FROM log';
            $stmt = $dsn->prepare($sql);
            $stmt->execute();
            while($task = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo'<div class="log" style="float:left">'.$task['username'].'  '.$task['sdate'].'</div>';
              echo'<form method="get" class="log" action="index.php" >';
              echo'<input type="image" class="log" src="./gomibako.png" alt="削除ボタン" width="20" height="20" name="delete" value="'.$task['id'].'"><br>';
              echo'<label class="log" style="float:left">'.$task['message'].'</label></br>';
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
