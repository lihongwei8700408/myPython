<?php
	function actionV_index(){
		global $_USER;
		$layout_content = './V/v_aboutus.php';
		include './V/layout.php';
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['Content'])&&$_POST['Content']==''){
			echo '<script>alert("反馈意见不能为空");history.go(-1);</script>';
			Quit();
		}
		unset($_POST['submit']);
		$_POST['UserId']= $_USER->UserId;
		$_POST['UserName']= $_USER->UserName;
		$prm = (object)array();
		$prm->table = 'cl_feedback';
		$prm->insert = $_POST;
		$ret = dbInsertOne($prm,$con);
			
		if($ret){
			echo '<script>alert("操作成功");</script>';
		}else{
			echo '<script>alert("操作失败");</script>';
		}
	}
	
?>