<?php
	session_start();
	unset($_SESSION['survey_student_id']);
	unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
    echo "<meta http-equiv=REFRESH CONTENT=0;url=survey.php>";
?>