<?php
    function actionV_index(){
		if(isset($_SERVER['HTTP_REFERER'])){
			var_dump($_SERVER["REQUEST_URI"]);
			echo '<script>alert("您还未登录，请先登录！");location.href="'.WEB_SHOPADMIN.'/index.php?c=login";</script>';
		}else{
			header('Location:'.WEB_SHOPADMIN.'/index.php?c=login');
		}
		
	}