<?php
	function actionV_index(){
		include './resource/file/searchfile_mallorders.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 
		 }
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State!=7 '.$sqlSearch;
		$count = ListCount('cl_mall_order',$where,'Id');
		$layout_content = './V/v_mallorder.php';
		include './V/layout.php';
	}
	function actionV_nopaymallorder(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State=1 '.$sqlSearch;
		$count = ListCount('cl_mall_order',$where,'Id');
		$layout_content = './V/v_nopaymallorder.php';
		include './V/layout.php';
	}
	function actionV_postmallorder(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State=2 '.$sqlSearch;
		$count = ListCount('cl_mall_order',$where,'Id');
		$layout_content = './V/v_postmallorder.php';
		include './V/layout.php';
	}
	function actionV_reviewmallorder(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State=4 '.$sqlSearch;
		$count = ListCount('cl_mall_order',$where,'Id');
		$layout_content = './V/v_reviewmallorder.php';
		include './V/layout.php';
	}
	function actionV_endmallorder(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State=5 '.$sqlSearch;
		$count = ListCount('cl_mall_order',$where,'Id');
		$layout_content = './V/v_endmallorder.php';
		include './V/layout.php';
	}
	function actionV_closemallorder(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State=6 '.$sqlSearch;
		$count = ListCount('cl_mall_order',$where,'Id');
		$layout_content = './V/v_closemallorder.php';
		include './V/layout.php';
	}
	function actionV_deleteorder(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			$ret = MallOrderDelete($id);	  
			if($ret){
				echo '1';
			}
			else{
				echo '';		
			}
		}
	}
	
?>