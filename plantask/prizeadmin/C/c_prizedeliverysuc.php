<?php
	function actionV_index(){
		global $_USER;
	    if(isset($_GET['Id'])&&!empty($_GET['Id'])){
			$id = $_GET['Id'];
			$res = PrizePostInfoSub($id);
		}else{
			$res='';
		}
		$layout_content = './V/v_prizedeliverysuc.php';
		include './V/layout.php';
	}
	
?>