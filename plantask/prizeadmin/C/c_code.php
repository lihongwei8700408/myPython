<?php
	function actionV_index(){
		include './resource/file/searchfile_code.php';
		global $sqlSearch;
		global $_USER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 
		 }
		$where = 'State = 1'.$sqlSearch;
		$count = ListCount('cl_member',$where,'MemberId');
		$layout_content = './V/v_code.php';
		include './V/layout.php';
	
	}
	
	
?>