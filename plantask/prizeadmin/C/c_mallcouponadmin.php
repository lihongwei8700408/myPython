<?php
	function actionV_index(){
	   
		include './resource/file/searchfile_coupon.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 
		 }
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =1 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_couponadmin.php';
		include './V/layout.php';
	
	}
	
	function actionV_oncouponadmin(){
	
		include './resource/file/searchfile_oncoupon.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =1 And State = 2 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_oncouponadmin.php';
		include './V/layout.php';
	
	}
	function actionV_offcouponadmin(){
	
		include './resource/file/searchfile_oncoupon.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =1 And State = 1 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_offcouponadmin.php';
		include './V/layout.php';
	
	}
	function actionV_autooffcouponadmin(){
	
		include './resource/file/searchfile_oncoupon.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =1 And State = 3 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_autooffcouponadmin.php';
		include './V/layout.php';
	
	}
	function actionV_selleroffcouponadmin(){
	
		include './resource/file/searchfile_oncoupon.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =1 And State = 4 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_selleroffcouponadmin.php';
		include './V/layout.php';
	
	}
	function actionV_deletegoods(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret =MallListDelete('Id='.$onlyid);
				}
					
			}
			else{
				$ret = MallListDelete('Id='.$id);	
			}
			if($ret){
				echo '1';
			}
			else{
				echo '';
						
			}
		    
		}
		
	}
	function actionV_upgoods(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret = UpGoods($onlyid,'cl_mall_coupons');
				}
					
			}
			else{
				$ret = UpGoods($id,'cl_mall_coupons');	
			}
			if($ret){
				echo '1';
			}
			else{
				echo '';
						
			}
		    
		}
		
	}
	function actionV_downgoods(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret = DownGoods($onlyid,'cl_mall_coupons');
				}
					
			}
			else{
				
				$ret = DownGoods($id,'cl_mall_coupons');	
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