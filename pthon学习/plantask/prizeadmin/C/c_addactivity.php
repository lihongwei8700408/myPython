<?php
	function actionV_index(){
		global $_SELLER;
		$layout_content = './V/v_addactivity.php';
		include './V/layout.php';
	}
   
	
	if(isset($_POST['submit'])){
		if(isset($_POST['ServiceId'])&&$_POST['ServiceId']==''){
			echo '<script>alert("服务项目不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ActiveName'])&&$_POST['ActiveName']==''){
			echo '<script>alert("活动名称不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['StartTime'])&&$_POST['StartTime']==''){
			echo '<script>alert("开始时间不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['EndTime'])&&$_POST['EndTime']==''){
			echo '<script>alert("结束时间不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Price'])&&$_POST['Price']==''){
			echo '<script>alert("价格不能为空");history.go(-1);</script>';
			exit;
		}
		$_POST['StartTime'] = strtotime($_POST['StartTime']);
		$_POST['EndTime'] = strtotime($_POST['EndTime']);
		$_POST['SellerId'] = $_SELLER->SellerId;
		$_POST['CreatTime'] = time();
		$_POST['Checked'] = 1;
		unset($_POST['submit']);
		
		$prm = (object)array();
		$prm->table = 'cl_seller_activity';
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