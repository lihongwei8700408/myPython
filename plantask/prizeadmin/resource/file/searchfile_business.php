<?php
     global $con;
     $prm = (object)array();
	 $prm->table = 'cl_class';
	 $prm->select = 'ClassId,ClassName';
	 $prm->where ='ParentClassId = 0';	
	 $a = dbSelect($prm,$con);
	 $res = array();
	 $res['']='请选择';
	 while($r = mysql_fetch_assoc($a))
	 {
		$res[$r['ClassId']] = $r['ClassName'];
	 }
	 
	//一部分公用的配置
		$comm_optionSearch = array(
				'classid'=>array(
						'name'=>'类别：',
						'type'=>'select',  //下拉  带有data数据
						'field'=>'ClassId',
						'html'=>'style="width:100px"',
						'data'=>$res,
				),
				
				'title'=>array(
						'name'=>'服务名称：',
						'type'=>'like',  //下拉  带有data数据
						'field'=>'Title',
						'html'=>'style="width:100px"',
							
				),
				
				
		);
		
		//另一部分每个控制器中独有的配置
		$optionSearch = array(
		
				'state'=>array(
						'name'=>'状态：',
						'type'=>'select',  //下拉  带有data数据
						'field'=>'Checked',
						'html'=>'style="width:100px"',
						'data'=>array(
		                        ''=>'请选择',
								'2'=>'已上架',
								'3'=>'已下架',
								'1'=>'未上架',
								
								
								
						),
				), 
				
// 				
				
		);

?>