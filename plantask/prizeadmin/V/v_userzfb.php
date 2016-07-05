<?php
	global $_SELLER;
?>
<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">
<div class="content" style="margin-left:10px;">

         <div class="cLineB" style="width:800px;"><h4>绑定支付宝</h4></div>
          <form method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=userzfb';?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                
				<tr>
                  <th><span class="red">*</span>姓名：</th>
                   <td><input type="text" required="" name="ZFBName"  class="px" tabindex="1" size="35"></td>
                </tr>
              </thead>
              <tbody>
                 <tr>
                  <th><span class="red">*</span>支付宝账号：</th>
                   <td><input type="text" required="" name="ZFB"  class="px" tabindex="1" size="35"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>手机号码：</th>
                  <td><input type="text" required="" name="Tel"  class="px" tabindex="1" size="35" value="<?php echo $_SELLER->Tel;?>"></td>
                </tr>
				 <tr>
                  <th><span class="red">*</span>验证码：</th>
                  <td><input type="text" required="" name="Code"  class="px" tabindex="1" size="35"><button type="button" class="btnGreen"  id="saveSetting">获取验证码</button></td>
                </tr>
               <tr>
                  <th></th>
                  <td><button type="submit" class="btnGreen" name="submit" id="saveSetting">绑定</button></td>
                </tr>
              </tbody>
            </table>
            
          </div>
         </form>
 </div>
        
       