<?php
	/**
	 * FUN dbConnect
	 * EFF 数据库链接
	 * PRM  object
	 * PRM  host    string      主机地址
	 * PRM  user	string      用户名
	 * PRM	pw		string		密码
	 * PRM	code	string		编码
	 * PRM	base	string		数据库
	 * RET  资源链接句柄
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $p = (object)array();
	 $p->pw = '123456';
	 $p->host = '127.0.0.1';
	 $p->user = 'root';
	 $p->code = 'utf8';
	 $p->base = 'flh';
	 $con = dbConnect($p);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbConnect($prm)
	{
		$conn = @mysql_connect($prm->host,$prm->user,$prm->pw);
		if(!$conn) 
			return 0;
		if(isset($prm->code))
			mysql_query('SET NAMES '.$prm->code);
		if(!isset($prm->base)) 
			return 0;
		mysql_select_db($prm->base,$conn);
		
		return $conn;
	}
	/**
	 * FUN dbInsert
	 * EFF 多条增加   在一个表中插入多条不同的数据。
	 * PRM    insert    array     添加数据
	 * PRM    table	    string    表名
	 * PRM	  $conn     resource  资源链接句柄 
	 * RET  受影响的行数，返回插入数据的条数
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->select = 'sum(dbid)';
	 $prm->insert = array(
					array(
							'user'=>'法国会飞的格式的',
							'pw'=>'',
							'name'=>'14',
						),
					array(
							'user'=>'',
							'pw'=>'',
							'name'=>'14',
						)
					);
				
	 dbInsert($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
		
	function dbInsert($prm,$conn)
	{
		if(!isset($prm->insert[0]) || !is_array($prm->insert[0])) return 0;
		//获取表字段
		$insField = '';
		$insValues = '';
		$flag = true;
		foreach($prm->insert as $v)
		{
			$v = array_change_key_case($v); //转换为小写
			$tmp = '';
			foreach($v as $sk=>$sv)
			{
				if($flag)
					$insField .= '`'.$sk.'`,';
				$tmp .= '\''.injectCheck($sv).'\',';            //防sql注入
			}
			$flag = false;
			$insValues .= '('.substr($tmp,0,-1).'),';
		}
		
		if(empty($insField))
			return 0;
		$sql = 'INSERT INTO '.$prm->table.' ('.substr($insField,0,-1).') VALUES '.substr($insValues,0,-1);
		
		if(mysql_query($sql,$conn)) 
			//return mysql_insert_id();
			return mysql_affected_rows();//返回受影响的行数
		return 0;
	}
	
	/**
	 * FUN dbInsertOne
	 * EFF 单条增加   在表中插入一条数据。添加数据是一个数组。如：在db表中插入user，pw，name三个字段的值。
	 * PRM insert     array     添加数据
	 * PRM table	  string	表名	
	 * RET 成功返回 最新插入的主键id
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->insert = array(
							'user'=>'fdgfdshj',
							'pw'=>'1454685nbdfd',
							'name'=>'16',
						);
	　$prm->base　＝　'';
	 dbInsertOne($prm,$con);
	
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbInsertOne($prm,$conn)
	{
		if(!isset($prm->insert) || !is_array($prm->insert)) return 0;
		$prm->insert = array_change_key_case($prm->insert); //转换为小写
		$prm->base = isset($prm->base) ? $prm->base : DB_BASE;
		//获取表字段
		//return 'select COLUMN_NAME as field from information_schema.columns where table_schema="'.$prm->base.'" AND table_name="'.$prm->table.'"';
		$fields = mysql_query('select COLUMN_NAME as field from information_schema.columns where table_schema="'.$prm->base.'" AND table_name="'.$prm->table.'"');
		$insField = '';
		$insValues = '';
		while($res = mysql_fetch_assoc($fields))
		{
			$tmp = strtolower($res['field']);
			
			if(array_key_exists($tmp,$prm->insert))
			{
				$insField .= '`'.$tmp.'`,';
				//$insValues .= '"'.$prm->insert[$tmp].'",';
				$insValues .= '\''.injectCheck($prm->insert[$tmp]).'\',';
			}
		}
		if(empty($insField))
			return 0;
		$sql = 'INSERT INTO '.$prm->table.' ('.substr($insField,0,-1).') VALUES ('.substr($insValues,0,-1).')';
	//	echo $sql;
// 		var_dump($conn);
// 		echo 111111;
// 		Quit();

		if(mysql_query($sql,$conn)) {
			$a = mysql_insert_id($conn);
			return $a;
		}else{
			return 0;
			
		}
		
	}
	
	/**
	 * FUN dbDelete
	 * EFF 批量删除  可删除表中的多条数据，删除条件是一个数组，如：删除db表中id=3和id=5的数据。
	 * PRM    field    string    字段名
	 * PRM    where	   array     条件
	 * PRM	  table	   string	 表名   
	 * PRM	  $conn    resource  资源链接句柄
	 * RET  成功返回true
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->field = 'id'; 
	 $prm->where = array(3,5);
	 dbDelete($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbDelete($prm,$conn)
	{
		if(!$prm->where)
		{
			return 0;
		}
		if(isset($prm->field) && isset($prm->where) && is_array($prm->where))
		{
			$prm->where = ' 1 AND '.$prm->field.' IN ('.implode(',',$prm->where).')';
		}
		 $sql = 'DELETE FROM '.$prm->table.' WHERE '.$prm->where;
	
		return mysql_query($sql,$conn);
	}
	
	/**
	 * FUN dbDeleteOne
	 * EFF  单次删除数据  删除表中符合条件的数据行。如：删除db表中pw为空的数据
	 * PRM   table    string    表名
	 * PRM   where	  string    条件
	 * PRM	 $conn    resource  资源链接句柄
	 * RET  成功返回true。
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->where = 'pw=""';
	 $a = dbDeleteOne($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbDeleteOne($prm,$conn)
	{
		if(strpbrk ($prm->where, '=><!') === false)
		{
			return 0;
		}
		 $sql = 'DELETE FROM '.$prm->table.' WHERE '.$prm->where;
		return mysql_query($sql,$conn);
	}
	
	/**
	 * FUN     dbUpdateByRelation
	 * EFF     根据表关系更新数据，从一个表中满足该条件的数据去更新另一个表中满足条件的数据（字段名可不同）。
			   
	 * PRM     from         string    来源表
	 * PRM     to	        string    目的表
	 * PRM	   fields	    string    字段名  待更新字段=来源字段 例如: field1=field2 更新to表中field1的值为from表中field2的值
	 * PRM     fromwhere    string    来源表条件
	 * PRM     towhere      string    目的表条件
	 * PRM	   $conn        resource  资源链接句柄
	 * RET     成功返回1，失败返回0,如更新的数据和条件完全一样就会返回0
	 * *********************************************************************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	
	 $prm->from = 'db';
	 $prm->to = 'db123';
	 //$prm->fields = 'user = pw';
	 $prm->fields = 'user = pw';
	 $prm->fromWhere = 'id=2';
	 $prm->toWhere = 'pw = "ghghjgh"';
	 $a = dbUpdateByRelation($prm,$conn);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	*/
	function dbUpdateByRelation($prm,$conn)
	{
		$keys = '*';
		$toIns = $prm->to.'.'.str_replace('= ','= t.',$prm->fields);
		$toIns = str_replace(',',' ,'.$prm->to.'.',$toIns);
		
		$prm->toWhere = $prm->to.'.'.str_replace('AND',' AND '.$prm->to.'.',$prm->toWhere);
		$prm->fromWhere = $prm->from.'.'.str_replace('AND',' AND '.$prm->from.'.',$prm->fromWhere);
		$sql = 'UPDATE '.$prm->to.',(SELECT '.$keys.' FROM '.$prm->from.' WHERE '.$prm->fromWhere.') as t SET '.$toIns.' WHERE '.$prm->toWhere;
		
// 		var_dump($sql);
		if(mysql_query($sql,$conn)) 
			return mysql_affected_rows($conn);
		return 0;
		
		
		
	}
	
	/**
	 * FUN dbUpdate
	 * EFF 批量更新，更新一个表中满足条件的数据。
	 * PRM     update     string    更新
	 * PRM     field	  array     字段名
	 * PRM	   where	  string    条件
	 * PRM	   table	  string	表名	
	 * PRM	   $conn      Resource  资源链接句柄
	 * RET  成功返回true,失败返回false
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'star';
	 $prm->update = 'name="hg"';
	 $prm->where = array(5,6);
	 $prm->field = 'postid';
	 $a = dbUpdate($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbUpdate($prm,$conn)
	{
		$sql ='UPDATE ';
		!isset($prm->update) ? $prm->update = ' '  : '';
		if(isset($prm->field) && isset($prm->where) && is_array($prm->where))
		{
			$prm->where = ' 1 AND '.$prm->field.' IN ('.implode(',',$prm->where).')';
		}
		
		$sql .= $prm->table.' SET '.$prm->update;
		$sql .= ' WHERE '.$prm->where;
		return mysql_query($sql,$conn);
	}
	//李红薇2015-10-19批量更新
	function dbUpdates($prm,$conn)
	{
		$sql ='UPDATE ';
		!isset($prm->update) ? $prm->update = ' '  : '';
		if(isset($prm->where))
		{
			$prm->where = $prm->where;
		}
		
		$sql .= $prm->table.' SET '.$prm->update;
		$sql .= ' WHERE '.$prm->where;
		echo $sql;
		return mysql_query($sql,$conn);
	}
	
	/**
	 * FUN dbUpdateOne
	 * EFF 普通更新，更新表中的数据
	 * PRM      update   string    更新
	 * PRM	    where	 string    条件
	 * PRM		order	 string	   排序
	 * PRM		table	 string	   表名
	 * PRM      limit    string    范围（默认为空）
	 * PRM		$conn    resource  资源链接句柄
	 * RET  成功为true，失败为false
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->update = 'name="30"';
	 $prm->where = 'id=2';
     $prm->order = 'desc';	
	 $prm->limit = '';
	 dbUpdateOne($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbUpdateOne($prm,$conn)
	{
		$sql ='UPDATE ';
		!isset($prm->update) ? $prm->update = ' '  : '';						
		!isset($prm->where) ? $prm->where = ' 1 ' : empty($prm->where) ? $prm->where = '1' : $prm->where = ' 1 AND '.$prm->where;
		
		isset($prm->order) && $prm->order ? $prm->order = ' ORDER BY '.$prm->order : $prm->order = '';
		isset($prm->limit) && $prm->limit ? $prm->limit = ' LIMIT '.$prm->limit : $prm->limit = '';
		$sql .= $prm->table.' SET '.$prm->update;
		$sql .= ' WHERE '.$prm->where.' '.$prm->order.' '.$prm->limit;
 		//echo $sql;
		return mysql_query($sql,$conn);
	}
	
	
	
	
	/**
	 * FUN dbNewUpdateOne
	 * EFF 高级更新，更新表中的数据
	 * PRM      update   array    更新
	 * PRM	    where	 string    条件
	 * PRM		order	 string	   排序
	 * PRM		table	 string	   表名
	 * PRM      limit    string    范围（默认为空）
	 * PRM		$conn    resource  资源链接句柄
	 * RET  成功为true，失败为 0
	 * *********************************************
	 * time	2015-1-22
	 * who	李笑沙
	 +++++++++++++++++++++++++++++++++++++++++++++++
	$prm = ( object ) array ();
	$prm->table = 'fl_api';
	$prm->update = array (
			'name' => "Android",
			'count' => 18,
			'mm' => 12 
	);
	$prm->where = 'id=2';

	dbNewUpdateOne ( $prm, $con );
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
function dbNewUpdateOne($prm, $con) {

	$sql = 'UPDATE ';
	// 获取表字段
	$fieldss = mysql_query ( 'select COLUMN_NAME as field from information_schema.columns where table_name="' . $prm->table . '"' );	
// 	var_dump($fieldss);
	$insField = '';	
	while ( $res = mysql_fetch_assoc ( $fieldss ) ) {
		
// 		$tmp = strtolower ( $res ['field'] );
// 		var_dump($tmp);
		
// 		echo '***************';
// 		var_dump($prm->update);
		if (array_key_exists ( $res ['field'] , $prm->update )) {
			//$insField .= '`' . $res ['field']  . '`="' . $prm->update [$res ['field']] . '",';
			$insField .= '`' . $res ['field']  . "`='" . $prm->update [$res ['field']] . "',";
		
		}
	}
// 	echo '---------------------------------';
// 	var_dump($insField);
	if (empty ( $insField ))
		return 0;
	
	isset ( $prm->order ) && $prm->order ? $prm->order = ' ORDER BY ' . $prm->order : $prm->order = '';
	isset ( $prm->limit ) && $prm->limit ? $prm->limit = ' LIMIT ' . $prm->limit : $prm->limit = '';
	$sql .= $prm->table . ' SET ' . (substr ( $insField, 0, - 1 ));
	
	$sql .= ' WHERE ' . $prm->where. ' ' . $prm->order . ' ' . $prm->limit;
	//var_dump($sql);
	return mysql_query ( $sql, $con );
}
	
	
	
	
	
	
	
	
	
	/**
	 * FUN dbSelectOne
	 * EFF 单次查询，根据条件查询表中的数据，如：查询db表中user="ghghjgh"的数据。
	 *  PRM   select   string    返回字段
	 *  PRM   table    string    表名
	 *	PRM   where	   string    条件
	 *	PRM   order	   string	 排序
	 *	PRM   group	   string	 分组
	 *	PRM	  $conn    resource  资源链接句柄 
	 * RET  单次查询结果,创建单次查询表结构
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 
    $prm = (object)array();
	$prm->table = 'db';
	$prm->select = '*';
	$prm->where = 'user="ghghjgh"';
	$prm->order = '';	
	dbSelectOne($prm,$con);
	
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbSelectOne($prm,$conn)
	{
		$sql ='SELECT ';
		!isset($prm->select) ? $prm->select = '*' : empty($prm->select) ? $prm->select = '*' : '';
		!isset($prm->where) ? $prm->where = ' 1 ' : empty($prm->where) ? $prm->where = '1' : $prm->where = ' 1 AND '.$prm->where;
		isset($prm->order) && $prm->order ? $prm->order = ' ORDER BY '.$prm->order : $prm->order = '';
		isset($prm->group) && $prm->group ? $prm->group = ' GROUP BY '.$prm->group : $prm->group = '';
		//isset($prm->limit) ? $prm->limit = ' LIMIT '.$prm->limit : $prm->limit = '';
		$sql .= $prm->select.' FROM '.$prm->table;
		$sql .= ' WHERE '.$prm->where.' '.$prm->group.' '.$prm->order.' LIMIT 1';
		
//		echo $sql;
		$ret = mysql_query($sql,$conn);
		
		//var_dump($prm);
		if(is_resource($ret) && $ret = mysql_fetch_assoc($ret))
		{
			return (object)$ret;
		}
		return 0;
	}
	
	/**
	 * FUN dbSelectCount
	 * EFF 数量统计，查询表中符合条件的数量和数据总和
	 * PRM    field    string    字段名(只能是整型才能求总和)
	 * PRM    where	   string    条件
	 * PRM    table	   string    表名
	 * PRM	  limit	   string	 范围
	 * PRM	  type	   string	 类型(1代表查询符合条件的数量，2代表查询出来的数据总和)
	 * PRM	  $conn    resource  资源链接句柄
	 * RET  type=1时返回数量，type=2时返回总和。
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->type = 2; 
	 $prm->field = 'name'; 
	 $prm->where = 'id>8';
	 $prm->limit = '';
	 dbSelectCount($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbSelectCount($prm,$conn)
	{
		!isset($prm->field) ? $prm->field = '*' : empty($prm->field) ? $prm->field = '*' : '';
		!isset($prm->where) ? $prm->where = ' 1 ' : empty($prm->where) ? $prm->where = '1' : $prm->where = ' 1 AND '.$prm->where;
		//isset($prm->limit) && $prm->limit ? $prm->limit = (' LIMIT '.$prm->limit ): $prm->limit = '';
		!isset($prm->type) ? $prm->type = 1 : '';
		
		switch($prm->type)
		{
			case 2:
				$prm->type = 'SUM(';
			break;
			case 1:
				$prm->type = 'COUNT(';
		}
		$sql = 'SELECT '.$prm->type.$prm->field.') as total FROM '.$prm->table;
		//$sql .= ' WHERE '.$prm->where.' '.$prm->limit;
		$sql .= ' WHERE '.$prm->where;
		//echo $sql;
		if($res = @mysql_fetch_assoc(mysql_query($sql,$conn)))
		{
			return intval($res['total']);
		}
		
		return false;
	}
	
	
	/**
	 * FUN dbSelect
	 * EFF 多次查询，查询表中多条不同数据，如数据过多，可用limit取查看数据范围
	 * PRM    select   string      查询表
	 * PRM    where	   string      条件
	 * PRM    table	   string      表名
	 * PRM	  order	   string	   排序
	 * PRM	  group	   string	   分组
	 * PRM    limit    string      范围
	 * PRM	  $conn    resource    资源链接句柄
	 * RET  符合条件的具体数据
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->table = 'db';
	 $prm->select = '*';
	 $prm->where ='1';
	 //$prm->order = 'AdId desc';	
	 $prm->limit = '';
	 $a = dbSelect($prm,$con);
	 
	 $res = array();
	 while($r = mysql_fetch_assoc($a))
	 {
		$res[] = $r;
	 }
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbSelect($prm,$conn)
	{
		$sql ='SELECT ';
		!isset($prm->select) ? $prm->select = '*' : empty($prm->select) ? $prm->select = '*' : '';
		!isset($prm->where) ? $prm->where = ' 1 ' : empty($prm->where) ? $prm->where = '1' : $prm->where = ' 1 AND '.$prm->where;
		isset($prm->order) && $prm->order ? $prm->order = ' ORDER BY '.$prm->order : $prm->order = '';
		isset($prm->group) && $prm->group ? $prm->group = ' GROUP BY '.$prm->group : $prm->group = '';
		isset($prm->limit) && $prm->limit ? $prm->limit = ' LIMIT '.$prm->limit : $prm->limit = '';
		$sql .= $prm->select.' FROM '.$prm->table;
		$sql .= ' WHERE '.$prm->where.' '.$prm->group.' '.$prm->order.' '.$prm->limit;
		// echo $sql;//exit;
		// echo '<br/>';
		if(isset($prm->list))
		{
			echo $sql.'<br />';
		}
		
		return mysql_query($sql,$conn);            
	}
	
	/**
	 * FUN  dbCopyData
	 * EFF  不同表结构数据复制(注：需要主键)
	 * PRM  $prm      object
	 * PRM	from      string    来源表
	 * PRM  to	      string    目的表 
	 * PRM  fields	  string    来源表，目标表字段替换映射  to=from, 
	 * PRM  where	  string    来源表替换数据查找条件 
	 *    
	 * PRM	 $conn    resource  资源链接句柄 
	 * RET   最后一次插入的(主键)值
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->from = 'member';
	 $prm->to = 'db369';
	 $prm->fields = 'user = adress';
	 $prm->where = 'id = 5';
				
	 dbCopyData($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbCopyData($prm,$conn)
	{
		$fieldsArr = explode(',', $prm->fields);

		$fromIns = '';
		$toIns = '';
		foreach ($fieldsArr as $k => $v) {
			@list($to,$from) = explode('=',str_replace(' ', '', $v));
			$fromIns .= $from.',';
			$toIns .= $to.',';
		}
		$fromIns = substr($fromIns,0,-1);
		$toIns = substr($toIns,0,-1);
		
		!isset($prm->where) ? $prm->where = ' 1 ' : empty($prm->where) ? $prm->where = '1' : $prm->where = ' 1 AND '.$prm->where;
		
		$sql = 'INSERT INTO '.$prm->to.' ('.$toIns.') SELECT '.$fromIns.' FROM '.$prm->from.' WHERE '.$prm->where;
		
		if(mysql_query($sql,$conn))
			return mysql_insert_id($conn);
		return 0;
	}
	
	/**
	 * FUN dbCopyDataOne
	 * EFF 相同表结构复制 复制相同表结构的数据，如：复制db表中的现有数据到star表(注：需要主键)
	 * PRM   from     string    来源表
	 * PRM   to	      string    目的表
	 * PRM	 extra	  array     过滤不需要的字段
	 * PRM	 $conn    resource  资源链接句柄 
	 * RET   最后一次插入的(主键)值
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 $prm = (object)array();
	 $prm->from = 'db';
	 $prm->to = 'db369';
	 $prm->where = 'id = 6';
	 $prm->extra =  'id';
	 $prm->base = DB_BASE;
	 dbCopyDataOne($prm,$con);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbCopyDataOne($prm,$conn)
	{
		$fromField = mysql_query('select COLUMN_NAME as field from information_schema.columns where table_schema="'.$prm->base.'" AND table_name="'.$prm->from.'"',$conn);
		$toField = mysql_query('select COLUMN_NAME as field from information_schema.columns where table_schema="'.$prm->base.'" AND table_name="'.$prm->to.'"',$conn);
		
		if(isset($prm->extra))
		{
			!is_array($prm->extra) ? $prm->extra = explode(',',$prm->extra) : '';
		}
		
		$field = array();
		while($res = mysql_fetch_assoc($fromField))
		{
			$tmp = strtolower($res['field']);
			if(!in_array($tmp,$prm->extra)) //过滤不需要的字段
				$field[] = $tmp;
		}
		$fromIns = '';
		$toIns = '';
		while($res = mysql_fetch_assoc($toField))
		{
			$tmp = strtolower($res['field']);
			if(in_array($tmp,$field))
			{
				$toIns .= '`'.$tmp.'`,';
			}
		}
		$toIns = substr($toIns,0,-1);
		!isset($prm->where) ? $prm->where = ' 1 ' : empty($prm->where) ? $prm->where = '1' : $prm->where = ' 1 AND '.$prm->where;
		
		$sql = 'INSERT INTO '.$prm->to.' ('.$toIns.') SELECT '.$toIns.' FROM '.$prm->from.' WHERE '.$prm->where;
		
		//echo $sql;
		if(mysql_query($sql,$conn))
			return mysql_insert_id($conn);
		return 0;
	}
	
	/**
	 * FUN dbClose
	 * EFF 句柄关闭
	 * PRM $conn    resource  资源链接句柄		
	 * RET 资源关闭句柄
	 * *********************************************
	 * time	2014-11-4
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 dbClose($conn);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function dbClose($conn)
	{
		return mysql_close($conn);
	}
	
	/**
	 * 变相停止数据库
	 */
	function Quit()
	{
		global $con;
		dbClose($con);
		exit();
	}
	
	/**
	 * 过滤sql危险字符 防注入
	 */
	function injectCheck($sql_str){
		if(!is_string($sql_str))
		{
			return $sql_str;
		} 
		$toArray = array(
			'select'=>'','insert'=>'',' and '=>'',' or '=>'','update'=>'','delete'=>'',
			'\''=>'"','\/\*'=>'','\*'=>'','\.\.\/'=>'',
			'\.\/'=>'','union'=>'','into'=>'','load_file'=>'','outfile'=>'',
		);
	    return strtr($sql_str,$toArray);
	} 
	
	/**
		
	*/
	function DropInjectChar($sql_str)
	{
		if(!is_string($sql_str))
		{
			return $sql_str;
		}
		$toArray = array(
			':'=>'',';'=>'',' .'=>'','\\'=>'','union'=>'','into'=>'','load_file'=>'','outfile'=>'','delete'=>''
		);
	    return strtr($sql_str,$toArray);
	}