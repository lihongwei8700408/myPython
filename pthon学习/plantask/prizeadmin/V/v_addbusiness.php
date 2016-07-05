<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">
<style>
.helpimg{display:inline;}
</style>
<div class="content" style="margin-left:10px;">

           <div class="cLineB" style="width:800px;"><h4>服务发布</h4></div>
          <form method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=addbusiness';?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
                  <th><span class="red">*</span>服务类型：</th>
                  <td><select id="servicetype" name="ClassId" style="width:150px;">   		  
					  <?php echo GetParentClass($update);?>
                     </select>　 
                  </td>
                </tr>
				<tr>
                  <th><span class="red">*</span>二级服务类别：</th>
                  <td width="550"><div id="SecondClass"></div></td><td><a><button type="button" class="btnGreen addother">手动输入类别</button></a></td>
				  
                </tr>
              </thead>
              <tbody>
                 <tr>
                  <th><span class="red">*</span>服务名称：</th>
                  <td><input type="text"  required="" name="Title" id="Title" value="<?php if(isset($update)) echo $update->Title;?>" onmouseup="this.value=this.value.replace(&#39;_430&#39;,&#39;&#39;)" class="px" tabindex="1" size="50">　<a href="http://weixin.fenlei168.com/tpl/static/getoid.htm" target="_blank"><img src="<?php echo STATIC_DOMAIN?>/images/help.png" class="vm helpimg" title="帮助"></a></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>开始时间：</th>
                  <td><input type="text" required="" name="ServiceStartTime" value="<?php if($update->ServiceStartTime >= 100) {echo str_replace('.',':', sprintf( '%.2f',$update->ServiceStartTime/100));} else{echo $update->ServiceStartTime;};?>" class="px" tabindex="1" size="25"><span class="red">&nbsp;比如：9:00</span></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>结束时间：</th>
                  <td><input type="text" name="ServiceEndTime" value="<?php if($update->ServiceEndTime >= 100) {echo str_replace('.',':', sprintf( '%.2f',$update->ServiceEndTime/100));}else{echo $update->ServiceEndTime;}?>" class="px" tabindex="1" size="25"><span class="red">&nbsp;比如：19:00</span></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>服务价格：</th>
                  <td><input type="number" name="Price" value="<?php if(isset($update)) echo $update->Price;?>" class="px" tabindex="1" size="25" placeholder="门市价（最多8位）"  >
				  <input type="number" name="CheapPrice" value="<?php if(isset($update)) echo $update->CheapPrice;?>" class="px" tabindex="1" size="25" placeholder="网络价（最多8位）"> </td>
				  
                </tr>
				
                <tr>
                  <th><span class="red">*</span>是否上架：</th>
                  <td><input type="radio" name="Checked" value="2" class="px" tabindex="1" size="25" <?php if(isset($update)&&$update->Checked=='2') echo 'checked';?>>是<input type="radio" name="Checked" value="1" class="px" tabindex="1" size="25" <?php if(isset($update)&&$update->Checked=='1') echo 'checked';?>>否</td>
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

var text = '<?php if($update){ $id = $update->ClassId;$sid = $update->ServiceId;}else { $id =1;$sid = '';} echo GetSecondClass($id,$sid);?>';

$('#SecondClass').html(text);
$('#servicetype').change(function(){
	var id = $('#servicetype').val();
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=addbusiness&other=getclass';?>",{ClassId:id},function(date){
	  
	  $('#SecondClass').html(date);
	});
});
$('.ServiceId').live('click',function(){
	var title = $('input[name="ServiceId"]:checked').attr('date-name');
    $('#Title').val(title);
	$('#Title').attr('readonly',true);
})
$('.addother').click(function(){
	$('#SecondClass').html('<input type="text" required name="otherclass" class="px" tabindex="1" size="50">');
})
$('input[name="otherclass"]').live('keyup',function(){
	var title =  $('input[name="otherclass"]').attr('value');
    $('#Title').val(title);
	$('#Title').attr('readonly',true);
	
})

</script>
