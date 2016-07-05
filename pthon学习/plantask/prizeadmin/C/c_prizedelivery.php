<?php
	function actionV_index(){
		
		global $_USER;
		if(isset($_GET['Id'])&&!empty($_GET['Id'])){
			$id = $_GET['Id'];
			$res = PrizePostInfo($id);
		}else{
			$res='';
		}
		$layout_content = './V/v_prizedelivery.php';
		include './V/layout.php';
	}
	if(isset($_POST['submitaddress'])){
		
		$prm = (object)array();
		$prm->table = 'cl_member';
		$prm->where = 'MemberId ='.$_POST['MemberId'];
		$prm->update = 'PrizeAddress="'.$_POST['PrizeAddress'].'"';
		$a = dbUpdateOne($prm,$con);
		if($a){
			echo '<script>alert("修改成功！")</script>';
		}else{
			echo '<script>alert("修改失败！")</script>';
		}
	}
	
	if(isset($_POST['submit'])){
		
		if(isset($_GET['Id'])){
			$id = $_GET['Id'];

		}
		$res = PrizePostInfo($id);
		$t = time();
		$_POST['CreatTime'] = $t;
		$_POST['GameId'] = $id;
		$_POST['MemberId'] = $res->MemberId;
		$_POST['OperateId'] = $_USER->UserId;
		unset($_POST['submit']);
		$prm = (object)array();
		$prm->table = 'cl_prize_post_record';
		$prm->insert = $_POST;
		$a = dbInsertOne($prm,$con);
		if($a){
			$prm->table = 'cl_game';
			$prm->where = 'Id ='.$id;
			$prm->update = 'State="1"';
			$b = dbUpdateOne($prm,$con);
			$url = 'http://weixin.clejw.com/Activity/send_customer_service.php';
			$content = '您的奖品'.$res->GameName.'已经发货,点击查看详情！';
			$oid = GetMemberOpenId($res->MemberId);
			$data = array(
				'mid'=>$res->MemberId,
				'openid'=>$oid,
				'content'=>$content
			);
			https_request($url,$data);
			if($b){
				$html = WEB_SHOPADMIN.'/index.php?c=prizedeliverysuc&Id='.$id;
				header("Location:".$html); 
				Quit();
			}else{
				echo '<script>alert("操作失败！")</script>';
			}
		 	
		}
		else{
			echo '<script>alert("操作失败！")</script>';
		}
	}
?>