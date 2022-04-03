<?php
	session_start();
	if ($_GET['Course_ID']!=''){
      $Course_ID = $_GET['Course_ID'];
    }
	unset($_SESSION['survey_student_id']);
	unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
    echo "<meta http-equiv=REFRESH CONTENT=0;url='survey-single.php?Course_ID=$Course_ID'>";
?>