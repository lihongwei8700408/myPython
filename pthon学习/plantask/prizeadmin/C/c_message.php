<?php
	function actionV_index(){
		include './resource/file/searchfile_message.php';
		global $_SELLER;
		global $sqlSearch;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.$sqlSearch;
		$count = ListCount('cl_seller_message',$where,'Id');
		$layout_content = './V/v_message.php';
		include './V/layout.php';
	}
	//改为已读状态
	function actionV_updatestate(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			$ret = MessageUpdate($id);	
			$ret->CreatTime = date('Y-m-d H:i:s',$ret->CreatTime);
			$ret = json_encode($ret);
			echo $ret;
		}
	}
	
	
	
?>