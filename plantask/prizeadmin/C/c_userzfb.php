<?php
	function actionV_index(){
		global $_SELLER;
		$layout_content = './V/v_userzfb.php';
		include './V/layout.php';
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['ZFBName'])&&$_POST['ZFBName']==''){
			echo '<script>alert("姓名不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ZFB'])&&$_POST['ZFB']==''){
			echo '<script>alert("支付宝账号不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Tel'])&&$_POST['Tel']==''){
			echo '<script>alert("手机号码不能为空");history.go(-1);</script>';
			exit;
		}
		if($_POST['Code']!= '123'){
			echo '<script>alert("验证码不正确");history.go(-1);</script>';
			exit;
		}
		$prm = (object)array();
		$prm->table = 'cl_seller';
		$prm->update = 'ZFBName ='.$_POST['ZFBName'].', ZFB='.$_POST['ZFB'];
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$ret = dbUpdateOne($prm,$con);
		if($ret){
			echo '<script>alert("操作成功");history.go(-1);</script>';
		}else{
			echo '<script>alert("操作失败");history.go(-1);</script>';
		}
	}
	
?>