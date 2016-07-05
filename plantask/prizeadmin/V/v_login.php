
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车联微信商家管理平台登录</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/loginPage.css">
    <script src="<?php echo STATIC_DOMAIN?>/js/jquery-1.7.2.min.js"></script>
    <script src="<?php echo STATIC_DOMAIN?>/js/validate.js"></script>
</head>
<body>
	<div class="logo_wrap">
		<h1><img src="<?php echo STATIC_DOMAIN?>/images/logo.png" height="65" width="106" alt=""></h1>
		<p class="logoName">车联全国汽车信息服务平台</p>
	</div>
	<div class="login_outline">
	 <form action="<?php echo WEB_SHOPADMIN.'/index.php?c=login';?>" enctype="multipart/form-data" onsubmit="return onpost()" id="registerform" name="register" autocomplete="off" method="post">
		<h2>商家登录页</h2>
		<div class="login_wrap">
			<div class="loginNum">
				<p>用户名：</p>
				<input type="text" name="username" id="idname"  value="<?php echo $_COOKIE['name'];?>" placeholder="请输入名称/手机号">
			</div>
			<div class="loginPassword">
				<p>登录密码：</p>
				<input type="password" name="password" id="password"  value="<?php echo $_COOKIE['password'];?>" placeholder="请输入密码">
			</div>
			<div class="checkbox">
				<?php if($_COOKIE['remember'] == 1){?><input type="checkbox" name="remember" value="1" checked><?php }else{($_COOKIE['remember'] == "")?><input type="checkbox" name="remember" value="1"><?php }?>
				<p>记住密码</p>
			</div>
			<button name="regsubmit" type="submit"  id="registerformsubmit" >登录</button>
			<div class="login_bottom">
				<!--<span class="forget"><a href="#">忘记登录密码？</a></span> -->
				<!--<span class="reg"><a href="#">立即注册</a></span>  -->
			</div>
		</div>
	</form>
	</div>
	<div class="foot_nav">
		<!--<ul>
			<li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order';?>">我的订单</a>|</li>
			<li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=business';?>">业务管理</a>|</li>
			<li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=user';?>">个人中心</a>|</li>
			<li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=addbusiness';?>">添加</a>|</li>
			<li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=aboutus';?>">联系我们</a></li>
		</ul>-->
       <br/> <br/>		
		<p>Copyright All Right Reserd 版权所有：江西车联 赣ICP备12003881号- 2  </p>
	</div>
<script type="text/javascript">
function onpost() {
	var pw = max.$("password");
	var idname = max.$("idname");
	if(idname.value == "") {
		alert("请输入用户名");
		return false;
	}
	if (pw.value == "" ){
		alert("请输入密码");
		return false;
	}	
	return true;
}
</script> 
</body>
</html>
