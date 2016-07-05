<?php
   
	//一部分公用的配置
		$comm_optionSearch = array(
			'obegin'=>array(
						'name'=>'时间：',
						'field'=>'LastTime > ',
						'type'=>'time',
						'html'=>'',
						),
			'oend'=>array(
						'name'=>'-',
						'field'=>'LastTime < ',
						'type'=>'time',
						'html'=>'',
						),
			'card'=>array(
						'name'=>'油卡号',
						'field'=>'OilCard',
						'type'=>'like',
						'html'=>'style="width:120px"',
						
					),
			/* 'tel'=>array(
						'name'=>'手机',
						'field'=>'Tel',
						'type'=>'like',
						'html'=>'style="width:120px"',
						
					), */
		);
		
		//另一部分每个控制器中独有的配置
		$optionSearch = array(
		
				
				
		);

?>