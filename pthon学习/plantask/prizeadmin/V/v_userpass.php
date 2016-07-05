<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">
<div class="content" style="margin-left:10px;">

           <div class="cLineB" style="width:800px;"><h4>修改密码</h4></div>
          <form method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=userpass';?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                
				<tr>
                  <th><span class="red">*</span>旧密码：</th>
                   <td><input type="password" required="" name="oldpass"  class="px" tabindex="1" size="35"></td>
                </tr>
              </thead>
              <tbody>
                 <tr>
                  <th><span class="red">*</span>新密码：</th>
                   <td><input type="password" required="" name="newpass"  class="px" tabindex="1" size="35"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>确认新密码：</th>
                  <td><input type="password" required="" name="renewpass"  class="px" tabindex="1" size="35"></td>
                </tr>
               <tr>
                  <th></th>
                  <td><button type="submit" class="btnGreen" name="submit" id="saveSetting">提交修改</button></td>
                </tr>
              </tbody>
            </table>
            
          </div>
         </form>
</div>
       