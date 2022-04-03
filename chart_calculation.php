<?php
	include('mysql_connect_inc.php');
	$sql = "SELECT * FROM `course_list` WHERE `Teacher_CName`='$_SESSION['Teacher_CName']' and `Year` = '$_SESSION['Year']' and `Course_CName` = '$_SESSION['Course_CName']' and `Hide`='0'";
	$result = mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($result);
	print($row["Course_ID"])
?>