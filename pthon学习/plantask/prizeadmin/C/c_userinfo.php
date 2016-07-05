<?php
	function actionV_index(){
		global $_SELLER;
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_seller';
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$update = dbSelectOne($prm,$con);
		$layout_content = './V/v_userinfo.php';
		include './V/layout.php';
		
	}
	function actionV_pro(){
		include './resource/data/province';
	}
	//省份对城市
	function actionV_proToCity(){
		$id=intval($_GET['id']);
		include './resource/data/city_json/'.$id;
	}
	//城市对地区
	function actionV_cityToDistrict(){
		$id=intval($_GET['id']);
		include './resource/data/district_json/'.$id;
	}
	//地区对区域
	function actionV_districtToRegion(){
		$id=intval($_GET['id']);
		include './resource/data/region_json/'.$id;
	}
	if(isset($_POST['submit'])){
		
		
		if(isset($_POST['SellerName'])&&$_POST['SellerName']==''){
			echo '<script>alert("法人姓名不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ShopName'])&&$_POST['ShopName']==''){
			echo '<script>alert("店铺名称不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Tel'])&&$_POST['Tel']==''){
			echo '<script>alert("手机号码不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Content'])&&$_POST['Content']==''){
			echo '<script>alert("店铺介绍不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Address'])&&$_POST['Address']==''){
			echo '<script>alert("店铺地址不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['TelOne'])&&$_POST['TelOne']==''){
			echo '<script>alert("服务电话不能为空");history.go(-1);</script>';
			exit;
		}
		$path = $_SERVER[DOCUMENT_ROOT].'/shopadmin/upload/userimg/';
		if (($_FILES["file"]["size"]) < 2000000)
	    { 
		 
		 if ($_FILES["file"]["error"] > 0)
			{
			// echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			$shoplogo = $_SELLER->ShopLogo; //上传错误时恢复原来传的图片
			}
		 else
		 {
		   //echo "Upload: ".$_FILES["file"]["name"] . "<br />";
		   //echo "Type: " .$_FILES["file"]["type"] . "<br />";
		   //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		   //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
         
		 if(!is_dir($path ))
		{
			mkdir($path,0777,true);
		}
		  move_uploaded_file($_FILES["file"]["tmp_name"],$path.$_SERVER['REQUEST_TIME'].'.jpg');
		 // echo "Stored in: " . "$path".$_FILES["file"]["name"];
		 $shoplogo = PIC_DOMAIN.'/userimg/'.$_SERVER['REQUEST_TIME'].'.jpg';
	  
		 }
		}
		
		$_POST['ShopLogo'] = $shoplogo;
		$prm = (object)array();
		$prm->table = 'cl_seller';
		$prm->update = glurSql($_POST,array('submit'),',');
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$ret = dbUpdateOne($prm,$con);
		if($ret){
			echo '<script>alert("操作成功");history.go(-1);</script>';
		}else{
			echo '<script>alert("操作失败");history.go(-1);</script>';
		}
	}
	
?>