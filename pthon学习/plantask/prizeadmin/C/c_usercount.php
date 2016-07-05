<?php
	function actionV_index(){
		global $_SELLER;
		global $sqlSearch;
		$sqlSearch = '';
		global $count;
		$where = 'SellerId ='.$_SELLER->SellerId.$sqlSearch;
		$count = ListCount('cl_seller_account',$where,'Id');
		$layout_content = './V/v_usercount.php';
		include './V/layout.php';
	}
	function actionV_accountadd(){
		global $_SELLER;
		global $sqlSearch;
		$sqlSearch = '';
		global $count;
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type=1 '.$sqlSearch;
		$count = ListCount('cl_seller_account',$where,'Id');
		$layout_content = './V/v_usercountadd.php';
		include './V/layout.php';
	}
	function actionV_accountdrop(){
		global $_SELLER;
		global $sqlSearch;
		$sqlSearch = '';
		global $count;
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type=2 '.$sqlSearch;
		$count = ListCount('cl_seller_account',$where,'Id');
		$layout_content = './V/v_usercountdrop.php';
		include './V/layout.php';
	}
	
	
?>