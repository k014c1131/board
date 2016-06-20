<!DOCTYPE HTML>
<html lang = "ja">
  <head>
    <meta charset = "UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../tmp/css/bootstrap.min.css" rel="stylesheet">

<title>ログイン画面</title>
  <style type="text/css">
  body{
  background: url(59.jpg) no-repeat center center fixed;
  -webkit-background-size:cover;
  -moz-background-size:cover;
  -o-background-size:cover;
  background-size: cover;
  }

</style>
</head>
<body>


<div class="container">

  <form class="form-signin" action="index.php" method="get">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text"  name="username" class="form-control" placeholder="Name" >
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password"  name="pass" class="form-control" placeholder="Password" >
    <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me" name="me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../tmp/js/bootstrap.min.js"></script>
</body>
</html>
