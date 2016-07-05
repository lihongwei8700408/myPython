<?php
    
	
	//一部分公用的配置
		$comm_optionSearch = array(
			'obegin'=>array(
						'name'=>'成交时间：',
						'field'=>'AddTime > ',
						'type'=>'time',
						'html'=>'',
						),
			'oend'=>array(
						'name'=>'-',
						'field'=>'AddTime < ',
						'type'=>'time',
						'html'=>'',
						),		
				
		);
		
		//另一部分每个控制器中独有的配置
		$optionSearch = array(
		
				'state'=>array(
						'name'=>'状态：',
						'type'=>'select',  //下拉  带有data数据
						'field'=>'State',
						'html'=>'style="width:100px"',
						'data'=>array(
		                        ''=>'请选择',
								'1'=>'待付款',
								'2'=>'待发货',
								'4'=>'待评价',
								'5'=>'已完成',
								'6'=>'已关闭',
								
								
								
						),
				), 
				
// 				
				
		);

?>