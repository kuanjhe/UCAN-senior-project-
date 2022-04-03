<?php
	session_start();
	if ($_GET['Course_ID']!=''){
      $Course_ID = $_GET['Course_ID'];
    }
	unset($_SESSION['survey_student_id']);
	unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
    unset($_SESSION['quction']);
    echo "<meta http-equiv=REFRESH CONTENT=0;url='../choose_courses.php'>";
?>