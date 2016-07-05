<?php
include('conf.php');

// Code for Session Cookie workaround
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}

	session_start();

// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
		header("HTTP/1.1 500 Internal Server Error");
		echo "POST exceeded maximum allowed size.";
		exit(0);
	}

	
	$save_path = "./mallpic/".date('Y'.'m')."/bigpic/";				// The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)	
	$save_path_smart = "./mallpic/".date('Y'.'m')."/minpic";
	

	//如果目录不存在则新建目录
	if(!is_dir($save_path)){
		mkdir($save_path,0777,TRUE);
	}
	
	//如果目录不存在则新建目录
	if(!is_dir($save_path_smart)){
		mkdir($save_path_smart,0777,TRUE);
	}
	

	//exit;
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 2147483647;				// 2GB in bytes
	$extension_whitelist = array("doc", "txt", "jpg", "gif", "png");	// Allowed file extensions
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)
	
// Other variables	
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"文件上传成功",
        1=>"上传的文件超过了 php.ini 文件中的 upload_max_filesize directive 里的设置",
        2=>"上传的文件超过了 HTML form 文件中的 MAX_FILE_SIZE directive 里的设置",
        3=>"上传的文件仅为部分文件",
        4=>"没有文件上传",
        6=>"缺少临时文件夹"
	);


// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("No upload found in \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("Upload failed is_uploaded_file test.");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("File has no name.");
		exit(0);
	}
	
// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("File exceeds the maximum allowed size");
		exit(0);
	}
	
	if ($file_size <= 0) {
		HandleError("File size outside allowed lower bound");
		exit(0);
	}


// Validate file name (for our purposes we'll just remove invalid characters)
	//$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", uniqid().'.jpg');
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("Invalid file name");
		exit(0);
	}

	

// Validate that we won't over-write an existing file
	if (file_exists($save_path . $file_name)) {
		HandleError("File with this name already exists");
		exit(0);
	}

// Validate file extension
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
	$is_valid_extension = false;
	foreach ($extension_whitelist as $extension) {
		if (strcasecmp($file_extension, $extension) == 0) {
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) {
		HandleError("Invalid file extension");
		exit(0);
	}

// Validate file contents (extension and mime-type can't be trusted)
	/*
		Validating the file contents is OS and web server configuration dependant.  Also, it may not be reliable.
		See the comments on this page: http://us2.php.net/fileinfo
		
		Also see http://72.14.253.104/search?q=cache:3YGZfcnKDrYJ:www.scanit.be/uploads/php-file-upload.pdf+php+file+command&hl=en&ct=clnk&cd=8&gl=us&client=firefox-a
		 which describes how a PHP script can be embedded within a GIF image file.
		
		Therefore, no sample code will be provided here.  Research the issue, decide how much security is
		 needed, and implement a solution that meets the needs.
	*/


// Process the file
	/*
		At this point we are ready to process the valid file. This sample code shows how to save the file. Other tasks
		 could be done such as creating an entry in a database or generating a thumbnail.
		 
		Depending on your server OS and needs you may need to set the Security Permissions on the file after it has
		been saved.
	*/
	
	
// 	$im = @imagecreatefromstring($save_path.$file_name);
	

	
// 	if(is_resource($im)){
	
// 	}else{
// 		copy($save_path.$file_name, $save_path_smart.$file_name);
// 	}
	
	
	
	if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$file_name)) {
		HandleError("文件无法保存.");
		exit(0);
	}
	
	/*
	 * 压缩图片方法
	 * 
	 */
	$big=$save_path.$file_name;
	$smart=$save_path_smart.$file_name;

	ResizeImg($big, $big, 640); //大图最宽640
	ResizeImg($big, $smart, 470); //大图最宽470
	/**
	 * 压缩图像并保存压缩后的图像文件
	 * $src		string		原始图片路径
	 * $aim		string		压缩后图片路径
	 * $w		int			压缩后图片的宽度
	 * @return	boolean		成功返回true，失败返回false
	 */
	function ResizeImg($src, $aim, $w){
		$info=getimagesize($src);							//获取图片的基本信息
		$width=$info[0];									//获取图片宽度
		$height=$info[1];									//获取图片高度
		if($width > $w){
			$h = intval($w * $height / $width);				//等比缩放图片高度 变整型
		}else{
			$w = $width;
			$h = $height;
		}
		$temp_img=imagecreatetruecolor($w,$h);				//创建画布
		switch($info[2]){
			case 1:
				$im=imagecreatefromgif($src);
				$white = imagecolorallocate($temp_img,255,255,255);				//填充白色背景色
				imagefilledrectangle($temp_img,0,0,$w,$h,$white);				//画一个矩形并填充颜色
				imagecolortransparent($temp_img,$white);						//指定透明背景色
				imagecopyresampled($temp_img,$im,0,0,0,0,$w,$h,$width,$height);	//将图片复制到画布中
				$res = imagegif($temp_img,$aim);								//创建保存图像文件
				break;
			case 2:
				$im=imagecreatefromjpeg($src);
				imagecopyresampled($temp_img,$im,0,0,0,0,$w,$h,$width,$height);	//将图片复制到画布中
				$res = imagejpeg($temp_img,$aim, 75);							//创建保存图像文件
				break;
			case 3:
				$im=imagecreatefrompng($src);
				$alpha = imagecolorallocatealpha($temp_img, 0, 0, 0, 127);		//为图像分配颜色 + alpha(透明)
				imagefill($temp_img, 0, 0, $alpha);								//区域填充
				imagesavealpha($temp_img, true);								//保存PNG图像时保存完整alpha通道信息
				imagecopyresampled($temp_img,$im,0,0,0,0,$w,$h,$width,$height);	//将图片复制到画布中
				$res = imagepng($temp_img,$aim);								//创建保存图像文件
				break;
			default:
				return false;
		}
		imagedestroy($im);														//销毁图像，节约内存
	
		return $res;
	}
	
	
	 /* resizeImage($big,470,300,$smart);
	
	function resizeImage($src_imagename,$maxwidth,$maxheight,$savename){
		$im=imagecreatefromjpeg($src_imagename);
		$current_width = imagesx($im);
		$current_height = imagesy($im);
	
		if(($maxwidth && $current_width > $maxwidth) || ($maxheight && $current_height > $maxheight)){
			if($maxwidth && $current_width>$maxwidth){
				$widthratio = $maxwidth/$current_width;
				$resizewidth_tag = true;
			}
	
			if($maxheight && $current_height>$maxheight){
				$heightratio = $maxheight/$current_height;
				$resizeheight_tag = true;
			}
	
			if($resizewidth_tag && $resizeheight_tag){
				if($widthratio<$heightratio)
					$ratio = $widthratio;
				else
					$ratio = $heightratio;
			}
	
			if($resizewidth_tag && !$resizeheight_tag)
				$ratio = $widthratio;
			if($resizeheight_tag && !$resizewidth_tag)
				$ratio = $heightratio;
	
			$newwidth = $current_width * $ratio;
			$newheight = $current_height * $ratio;
	
			if(function_exists("imagecopyresampled")){
				$newim = imagecreatetruecolor($newwidth,$newheight);
				imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$current_width,$current_height);
			}else{
				$newim = imagecreate($newwidth,$newheight);
				imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$current_width,$current_height);
			}
	
			$savename = $savename;
			imagejpeg($newim,$savename);
			imagedestroy($newim);
		}else{
			//$savename = $savename;
			//imagejpeg($im,$savename);
			copy($src_imagename,$savename);//复制文件  徐鑫20150303
		}
	}   */
	
// 	if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path_smart.$file_name)) {
// 		HandleError("文件无法保存.");
// 		exit(0);
// 	}
// Return output to the browser (only supported by SWFUpload for Flash Player 9)

	//echo "File Received";
	
	
		echo "/shopadmin/upload/mallpic/".date('Y'.'m')."/bigpic/".$file_name;				// The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)		
	
		//fleapic/当前城市/类别id/resource/201505/11
		//echo PIC_DOMAIN."/mall_pic/fleapic/".$_POST["cityId"]."/".$_POST["classId"]."/".date('Y'.'m')."/".date('d')."/bigpic/".$file_name;
		//echo 'http://s.baixing.net/img/visualize/logo_81x36.png';
	
	exit(0);


/* Handles the error output.  This function was written for SWFUpload for Flash Player 8 which
cannot return data to the server, so it just returns a 500 error. For Flash Player 9 you will
want to change this to return the server data you want to indicate an error and then use SWFUpload's
uploadSuccess to check the server_data for your error indicator. */
function HandleError($message) {
	header("HTTP/1.1 500 Internal Server Error");
	echo $message;
}


?>