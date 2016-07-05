<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">
<div class="content" style="margin-left:10px;">

           <div class="cLineB" style="width:800px;"><h4>添加活动</h4></div>
          <form method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=addactivity';?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
			   <tr>
                  <th><span class="red">*</span>活动名称：</th>
                  <td><input type="text"  required="" name="ActiveName" id="Title"  class="px" tabindex="1" size="50"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>服务项目：</th>
                  <td><select id="servicetype" name="ServiceId" style="width:150px;">   		  
					  <?php echo GetSellerService();?>
                     </select>　 
                  </td>
                </tr>
				<tr>
                  <th><span class="red">*</span>优惠方式：</th>
                  <td><input type="radio" name="ActiveType" class="youhui" value="1" checked/>折扣<input type="radio" name="ActiveType" class="youhui" value="2"/>送积分</td>
                </tr>
              </thead>
              <tbody>
                <tr id="zhekou">
                  <th><span class="red">*</span>享受折扣：</th>
                  <td><input type="number"  name="DiscoutNum1"  placeholder="请输入0-99" id="Title" value="" class="px" tabindex="1" size="50"><span class="red">&nbsp;比如：10</span></td>
                </tr>
				<tr id="jifen" style="display:none;">
                  <th><span class="red">*</span>返还积分：</th>
                  <td><input type="number" name="DiscoutNum2"  placeholder="请输入整数" id="Title" value="" class="px" tabindex="1" size="50"><span class="red">&nbsp;比如：200</span></td>
                </tr>
				<tr>
                  <th><span class="red">*</span>活动群组：</th>
                  <td><input type="radio" name="Group" value="1" checked/>所有用户<input type="radio" name="Group" value="2"/>会员　 
                  </td>
                </tr>
                <tr>
                  <th><span class="red">*</span>开始时间：</th>
                  <td><input type="datetime-local" required="" name="StartTime" value="" class="px" tabindex="1" size="25"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>结束时间：</th>
                  <td><input type="datetime-local" name="EndTime" value="" class="px" tabindex="1" size="25"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>活动名额：</th>
                  <td><input type="text" name="ActiveLimit" value="" class="px" tabindex="1" size="25" placeholder="不限"  >
				  
				  
                </tr>
				
                <tr>
                  <th><span class="red">*</span>是否发布活动：</th>
                  <td><input type="radio" name="ActiveState" value="1" class="px" tabindex="1" size="25" >是<input type="radio" name="ActiveState" value="2" class="px" tabindex="1" size="25" >否</td>
                </tr>
               
                <tr>
                  <th></th>
                  <td><button type="submit" class="btnGreen" name="submit" id="saveSetting">保存</button></td>
                </tr>
              </tbody>
            </table>
            
          </div>
         </form>
        </div>
        
       
<script>

$('.youhui').change(function(){
	var v = $('.youhui:checked').val();
	
	if(v==1){
		$('#zhekou').show();
		$('#jifen').hide();
		$('input[name="DiscoutNum2"]').val('');
	}
	if(v==2){
		$('#zhekou').hide();
		$('#jifen').show();
		$('input[name="DiscoutNum1"]').val('');
	}
	
})

</script>
