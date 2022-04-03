<?php
	session_start();
	unset($_SESSION['survey_student_id']);
	unset($_SESSION['survey_item_results']);
    unset($_SESSION['survey_item_no_id']);
    unset($_SESSION['o5H4KY3Uz2789']);
    echo "<meta http-equiv=REFRESH CONTENT=0;url=QR_survey_single.php?Course_ID={$_SESSION['Course_ID']}>";
?>