<?php
	session_start();
	include('mysql_connect_inc.php');	
?>
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
  include("header.php");
?>
<script>
function check(name,reg,spanId,okinfo,errinfo){
  var flag;
  var val=document.getElementByName(name)[0].value;
  var oSpanNode = document.getElementById(spanId);
  if(reg.test(val)){
    oSpanNode.innerHTML = okinfo.fontcolor("green");
    flag=true;
  }else{
    oSpanNode.innerHTML = errinfo.fontcolor("red");
    document.getElementById("demo1").innerHTML = "Hi!";
    flag=false;
  }
  return flag;
}
 

function checkUsername() {
  var usernameId = "username";
  var spanId = "usernamespan";
  var reg = /^[1][0]\d{5}$/;

  //reg.test("s1042655");
  //document.getElementById("demo1").innerHTML="s1042655";
  //document.getElementById("demo1").innerHTML=reg.test("s1042655");
  //document.getElementById("demo1").innerHTML=document.getElementById(usernameId).value;
  var val = document.getElementById(usernameId).value;
  document.getElementById("email").value = "s" + val + "@mail.ncyu.edu.tw";
  var oSpanNode = document.getElementById(spanId);
  //document.getElementById("demo1").innerHTML=reg.test(val) + " Hi";
  if(reg.test(val)){
    oSpanNode.innerHTML = "學號格式正確".fontcolor("green");
    //document.getElementById("demo1").innerHTML = okinfo.fontcolor("green");
    //document.getElementById("demo1").innerHTML = true;
    flag=true;
  }else{
    oSpanNode.innerHTML = "學號格式錯誤".fontcolor("red");
    //document.getElementById(usernameId).backgroundcolor="red";
    //document.getElementById("demo1").innerHTML = document.getElementById("demo1").innerHTML + "Hi";
    document.getElementById(usernameId).focus();
    flag=false;
  }
  return flag;
  //return check("username",reg,"usernamespan","學號格式正確","學號格式錯誤");
}
/*function checkform(){
  if(checkid()){
    return true;
  }else{
    return false;
  }
function mySubmit(){
  var oFormNode = document.getElementById("userinfo");
  oFormNode.submit();
} 
}*/
</script>

	<div class="container">
    <p id="demo1"></p>
    <form method="post" action="register_finish.php">
      <div class="form-group">
        <label for="username">學號(帳號):</label>
        <input type="text" id="username" class="form-control" onblur="checkUsername()" onkeyup="checkUsername()" placeholder="請輸入學號(學號開頭不用加s)" name="username" required>
        <span id="usernamespan"></span>
      </div>

      <div class="form-group">
        <label for="name">姓名:</label>
        <input type="text" class="form-control" id="name" placeholder="請輸入姓名" name="name" required>
      </div>

      <div class="form-group">
        <label for="password">密碼:</label>
        <input type="password" class="form-control" id="password" placeholder="請輸入密碼" name="password" required>
      </div>

      <div class="form-group">
        <label for="password2">確認密碼:</label>
        <input type="password" class="form-control" id="password2" placeholder="請輸入密碼" name="password2" required>
      </div>
      <div class="form-group">
        <label for="email">信箱:</label>
        <input type="email" class="form-control" id="email" placeholder="請輸入信箱" name="email" required readonly>
      </div>
      <input type="submit" role="button" class="btn btn-info" value="註冊">
      <input class="btn btn-info" type ="button" onclick="history.back()"" value="回到上一頁"></input>
    </form>
  </div>
</body>
</html>
