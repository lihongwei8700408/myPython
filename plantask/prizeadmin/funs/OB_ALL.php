<?php
/*
 *共1个方法
 *OB_Substr
*/
?>
<?php
/**
	 * FUN   OB_Substr
	 * EFF   中文字符串截取 
	 * PRM   $str     string     截取的字符串
	 * PRM   $strat   int        起始偏移
	 * PRM   $length  int        结束位置
	 * PRM   $charset string     字符串编码  默认utf-8，可用gb2312,gbk,big5
	 * PRM   $suffix  string     结束后缀  默认空
	 *
	 * RET   string
	 * LOC   公共函数
	 * 
	 * *********************************************
	 * time	2014-11-10
     * who	谢伟
	 */
	function OB_Substr($str,$start,$length,$charset="utf-8", $suffix='')
	{
		if(function_exists("mb_substrs")){
			$slice = mb_substr($str, $start, $length, $charset);
		}elseif(function_exists('iconv_substr')) {
			$slice = @iconv_substr($str,$start,$length,$charset);
		}else{ 
			$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
			$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
			$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
			$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
			preg_match_all($re[$charset], $str, $match);
			$slice = join("",array_slice($match[0], $start, $length));
		}
		return $slice.$suffix;
	}

	//添加今天日志
	function toDayLog($neiRong){
		global $con;
		$neiRong=date('Y-m-d H:i:s',time()).'<==>'.$neiRong;
		//查询今日是否有记录
		$lo_prm = (object)array();
		$lo_prm->table = 'rizhi';
		$lo_prm->select = 'RiQi';
		$lo_prm->where = 'ChengYuanId='.$_SESSION['ChengYuanId'].' and RiQi>'.strtotime(date('Y-m-d',time()));
		$lo_data=dbSelectOne($lo_prm,$con);

		if(empty($lo_data->RiQi)){
			$prmInsert = (object)array();
			$prmInsert->table = 'rizhi';
			$prmInsert->insert = array(
					'ChengYuanId'=>$_SESSION['ChengYuanId'],
					'RiQi'=>time(),
					'NeiRong'=>$neiRong,
					'ChengYuan'=>$_SESSION['XingMing'],
			);
			
			$state = dbInsertOne($prmInsert,$con);
		}else{
			$prm = (object)array();
			$prm->table = 'rizhi';
			$prm->update = "NeiRong=concat(NeiRong,'".'\n'.$neiRong."')";
			$prm->where = 'ChengYuanId='.$_SESSION['ChengYuanId'].' and RiQi>'.strtotime(date('Y-m-d',time()));
			$state = dbUpdateOne($prm,$con);
		}
		return $state;
	}	
?>