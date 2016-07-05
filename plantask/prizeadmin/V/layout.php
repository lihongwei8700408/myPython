<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车联微信商家管理平台</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/index.css">
    <link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/orderPage.css">
    <script src="<?php echo STATIC_DOMAIN?>/js/jquery-1.7.2.min.js"></script>
</head>
<body>
	<!-- 公共头部 -->
	<?php include './V/v_header.php';?>
	<!-- 公共头部 -->

	<div class="content-wrap">
		<div class="content">
			<div class="con_left">
				<?php include './V/v_left.php';?>
			</div>
			<div class="con_right">
				<?php  include $layout_content;?>
			</div>
		</div>
	</div>
	<!-- 公共尾部 -->
	<?php include './V/v_footer.php';?>
	<!-- 公共尾部 -->
</body>
</html>
