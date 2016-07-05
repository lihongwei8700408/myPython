<?php
	function actionV_index(){
		$layout_content = './V/v_addcaragent.php';
		include './V/layout.php';
	}
   
	
	if(isset($_POST['submit'])){
		if(isset($_POST['ServiceId'])&&$_POST['ServiceId']==''){
			echo '<script>alert("代办服务类型不能为空");history.go(-1);</script>';
			exit;
		}
	
		if(isset($_POST['Price'])&&$_POST['Price']==''){
			echo '<script>alert("价格不能为空");history.go(-1);</script>';
			exit;
		}
		$_POST['SellerId'] = $_SELLER->SellerId;
		$_POST['AddTime'] = time();
		$_POST['Checked'] = 1;
		unset($_POST['submit']);
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->insert = $_POST;
		$ret = dbInsertOne($prm,$con);
		if($ret){
			echo '<script>alert("操作成功");history.go(-1);</script>';
		}
		else{
			echo '<script>alert("操作失败");history.go(-1);</script>';
		}
	}
   
?>