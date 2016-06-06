<!DOCTYPE HTML>
<html>
    <head>
        <title>ToDoList</title>
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
            print('データの追加に成功しました<br>');
          //$dbn->query('SET NAMES utf8');

          $sql = 'INSERT INTO list (item) VALUES(:ToDoname)';
            print('データの追加に成功しました<br>');
          $stmt = $dsn->prepare($sql);
            print('データの追加に成功しました<br>');
          $stmt->bindParam(':ToDoname',$ToDoname);
            print('データの追加に成功しました<br>');
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
          print('データの追加に成功しました<br>');
        //$dbn->query('SET NAMES utf8');

        $sql = 'DELETE FROM  list WHERE id = :delete';
          print('データの追加に成功しました!!<br>');
        $stmt = $dsn->prepare($sql);
          print('データの追加に成功しました!!<br>');
        $stmt->bindParam(':delete',$deleteNo);
          print('データの追加に成功しました!!<br>');
        $stmt->execute();

        $dsn=NULL;
      } catch (Exception $e) {
        print('データの追加に失敗しました!!<br>');
      }
      }


        ?>
          <form  action="index.php" method="get">
          <input type="text" id="ToDoname" name="ToDoname" style="float:left">
          <input type="submit" name="add" value="add"><br>

          <?php
          $dsn ='mysql:dbname=todolist;host=localhost;charset=utf8';
          $user='root';
          $password ='';
          try {
            $dsn= new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => false));
              print('データの追加に成功しました!!<br>');
            //$dbn->query('SET NAMES utf8')
            $sql = 'SELECT * FROM list';
            $stmt = $dsn->prepare($sql);
            $stmt->execute();
            while($task = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo'<form method="get" action="index.php"><label style="float:left">'.$task['item'].'</label>';
              echo'<input type="submit" id="'.$task['id'].'" name="delete" value="'.$task['id'].'"><br>';
              echo'</form>';
            }
          } catch (Exception $ex) {
            print('データの追加に失敗しました<br>');
          }
          $dsn=NULL;
           ?>
            </form>
          </body>
</html>
