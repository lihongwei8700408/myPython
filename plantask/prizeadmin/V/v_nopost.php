<?php
	
	global $_USER;
	$template="
 		<tr>
		<td align='center'><!--{VmSContent('Id[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('GameName[]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('MemberId[11]:_fun->GetMemberName',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('Time[]:_fun->DealTime',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('Id[11]:_fun->PrizeDeal',\$vm_data)}--></td>
    	</tr>";
	if(isset($_GET['submitgroup'])){
		$template="
 		<tr>
		<td align='center'><!--{VmSContent('Id[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('GameName[]',\$vm_data)}--></td>
    	<td align='center'><a href='javascript:;'><!--{VmSContent('MemberId[11]:_fun->GetMemberName',\$vm_data)}--></a></td>
		<td align='center'><!--{VmSContent('Time[]:_fun->DealTime',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('MemberId[11]:_fun->MassDelivery',\$vm_data)}--></td>
    	</tr>";
		$res=GameGroupList('0');
	}else{
		$res=GameList('0');
	}
	$templates="
 		<tr>
		<td align='center'><input class='check-one check_each' name='S_id[]' type='checkbox' /></td>
    	<td align='center'><!--{VmSContent('GameName[]',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('Time[]:_fun->DealTime',\$vm_data)}--></td>
 
    	</tr>";

	
?>
<style>
.massinput{width: 90px;height: 22px;background: #2d7fff;border: 1px solid #1656b7;border-radius: 3px;color: #fff;}
#update{display:inline-block;}
</style>
<script language="javascript" type="text/javascript" src="<?php echo STATIC_DOMAIN ?>/js/laydate/laydate.js"></script>
<div class="content">

           <div class="userRight">
                <div class="uRight_user">
				   <div class="user_Eva_botTab">
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord'?>">全部获奖记录</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=nopost'?>" class="curr">待发货奖品记录</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=alreadypost'?>">已发货奖品记录</a>	
                    </div>
					<div class="userTitle">
                    	<span>待发货奖品记录</span>
                    </div>
                     <div class="sellerSearch">
                     <div>
						<form method="get" action="">
						<input type="hidden" value='prizerecord' name="c"/>
						<input type="hidden" value='nopost' name="other"/>
					   <?php 
						   echo ShowSearchHtml($optionSearch);
				   
						  ?>
						 &nbsp;&nbsp;
						<form method="get" action="" style="margin-left:10px;">
						<input type="hidden" value='prizerecord' name="c"/>
						<input type="hidden" value='nopost' name="other"/>
						<input type="submit" value='按会员批量发货' name="submitgroup" class="massinput"/>
						</form>
					 </div>
            
					</div>
                    
                   
                    <table class="bought_table" id="businesstable">
					   
                        <thead>
						 
                            <tr>
			                  
								<th>编号</th>
                                <th>奖品名称</th>
								   <th>粉丝名称</th>
                                <th width="180">获奖时间</th>
                                <th width="110">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  echo  VwList($res,$template)?> 
                        
                        </tbody>
                       <tfoot>
                            
                        </tfoot>
                    </table> 

					
                      <?php 
							  $search='';
							  
							  if(isset($_GET['state'])){
								  $search.= '&state='.$_GET['state'];
							  }
							 if(isset($_GET['obegin'])){
								  $search.= '&obegin='.$_GET['obegin'];
							  }
							  if(isset($_GET['oend'])){
								  $search.= '&oend='.$_GET['oend'];
							  }
							  if(isset($_GET['title'])){
								  $search.= '&title='.$_GET['title'];
							  }
							  if(isset($_GET['submitgroup'])){
								  $search.= '&submitgroup='.$_GET['submitgroup'];
							  }
							  
							 echo  NewPage($search);
							 

						?>
					
                    <!-- 分页 结束 -->
					<div class="grey"></div>
                    <div class="msg_tanchu">
                        <h3>批量发货<span></span></h3>
                        <table class="bought_table" id="businesstable" style="width:700px;">
					   
                        <thead>
						      <tr><input class='check-one check_all' type='checkbox' />全选</tr>
                            <tr>
			                  
								<th>编号</th>
                                <th>奖品名称</th>
                                <th width="180">获奖时间</th>
                                
                            </tr>
                        </thead>
                        <tbody id="group">
                      
                        </tbody>
                       <tfoot>
                         
                        </tfoot>
                    </table>
                       <div style="width:700px; margin-top:10px;">
                        	<div class="deliGood_tab">
                            	<a href="" >自己联系物流</a>
                            </div>
                           <div class="deliGood_box">
                            	<table class="tables">
                                	<tbody>
                                    	<tr>
                                        	<td width="232">公司名称</td>
                                        	<td width="232">运单号码</td>
                                        	<td width="232">备注</td>
                                        	<td width="232">操作</td>
                                        </tr>
										
                                    	
                                    	<form action="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord';?>" method='post' name="form1">
                                    	<tr>
                                        	<td>
												<select name="PostCompany">
												<?php echo GetPostCompany();?>
												</select>
											
											</td>
                                        	<td><input type='text' name='PostNumber' style="width:200px;"></td>
                                        	<td></td>
                                        	<td><input type="hidden" id="gid" name="gameid"/><input type="hidden" id="mid" name="mid"/><input type="submit" name="submit1" value="确认" class="qr"></td>
											
                                        </tr>
										</form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

 				   
                    </div>
            
                </div> 
                  
                  
            </div>
          <br>
        <div class="cLine">
            <div class="pageNavigator right">
              <div class="pages"></div>
            </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
     



<script>
//全选
	$("input.check_all").click(function(){
		
		var $this=$(this);
		if($this.attr("checked")){
			$('.check_each').attr("checked",true);
		}else{
			$('.check_each').attr("checked",false);
		};
		
	});	
	$(".check_each").click(function(){
		var $this=$(this);
		var len=$(".check_each[type=checkbox]:checked").length;
		var tlen=$(".check_each[type=checkbox]").length;
		if(len==tlen){
			$("input.check_all").attr("checked",true);	
		}else{
			$("input.check_all").attr("checked",false);
		}
	});
//时间插件
var start = {
    elem: '#fk_obegin',
    format: 'YYYY/MM/DD hh:mm:ss',
    min: '', //设定最小日期为当前日期
    max: laydate.now(), //最大日期
    istime: true,
    istoday: true,
    festival: true,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#fk_oend',
    format: 'YYYY/MM/DD 23:59:59',
    min: '',
    max: laydate.now(),
    istime: true,
    istoday: true,
    festival: true,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};
laydate(start);
laydate(end);  
$('.sellbutton').click(function(){
	var id = $(this).attr('data-id');
	location.href='<?php echo WEB_SHOPADMIN;?>/index.php?c=prizedelivery&Id='+id;
})
$('.mass').click(function(){
	var mid = $(this).attr('data-id');
	$(".grey").css("display","block");
	$(".msg_tanchu").css("display","block");
	$('#mid').val(mid);
	$(".msg_tanchu h3 span").click(function(){
			
			$(".grey").css("display","none");
			$(".msg_tanchu").css("display","none");
		
		});
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=group';?>",{Mid:mid},function(data){
		console.log(data);
	    var json=eval("("+data+")");
		var h = '';
		$(json.list).each(function(){
			h+='<tr><td align="center"><input class="check-one check_each" name="S_id[]" type="checkbox" value="'+this.Id+'" /></td><td align="center">'+this.GameName+'</td><td align="center">'+this.Time+'</td></tr>';
		})
		h+='<tr><td colspan="3" height="30">买家收货信息:姓名：'+json.name+'&nbsp;手机：'+json.tel+'&nbsp;收货地址：'+json.address+' <a id="update" class="sellbutton" href="javascript:;">点击修改</a><div id="address" style="display:none;"><form method="post" action=""><input type="hidden" name="MemberId" value="'+mid+'"/><input type="text" name="PrizeAddress" style="width:200px;" value="'+json.address+'"/>&nbsp;&nbsp;<input type="submit" name="submitaddress"/></form></div></td></tr>';  
		$('#group').html(h);
		
	});
	
}) 
$('#update').live('click',function(){
		$('#address').css('display','block');
}) 
$('.qr').click(function(){
	var data=new Array();	
	var t_tr=$('#businesstable tr')
			t_tr.each(function(){
				var t_input=$(this).find("td input[name='S_id[]']:checked");
				var val=t_input.val();
				if (!isNaN(Number(val)))
				{
					data.push(val);
				}
			 });

	if(data.length > 0){
		$('#gid').val(data);
		$('#mid').val();
		$('form1').submit();
	}else{
		alert("请选择要发货的奖品！");
		return false;
	}
})
</script>    