<?php
    
	
	//一部分公用的配置
		$comm_optionSearch = array(
			'obegin'=>array(
						'name'=>'时间：',
						'field'=>'CreatTime > ',
						'type'=>'time',
						'html'=>'',
						),
			'oend'=>array(
						'name'=>'-',
						'field'=>'CreatTime < ',
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
								'1'=>'未读',
								'2'=>'已读',
								
								
								
						),
				), 
				
// 				
				
		);

?>