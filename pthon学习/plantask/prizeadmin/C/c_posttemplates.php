<?php
	function actionV_index(){
		global $_SELLER;
		$layout_content = './V/v_posttemplates.php';
		include './V/layout.php';
	}
	
	function actionV_address(){
		global $_SELLER;
		$layout_content = './V/v_postaddress.php';
		include './V/layout.php';

		function CssShow($data,$field){
		
			 if($data[$field]==1){
					return 'display:inline';
			 }
				
		}

		
 	
	}
	function actionV_book(){
		global $_SELLER;
		$layout_content = './V/v_postbook.php';
		include './V/layout.php';
 	
	}
	function actionV_delAddress(){
		global $DB_CON;
		if(isset($_POST['delid'])){

			$prm = (object)array();
			$prm->table = 'mall_memberAddress';
			$prm->where = 'Id='.$_POST['delid'];
			dbDeleteOne($prm,$DB_CON);
		}


	}
	if(isset($_POST['build'])){
	
		$data = array(
			'Name'=>$_POST['Name'],
			'SellerId'=>$_SELLER->SellerId,
			
		);
		$prm = (object)array();
		$prm->table = 'cl_ratetemp';
		$prm->insert = $data;
		$ret = dbInsertOne($prm,$con);
		if($ret){
			
			if(isset($_POST['Type_fast'])){
				$data = array(
				'TempId'=>$ret,
				'Type'=>$_POST['Type_fast'],
				'Province'=>'|全国|',
				'FirstNum'=>$_POST['default_fn_fast'],
				'AddNum'=>$_POST['default_an_fast'],
				'FirstWeight'=>$_POST['default_fw_fast'],
				'AddWeight'=>$_POST['default_aw_fast'],
				);
				$prm = (object)array();
				$prm->table = 'cl_ratetempsub';
				$prm->insert = $data;
				$a = dbInsertOne($prm,$con);
				if(!empty($_POST['datafast'])){
					
					foreach($_POST['datafast']as $val){
						
						$p =str_replace(',','|',$val['Province']);
						$p = '|'.$p;
						
						$datas = array(
						'TempId'=>$ret,
						'Type'=>$_POST['Type_fast'],
						'Province'=>$p,
						'FirstNum'=>$val['FirstNum'],
						'AddNum'=>$val['AddNum'],
						'FirstWeight'=>$val['FirstWeight'],
						'AddWeight'=>$val['AddWeight'],
						);
						$prm = (object)array();
						$prm->table = 'cl_ratetempsub';
						$prm->insert = $datas;
						$b = dbInsertOne($prm,$con);
						}
				}
			}
			
		if(isset($_POST['Type_ems'])){
				$data = array(
				'TempId'=>$ret,
				'Type'=>$_POST['Type_ems'],
				'Province'=>'全国',
				'FirstNum'=>$_POST['default_fn_ems'],
				'AddNum'=>$_POST['default_an_ems'],
				'FirstWeight'=>$_POST['default_fw_ems'],
				'AddWeight'=>$_POST['default_aw_ems'],
				);
				$prm = (object)array();
				$prm->table = 'cl_ratetempsub';
				$prm->insert = $data;
				$a = dbInsertOne($prm,$con);
				
				if(!empty($_POST['dataems'])){
					
					foreach($_POST['dataems']as $val){
						
						$p =str_replace(',','|',$val['Province']);
						$p = '|'.$p;
						
						$datas = array(
						'TempId'=>$ret,
						'Type'=>$_POST['Type_ems'],
						'Province'=>$p,
						'FirstNum'=>$val['FirstNum'],
						'AddNum'=>$val['AddNum'],
						'FirstWeight'=>$val['FirstWeight'],
						'AddWeight'=>$val['AddWeight'],
						);
						$prm = (object)array();
						$prm->table = 'cl_ratetempsub';
						$prm->insert = $datas;
						$b = dbInsertOne($prm,$con);
						}
				}
			}
			if(isset($_POST['Type_com'])){
				$data = array(
				'TempId'=>$ret,
				'Type'=>$_POST['Type_com'],
				'Province'=>'全国',
				'FirstNum'=>$_POST['default_fn_com'],
				'AddNum'=>$_POST['default_an_com'],
				'FirstWeight'=>$_POST['default_fw_com'],
				'AddWeight'=>$_POST['default_aw_com'],
				);
				$prm = (object)array();
				$prm->table = 'cl_ratetempsub';
				$prm->insert = $data;
				$a = dbInsertOne($prm,$con);
				
				if(!empty($_POST['datacom'])){
					
					foreach($_POST['datacom']as $val){
						
						$p =str_replace(',','|',$val['Province']);
						$p = '|'.$p;
						
						$datas = array(
						'TempId'=>$ret,
						'Type'=>$_POST['Type_com'],
						'Province'=>$p,
						'FirstNum'=>$val['FirstNum'],
						'AddNum'=>$val['AddNum'],
						'FirstWeight'=>$val['FirstWeight'],
						'AddWeight'=>$val['AddWeight'],
						);
						$prm = (object)array();
						$prm->table = 'cl_ratetempsub';
						$prm->insert = $datas;
						$b = dbInsertOne($prm,$con);
						}
				}
			}
		}	
	}
	//地址库操作
	if(isset($_POST['addsave'])){
		global $_MEMBER;
		unset($_POST['addsave']);
		$_POST['MemberId'] = $_MEMBER->MemberId;
		
		$ret = TBInMemberAddress($_POST);
		if($ret){
			echo "<script>alert('保存成功');</script>";
		}
		else{
			echo "<script>alert('保存失败');</script>";
		}
	}
	function actionV_add(){
		if(isset($_POST['add'])){
			
			$ret = MEMPostToolsAdd($_POST['add']);
			if($ret){
				echo 1;
				
				
			}
			else{
				echo '';
			}
		}
		if(isset($_POST['S_id'])){
			
			 foreach($_POST['S_id'] as $id)
			{
				$ret = MEMPostToolsAdd($id);
			}
			
			if($ret){
				echo 1;
				
				
			}
			else{
				echo '';
			}
		}
 	
	}
	
	//删除模板
	function actionV_del(){
		if(isset($_POST['S_id'])){
			
			 foreach($_POST['S_id'] as $id)
			{
				$ret = MEMSellRateDel($id);
			}
			if($ret){
				echo 1;
			}
			else{
				echo "<script>alert('操作失败');</script>";
			}
		}
 	
	}
	function actionV_quit(){
		if(isset($_POST['add'])){
			
			$ret = MEMPostToolsDel($_POST['add']);
			if($ret){
				echo 1;
			}
			else{
				echo '';
			}
		}
 	
	}
	
    


?>
	
	
