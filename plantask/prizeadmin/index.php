<?php
   
	header("Content-type: text/html; charset=utf-8");
	session_start();
	include './funs/DB_ALL.php';
	include './funs/VW_ALL.php';
	include './funs/OB_ALL.php';
	include './funs/common.php';
	include './funs/page.php';
	include './config.php';
	$p = (object)array();
	$p->pw = DB_PASS;
	$p->host = DB_HOST;
	$p->user = DB_USER;
	$p->code = DB_CODE;
	$p->base = DB_BASE;
	$con = dbConnect($p);
    if(isset($_SESSION['UserId']))
	{
		$res = GetUserInfo($_SESSION['UserId']);
		if($res){
			$_USER = (object)$res;
		}
	}
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = $page * PAGE - PAGE;
	if(isset($_GET['c']) && $_GET['c'] != ''){
		$controller = './C/c_'.$_GET['c'].'.php';
	     
		if(file_exists($controller))
		{
			
			include $controller;
			$fun ='actionV_index';
			
			if(isset($_GET['other']) && $_GET['other'] != ''){
				$other = 'actionV_'.$_GET['other'];
				if(function_exists($other)){
					$fun = $other;
					
				}
				else{
					echo 404;
					Quit();
				}
				
			}
			$fun();
			
		}else{
			echo 404;
			Quit();
		}
	}
	else{
		$layout_content = './V/v_userindex.php';
		include './V/layout.php';
		
	}
    
		
	mysql_close($con);
?>