<?php
	function actionV_index(){
		global $_SELLER;
	     if(isset($_GET['Id'])&&!empty($_GET['Id'])){
			$update = GetUpdateData('*','cl_service','Id='.$_GET['Id']);
		
		}
		
		$layout_content = './V/v_addbusiness.php';
		include './V/layout.php';
	}
   
	function actionV_getclass(){
	   if(isset($_POST['ClassId'])){
		   $id = $_POST['ClassId'];
		   echo GetSecondClass($id);
		   
	   }
	}
	
	if(isset($_POST['submit'])){
		if(isset($_POST['ClassId'])&&$_POST['ClassId']==''){
			echo '<script>alert("服务类型不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['otherclass'])&&$_POST['otherclass']==''){
			unset($_POST['ServiceId']);
			echo '<script>alert("二级服务类别不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ServiceId'])&&$_POST['ServiceId']==''){
			echo '<script>alert("二级服务类别不能为空");history.go(-1);</script>';
			exit;
		}
		
		if(isset($_POST['ServiceStartTime'])&&$_POST['ServiceStartTime']==''){
			echo '<script>alert("开始时间不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ServiceEndTime'])&&$_POST['ServiceEndTime']==''){
			echo '<script>alert("结束时间不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Price'])&&$_POST['Price']==''){
			echo '<script>alert("价格不能为空");history.go(-1);</script>';
			exit;
		}
		$_POST['SellerId'] = $_SELLER->SellerId;
		$_POST['AddTime'] = time();
		$_POST['ServiceStartTime'] = intval(str_replace(':','',$_POST['ServiceStartTime']));
		if($_POST['ServiceStartTime'] < 100){
			$_POST['ServiceStartTime']=$_POST['ServiceStartTime']*100;
		}
		$_POST['ServiceEndTime'] = intval(str_replace(':','',$_POST['ServiceEndTime']));
		if($_POST['ServiceEndTime'] < 100){
			$_POST['ServiceEndTime']=$_POST['ServiceEndTime']*100;
		}
		unset($_POST['submit']);
		if($_POST['update']){
			$prm = (object)array();
			$prm->table = 'cl_service';
			$prm->update = glurSql($_POST,array('update'),',');
			$prm->where = 'Id='.$_POST['update'];
			$ret = dbUpdateOne($prm,$con);
			
			if($ret){
				echo '<script>alert("操作成功");history.go(-1);</script>';
			}
			else{
				echo '<script>alert("操作失败");history.go(-1);</script>';
			}
		}
		else{
			if(!empty($_POST['otherclass'])){
				$array = array(
						'ParentClassId'=> $_POST['ClassId'],
						'ClassName' => $_POST['otherclass'],
						'IsFinal'=> 1,
						'IsUserInput'=>1,
						);
				$prm = (object)array();
				$prm->table = 'cl_class';
				$prm->insert = $array;
				$id = dbInsertOne($prm,$con);
				$_POST['ServiceId'] = $id;
				
				//插入服务表
				$prm = (object)array();
				$prm->table = 'cl_service';
				$prm->insert = $_POST;
				$ret = dbInsertOne($prm,$con);
			}else{
				$prm = (object)array();
				$prm->table = 'cl_service';
				$prm->insert = $_POST;
				$ret = dbInsertOne($prm,$con);
			}
			if($ret){
				UpdateSellrtServiceId(); //更新商家表的ServiceId字段
				echo '<script>alert("操作成功");history.go(-1);</script>';
			}
			else{
				echo '<script>alert("操作失败");history.go(-1);</script>';
			}
		}
	}
   
?>