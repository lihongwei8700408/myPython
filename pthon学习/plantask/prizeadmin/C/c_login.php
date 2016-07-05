<?php

    
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		
		$p = (object)array();
		$p->table = 'cl_static_user';
		$p->select = 'UserId,UserName,Password';
		$p->where = 'UserName = "'.$_POST['username'].'" and Password = "'.$_POST['password'].'" and Level < 3';
		$ret = dbSelectOne($p,$con);
		$remember = $_POST['remember'];
		if($remember == 1){
			setcookie('name',$_POST['username'],time()+7*86400);
			setcookie('password',$_POST['password'],time()+7*86400);
			setcookie('remember',$remember,time()+7*86400);
		}else{
			setcookie('name',$_POST['username'],time()-3600);
			setcookie('password',$_POST['password'],time()-3600);
			setcookie('remember',$remember,time()-3600);
		}
		if($ret)
		{
			
			$_SESSION['UserId'] = $ret->UserId;
			$_SESSION['UserName'] = $ret->UserName;
			$Ip = GetIp();
			//插入登入记录表
			$prm = (object)array();
			$prm->table = 'cl_user_loginlog';
			$prm->insert = array(
							'UserId'=>$ret->UserId,
							'UserName'=>$ret->UserName,
							'LoginTime'=>time(),
							'LoginIp'=>$Ip,
							'LoginStatus'=>1
						);
			dbInsertOne($prm,$con);
	       
			header( "Location:".WEB_SHOPADMIN); 
			
			
			 
			
		}
		else{
			echo "<script>alert('用户不存在或密码错误！');</script>";
			echo '<script>location.href="'.WEB_SHOPADMIN.'/index.php?c=login"</script>';
			
		}
		
		
	}
	function actionV_index(){
		include './V/v_login.php';
	}
	
		


?>