<?php session_start();
include('mysql_connect_inc.php');
if  (isset($_SESSION['login_RNuikEEFpDrrjTQ'])){
  if ($_SESSION['login_RNuikEEFpDrrjTQ']!="PIYW7iyWXS6POakVFnzPik80xJquSWHaePSqnYdh"&&$_SESSION['login_RNuikEEFpDrrjTQ']!="84gt2E2fUtrKIxCzAtdjmNuKbpgPE1bPOxezdv7wEe3In")
    echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
} else
    echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php>";
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
include('header.php');
?>
	<div class="container">
		<div class="row">
      <?php
      include('left_side_bar.php');
      ?>
		</div>
	</div>
</body>
</html>



