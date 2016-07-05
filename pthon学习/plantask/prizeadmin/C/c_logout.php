<?php
    function actionV_index(){
		$_SESSION = array();

		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		
		// 最后，销毁会话
		session_destroy();
	    echo '<script>location.href="'.WEB_SHOPADMIN.'"</script>';
	}