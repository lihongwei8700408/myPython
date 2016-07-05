<?php
     
	//一部分公用的配置
		$comm_optionSearch = array(
				
				'titlename'=>array(
						'name'=>'会员名称：',
						'type'=>'like',  //下拉  带有data数据
						'field'=>'MemberName',
						'html'=>'style="width:150px"',
							
				),
				'titletel'=>array(
						'name'=>'手机号码：',
						'type'=>'like',  //下拉  带有data数据
						'field'=>'Tel',
						'html'=>'style="width:150px"',
							
				),
				
				
		);
		
		//另一部分每个控制器中独有的配置
		$optionSearch = array(
		
				
		);

?>