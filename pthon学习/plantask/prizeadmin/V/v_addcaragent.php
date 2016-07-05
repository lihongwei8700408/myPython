<div class="content">

           <div class="cLineB"><h4>添加车务代办服务</h4></div>
          <form method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=addcaragent';?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
                  <th><span class="red">*</span>代办服务类型：</th>
                  <td><select  class="ServiceId" name="ServiceId" style="width:150px;">   		  
					  <?php echo GetCarAgentClass();?>
                     </select>　 
					 <input type="hidden" id="Title" name="Title"/>
					  <input type="hidden" id="Title" name="ClassId" value="2"/>
                  </td>
                </tr>
				
              </thead>
              <tbody>
                 
                <tr>
                  <th><span class="red">*</span>价格：</th>
                  <td><input type="number" name="Price" value="" class="px" tabindex="1" size="25" placeholder="门市价（最多8位）"  >
				  <input type="number" name="CheapPrice" value="" class="px" tabindex="1" size="25" placeholder="网络价（最多8位）"> </td>
				  
                </tr>
				
                <tr>
                  <th><span class="red">*</span>是否上架：</th>
                  <td><input type="radio" name="IsMarket" value="1" class="px" tabindex="1" size="25" >是<input type="radio" name="IsMarket" value="2" class="px" tabindex="1" size="25" >否</td>
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

var title = $('.ServiceId option:selected').text();
$('#Title').val(title);
$('.ServiceId').change(function(){
	var title = $('.ServiceId option:selected').text();
    $('#Title').val(title);
	
})

</script>
