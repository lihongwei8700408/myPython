<?php
	function actionV_index(){
	   
		include './resource/file/searchfile_business.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 
		 }
		$where = 'SellerId ='.$_SELLER->SellerId.$sqlSearch;
		$count = ListCount('cl_service',$where,'Id');
		$layout_content = './V/v_activity.php';
		include './V/layout.php';
		
		
		
	
	}
	function actionV_onbusiness(){
		include './resource/file/searchfile_business.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Checked=2'.$sqlSearch;
		$count = ListCount('cl_service',$where,'Id');
		$layout_content = './V/v_onbusiness.php';
		include './V/layout.php';
	}
	function actionV_offbusiness(){
		include './resource/file/searchfile_business.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Checked IN (1,3,4)'.$sqlSearch;
		$count = ListCount('cl_service',$where,'Id');
		$layout_content = './V/v_offbusiness.php';
		include './V/layout.php';
	}
	function actionV_deletebusiness(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret = ListDelete('Id='.$onlyid,'cl_service','Checked = "4"');
				}
					
			}
			else{
				$ret = ListDelete('Id='.$id,'cl_service','Checked = "4"');	
			}
			if($ret){
				echo '1';
			}
			else{
				echo '';
						
			}
		    
		}
		
	}
	function actionV_upbusiness(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret = UpBusiness($onlyid);
				}
					
			}
			else{
				$ret = UpBusiness($id);	
			}
			if($ret){
				echo '1';
			}
			else{
				echo '';
						
			}
		    
		}
		
	}
	function actionV_downbusiness(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret = DownBusiness($onlyid);
				}
					
			}
			else{
				$ret = DownBusiness($id);	
			}
			if($ret){
				echo '1';
			}
			else{
				echo '';
						
			}
		    
		}
		
	}
   
	
?>