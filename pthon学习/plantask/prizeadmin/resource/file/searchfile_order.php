<?php
	global $con;
    $prm = (object)array();
	$prm->table = 'cl_prize';
	$prm->select = 'Id,Name';
	$prm->where ='Id!=10';	
	$a = dbSelect($prm,$con);
	$res = array();
	$res['']='请选择';
	while($r = mysql_fetch_assoc($a))
	{
	$res[$r['Id']] = $r['Name'];
	}
	
	//一部分公用的配置
		$comm_optionSearch = array(
			'obegin'=>array(
						'name'=>'时间：',
						'field'=>'Time > ',
						'type'=>'time',
						'html'=>'',
						),
			'oend'=>array(
						'name'=>'-',
						'field'=>'Time < ',
						'type'=>'time',
						'html'=>'',
						),	
			'title'=>array(
						'name'=>'奖品名称',
						'field'=>'Type',
						'type'=>'select',
						'html'=>'style="width:120px"',
						'data'=>$res
						
						
					),	
				
		);
		
		//另一部分每个控制器中独有的配置
		$optionSearch = array(
		
				/* 'state'=>array(
						'name'=>'状态：',
						'type'=>'select',  //下拉  带有data数据
						'field'=>'State',
						'html'=>'style="width:80px"',
						'data'=>array(
		                        ''=>'请选择',
								'0'=>'待发货',
								'1'=>'已发货',
						
						),
				),  */
				
// 				
				
		);

?>