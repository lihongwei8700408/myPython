<?php
	/**
	 * 获取商家信息存入对象$_SELLER
	 * PAR    $sid    int   会员id
	 */
	function GetUserInfo($id){
		
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_static_user';
		$prm->select = '*';
		$prm->where = 'UserId = '.$id;
		$res = DbSelectOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}
		
		
	}
	function GetMemInfo($id){
		
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_member';
		$prm->select = '*';
		$prm->where = 'MemberId = '.$id;
		$res = DbSelectOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}
		
		
	}
	//统计登录次数
	function CountLogin(){
		global $con;
		global $_USER;
		$prm = (object)array();
		$prm->table = 'cl_user_loginlog';
		$prm->type = 1; 
		$prm->field = 'Id'; 
		$prm->where = 'UserId='.$_USER->UserId;
		$prm->limit = '';
		$ret = dbSelectCount($prm,$con);
		return $ret;
	}
	//上次登录时间查询
	function PreLoginTime(){
		global $con;
		global $_USER;
		$prm = (object)array();
		$prm->table = 'cl_user_loginlog';
		$prm->select ='LoginTime';
		$prm->where = 'UserId='.$_USER->UserId;
		$prm->order = 'Id desc';
		$prm->limit = '0,2';
		$res = DbSelect($prm,$con);
		$data=array();
		$a= array();
		while($data = mysql_fetch_assoc($res)){
			$a[] = $data['LoginTime'];
		}
		if($a[0]){
			return  date('Y-m-d H:i:s',$a[0]);
		}else{
			return '';
		}
		
	}
	//首页件数统计
	function CountPostRecord($where){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_prize_post_record';
		$prm->select = 'GameId';
		$prm->where =$where;
		$prm->limit = '';
		$ret = dbSelect($prm,$con);
		$r = array();
		$n = 0;
		while($data = mysql_fetch_assoc($ret)){
			$r[]= $data;
		}
		foreach($r as $val){
			$a = explode(',',$val['GameId']);
			$n +=count($a);
		} 
		return $n;
	}
	//商家头像
	function Avator(){
		global $_SELLER;
		if(!empty($_SELLER->ShopLogo)){

			return "<img  src='".$_SELLER->ShopLogo."'  width='80' height='80' onerror=\"javascript:this.src='".STATIC_DOMAIN."/images/default_head.gif'\">";


		}else{
			return "<img  src='".STATIC_DOMAIN."/images/default_head.gif' width='80' height='80'>";
				
		}
	}
	//获取买家会员名称
	function GetMemberName($res,$field){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_member';
		$prm->select = 'MemberName';
		$prm->where = 'MemberId = '.$res[$field];
		$res = DbSelectOne($prm,$con);
		if($res){
			unset($con);
			return $res->MemberName;
		}
		
	}
	//获取买家会员openid
	function GetMemberOpenId($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_member';
		$prm->select = 'OpenId';
		$prm->where = 'MemberId = '.$id;
		$res = DbSelectOne($prm,$con);
		if($res){
			unset($con);
			return $res->OpenId;
		}
		
	}
	
	/**
	 * FUN  CountSellerService	    统计cl_service表记录条数及某些字段合计值
	 * PAR   $option    string		配置参数，_count表示要统计条数，后面再有逗号分割的表示要累计的字段
									例：$option = '_count,OrderCoin,OrderMoney';
	 * 		 $where     string		查询过滤条件
	 */
	//商家发布的服务统计（已上架，未上架）
	function CountSellerService($option,$where){
		if(!$option){return false;}
		$opt = explode(',',$option);
		$sum = $count = '';
		if($opt[0] == '_count'){
			$count = 'COUNT(Id) as Count,';
			unset($opt[0]);
		}
		if(count($opt) > 0){
			foreach($opt as $v){
				$sum .= 'SUM('.$v.') as '.$v.',';
			}
		}
		$sum = $count.$sum;
		$sum = substr($sum,0,-1);
		
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->select = $sum;
		$prm->where =$where;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res->Count;
	}
	//服务订单统计
	function CountServiceOrder($option,$where){
		if(!$option){return false;}
		$opt = explode(',',$option);
		$sum = $count = '';
		if($opt[0] == '_count'){
			$count = 'COUNT(Id) as Count,';
			unset($opt[0]);
		}
		if(count($opt) > 0){
			foreach($opt as $v){
				$sum .= 'SUM('.$v.') as '.$v.',';
			}
		}
		$sum = $count.$sum;
		$sum = substr($sum,0,-1);
	
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_order';
		$prm->select = $sum;
		$prm->where =$where;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res->Count;
	}
	//商城订单统计
	function CountMallOrder($option,$where){
		if(!$option){return false;}
		$opt = explode(',',$option);
		$sum = $count = '';
		if($opt[0] == '_count'){
			$count = 'COUNT(Id) as Count,';
			unset($opt[0]);
		}
		if(count($opt) > 0){
			foreach($opt as $v){
				$sum .= 'SUM('.$v.') as '.$v.',';
			}
		}
		$sum = $count.$sum;
		$sum = substr($sum,0,-1);
	
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_order';
		$prm->select = $sum;
		$prm->where =$where;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res->Count;
	}
	//服务订单操作按钮
	function OrderDeal($res,$field){
		$array = array(
			'1'=>'接单',
			'4'=>'删除',
			'5'=>'确认完成'
		);
		if(array_key_exists($res['State'],$array)){
			$str = '<a class="sellbutton" href="'.WEB_SHOPADMIN.'/index.php?c=sorderdetail&Id='.$res['Id'].'">查看</a><a  href="javascript:;" class="sellbutton" data-id="'.$res['Id'].'" data-state="'.$res['State'].'">'.$array[$res['State']].'</a>';
		}else{
			$str = '<a class="sellbutton" href="'.WEB_SHOPADMIN.'/index.php?c=sorderdetail&Id='.$res['Id'].'">查看</a>';
		}
		
		return $str;
	}
	function MallOrderDeal($res,$field){
		$array = array(
			'2'=>'发货',
			'6'=>'删除'
		);
		if(array_key_exists($res['State'],$array)){
			$str = '<a class="sellbutton" href="'.WEB_SHOPADMIN.'/index.php?c=orderdetail&Id='.$res['Id'].'">查看</a><a  href="javascript:;" class="sellbutton" data-id="'.$res['Id'].'" data-state="'.$res['State'].'">'.$array[$res['State']].'</a>';
		}else{
			$str = '<a class="sellbutton" href="'.WEB_SHOPADMIN.'/index.php?c=orderdetail&Id='.$res['Id'].'">查看</a>';
		}
		
		return $str;
	}
	//服务类别名称转换
	function GetBigClassName($res,$field,$cid){
		global $con;
		if($res[$field]){
			$id = $res[$field];
		}else{
			$id = $cid;
		}
		$prm = (object)array();
		$prm->table = 'cl_class';
		$prm->select = 'ClassName';
		$prm->where = 'ClassId='.$id;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res->ClassName;
		
	}
	//商品类别名称转换
	function GetMallClassName($cid){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_class';
		$prm->select = 'ClassName';
		$prm->where = 'ClassId='.$cid;
		$res = DbSelectOne($prm,$con);
		unset($con);
		if($res){
			return $res->ClassName;
		}else{
			return '代金券';
		}
		
	}
	//首页店铺技术，态度,环境评分等 $type =1,2,3
	function GetRiewGrade($type){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = 'cl_review';
		$prm->type = 1;
		$prm->field = 'Id';
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$prm->limit = '';
		$num = dbSelectCount($prm,$con);
		if($type==1){
			$prm = (object)array();
			$prm->table = 'cl_review';
			$prm->type = 2;
			$prm->field = 'Skill';
			$prm->where = 'SellerId='.$_SELLER->SellerId;
			$prm->limit = '';
			$total = dbSelectCount($prm,$con);
		}else if($type==2){
			$prm = (object)array();
			$prm->table = 'cl_review';
			$prm->type = 2;
			$prm->field = 'Attitude';
			$prm->where = 'SellerId='.$_SELLER->SellerId;
			$prm->limit = '';
			$total = dbSelectCount($prm,$con);
		}else{
			$prm = (object)array();
			$prm->table = 'cl_review';
			$prm->type = 2;
			$prm->field = 'Environ';
			$prm->where = 'SellerId='.$_SELLER->SellerId;
			$prm->limit = '';
			$total = dbSelectCount($prm,$con);
		}
		if($total){
			return round( $total / $num , 2);
		}else{
			return '5.00';
		}
		
	}
	//商家发布的商品统计（已上架，未上架）
	function CountSellerProduct($option,$where){
		if(!$option){return false;}
		$opt = explode(',',$option);
		$sum = $count = '';
		if($opt[0] == '_count'){
			$count = 'COUNT(Id) as Count,';
			unset($opt[0]);
		}
		if(count($opt) > 0){
			foreach($opt as $v){
				$sum .= 'SUM('.$v.') as '.$v.',';
			}
		}
		$sum = $count.$sum;
		$sum = substr($sum,0,-1);
	
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_goods';
		$prm->select = $sum;
		$prm->where =$where;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res->Count;
	}
	/**
	 * Fun VwList
	 * 列表渲染函数内层
	 * Params    $res     	  resource   数据库查询资源结果集
	 * 			 $template    string   模板
	 * 			 $opdata      array    适用于VwContent函数中的第三个参数  默认空
	 * ************************************************
	 * 
	 */
	function VwList($res,$template,$opdata = array())
	{
		if(!is_resource($res)){
			return '';
		}
		ob_start();
		while($vm_data = mysql_fetch_assoc($res)){
			
			$templateStr = '?>'.strtr($template,array('<!--{'=>'<?php echo ','}-->'=>'?>'));
			eval($templateStr);
		}
		$retStr = ob_get_contents();
		ob_end_clean();
		return $retStr;
		
	}
	
	/**
	 * FUN  VmSContent
	 * EFF  模板标签  列表页适用
	 * PRM  $prm	string     解析的字符串(支持多种格式)
				[]中括号不是必须的
				ClassId[6]   截取映射关系中长度为6的数据并返回
				ClassId[6]:_fun->test  调用用户自定义函数test
				id[5]:fl_class(ClassId)->ClassName  查fl_class表中ClassId=id的记录，返回ClassName字段值
				
				_where[8]:fl_member(MemberId=1)->MemberName  获取fl_member表中 满足MemberId=1的记录，返回MemberName字段值
				注:解析结果值来源字传入的第二个参数中键相同的值
	 * PRM  $vm_data    array    解析字段与数组的映射关系
	 * PRM  $opdata  对应解析数据包    默认为空    建议调用   DealInfoData($res,$option) 函数生成对应数据
	 * 					$opdata = array(
									'ClassId'=>array(
										'1'=>'测试1',
										'2'=>'测试2',
										'3'=>'测试3',
									),
									'TagId'=>array(
										'1'=>'牛',
										'2'=>'羊',
										'3'=>'鸡',
									),
							);
	 * RET  无   直接输出解析字符串
	 * REL 
           ====================================================	 
	        SubStrUtf() 函数 中文字符串截取
			db*       系列函数  需要实现查询功能
		   ====================================================
	 * *********************************************
	 * time	2014-11-10
     * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 VmSContent('ClassId[6]',$array);
	 VmSContent('ClassId[6]:_fun->test',$array);
	 VmSContent('ClassId[6]:fl_class(ClassId)->ClassName',$array);
	 VmSContent('_where[6]:fl_member（MemberId=1）->MemberName',$array);
	 * 
	 ////////////////////////////////////新增数据映射方式/////////////////////////////////////////////
	 VmSContent('ClassId[]',$array,$opdata); $opdata = DealInfoData($data,$option);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function VmSContent($prm,$vm_data=array(),$opdata = array())
	{
		$prm = str_replace(' ','',$prm);
		
		@list($prm1,$prm2) = explode(':', $prm);

		$chunk = explode('[',strtr($prm1,array(' '=>'',']'=>'')));
		
		$chnkLen = isset($chunk[1]) ? $chunk[1] : 0;
		
		$chnkLen = strtr($chnkLen,array(','=>''));
		
		if($opdata){
			if(isset($opdata[$chunk[0]])){
				$otherData = $opdata[$chunk[0]];
				if(isset($otherData[$vm_data[$chunk[0]]])){
					if($chnkLen){
						return SubStrUtf($otherData[$vm_data[$chunk[0]]],0,$chnkLen);
					}else{
						return $otherData[$vm_data[$chunk[0]]];
					}
					
				}
			}
		}
		
		if((strpos($prm1, '_where') !== false))
		{	
			//_where[6]:   fl_member(MemberId=1)->MemberName
			
			@list($table,$field) = explode('->', $prm2);
			@list($table,$where) = explode('(', $table);
			$where = substr($where,0,-1);
			
		}else{
			$content = $vm_data[$chunk[0]];
			if(!$chnkLen)
				$chnkLen = strlen($content);
			if(!$prm2)
			{
				return SubStrUtf($content,0,$chnkLen);
			}else{
				list($prm3,$prm4) = explode('->', $prm2);
				
				$string = $prm1;
				
				if($prm3 == '_fun')
				{
					return $prm4($vm_data,$chunk[0]);
				}else{
				
					@list($table,$field) = explode('(', $prm3);
					
					if($field)
					{
						$where = substr($field,0,-1).' = "'.$content.'"';
						$field = $prm4;
					}
				}
			}
		}
		
		$_prm = (object)array();
		$_prm->table = $table;
		$_prm->select = $field;
		$_prm->where = $where;
		global $con;
		if($obj = DbSelectOne($_prm,$con))
		{
			unset($_prm);
			unset($con);
			return SubStrUtf($obj->$field,0,$chnkLen);
		}
	}
	/**
	 * utf8 字符串截取
	 * @param $str      string  待截取字串
	 * @param $start    int     开始位置
	 * @param $length   int     截取长度
	 * @param $charset  string  字符编码
	 * @param $suffix   string  截取后拼接字串
	 * -------------------------------------
	 * author   xiewei
	 * time     2015-01-07 10:44
	 */
	function SubStrUtf($str,$start,$length,$charset="utf-8", $suffix='')
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
	//分页
	function PagePrm($count){
	global $_URL;
	
	$prm = (object)array();

	$popUrl = $_URL[count($_URL)-1];
	if(preg_match('/_p(\d+)$/i', $popUrl,$page)){ //带分页
		$nowPageNum = $page[1];
		$prm->preUrl =  preg_replace('/(\/\w*)_p(\d+)/i', '$1_p',$_SERVER['SCRIPT_URI']);
	}else{
		$nowPageNum = 1;
		$prm->preUrl =  $_SERVER['SCRIPT_URI'].'/_p';
	}
	
    if(!empty($_SERVER['QUERY_STRING'])){
    	$prm->isQuery='?'.$_SERVER['QUERY_STRING'];
		
    }
  
	$prm->total = $count->Count; //总数
	$prm->perNum = PAGE; //每页显示条数
	$prm->showBtn = '3'; //最大显示按钮数量
	$prm->nowPage = $nowPageNum; //当前所处页码数
	
	return $prm;
	
   }
	//分页
	function UserPage($prm)
	{
		if(!$prm->total)
		{
			return ;
		}
		$totalPage = ceil($prm->total/$prm->perNum);
		$limit = floor($prm->showBtn/2);

		$max = ($prm->nowPage+$limit);
		$min = ($prm->nowPage-$limit);
		if($min < 1){
			$min = 1;
			$max = $prm->showBtn;
		}

		if($max > $totalPage){
			$min = ($totalPage - $prm->showBtn)+1;
			$max = $totalPage;
		}
		if($min < 1){ $min = 1; }
		if($prm->nowPage >= $totalPage){$prm->nowPage = $totalPage;}
		//上一页 下一页
		$nextPage = ($prm->nowPage == $totalPage)? $totalPage : $prm->nowPage+1;
		$prevPage = ($prm->nowPage == 1)? 1 : $prm->nowPage-1;
		/* $nextPage = $nextPage.$prm->isQuery;
		$prevPage = $prevPage.$prm->isQuery;
	 */
		echo '<div class="pagnation" id="pagnation">';
		$queryStr = '';
		$prm->isQuery = $prm->isQuery ? $prm->isQuery : false;
		if($prm->isQuery && $_SERVER['QUERY_STRING']) //追加 query string
		{
			$queryStr = '?'.$_SERVER['QUERY_STRING'];
			$prevPage .= $queryStr;
		}
		
		if($prm->nowPage != 1)
		{
			echo '<a href="'.$prm->preUrl.$prevPage.'" class="page-prev"></a>';
		}
		
		//echo $prm->nowPage - floor($prm->showBtn/2);
		//输出  ...
		//($prm->nowPage - floor($prm->showBtn/2)) > 1
		if(($prm->nowPage - $prm->showBtn) > 1)
		{
			echo '<a href="'.$prm->preUrl.'1" >1</a><a href="javascript:;"><strong>···</strong></a>';
		}

		for($i = $min;$i <= $max;$i++)
		{
		if($i == $prm->nowPage ) //当前页
		{
		echo '<a href="'.$prm->preUrl.$i.$queryStr.'" class="current">'.$i.'</a>';
				continue;
		}
		//普通页
		echo '<a href="'.$prm->preUrl.$i.$queryStr.'">'.$i.'</a>';
		}
		if($prm->nowPage != $totalPage) //到达最终数
		{
		echo '<a href="'.$prm->preUrl.$nextPage.$queryStr.'" class="page-next">下一页</a>';
				}
				echo '</div>';
	}
	/**
	 * 搜索
	 */
	function GetSqlWhereByGet($option){
		global $con;
		//获取查询条件
		if($_GET){
			$sqlStr = '';
			
			foreach($_GET as $k=>$v){
				if(array_key_exists($k, $option)){
					switch($option[$k]['type']){
						case 'select':
							if(array_key_exists($v, $option[$k]['data']) && $v){
								$sqlStr .= ' AND  '.$option[$k]['field'].' = '.$v;
							}
							break;
						case 'time':
							if($v){
								$sqlStr .= ' AND  '.$option[$k]['field'].strtotime($v);
							}
								
							break;
						
						case 'like':
							if($v){
								$sqlStr .= ' AND  '.$option[$k]['field'].' LIKE "%'.mysql_real_escape_string($v).'%"';
							}
							break;
					}
				}
			}
			//$sqlStr.=' AND ';
			//$sqlStr = substr($sqlStr,5);
			
			return $sqlStr;
		}
	}
	/**
	 * FUN  ShowSearchHtml
	 * PAR  $option    array   呈现过滤的数组配置
	 *      $validate  array   默认值
	 * RET  void
	 */
	function ShowSearchHtml($option,$validate = array()){
		
	
	
		
		$validate = $validate ? $validate : $_GET;
		$brNum = 4;//每1个换一行
		$num = 1;
		$nbsp='&nbsp;&nbsp;&nbsp;';
		foreach($option as $k=>$v){
			
			if($num > $brNum){
				 echo '<br />';
				 echo '<br />'; 
				 
				 
				 
			}
			if($num==$brNum+1){
				$num=1;
			}
			$num++;

			$code = isset($v['html']) ? $v['html'] : '';
				
			$selValue = (isset($validate[$k])) ? $validate[$k] : '';
			if($v['type'] == 'select'){ //下拉
	
				echo $nbsp.$v['name'].$nbsp.'<select name="'.$k.'" '.$code.' id="fk_'.$k.'">';
				foreach($v['data'] as $sk=>$sv){
					if($selValue == $sk){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					echo '<option value="'.$sk.'" '.$selected.'>'.$sv.'</option>';
				}
				echo '</select>';
			}else{//时间组件
				echo $nbsp.$v['name'].$nbsp.'<input type="text" name="'.$k.'" value="'.$selValue.'" '.$code.' id="fk_'.$k.'"/>';
			}
		}
		
		echo $nbsp.'<input  class="sellbutton" type="submit" value="搜索"/></form>';
	}
	//分页新 李红薇9-21
	function NewPage($search){
		global $count;
		$prm = (object)array();
		$prm->total = $count; //总数
		$prm->perNum = PAGE; //每页显示条数
		$prm->showBtn = '5'; //最大显示按钮数量
		$prm->nowPage = !isset($_GET['page']) ? 1 : $_GET['page']; //当前所处页码数
		if(isset($_GET['other'])){
			$prm->preUrl = 'index.php?c='.$_GET['c'].'&other='.$_GET['other'].$search.'&page='; //跳转地址前缀 
		}else{
			$prm->preUrl = 'index.php?c='.$_GET['c'].$search.'&page='; //跳转地址前缀
		}
		$prm->zhCss = 'color:purple;width:50px;';//中文样式可分页
		$prm->zhCssNo = 'width:50px;color:#ccc';//中文样式不可分页
		$prm->commonCss = 'color:red;text-decoration:none;width:24px;'; //公共样式
		$prm->specialCss = 'font-weight:bold;color:red;width:24px;'; //当前页样式

		$page = VW_Page($prm);	
		return $page;
	}
	//订单列表 
	function OrderList($state,$sid){
		if(empty($state)){
			global $con;
			global $limit;
			global $sqlSearch;
			$prm = (object)array();
			$prm->table = 'cl_order';
			$prm->select = '*';
			$prm->where = 'SellerId = '.$sid.' AND State!= 6 AND State!= 7 '.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}else{
			global $con;
			global $limit;
			global $sqlSearch;
			$prm = (object)array();
			$prm->table = 'cl_order';
			$prm->select = '*';
			$prm->where = 'SellerId = '.$sid.' AND State = '.$state.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}
	}
	//服务订单删除操作  改状态为6
	function OrderDelete($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_order';
		$prm->where = 'Id='.$id;
		$prm->update = 'State = "6"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}else{
			return false;
		}
	}
	//服务订单接单操作  改状态为5
	function OrderRecive($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_order';
		$prm->where = 'Id='.$id;
		$prm->update = 'State = "5"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}else{
			return false;
		}
	}
	//服务订单商家确认完成操作  改状态为2
	function OrderConfirm($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_order';
		$prm->where = 'Id='.$id;
		$prm->update = 'State = "2"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}else{
			return false;
		}
	}
	//商城订单列表
	function MallOrderList($state,$sid){
		if(empty($state)){
			global $con;
			global $limit;
			global $sqlSearch;
			$prm = (object)array();
			$prm->table = 'cl_mall_order';
			$prm->select = '*';
			$prm->where = 'SellerId = '.$sid.' AND State!= 7 '.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}else{
			global $con;
			global $limit;
			global $sqlSearch;
			$prm = (object)array();
			$prm->table = 'cl_mall_order';
			$prm->select = '*';
			$prm->where = 'SellerId = '.$sid.' AND State = '.$state.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}
	}
	//商城订单删除 改订单及分表状态为7
	function MallOrderDelete($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_order';
		$prm->where = 'Id='.$id;
		$prm->update = 'State = "7"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			$prm = (object)array();
			$prm->table = 'cl_mall_buy_log';
			$prm->update = 'State="7"';
			$prm->where = 'OrderId='.$id;
			$ret = dbUpdates($prm,$con);
			unset($con);
			return $ret;
		}else{
			return false;
		}
	}
	//商城订单发货 改订单及分表状态为3
	function MallOrderDelivery($id,$data){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_order';
		$prm->where = 'Id='.$id;
		$prm->update = glurSql($data,array(),',');
		$res = dbUpdateOne($prm,$con);
		if($res){
			$prm = (object)array();
			$prm->table = 'cl_mall_buy_log';
			$prm->where = 'OrderId ='.$id;
			$prm->update = 'State="3"';
			$ret = dbUpdateOne($prm,$con);
			unset($con);
			return $ret;
		}else{
			return false;
		}
	}
	//时间戳转换
    function DealTime($res,$field){
		if(!$res[$field] || !is_numeric($res[$field]))
		{
			return '';
		}
		
		return date('Y-m-d H:i:s',$res[$field]);
		
	}
	//服务订单状态0--未支付 1--已支付 2--已服务完成3--已完成4--取消5--商家已接单6--商家删除7--用户删除 
	function OrderState($res,$field){
		$stateaArr=array(
				'1'=>'待接收',
				'2'=>'待评价',
				'3'=>'交易完成',
				'4'=>'交易关闭',
				'5'=>'已接单'
				);
		if(!$res[$field] || !is_numeric($res[$field]))
		{
			return '';
		}
		
		return $stateaArr[$res[$field]];
	}
	//商城订单状态
	function OrderCheck($res,$field){
		$stateaArr=array(
				'1'=>'待支付',
				'2'=>'待发货',
				'3'=>'已发货',
				'4'=>'待评价',
				'5'=>'交易完成',
				'6'=>'交易关闭',
				);
		if(!$res[$field] || !is_numeric($res[$field]))
		{
			return '';
		}
		
		return $stateaArr[$res[$field]];
	}
	//统计列表总数
	function ListPrizeCount($table,$where,$field){
		global $con;
		$prm = (object)array();
		$prm->table = $table;
		$prm->type = 1; 
		$prm->field = $field; 
		$prm->where = $where;
		$prm->limit = '';
		$ret = dbSelectCount($prm,$con);
		return $ret;
	}
	//统计列表总数
	function MemberPrizeCount($where){
		global $con;
		$sql = 'select count(distinct MemberId) as count from cl_game where '.$where;
		$ret = mysql_query($sql,$con);
		$r = mysql_fetch_array($ret);
		return $r['count'];
	}
	//查询订单列表数据
	function TBSlServiceMore($where,$select,$order){
		global $con;
		global $_SELLER;
		$limit = '';
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->select =$select;
		$prm->where = $where;
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		unset($con);
		return $res;
	}
	//查询商城订单列表数据
	function TBSlBuyMore($where,$select,$order){
		global $con;
		global $_SELLER;
		$limit = '';
		$prm = (object)array();
		$prm->table = 'cl_mall_buy_log';
		$prm->select =$select;
		$prm->where = $where;
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		unset($con);
		return $res;
	}
	//订单列表小模板
	function OrderSmallTemp($res,$field){
		global $_SELLER;
		$sid =array_filter(explode('|',$res['ServiceId']));
		$strid = '(';
		foreach($sid as $v){
			$strid.=$v.',';
		}
		$strid = substr($strid,0,strlen($strid)-1).')';
		$where = 'Id In'.$strid.' AND SellerId='.$_SELLER->SellerId;
		$a = TBSlServiceMore($where, $select = '*', $order = '');
		$data = array();
		while($r = mysql_fetch_assoc($a))
		{
			$data[] = $r;
		}
		
		$str ='';
		foreach($data as $val){
			$stime = str_replace('.',':', sprintf( '%.2f',$val['ServiceStartTime']/100));
			$etime = str_replace('.',':', sprintf( '%.2f',$val['ServiceEndTime']/100));
			$str.="<tr>
	    	<td align='left'><img  class='orderpic' src='".STATIC_DOMAIN."/images/orderpic/shai_".$val['ServiceId']."' onerror=\"javascript:this.src='".STATIC_DOMAIN."/images/orderpic/default.png'\"><a href='' class='title'>".$val['Title']."</a> </td>
			<td align='center'>".GetBigClassName('','',$val['ClassId'])."</td>
	    	<td align='center'>".$val['Price']."</td>
			<td align='center'>".$val['CheapPrice']."</td>
	    	<td align='center'>".$stime."-".$etime."</td>
			
	  
	    	</tr>";
		
			
		}
		return $str;
		
		
	}
	//订单列表小模板
	function MallOrderSmallTemp($res,$field){
		
		global $_SELLER;
		$where = 'OrderId ='.$res[$field].' AND SellerId='.$_SELLER->SellerId;
		$a = TBSlBuyMore($where, $select = '*', $order = '');
		$data = array();
		while($r = mysql_fetch_assoc($a))
		{
			$data[] = $r;
		}
	
		$str ='';
		foreach($data as $val){
				
			$str.="<tr>
    	<td align='left'><img  class='orderpic' src='".$val['TitlePic']."' /><a href='' class='title'>".$val['Title']." * ".$val['BuyNum']."</a> </td>
    	<td align='center'>".GetMallClassName($val['ClassId'])."</td>
		<td align='center'>".$val['Price']."</td>
		<td align='center'>".$val['CheapPrice']."</td>
    	
	
    	</tr>";
	
				
		}
		
		return $str;
	
	
	}
	//统计列表总数
	function ListCount($table,$where,$field){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = $table;
		$prm->type = 1; 
		$prm->field = $field; 
		$prm->where = $where;
		$prm->limit = '';
		$ret = dbSelectCount($prm,$con);
		return $ret;
	}
	//全部会员验证码数据
	function CodeList(){
		global $con;
		global $limit;
		global $sqlSearch;
		$prm = (object)array();
		$prm->table = 'cl_member';
		$prm->select = 'MemberId,MemberName,Tel,VerifyCode';
		$prm->where = 'State = 1'.$sqlSearch;
		$prm->limit = $limit.','.PAGE;
		$res = DbSelect($prm,$con);
		if($res){
			unset($con);
			return $res;
		}
		
	}
	//全部奖品列表数据
	function PrizeList($where){
		global $con;
		global $limit;
		global $sqlSearch;
		$prm = (object)array();
		$prm->table = 'cl_prize';
		$prm->select = '*';
		$prm->where = $where.$sqlSearch;
		$prm->limit = $limit.','.PAGE;
		$res = DbSelect($prm,$con);
		if($res){
			unset($con);
			return $res;
		}
		
	}
	//查询获奖记录列表数据
	function GameList($state){
		global $con;
		global $limit;
		global $sqlSearch;
		if($state ==''){
			$prm = (object)array();
			$prm->table = 'cl_game';
			$prm->select = '*';
			$prm->where ='Type!=10 '.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$prm->order='Id desc';
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}else{
			$prm = (object)array();
			$prm->table = 'cl_game';
			$prm->select = '*';
			$prm->where = 'Type!=10 AND Type!=9 AND Type!=6 AND State = '.$state.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$prm->order='Id desc';
			$res = DbSelect($prm,$con);
			
			if($res){
				unset($con);
				return $res;
			}
		}
	}
	//查询获奖记录列表数据按会员分组
	function GameGroupList($state){
		global $con;
		global $limit;
		global $sqlSearch;
		if($state ==''){
			$prm = (object)array();
			$prm->table = 'cl_game';
			$prm->select = '*';
			$prm->where ='Type!=10 AND Type!=9 AND Type!=6 '.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$prm->order='MemberId asc';
			$prm->group='MemberId';
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}else{
			$prm = (object)array();
			$prm->table = 'cl_game';
			$prm->select = '*';
			$prm->where = 'Type!=10 AND Type!=9 AND Type!=6  AND State = '.$state.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$prm->order='MemberId asc';
			$prm->group='MemberId';
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}
	}
	
	//奖品状态
	function PrizeState($res,$field){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_game';
		$prm->select = 'Id,Type,State';
		$prm->where = 'Id='.$res[$field];
		$res = DbSelectOne($prm,$con);
		if($res->Type==9||$res->Type==6){
			return '已送达';
		}else{
		$stateaArr=array(
				'0'=>'未发货',
				'1'=>'已发货',
				);
		return $stateaArr[$res->State];
		}
	}
	//奖品记录操作按钮
	function PrizeDeal($res,$field){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_game';
		$prm->select = 'Id,Type,State';
		$prm->where = 'Id='.$res[$field];
		$res = DbSelectOne($prm,$con);
		if($res->Type==9 ||$res->Type==10||$res->Type==6){
			return '';
		}else{
			
			$stateaArr=array(
				'0'=>'去发货',
				'1'=>'',
				);
			if($stateaArr[$res->State]==''){
				return '';
			}else{
				$str = '<a  href="javascript:;" class="sellbutton" data-id="'.$res->Id.'">'.$stateaArr[$res->State].'</a>';
				return $str;
			}
		}
	}
	//奖品记录批量发货操作按钮
	function MassDelivery($res,$field){
		
		$str = '<a  href="javascript:;" class="mass" data-id="'.$res[$field].'">批量发货</a>';
		return $str;
		
	}
	//根据会员id查询奖品记录
	function PrizeMemberGroup($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_game';
		$prm->select ='*';
		$prm->where ='MemberId='.$id.' AND Type!=9 AND Type!=10 AND State=0';
		$prm->order = 'Id desc';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$rs = array();
		while($data = mysql_fetch_assoc($res)){
			$r['Id'] = $data['Id'];
			$r['GameName'] = $data['GameName'];
			$r['Time'] = date('Y-m-d H:i:s',$data['Time']);
			$rs['list'][] = $r;
		}
		$info = GetMemInfo($id);
		$rs['address'] = MemberAddress($id);
		$rs['name'] = $info->RealName;
		$rs['tel'] = $info->Tel;
		return json_encode($rs);
	}
	//单个发送奖品后修改cl_game表状态
	function UpGame($id){
		global $con;
		$prm->table = 'cl_game';
		$prm->where = 'Id ='.$id;
		$prm->update = 'State="1"';
		$b = dbUpdateOne($prm,$con);
		return $b;
	}
	function GetPostCompany(){
	    global $con;
		$prm = (object)array();
		$prm->table = 'cl_post_company';
		$prm->select ='Id,CompanyName';
		$prm->where ='';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			$str.='<option value='.$data['Id'].'>'.$data['CompanyName'].'</option>';
		}
		
		unset($con);
		return $str;
	}
	/**
	 * 奖品发货信息
	 */
	function PrizePostInfo($id){
		global $con;
		$prm = (object)array();
		$prm->table = cl_game;
		$prm->select = '*';
		$prm->where = 'Id='.$id;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res;
	}
	function PrizePostInfoSub($id){
		global $con;
		$prm = (object)array();
		$prm->table = cl_prize_post_record;
		$prm->select = '*';
		$prm->where = 'GameId='.$id;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res;
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
	function MemberAddress($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_member';
		$prm->select = 'PrizeAddress';
		$prm->where = 'MemberId = '.$id;
		$res = DbSelectOne($prm,$con);
		if($res){
			unset($con);
			return $res->PrizeAddress;
		}
	}
	//列表删除（单个）改状态
	function ListDelete($where,$table,$update){
		global $con;
		$prm = (object)array();
		$prm->table = $table;
		$prm->where = $where;
		$prm->update = $update;
		$res = dbUpdateOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}
	}
	//服务上架（单个）
	function UpBusiness($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->where = 'Id ='.$id;
		$prm->update = 'Checked="2"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}else{
			return false;
		}
	}
	//服务下架（单个）
	function DownBusiness($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->where = 'Id ='.$id;
		$prm->update = 'Checked="3"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			unset($con);
			return $res;
		}else{
			return false;
		}
	}
	//服务时间处理展示
	function ServiceTimeChange($res,$field){
		$t = sprintf( '%.2f',$res[$field] / 100);
		$ts = str_replace('.',':',$t);
		return $ts;
		
	}
	//商城列表删除（单个）改状态
	function MallListDelete($where){
		global $con;
		$prm = (object)array();
		$prm->table = $table;
		$prm->where = $where;
		$prm->update = 'State = "5"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			$prm = (object)array();
			$prm->table = 'cl_mall_coupons';
			$prm->where = 'GoodsId ='.$id;
			$prm->update = 'State="5"';
			$ret = dbUpdateOne($prm,$con);
			unset($con);
			return $ret;
		}else{
			return false;
		}
	}
	//商城商品上架（单个）
	function UpGoods($id,$table){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_goods';
		$prm->where = 'Id ='.$id;
		$prm->update = 'State="2"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			$prm = (object)array();
			$prm->table = $table;
			$prm->where = 'GoodsId ='.$id;
			$prm->update = 'State="2"';
			$ret = dbUpdateOne($prm,$con);
			unset($con);
			return $ret;
		}else{
			return false;
		}
	}
	//商城商品下架（单个）
	function DownGoods($id,$table){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_goods';
		$prm->where = 'Id ='.$id;
		$prm->update = 'State="4"';
		$res = dbUpdateOne($prm,$con);
		if($res){
			$prm = (object)array();
			$prm->table = $table;
			$prm->where = 'GoodsId ='.$id;
			$prm->update = 'State="4"';
			$ret = dbUpdateOne($prm,$con);
			unset($con);
			return $ret;
		}else{
			return false;
		}
	}
	//商品状态对应
	function GoodsState($res,$field){
		$array = array(
				'1'=>'未上架',
				'2'=>'已上架',
				'3'=>'售完下架',
				'4'=>'手动下架',
				'5'=>'商家删除',
				);
		return $array[$res[$field]];
	}
	//服务状态对应
	function ServiceState($res,$field){
		$array = array(
				'1'=>'未上架',
				'2'=>'已上架',
				'3'=>'已下架',
				'4'=>'已删除',
		);
		return $array[$res[$field]];
	}
	/*
	**个人中心
	*/
	//商家公告
	function SellerNotice(){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_seller_notice';
		$prm->select ='SellerNotice';
		$prm->order = 'Id desc';
		$prm->limit = '0,1';
		$res = DbSelect($prm,$con);
		$data=array();
		while($data = mysql_fetch_assoc($res)){
			$str = $data['SellerNotice'];
		}
		return $str;
	}
	//商家登录统计
	function SellerLoginLog(){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = 'cl_seller_loginlog';
		$prm->select ='LoginTime';
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$prm->order = 'Id desc';
		$prm->limit = '0,2';
		$res = DbSelect($prm,$con);
		$data=array();
		$a= array();
		while($data = mysql_fetch_assoc($res)){
			$a[] = $data['LoginTime'];
		}
		return  date('Y-m-d H:i:s',$a[0]);
	}
	//商家登录次数统计
	function SellerLoginCount(){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = 'cl_seller_loginlog';
		$prm->type = 1; 
		$prm->field = 'Id'; 
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$prm->limit = '';
		$ret = dbSelectCount($prm,$con);
		return $ret;
	}
	//商家站内信统计
	function SellerMessageCount(){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = 'cl_seller_message';
		$prm->type = 1; 
		$prm->field = 'Id'; 
		$prm->where = 'SellerId='.$_SELLER->SellerId.' AND State=1';
		$prm->limit = '';
		$ret = dbSelectCount($prm,$con);
		return $ret;
	}
	//商家站内信管理
	function SellerMessage(){
		global $con;
		global $_SELLER;
		global $limit;
		global $sqlSearch;
		$prm = (object)array();
		$prm->table = 'cl_seller_message';
		$prm->where = 'SellerId='.$_SELLER->SellerId.$sqlSearch;
		$prm->limit = $limit.','.PAGE;
		$prm->order = 'Id desc';
		$ret = dbSelect($prm,$con);
		return $ret;
	}
	function MessageState($res,$field){
		$array = array(
			'1'=>'未读',
			'2'=>'已读'
		);
		return $array[$res[$field]];
	}
	function MessageUpdate($id){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_seller_message';
		$prm->where = 'Id ='.$id;
		$prm->update = 'State="2"';
		$res = dbUpdateOne($prm,$con);
		$prm = (object)array();
		$prm->table = 'cl_seller_message';
		$prm->select = '*';
		$prm->where = 'Id ='.$id;
		$ret = dbSelectOne($prm,$con);
		return $ret;
	}
	/*
	**表单相关
	*/
	//获取一级服务类别下拉数据
	function GetParentClass($update){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_class';
		$prm->select ='ClassId,ClassName';
		$prm->where ='ParentClassId = 0';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			if($update->ClassId==$data['ClassId']){
				$str.='<option value='.$data['ClassId'].' selected>'.$data['ClassName'].'</option>';
			}else{
				$str.='<option value='.$data['ClassId'].'>'.$data['ClassName'].'</option>';
			}
			
		}
		
		unset($con);
		return $str;
	}
	//获取车务代办下拉数据
	function GetCarAgentClass(){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_class';
		$prm->select ='ClassId,ClassName';
		$prm->where ='ParentClassId = 2 AND IsFinal = 1';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			$str.='<option value='.$data['ClassId'].'>'.$data['ClassName'].'</option>';
		}
		
		unset($con);
		return $str;
	}
	//获取二级服务类别下拉数据
	function GetSecondClass($id,$sid){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_class';
		$prm->select ='ClassId,ClassName';
		$prm->where ='ParentClassId = '.$id.' AND IsFinal =1' ;
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			if($sid == $data['ClassId']){
				$str.='<input type="radio" class="ServiceId" name="ServiceId" value='.$data['ClassId'].' date-name='.$data['ClassName'].' checked>'.$data['ClassName'];
			}else{
				$str.='<input type="radio" class="ServiceId" name="ServiceId" value='.$data['ClassId'].' date-name='.$data['ClassName'].'>'.$data['ClassName'];
			}
		}
		
		unset($con);
		return $str;
	}
	//获取商城商品大类别
	function MallProductClass($update){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_class';
		$prm->select ='ClassId,ClassName';
		$prm->where ='ParentId = 0';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			if($update->ParentId==$data['ClassId']){
				$str.='<option value='.$data['ClassId'].' selected>'.$data['ClassName'].'</option>';
			}else{
				$str.='<option value='.$data['ClassId'].'>'.$data['ClassName'].'</option>';
			}
				
		}
		unset($con);
		return $str;
	}
	//获取商城二级服务类别下拉数据
	function MallProductSecondClass($id,$sid){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_mall_class';
		$prm->select ='ClassId,ClassName';
		$prm->where ='ParentId = '.$id.' AND IsFinal =1' ;
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='<option value="0">请选择</option>';
		while($data = mysql_fetch_assoc($res)){
			if($sid == $data['ClassId']){
				$str.='<option value='.$data['ClassId'].' selected>'.$data['ClassName'].'</option>';
			}else{
				$str.='<option value='.$data['ClassId'].'>'.$data['ClassName'].'</option>';
			}
		}
	    
		unset($con);
		return $str;
	}
	//获取参加活动的服务项目下拉数据
	function GetSellerService(){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->select ='Id,Title,ClassId,Price,CheapPrice,ServiceStartTime,ServiceEndTime';
		$prm->where ='SellerId = '.$_SELLER->SellerId.' And IsMarket =1';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			$str.='<option value='.$data['Id'].'>'.$data['Title'].'</option>';
		}
		
		unset($con);
		return $str;
	}
	//根据类别id转换类别名称
	function GetClassName($res,$field){
		global $con;
		$prm = (object)array();
		$prm->table = cl_mall_class;
		$prm->select = 'ClassName';
		$prm->where = 'ClassId='.$res[$field];
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res->ClassName;
	}
	
	//修改时查数据函数 
	function GetUpdateData($select,$table,$where){
		global $con;
		$prm = (object)array();
		$prm->table = $table;
		$prm->select = $select;
		$prm->where = $where;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res;
	}
	//修改商城商品查数据函数 
	function GetUpdateMallData($select,$table,$where,$other,$othertable,$otherwhere){
		global $con;
		$prm = (object)array();
		$prm->table = $table;
		$prm->select = $select;
		$prm->where = $where;
		$res = DbSelectOne($prm,$con);
		if(!empty($other)){
			$prm = (object)array();
			$prm->table = $othertable;
			$prm->select = $other;
			$prm->where = $otherwhere;
			$ress = DbSelectOne($prm,$con);
		}
		$res = (array)$res;
		$ress = (array)$ress;
		$a = array_merge($res,$ress);
		$a = (object)$a;
		unset($con);
		return $a;
	}
	//拼凑sql语句
	/**
	 * $array 需要拼凑的数据 一维数组  $extra 过滤的额外字段
	 */
	function glurSql($array,$extra = array(),$limit = 'AND')
	{
		$str = '';
		foreach($array as $k=>$v)
		{
			if(in_array($k,$extra))
			{
				continue;
			}
			$str .= $k.' = \''.$v.'\' '.$limit;
		}
		return substr($str,0,-strlen($limit));
	}
	//更新商家表的ServiceId字段
	
	function UpdateSellrtServiceId(){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = 'cl_service';
		$prm->select ='ServiceId';
		$prm->where ='SellerId = '.$_SELLER->SellerId.' And IsMarket =1';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		$data=array();
		$str='';
		while($data = mysql_fetch_assoc($res)){
			$str.=$data['ServiceId'].',';
		}
		$prm = (object)array();
		$prm->table = 'cl_seller';
		$prm->update = 'ServiceId="'.$str.'"';
		$prm->where = 'SellerId='.$_SELLER->SellerId;
		$prm->order = '';
		$prm->limit = '';
		$ret = dbUpdateOne($prm,$con);
		unset($con);
		return $ret;
	}
	/**
	 * 服务订单详情信息
	 */
	function ServiceOrderInfo($id){
		global $con;
		$prm = (object)array();
		$prm->table = cl_order;
		$prm->select = '*';
		$prm->where = 'Id='.$id;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res;
	}
	/**
	 * 商城发货信息
	 */
	function MallPostInfo($id){
		global $con;
		$prm = (object)array();
		$prm->table = cl_mall_order;
		$prm->select = '*';
		$prm->where = 'Id='.$id;
		$res = DbSelectOne($prm,$con);
		unset($con);
		return $res;
	}
	//发货商品小列表
	function MallPostList($id){
		global $con;
		$prm = (object)array();
		$prm->table = cl_mall_buy_log;
		$prm->select = '*';
		$prm->where = 'OrderId='.$id;
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		unset($con);
		return $res;
	}
	//快递公司列表
	function MallPostCompany(){
		global $con;
		$prm = (object)array();
		$prm->table = cl_post_company;
		$prm->select = '*';
		$prm->where = '';
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		unset($con);
		return $res;
	}
	//运费模板操作
	function MEMSellPostModels(){
		global $_SELLER;
		global $con;
		$prm = (object)array();
		$prm->table = cl_ratetemp;
		$prm->select = '*';
		$prm->where = 'SellerId ='.$_SELLER->SellerId;
		$prm->order = 'Id desc';
		$prm->limit = '';
		$ret = DbSelect($prm,$con);
		unset($con);
		return $ret;
		
	}
	//删除运费模板
	function MEMSellRateDel($id){
		global $con;
		$prm = (object)array();
		$prm->table = cl_ratetemp;
		$prm->where = 'Id ='.$id;
		$ret = DbDeleteOne($prm,$con);
		if($ret){
			    $prm = (object)array();
				$prm->table = cl_ratetempsub;
				$prm->select = '*';
				$prm->where = 'TempId='.$id;
				$prm->order = '';
				$prm->limit = '';
				$a = DbSelect($prm,$con);
				$res = array();
				while($r = mysql_fetch_assoc($a))
				{
					$res[] = $r['Id'];
				}
				$prm = (object)array();
				$prm->table = 'cl_ratetempsub';
				$prm->field = 'Id'; 
				$prm->where = $res;
				$ret = DbDelete($prm,$con);
				if($ret){
					return true;
				}
				else{
					return false;
				}
				
		}
		else{
			return false;
		}
		
		
	}
	function MEMSellPostModelsSmallTemp($res,$field){
		global $_SELLER;
		global $con;
		$prm = (object)array();
		$prm->table = cl_ratetempsub;
		$prm->select = '*';
		$prm->where = 'TempId = '.$res[$field];
		$prm->order = '';
		$prm->limit = '';
		$res = DbSelect($prm,$con);
		
		$data = array();
		while($r = mysql_fetch_assoc($res))
		{
			$data[] = $r;
		}
		 $stateaArr=array(
				'1'=>'快递',
				'2'=>'EMS',
				'3'=>'平邮',
				
				);
		foreach($data as $val){
			
		$p = str_replace('|',' ',$val['Province']);
		$str.="<tr>
    	
    	<td align='center'>".$stateaArr[$val['Type']]."</td>
    	<td align='center'>".$p."</td>
    	<td align='center'>".$val['FirstNum']."个</td>
		<td align='center'>".$val['FirstWeight']."</td>
		<td align='center'>".$val['FirstNum']."个</td>
		<td align='center'>".$val['AddWeight']."</td>
    	
    	</tr>";
		
			
		}
		return $str;
	
    }
	/**
	 * 获取ip地址
	 */
	function GetIp()
	{
		if (getenv("HTTP_CLIENT_IP")){
			$ip = getenv("HTTP_CLIENT_IP");
		}else if(getenv("HTTP_X_FORWARDED_FOR")){
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}else{
			$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}
	//发货成功给微信传消息
	function https_request($url,$data = null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
    }
	/*
	* 充值记录
	*/
	//统计数量
	//统计列表总数
	function ChargeRecordCount($table,$where,$field){
		global $con;
		global $_SELLER;
		$prm = (object)array();
		$prm->table = $table;
		$prm->type = 1; 
		$prm->field = $field; 
		$prm->where = $where;
		$prm->limit = '';
		$ret = dbSelectCount($prm,$con);
		return $ret;
	}
	//查询充值记录列表数据
	function ChargeRecordList($s,$w){
		global $con;
		global $limit;
		global $sqlSearch;
		if($s ==''&&$w ==''){
			$prm = (object)array();
			$prm->table = 'cl_oil_order';
			$prm->select = '*';
			$prm->where = '1 '.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$prm->order='';
			$res = DbSelect($prm,$con);
			if($res){
				unset($con);
				return $res;
			}
		}else{
			$prm = (object)array();
			$prm->table = 'cl_oil_order';
			$prm->select = '*';
			$prm->where = 'OilPayState = '.$s.' AND OrderState='.$w.$sqlSearch;
			$prm->limit = $limit.','.PAGE;
			$prm->order='';
			$res = DbSelect($prm,$con);
			
			if($res){
				unset($con);
				return $res;
			}
		}
	}
	//充值状态
	function ChargeState($res,$field){
		global $con;
		$prm = (object)array();
		$prm->table = 'cl_oil_order';
		$prm->select = 'OilPayState,OrderState,Id';
		$prm->where = 'Id='.$res[$field];
		$res = DbSelectOne($prm,$con);
		if($res->OilPayState==1&&$res->OrderState==2){
			return '充值中';
		}else if($res->OilPayState==3){
			return '充值成功';
		}else if($res->OilPayState==2&&$res->OrderState==4){
			return '已退款';
		}else if($res->OilPayState==2&&$res->OrderState==5){
			return '失败退款中';
		}else if($res->OilPayState==0){
			return '未支付';
		}else if($res->OilPayState==0&&$res->OrderState==3){
			return '支付失败';
		}
		
	}
	
	