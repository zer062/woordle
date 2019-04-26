<?php
	if ( is_user_logged_in() ) {
		include( WOORDLE_FRONTEND_PATH . '/templates/student-account/student-account.php' );
	} else {
		include( WOORDLE_FRONTEND_PATH . '/templates/student-account/login-section.php' );
	}
?>