<!DOCTYPE html>
<html lang="en">
<head>
  <title>學生課程意見調查</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="font-family: DFKai-sb;">
<?php
include('header.php');
?>
<div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <form action="action_login.php" method="post">
        <div class="form-group">
          <label for="username">使用者:</label>
          <input type="username" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">密碼:</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-default">登入</button>&nbsp;&nbsp;
        <a href="register.php" class="btn btn-outline-info" role="button">申請帳號</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="forget_pw.php" class="btn btn-outline-dark" role="button">忘記密碼</a>
     </form>
    </div>
    <div class="col-sm-4">
    </div>
  </div>
</div>
</body>
</html>