<?php
	function actionV_index(){
	    global $_USER;
		include './resource/file/searchfile_business.php';
		global $sqlSearch;
		$sqlSearch = '';
		global $count;
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 }
		$where = 'Id!=10'.$sqlSearch;
		$count = ListPrizeCount('cl_prize',$where,'Id');
		$layout_content = './V/v_prize.php';
		include './V/layout.php';
		
		
		
	
	}
	function actionV_real(){
		include './resource/file/searchfile_onbusiness.php';
		global $sqlSearch;
		global $_USER;
		$sqlSearch = '';
		global $count;
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'Id!=9 AND Id!=10 AND Id!=6'.$sqlSearch;
		$count = ListPrizeCount('cl_prize',$where,'Id');
		$layout_content = './V/v_realprize.php';
		include './V/layout.php';
	}
	function actionV_virtual(){
		include './resource/file/searchfile_offbusiness.php';
		global $sqlSearch;
		global $_USER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'Id =9 OR Id = 6'.$sqlSearch;
		$count = ListPrizeCount('cl_prize',$where,'Id');
		$layout_content = './V/v_virtualprize.php';
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