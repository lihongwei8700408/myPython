<?php
	header("Content-type: text/html; charset=utf-8");
	include '../funs/DB_ALL.php';
	include '../config.php';
	$prm = (object)array();
	$prm->pw = DB_PASS;
	$prm->host = DB_HOST;
	$prm->user = DB_USER;
	$prm->code = DB_CODE;
	$prm->base = DB_BASE;
	$con = dbConnect($prm);
	if(isset($_GET['Mid'])){
		$mid = $_GET['Mid'];
		$prm = (object)array();
		$prm->table = 'cl_prize_post_record';
		$prm->select = '*';
		$prm->where = 'MemberId = '.$mid;
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data = array();
		while($r = mysql_fetch_assoc($res))
		{
			$data[] = $r;
		}
	}
	function GetNum($mid){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_game';
		$prm->type = 1; 
		$prm->field = 'Id'; 
		$prm->where = 'MemberId='.$mid.' AND State=1';
		$prm->limit = '';
		$r = dbSelectCount($prm,$con);
		return $r;
	}
	function GetName($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_game';
		$prm->select = 'GameName';
		$prm->where = 'Id = '.$id;
		$res = DbSelectOne($prm,$con);
		return $res->GameName;
	}
	function GetCName($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_post_company';
		$prm->select = 'CompanyName';
		$prm->where = 'Id = '.$id;
		$res = DbSelectOne($prm,$con);
		return $res->CompanyName;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的发货记录</title>
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport" />
	<link rel="stylesheet" type="text/css" href="mallShare.css">
	<link rel="stylesheet" type="text/css" href="gold.css?1">

</head>
<body>
	<div class="wrap">
		<div class="head">
           
                <!--<div class="top fixedClear"><span class="top-left">奖品发货详情</span><a href="http://weixin.clejw.com/Activity/index.php?h=access" class="top-right" ></a></div> 
                <div class="momeny"></div>-->
                <div class="balance">奖品发货详情</div>
				
            
        </div>
       <!--  <div class="profit fixedClear" style="display: none;">
               <div class="profit-left"><span class="profit-tit">今日预计收益</span><span class="today">2.98积分</span></div>
               <div class="profit-right"><span class="profit-tit">累计收益</span><span class="addDay">13.33积分</span></div>
       </div> -->
		<div class="main">
            <div class="acc">发货记录</div>
    		<div class="abb">已发货<span id="oil"><?php echo GetNum($mid);?></span>件</div>	
			<div class="box">   
				<table class="tab">
                <thead>
                    <tr>
                        <th width="100">奖品名称</th>
                        <th width="100">物流公司</th>
                        <th>运单号</th>
                    </tr>
                </thead>
                <tbody class="ajx">
				 <?php
					$str = '';
					foreach($data as $val){
						if(strstr($val['GameId'],',')){
							$gid = explode(',',$val['GameId']);
							foreach($gid as $v){
								$str.='<tr><td>'.GetName($v).'</td><td>'.GetCName($val['PostCompany']).'</td><td>'.$val['PostNumber'].'</td></tr>';
							}
						}else{
							$str.='<tr><td>'.GetName($val['GameId']).'</td><td>'.GetCName($val['PostCompany']).'</td><td>'.$val['PostNumber'].'</td></tr>';
						}
					}
                    echo $str;
					?>
					 
                </tbody>
            </table>
			</div>
            <!--<a class="goOil" href="http://weixin.clejw.com/Activity/index.php?h=oilCardRecharge">去充油</a>--> 
		</div><!--main-->
       <!-- <div class="activity">
            <div class="act-tit">活动说明</div>
            <p class="act-m1">必须关注车联公众号，才能使用所获的油金;</p>
            <p class="act-m2">成功关注后再连加7天油;</p>
            <p class="act-m3">分享后每加入一人再加半升油;</p>
            <p class="act-m4">所得油金可在我的油箱里面查看;</p>
            <p class="act-m5">本公司保留最终解释权;</p>
        </div>
		-->
	</div>
</body>
</html>