<?php 
	$url = WEB_SHOPADMIN.'/index.php?c=';
	if(isset($_GET['c'])&&$_GET['c']=='prize'){
		$option = array(
					array(
							'name'=>'全部奖品',     //连接名称
							'url'=>'prize', //控制器
					),
					array(
							'name'=>'实物奖品',     //连接名称
							'url'=>'prize&other=real', //控制器
					),
					array(
							'name'=>'虚拟奖品',     //连接名称
							'url'=>'prize&other=virtual', //控制器
					),

		);
		
	}else if(isset($_GET['c'])&&$_GET['c']=='prizerecord'){
		$option = array(
				    array(
							'name'=>'全部获奖记录',     //连接名称
							'url'=>'prizerecord', //控制器
					),
					array(
							'name'=>'待发货记录',     //连接名称
							'url'=>'prizerecord&other=nopost', //控制器
					),
					array(
							'name'=>'已发货记录',     //连接名称
							'url'=>'prizerecord&other=alreadypost', //控制器
					),
		
		);
		
	}else{
		$option = array(
				
					array(
							'name'=>'快捷菜单',     //连接名称
							'url'=>'', //控制器
					),
					array(
							'name'=>'奖品管理',     //连接名称
							'url'=>'prize', //控制器
					),
					array(
							'name'=>'待发奖品',     //连接名称
							'url'=>'prizerecord&other=nopost', //控制器
					),
					array(
							'name'=>'查看验证码',     //连接名称
							'url'=>'code', //控制器
								),
					array(
							'name'=>'查看充值记录',     //连接名称
							'url'=>'chargerecord', //控制器
								),
					array(
							'name'=>'修改密码',     //连接名称
							'url'=>'userpass', //控制器
								),
					array(
							'name'=>'意见反馈',     //连接名称
							'url'=>'aboutus', //控制器
								),
		
			);
			
		
	}





?>


                <?php
						
							echo '<ul>';
							//尽情的输出吧
							
							foreach($option as $v){
								if(!isset($_GET['other'])){
									$u = $_GET['c'];
								}else{
									$u = $_GET['c'].'&other='.$_GET['other'];
								}
							     if($u==$v['url']){
							
								   echo ' <li class="selected"> <a href="'.$url.$v['url'].'">'.$v['name'].'</a></li>';
								}else{
									
                                  echo ' <li class="subCatalogList"> <a href="'.$url.$v['url'].'">'.$v['name'].'</a></li>';
								}

								
							}
							echo '</ul>';
						
					?>
            