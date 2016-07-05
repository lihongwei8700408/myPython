<?php
     global $con;
     $prm = (object)array();
	 $prm->table = 'cl_mall_class';
	 $prm->select = 'ClassId,ClassName';
	 $prm->where ='ParentId = 0';	
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
						'field'=>'ParentId',
						'html'=>'style="width:100px"',
						'data'=>$res,
				),
				
				'title'=>array(
						'name'=>'商品名称：',
						'type'=>'like',  //下拉  带有data数据
						'field'=>'Title',
						'html'=>'style="width:100px"',
							
				),
				
				
		);
		
		//另一部分每个控制器中独有的配置
		$optionSearch = array(
		
				
				
				
// 				
				
		);

?>