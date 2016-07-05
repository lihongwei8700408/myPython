<?php
	function actionV_index(){
		include './resource/file/searchfile_order.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 
		 }
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State!=6 AND State!=7 '.$sqlSearch;
		$count = ListCount('cl_order',$where,'Id');
		$layout_content = './V/v_order.php';
		include './V/layout.php';
	}
	
	function actionV_norevieworder(){
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
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State = 2 '.$sqlSearch;
		$count = ListCount('cl_order',$where,'Id');
		$layout_content = './V/v_norevieworder.php';
		include './V/layout.php';
	}
	function actionV_noreciveorder(){
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
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State = 1 '.$sqlSearch;
		$count = ListCount('cl_order',$where,'Id');
		$layout_content = './V/v_noreciveorder.php';
		include './V/layout.php';
	}
	
	function actionV_noconfirmorder(){
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
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State = 5 '.$sqlSearch;
		$count = ListCount('cl_order',$where,'Id');
		$layout_content = './V/v_noconfirmorder.php';
		include './V/layout.php';
	}
	function actionV_endorder(){
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
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State = 3 '.$sqlSearch;
		$count = ListCount('cl_order',$where,'Id');
		$layout_content = './V/v_endorder.php';
		include './V/layout.php';
	}
	function actionV_closeorder(){
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
		$where = 'SellerId ='.$_SELLER->SellerId.' AND State = 4 '.$sqlSearch;
		$count = ListCount('cl_order',$where,'Id');
		$layout_content = './V/v_closeorder.php';
		include './V/layout.php';
	}
	//商家删除订单
	function actionV_deleteorder(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			$ret = OrderDelete($id);	
			if($ret){
				echo '1';
			}
			else{
				echo '';		
			}
		}
	}
	//商家接收订单
	function actionV_reciveorder(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			$ret = OrderRecive($id);	
			if($ret){
				echo '1';
			}
			else{
				echo '';		
			}
		}
	}
	//商家确认订单完成
	function actionV_confirmorder(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			$ret = OrderConfirm($id);	
			if($ret){
				echo '1';
			}
			else{
				echo '';		
			}
		}
	}
?>