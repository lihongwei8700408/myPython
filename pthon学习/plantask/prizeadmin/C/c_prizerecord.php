<?php
	function actionV_index(){
	    global $_USER;
		include './resource/file/searchfile_order.php';
		global $sqlSearch;
		$sqlSearch = '';
		global $count;
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		//搜索拼接
		if($_GET){
		 $sqlSearch = GetSqlWhereByGet($optionSearch);
		 }
		$where = 'Type!=10'.$sqlSearch;
		$count = ListPrizeCount('cl_game',$where,'Id');
		$layout_content = './V/v_prizerecord.php';
		include './V/layout.php';
		
		
		
	
	}
	function actionV_nopost(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_USER;
		$sqlSearch = '';
		global $count;
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);	
		}
		if($_GET['submitgroup']){
			$where = 'Type!=10 AND Type!=9  AND Type!=6 AND State=0'.$sqlSearch;
			$count = MemberPrizeCount($where);
		}else{
			$where = 'Type!=10 AND Type!=9 AND State=0'.$sqlSearch;
			$count = ListPrizeCount('cl_game',$where,'Id');
		}
		
		$layout_content = './V/v_nopost.php';
		include './V/layout.php';
	}
	function actionV_alreadypost(){
		include './resource/file/searchfile_orders.php';
		global $sqlSearch;
		global $_USER;
		$sqlSearch = '';
		global $count;
		
		$optionSearch = array_merge($comm_optionSearch,$optionSearch);
		
		//搜索拼接
		if($_GET){
			$sqlSearch = GetSqlWhereByGet($optionSearch);
				
		}
		$where = 'Type!=10 AND Type!=9  AND Type!=6 AND State=1'.$sqlSearch;
		$count = ListPrizeCount('cl_game',$where,'Id');
		$layout_content = './V/v_alreadypost.php';
		include './V/layout.php';
	}
	
	function actionV_group(){
	    if(isset($_POST['Mid'])&&!empty($_POST['Mid'])){
			$id = $_POST['Mid'];
			$ret = PrizeMemberGroup($id);
			echo $ret;
		}
		
	}
	if(isset($_POST['submit1'])){
		
		$t = time();
		$_POST['CreatTime'] = $t;
		$_POST['GameId'] = $_POST['gameid'];
		$array = explode(',',$_POST['gameid']);
		$_POST['MemberId'] = $_POST['mid'];
		$_POST['OperateId'] = $_USER->UserId;
		unset($_POST['submit1']);
		$prm = (object)array();
		$prm->table = 'cl_prize_post_record';
		$prm->insert = $_POST;
		$a = dbInsertOne($prm,$con);
		if($a){
			if(count($array) > 1){
				foreach($array as $val){
					$b = UpGame($val);
				}
			}else{
				$b = UpGame($_POST['gameid']);
			}
			$url = 'http://weixin.clejw.com/Activity/send_customer_service.php';
			$content = '您在车联微信公众号抽中的奖品已经发货，请点击查看！';
			$oid = GetMemberOpenId($_POST['mid']);
			$data = array(
				'mid'=>$_POST['mid'],
				'openid'=>$oid,
				'content'=>$content
			);
			https_request($url,$data); 
			if($b){
				echo '<script>alert("发货成功！")</script>';
				echo '<script>location.href="'.WEB_SHOPADMIN.'/index.php?c=prizerecord&other=nopost";</script>';
			}else{
				echo '<script>alert("发货失败！")</script>';
			}
		 	
		}
		else{
			echo '<script>alert("发货失败！")</script>';
		}
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
	
	
   
	
?>