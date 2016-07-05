<?php
	function actionV_index(){
		global $_SELLER;
		$layout_content = './V/v_usermoney.php';
		include './V/layout.php';
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['oldpass'])&&$_POST['oldpass']==''){
			echo '<script>alert("旧密码不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['newpass'])&&$_POST['newpass']==''){
			echo '<script>alert("新密码不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['renewpass'])&&$_POST['renewpass']==''){
			echo '<script>alert("确认新密码不能为空");history.go(-1);</script>';
			exit;
		}
		if($_POST['renewpass']!= $_POST['newpass']){
			echo '<script>alert("两次密码输入不一致");history.go(-1);</script>';
			exit;
		}
		$prm = (object)array();
		$prm->table = 'cl_seller';
		$prm->update = 'Password ='.$_POST['newpass'];
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$ret = dbUpdateOne($prm,$con);
			
		if($ret){
			echo '<script>alert("操作成功");history.go(-1);</script>';
		}else{
			echo '<script>alert("操作失败");history.go(-1);</script>';
		}
	}
	
?>