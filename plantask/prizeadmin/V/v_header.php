<?php
	if((!isset($_SESSION['UserId'])) || ($_SESSION['UserId'] == '')){	
	       
		header('Location:'.WEB_SHOPADMIN.'/index.php?c=login');
		exit;
		   
			
					
	}
	
	

?>
<style>
.nav_left li a:hover{color:#FFF;}
.nav_right a:hover{color:#FFF;}
.top h1{float: left;padding: 15px 0 0 3px;}
</style>
    <div class="top_wrap">
		<div class="top">
			<h1><img src="<?php echo STATIC_DOMAIN?>/images/logo2.png" alt=""></h1>
			<p>服务热线：0791-961111</p>
		</div>
	</div>

	<div class="nav_wrap">
		<div class="nav">
			<ul class="nav_left">
				<li <?php if(!isset($_GET['c'])) echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN;?>">首页</a></li>
				<li <?php  if($_GET['c']=='prize') echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prize';?>">奖品管理</a></li>
				<li <?php  if($_GET['c']=='prizerecord') echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord';?>">获奖记录</a></li>
				<!--<li <?php  if($_GET['other']=='nopost') echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=nopost';?>">待发货奖品</a></li>-->
				<li <?php  if(isset($_GET['c'])&&strstr($_GET['c'],'chargerecord')) echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=chargerecord';?>">查看充值记录</a></li>
				<li <?php  if(strstr($_GET['c'],'code')) echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=code';?>">查看验证码</a></li>
				<li <?php  if(strstr($_GET['c'],'about')) echo 'class="current"';else echo '';?>><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=aboutus';?>">意见反馈</a></li>
			</ul>
			<div class="nav_right">
				
				  <span class="spanImg"><img  src="<?php echo STATIC_DOMAIN?>/images/avatar.png"></span>
				   <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=user';?>"><span class="spanName"><?php echo $_USER->UserName;?></span></a>
				   <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=logout';?>">	<span class="spanName">退出</span></a>
				
			</div>
		</div>
	</div>