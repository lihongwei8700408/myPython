<script type="text/javascript" charset="utf-8" src="<?php echo STATIC_DOMAIN?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo STATIC_DOMAIN?>/ueditor/ueditor.all.min.js"> </script>
<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">
<div class="content" style="margin-left:10px;">

           <div class="cLineB" style="width:800px;"><h4>添加实物商品</h4></div>
          <form  name="form" method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=addproduct';?>" enctype="multipart/form-data" onSubmit="getContent()">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
              
              </thead>
              <tbody>
                                <tr>
                  <th><span class="red">*</span>商品名称：</th>
                  <td><input type="text" required="" name="Title" id="Title"  value="<?php if(isset($update)) echo $update->Title;?>" class="px" tabindex="1" size="50">　</td>
                </tr>
				 <tr>
                  <th><span class="red">*</span>商品类别：</th>
                  <td><select id="servicetype" name="ParentId" style="width:150px;">   		  
					    <option value="0">请选择</option>
					    <?php echo MallProductClass($update);?>
                     </select>
					 <select id="SecondClass" name="ClassId" style="width:150px;display:none">
					 </select>
					 </td>
                </tr>
                <tr>
                  <th><span class="red">*</span>库存数量：</th>
                  <td><input type="number" required="" name="BaseNum" value="<?php if(isset($update)) echo $update->BaseNum;?>" class="px" tabindex="1" size="25"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>图片：</th>
                  <td><?php UploadPic($update->Images);?></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>商品价格：</th>
                  <td><input type="number" name="Price" value="<?php if(isset($update)) echo $update->Price;?>" class="px" tabindex="1" size="25" placeholder="门市价（最多8位）"  >
				  <input type="number" name="CheapPrice" value="<?php if(isset($update)) echo $update->CheapPrice;?>" class="px" tabindex="1" size="25" placeholder="网络价（最多8位）"> </td>
				  
                </tr>
				 <tr>
                  <th><span class="red">*</span>商品详情：</th>
                  <td>
				  <div><script id="editor" type="text/plain" style="width:500px;height:300px;"></script></div>
                <textarea name="Content" id="Content" style="display:none" ><?php if(isset($update)) echo $update->Content;?></textarea> 
				   </td>
                </tr>
                <tr>
                  <th><span class="red">*</span>是否上架：</th>
                  <td><input type="radio" name="State" value="2" class="px" tabindex="1" size="25" <?php if($update->State==2) echo 'Checked';?> >是<input type="radio" name="State" value="1" class="px" tabindex="1" size="25" <?php if($update->State==1) echo 'Checked';?>>否</td>
                </tr>
                <tr>
                  <th><span class="red">*</span>是否邮寄：</th>
                  <td><input type="radio" name="IsPost" value="1" class="px" tabindex="1" size="25" <?php if($update->IsPost==1) echo 'Checked';?>>是<input type="radio" name="IsPost" value="2" class="px" tabindex="1" size="25"<?php if($update->IsPost==2) echo 'Checked';?> >否</td>
                </tr>
               
                <tr>
                  <th></th>
                  <td><input type="hidden" name="update" value="<?php if(isset($update)) echo $update->Id;?>"><button type="submit" class="btnGreen" name="submit" id="saveSetting">保存</button></td>
                </tr>
              </tbody>
            </table>
            
          </div>
         </form>
        </div>
       
<script>
var sid = "<?php if($update) echo $update->ClassId;else echo '';?>";
var id =  "<?php if($update) echo $update->ParentId;else echo '';?>";
if(sid){
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=addproduct&other=getmallclass';?>",{ParentId:id,ClassId:sid},function(date){
		$('#SecondClass').html(date);
		$('#SecondClass').css('display','inline-block');
	});
}
$('#servicetype').change(function(){
	var id = $('#servicetype').val();
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=addproduct&other=getmallclass';?>",{ParentId:id},function(date){
	  $('#SecondClass').html(date);
	  $('#SecondClass').css('display','inline-block');
	});
});
$('.ServiceId').change(function(){
	var title = $('input[name="ServiceId"]:checked').attr('date-name');
    $('#Title').val(title);
	$('#Title').attr('readonly',true);
})

</script>
<script>

 function getContent() {    //获得格式的内容
        var arr = [];
        arr.push("");
        arr.push("");
        arr.push(UE.getEditor('editor').getContent());
        var rs=arr.join("\n");
	    document.form.Content.value=rs;
		
};
 

</script>


<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');




      ue.addListener("ready", function () {
        // editor准备好之后才可以使用 
		
        ue.setContent($("#Content").val());

});
</script>
<script type="text/javascript" src="<?php echo STATIC_DOMAIN;?>/SWFUpload/swfupload/swfupload.js"></script><!--上传图片-->
<script type="text/javascript" src="<?php echo STATIC_DOMAIN;?>/SWFUpload/js/swfupload.queue.js"></script><!--上传图片-->
<script type="text/javascript" src="<?php echo STATIC_DOMAIN;?>/SWFUpload/js/fileprogress.js"></script><!--上传图片-->
<script type="text/javascript" src="<?php echo STATIC_DOMAIN;?>/SWFUpload/js/handlers.js"></script><!--上传图片-->
<script>
	var swfu;
	window.onload = function() {
		var settings = {
			flash_url : "<?php echo PIC_DOMAIN;?>/swfupload.swf",
			upload_url: "<?php echo PIC_DOMAIN;?>/mallupload.php",	// Relative to the SWF file
			post_params: {"PHPSESSID" : "<?php echo session_id(); ?>","pathjm":"<?php echo md5(123)?>"},
			file_size_limit : "2MB",
			file_types : "*.*",
			file_types_description : "All Files",
			file_upload_limit : 5,
			file_queue_limit : 0,
			custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "btnCancel"
			},
			debug: false,

			// Button settings
			button_image_url: "<?php echo STATIC_DOMAIN?>/SWFUpload/images/TestImageNoText_65x29.png",	// Relative to the Flash file
			button_width: 90,
			button_height: 30,
			button_placeholder_id: "spanButtonPlaceHolder",
			button_text: '<a class="button">图片上传</a>',
			button_text_style: ".button {font-family: Arial,Helvetica,sans-serif; font-size: 13pt; color:#666666;} ",
			button_text_left_padding: 23,
			button_text_top_padding: 4,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			queue_complete_handler : queueComplete	// Queue plugin event
		};
		
				

		swfu = new SWFUpload(settings);
		numFile();	//页面自动加载
		getFirstPic();
		getAllPic();
		//图片上传成功
		function uploadSuccess(file, serverData) {
				var oDiv = document.getElementById('upImg');
				var img="<div class='img_each'><span class='close'></span><div class='feng'></div><div class='item_img'><img src='"+serverData+"'></div><div class='move'><a href='javascript:;' class='lftMove'></a><a href='javascript:;' class='firstImg'></a><a href='javascript:;' class='rhtMove'></a></div></div>";
				oDiv.innerHTML+=img;
				
				$("div.img_each").not(":hidden").eq(0).find('.feng').css('display','block');
				
				getFirstPic();
				getAllPic();
				 /* var   progress = new FileProgress(file,this.customSettings.progressTarget);
						progress.setComplete();
						progress.setStatus(serverData+"图片已上传完成.");
						progress.toggleCancel(false);*/
				//serverData即是回传回来的图片名称
		};
		
		//图片上传注释文字
		function queueComplete(numFilesUploaded) {
			numFile();
		};
		function numFile(){
			var num=$('#upImg').find('.img_each').length;
			$("#divStatus").html(" 已上传图片<span>"+num+"</span> / 5,只能上传5张图片，最大2MB,支持jpg/gif/png格式.");
		};
			
		//删除小图片
		$('.img_each .close').live("click",function(){
			$(this).parent().remove();
			var stats = swfu.getStats();//以下为 删除后删除文件 个数重置
			stats.successful_uploads--;
			swfu.setStats(stats);
			numFile();
			$("div.img_each").not(":hidden").eq(0).find('.feng').css('display','block');
			getFirstPic();
			getAllPic();
		});
		//出现左右移图
		$('.img_each').live("hover",function(){
			var move=$(this).find('.move')
			if(move.is(":hidden"))
				{
					move.show().parent().siblings().children(".move").hide();
				}
			else
				{move.hide();}
			return false;	
		});

		//移动
		var move=function(t,fx){
			var	tp=t.parents(".img_each"),//当前
				ind=tp.index();
			var lenHid=$("div.img_each:lt("+ind+")").not(":hidden").length;
			if(fx=="left"){
				if(lenHid==0){
					return false;	
				}
				var np=$("div.img_each").not(":hidden").eq(lenHid-1); //下一个或上一个
			}else if(fx=="right"){
				if(lenHid==($("div.img_each").not(":hidden").length-1)){
					return false;	
				}
				var np=$("div.img_each").not(":hidden").eq(lenHid+1);
			}else if(fx=="" || fx==null){
				if(ind==0)return false;
				var np=$("div.img_each").not(":hidden").eq(0);
				
			}
			var tempImg=np.find("img").attr("src");//暂存下一个或上一个元素的值
			np.find("img").attr("src",tp.find("img").attr("src"));//换值
			tp.find("img").attr("src",tempImg);
		}
		
		//左移
		$(".img_each .lftMove").live("click",function(){
			move($(this),"left");
			getFirstPic();
			getAllPic();
		});
		//右移
		$(".img_each .rhtMove").live("click",function(){
			move($(this),"right");  
			getFirstPic(); 
			getAllPic();                                   
		})
		//设为首图
		$(".img_each .firstImg").live("click",function(){
			var t=$(this);
			var src1=t.parents(".img_each").find("img").attr("src");
			$("input.firstPic").val(src1);
			move(t);    
			getFirstPic();
			getAllPic();
		}); 
		
		//获取第一张图片的url		
		function getFirstPic(){
		  var first_img=$('.img_each').eq(0).addClass("first_img");
		  var first_imgUrl=first_img.find('.item_img img').attr('src');

		  if(typeof(first_imgUrl) !== "undefined"){
			 //alert(first_imgUrl);
			  //截取图片url地址		需将http://html.888.com	替换掉			  
			  var sub='';
			  var strings = first_imgUrl.replace(sub, ''); 
			  $('#TitlePic').val(strings); 
		  }
		}
		 
		//获取所有图片的url		
		function getAllPic(){
		  var img_each=$('.img_each');
		  var allimgurl="";
		  img_each.each(function(){
			  var imgUrl=$(this).find('.item_img img').attr('src');
			  var sub='';
			  var strings = imgUrl.replace(sub, ''); 
			  allimgurl+=strings+'|';
		  });
		  $('#Images').val(allimgurl); 
		};
		
	 };


</script>
