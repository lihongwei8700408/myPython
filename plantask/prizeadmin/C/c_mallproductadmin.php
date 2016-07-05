<?php
	function actionV_index(){
	   
		include './resource/file/searchfile_product.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 
		 }
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =2 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_productadmin.php';
		include './V/layout.php';
		
	}
	function actionV_onproductadmin(){
	
		include './resource/file/searchfile_onproduct.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =2 And State = 2 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_onproductadmin.php';
		include './V/layout.php';
	
	}
	function actionV_offproductadmin(){
	
		include './resource/file/searchfile_offproduct.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =2 And State = 1 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_offproductadmin.php';
		include './V/layout.php';
	
	}
	function actionV_autooffproductadmin(){
	
		include './resource/file/searchfile_autoproduct.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =2 And State = 3 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_autooffproductadmin.php';
		include './V/layout.php';
	
	}
	function actionV_selleroffproductadmin(){
	
		include './resource/file/searchfile_selleroffproduct.php';
		global $sqlSearch;
		global $_SELLER;
		$sqlSearch = '';
		global $count;
	
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
	
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
	
		}
		$where = 'SellerId ='.$_SELLER->SellerId.' AND Type =2 And State = 4 '.$sqlSearch;
		$count = ListCount('cl_mall_goods',$where,'Id');
		$layout_content = './V/v_selleroffproductadmin.php';
		include './V/layout.php';
	
	}
	function actionV_deletegoods(){
	    if(isset($_POST['Id'])&&!empty($_POST['Id'])){
			$id = $_POST['Id'];
			if(is_array($id)){
				foreach($id as $onlyid){
					$ret = MallListDelete('Id='.$onlyid);
				}
					
			}
			else{
				$ret =MallListDelete('Id='.$id);	
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
					$ret = UpGoods($onlyid,'cl_mall_realgoods');
				}
					
			}
			else{
				$ret = UpGoods($id,'cl_mall_realgoods');	
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
					$ret = DownGoods($onlyid,'cl_mall_realgoods');
				}
					
			}
			else{
				$ret = DownGoods($id,'cl_mall_realgoods');	
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