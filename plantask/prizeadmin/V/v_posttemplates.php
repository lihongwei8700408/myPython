<?php 
   
	$template="<tr><td colspan='6' align='left'><input class='check-one check_each'  name='S_id[]' type='checkbox' value='<!--{VmSContent('Id[11]',\$vm_data)}-->'/>运费模板Id：<!--{VmSContent('Id[11]',\$vm_data)}-->模板名称：<!--{VmSContent('Name[11]',\$vm_data)}--></td></tr>
	           <!--{VmSContent('Id[11]:_fun->MEMSellPostModelsSmallTemp',\$vm_data)}--> ";
			
	$option = array(
		'华东' => array(
			'江西','安徽','上海','浙江','江苏',
			),
		'华北' => array(
			'山东','北京','内蒙古','山西','河北','天津',
			),
		'华中' => array(
			'河南','湖南','湖北',
			),
		'华南' => array(
			'福建','海南','广西','广东',
			),
		'东北' => array(
			'辽宁','吉林','黑龙江',
			),
		'西北' => array(
			'新疆','宁夏','青海','甘肃','陕西',
			),
		'西南' => array(
			'西藏','云南','贵州','四川','重庆',
			),
		'港澳台' => array(
			'香港','澳门','台湾','钓鱼岛',
			),
		);
	
?>
<style>
.newtemplate{display:none;}
.posttemplate dl dt{float: left;width: 70px;padding:5px;}
.posttemplate dl dd {width:620px; padding:5px;}
.postage-detail{display:none;}

</style>

<div class="content">

          <div class="userRight">
                <div class="uRight_user">
					 <div class="userTitle">
                    	<span>物流工具 > 运费模板设置</span>
                    </div>
					<div class="user_Eva_botTab">
                      <!--<a href="/user/sellposttools">服务商设置</a>-->
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates'?>" class="curr">运费模板设置</a>
						<!--<a href="/<?php echo WEB_CITY?>/user/sellposttools">运费/时效查看器</a>
						<a href="/<?php echo WEB_CITY?>/user/sellposttools">物流跟踪信息</a>
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=address'?>">地址库</a>-->
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=book'?>">运单模板设置</a>		
                    </div>
                    <div class="userDpBox">
                    	<div class="userDpEach" style="margin-left:10px;">
						 <div class="set_site">
                           
                            
                                <dt></dt>
                               
                               
                                <dd><br/><input type="button" value="新增运费模板" class="dizhi_baocun new"></dd>
								
								<dd>您可以按照宝贝的<font color="red">数量</font>设置模板，一般使用于比较轻的宝贝</dd>
                            </dl>
                        
						</div>
						<a style="color:blue;" href="<?php echo HELPDOMAIN;?>">使用帮助</a>
						<div> 
						<div class="newtemplate">
						 <div class="posttemplate">
						 <form action="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates';?>" method="post">
						 <dl><h2>新增运费模板</h2>
							<dt>模板名称:</dt>
							<dd><input name="Name" type="text" style="width:300px;"></dd>
							<!--<dt>是否包邮:</dt>
							<dd><input  type="radio" name="Isfree" value="1"/>卖家承担运费
								<input  type="radio" name="Isfree" value="2"/>自定义运费
							</dd>-->
							<dt>计价方式:</dt>
							<dd>按件数(车联默认)
								
							
							</dd>
							<dt>运送方式:</dt>
							<dd><input  type="checkbox" name="Type_fast" class="fast" value="1"/>快递</br>
							<div class="postage-detail" id="kuai" >	
                        	<div class="entity">
								<div class="default">
                                    默认运费：<input type="text" name="default_fn_fast" value="1"  class="input-text " maxlength="6"> 件内，
                                    <input type="text" class="j_sellerBearFrePrice" value="0.00"  style="display: none;">
                                    <input type="text" name="default_fw_fast" value="" class="input-text " maxlength="6"> 元，每增加 
                                    <input type="text" name="default_an_fast" value="1"  class="input-text " maxlength="6"> 件，增加运费 
                                    <input type="text" class="j_sellerBearFrePrice" value="0.00" disabled="disabled" style="display: none;">
                                    <input type="text" name="default_aw_fast" value="" class="input-text " maxlength="6" aria-label="加件运费">元
                                    <div class="J_DefaultMessage"></div>
                                </div>
                                <div class="tbl-except T1">
									<table border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="300">运送到</th>
                                                <th>首件(件)</th>
                                                <th>首费(元)</th>
                                                <th>续件(件)</th>
                                                <th>续费(元)</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											   
                                        </tbody>
                                	</table>
                                </div>
                                <div class="tbl-attach">
                                    <div class="J_SpecialMessage"></div>
                                    <a href="javascript:;" class="J_AddRule J1">为指定地区城市设置运费</a>
                                    <!--<a href="javascript:;" class="J_ToggleBatch" >批量操作</a>-->
                            	</div>
                        	</div>
                            <!-- 地区弹出层 -->
                            <div class="ks-dialog ks-overlay ks-ext-position dialog-areas ks-dialog-shown ks-overlay-shown"  hidefocus="true" ><a tabindex="0" href='javascript:void("关闭")' role="button" style="z-index:9" class="ks-ext-close"><span class="ks-ext-close-x">关闭</span></a>
                              <div class="ks-contentbox">
                                <div class="ks-stdmod-header" id="ks-dialog-header1029">
                                  <div class="title">选择区域</div>
                                </div>
                                <div class="ks-stdmod-body">
                                
                                    <ul id="J_CityList">
                                     <?php
									  foreach ($option as $key=>$val){
		
										
										echo  '<li>
																		<div class=" dcity clearfix">
																		  <div class="ecity gcity"> <span class="group-label">
																			<input type="checkbox" value="" class="J_Group" id="J_Group_0">
																			<label for="J_Group_0">'.$key.'</label>
																			</span> </div> <div class="province-list">';
										foreach ($val as $vals){
											echo  '<div class="ecity"> <span class="gareas">
																			  <input type="checkbox" value="'. $vals.'" id="J_Province_320000" class="J_Province">
																			  <label for="J_Province_320000">'. $vals.'</label>
																			 </span>
																			 </div>';
																			 
										
										}
										  
										 }
										   echo  ' </div></div></li>';
                                        
																	 
										
									
									 
									 ?>
                                    </ul>
                                    <div class="btns">
                                      <button type="button" class="J_Submit">确定</button>
                                      <button type="button" class="J_Cancel">取消</button>
                                    </div>
                                
                                </div>
                                <div class="ks-stdmod-footer"></div>
                              </div>
                              <div tabindex="0" style="position:absolute;"></div>
                            </div>                            <!-- 地区弹出层 -->
                            
                        </div>
						
                              
								<dt></dt><input  type="checkbox" name="Type_ems" class="ems" value="2"/>EMS</br>
								<div class="postage-detail" id="ems" style="width:620px;">	
                        	<div class="entity">
								<div class="default">
                                    默认运费：<input type="text" name="default_fn_ems" value="1"  class="input-text " maxlength="6"> 件内，
                                    <input type="text" class="j_sellerBearFrePrice" value="0.00"  style="display: none;">
                                    <input type="text" name="default_fw_ems" value="" class="input-text " maxlength="6"> 元，每增加 
                                    <input type="text" name="default_an_ems" value="1"  class="input-text " maxlength="6"> 件，增加运费 
                                    <input type="text" class="j_sellerBearFrePrice" value="0.00" disabled="disabled" style="display: none;">
                                    <input type="text" name="default_aw_ems" value="" class="input-text " maxlength="6" aria-label="加件运费">元
                                    <div class="J_DefaultMessage"></div>
                                </div>
                                <div class="tbl-except T2">
									<table border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="300">运送到</th>
                                                <th>首件(件)</th>
                                                <th>首费(元)</th>
                                                <th>续件(件)</th>
                                                <th>续费(元)</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											                         
                                        </tbody>
                                	</table>
                                </div>
                                <div class="tbl-attach">
                                    <div class="J_SpecialMessage"></div>
                                    <a href="javascript:;" class="J_AddRule J2">为指定地区城市设置运费</a>
                                    <!--<a href="javascript:;" class="J_ToggleBatch" >批量操作</a>-->
                            	</div>
                        	</div>
                            <!-- 地区弹出层 -->
                            <div class="ks-dialog ks-overlay ks-ext-position dialog-areas ks-dialog-shown ks-overlay-shown"  hidefocus="true" ><a tabindex="0" href='javascript:void("关闭")' role="button" style="z-index:9" class="ks-ext-close"><span class="ks-ext-close-x">关闭</span></a>
                              <div class="ks-contentbox">
                                <div class="ks-stdmod-header" id="ks-dialog-header1029">
                                  <div class="title">选择区域</div>
                                </div>
                                <div class="ks-stdmod-body">
                                  
                                    <ul id="J_CityList">
                                     <?php
									  foreach ($option as $key=>$val){
		
										
										echo  '<li>
																		<div class=" dcity clearfix">
																		  <div class="ecity gcity"> <span class="group-label">
																			<input type="checkbox" value="" class="J_Group" id="J_Group_0">
																			<label for="J_Group_0">'.$key.'</label>
																			</span> </div> <div class="province-list">';
										foreach ($val as $vals){
											echo  '<div class="ecity"> <span class="gareas">
																			  <input type="checkbox" value="'. $vals.'" id="J_Province_320000" class="J_Province">
																			  <label for="J_Province_320000">'. $vals.'</label>
																			 </span>
																			 </div>';
																			 
										
										}
										  
										 }
										   echo  ' </div></div></li>';
                                        
																	 
										
									
									 
									 ?>
                                    </ul>
                                    <div class="btns">
                                      <button type="button" class="J_Submit">确定</button>
                                      <button type="button" class="J_Cancel">取消</button>
                                    </div>
                                 
                                </div>
                                <div class="ks-stdmod-footer"></div>
                              </div>
                              <div tabindex="0" style="position:absolute;"></div>
                            </div>                            <!-- 地区弹出层 -->
                            
                        </div>
								<dt></dt><input type="checkbox" name="Type_com" class="common" value="3"/>平邮</br>
							<div class="postage-detail" id="ping" style="width:620px; >	
                        	<div class="entity">
								<div class="default">
                                    默认运费：<input type="text" name="default_fn_com" value="1"  class="input-text " maxlength="6"> 件内，
                                    <input type="text" class="j_sellerBearFrePrice" value="0.00"  style="display: none;">
                                    <input type="text" name="default_fw_com" value="" class="input-text " maxlength="6"> 元，每增加 
                                    <input type="text" name="default_an_com" value="1"  class="input-text " maxlength="6"> 件，增加运费 
                                    <input type="text" class="j_sellerBearFrePrice" value="0.00" disabled="disabled" style="display: none;">
                                    <input type="text" name="default_aw_com" value="" class="input-text " maxlength="6" aria-label="加件运费">元
                                    <div class="J_DefaultMessage"></div>
                                </div>
                                <div class="tbl-except T3">
									<table border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th width="300">运送到</th>
                                                <th>首件(件)</th>
                                                <th>首费(元)</th>
                                                <th>续件(件)</th>
                                                <th>续费(元)</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											                           
                                        </tbody>
                                	</table>
                                </div>
                                <div class="tbl-attach">
                                    <div class="J_SpecialMessage"></div>
                                    <a href="javascript:;" class="J_AddRule J3">为指定地区城市设置运费</a>
                                    <!--<a href="javascript:;" class="J_ToggleBatch" >批量操作</a>-->
                            	</div>
                        	</div>
                            <!-- 地区弹出层 -->
                            <div class="ks-dialog ks-overlay ks-ext-position dialog-areas ks-dialog-shown ks-overlay-shown"  hidefocus="true" ><a tabindex="0" href='javascript:void("关闭")' role="button" style="z-index:9" class="ks-ext-close"><span class="ks-ext-close-x">关闭</span></a>
                              <div class="ks-contentbox">
                                <div class="ks-stdmod-header" id="ks-dialog-header1029">
                                  <div class="title">选择区域</div>
                                </div>
                                <div class="ks-stdmod-body">
                                 
                                    <ul id="J_CityList">
                                     <?php
									  foreach ($option as $key=>$val){
		
										
										echo  '<li>
																		<div class=" dcity clearfix">
																		  <div class="ecity gcity"> <span class="group-label">
																			<input type="checkbox" value="" class="J_Group" id="J_Group_0">
																			<label for="J_Group_0">'.$key.'</label>
																			</span> </div> <div class="province-list">';
										foreach ($val as $vals){
											echo  '<div class="ecity"> <span class="gareas">
																			  <input type="checkbox" value="'. $vals.'" id="J_Province_320000" class="J_Province">
																			  <label for="J_Province_320000">'. $vals.'</label>
																			 </span>
																			 </div>';
																			 
										
										}
										  
										 }
										   echo  ' </div></div></li>';
                                        
																	 
										
									
									 
									 ?>
                                    </ul>
                                    <div class="btns">
                                      <button type="button" class="J_Submit">确定</button>
                                      <button type="button" class="J_Cancel">取消</button>
                                    </div>
                                 
                                </div>
                                <div class="ks-stdmod-footer"></div>
                              </div>
                              <div tabindex="0" style="position:absolute;"></div>
                            </div>                            <!-- 地区弹出层 -->
                            
                        </div>
							
							
							</dd>
                               
                                
                                <dt>&nbsp;</dt>
                                <dd><input type="submit" name="build" value="保存设置" style="margin-left:80px;"/></dd>
							</dl>
							</form>
                          </div>
						</div>
					   <div class="default1" style="overflow-x: hidden;overflow-y: auto; height: 300px;">
	                    <table id="selltable" class="tables" style="margin-top:5px;">
                        <thead>
						   <tr><th width=""  colspan="6" align="left"><input class='check-one check_all' type='checkbox'/>全选<a  href="javascript:;" onclick="dodel()" class="sellbutton">删除</a></th></tr>
                            <tr>
                                <th width="10%">运送方式</th>
                                <th width="40%">运送到</th>
								<th width="10%">首件（个）</th>
								<th width="10%">运费（元）</th>
								<th width="10%">续件（个）</th>
								<th width="20%">运费（元）</th>
                               
                               
                                
                            </tr>
							
                        </thead>
						  
                        <tbody>
						
                           
                           <?php 
													$res = MEMSellPostModels();echo VwList($res,$template)?> 
                           
                           
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table> 
					</div>
                    
                    </div>
                    
                </div>
                </div>
 </div>

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
	$('.dizhi_baocun').click(function(){
		
	
		if($('.newtemplate').is(':hidden') ){
			$('.newtemplate').css('display','block');
			$('.default1').css('display','none');
		}else{
		$('.newtemplate').css('display','none');
		$('.default1').css('display','block');
		}
	});
	$('.fast').click(function(){
		
	
		if($('#kuai').is(':hidden') ){
			$('#kuai').css('display','block');
			
		}else{
		$('#kuai').css('display','none');
		
		}
	});
	$('.ems').click(function(){
		
	
		if($('#ems').is(':hidden') ){
			$('#ems').css('display','block');
			
		}else{
		$('#ems').css('display','none');
		
		}
	}); 
	$('.common').click(function(){
		
	
		if($('#ping').is(':hidden') ){
			$('#ping').css('display','block');
			
		}else{
		$('#ping').css('display','none');
		
		}
	}) 
	var dodel = function (){
	    
        var data=new Array();
		if(!confirm("确认要删除运费模板吗！"))
		{
			return false;
		}
		var t_tr=$('#selltable tr')
				t_tr.each(function(){
					var t_input=$(this).find("td input[name='S_id[]']:checked");
					var val=t_input.val();
					if (!isNaN(Number(val)))
					{
						data.push(val);
					}
		});
		
		if(data.length > 0){
			$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=del';?>',{'S_id[]':data}, function (data) {	
				
				if (data ==1){
					alert('操作成功');location.reload();
				}else{
					alert("操作失败！");
				}
			});
        }else{
            alert("请选择要操作的选项!");
        }
}		
$(function(){
	
	//设置快递运费
	$('.J1').click(function(){
		var trlength = $('.T1 tbody tr').length;
		
		$('.T1').css('display','block');
		$('.T1 table tbody').append('<tr><td class="cell-area"><a href="javascript:;" class="acc_popup" title="编辑运送区域">编辑</a><div class="area-group"><p>未添加地区</p></div><input type="hidden" name="datafast['+trlength+'][Province]" value=""></td><td><input type="text" name="datafast['+trlength+'][FirstNum]" value="1"  maxlength="6"></td><td><input type="text" name="datafast['+trlength+'][FirstWeight]" maxlength="6"></td><td><input type="text" name="datafast['+trlength+'][AddNum]" value="1" maxlength="6" ></td><td><input type="text" name="datafast['+trlength+'][AddWeight]"  maxlength="6"></td><td><a href="javascript:;" class="J_DeleteRule">删除</a></td></tr>');
	});
	//设置EMS运费
	$('.J2').click(function(){
		var trlength = $('.T2 tbody tr').length;
		
		$('.T2').css('display','block');
		$('.T2 table tbody').append('<tr><td class="cell-area"><a href="javascript:;" class="acc_popup" title="编辑运送区域">编辑</a><div class="area-group"><p>未添加地区</p></div><input type="hidden" name="dataems['+trlength+'][Province]" value=""></td><td><input type="text" name="dataems['+trlength+'][FirstNum]" value="1"  maxlength="6"></td><td><input type="text" name="dataems['+trlength+'][FirstWeight]" maxlength="6"></td><td><input type="text" name="dataems['+trlength+'][AddNum]" value="1" maxlength="6" ></td><td><input type="text" name="dataems['+trlength+'][AddWeight]"  maxlength="6"></td><td><a href="javascript:;" class="J_DeleteRule">删除</a></td></tr>');
	});
	//设置平邮运费
	$('.J3').click(function(){
		var trlength = $('.T3 tbody tr').length;
		
		$('.T3').css('display','block');
		$('.T3 table tbody').append('<tr><td class="cell-area"><a href="javascript:;" class="acc_popup" title="编辑运送区域">编辑</a><div class="area-group"><p>未添加地区</p></div><input type="hidden" name="datacom['+trlength+'][Province]" value=""></td><td><input type="text" name="datacom['+trlength+'][FirstNum]" value="1"  maxlength="6"></td><td><input type="text" name="datacom['+trlength+'][FirstWeight]" maxlength="6"></td><td><input type="text" name="datacom['+trlength+'][AddNum]" value="1" maxlength="6" ></td><td><input type="text" name="datacom['+trlength+'][AddWeight]"  maxlength="6"></td><td><a href="javascript:;" class="J_DeleteRule">删除</a></td></tr>');
	});
	$('.J_DeleteRule').live('click',function(){
		if(confirm('确定要删除当前的信息设置吗？'))
		{
			$(this).parents('tr').remove();
			return true;
		}
	});
	var self='';
	//点击弹出层
	$('.acc_popup').live('click',function(){
		//初始化 start
		self=$(this);
		$('.ks-dialog input[type=checkbox]').attr('checked',false);
		$('.ks-dialog .check_num').html('');
		$('.ks-dialog').css('display','block');
		$('.citys').css('display','none');
		$('.citys').parent().removeClass('showCityPop');
		//初始化 end
		
		
		var checkVal=self.siblings('input[type=hidden]').val();
		if(checkVal!=''){
			checkVal=checkVal.substring(0,(checkVal.length-1));
			arr=checkVal.split(',');//选中的checkbox
			$('.ks-contentbox').find('input[type=checkbox]').each(function(){
				if($.inArray($(this).val(),arr)!=-1){
					$(this).attr('checked',true);
					//alert($(this).attr('ClassName'));
					if($(this).attr('class')=='J_Province'){
						//alert($(this).parent())
						$(this).parent().siblings('.citys').find('input[type=checkbox]').attr('checked',true);
					}
				}
			});
		}


		
		
		
		
	});
	//end
	//点击确定
	$('.J_Submit').click(function(){
		var html='';
		var value='';
		//debugger;
		$(".province-list").find('.ecity .gareas').each(function(){
			//alert($(this).find('input[type=checkbox]:checked'));
			//debugger;
			//alert($(this).find('input[type=checkbox]:checked').length);
			if($(this).find('input[type=checkbox]:checked').length){//如果选择就显示省份 否者显示城市
				html+=$(this).find('label').html()+',';
				value+=$(this).find('label').siblings('input[type=checkbox]').val()+',';
			}else{
				$(this).siblings('.citys').find('input[type=checkbox]:checked').each(function(){
					html+=$(this).siblings('label').html()+',';
					value+=$(this).val()+',';
				});
			}
		});
		self.siblings('.area-group').find('p').html(html);
		//console.log(value);
		self.siblings('input[type=hidden]').val(value);
		
		$('.ks-dialog').css('display','none');
	});
	//end
	$('.ks-ext-close-x').click(function(){
		$('.ks-dialog').css('display','none');
	});
	$('.J_Cancel').click(function(){
		$('.ks-dialog').css('display','none');
	});
	
	
	
	//区域表格
	$("#J_CityList li:odd").css("background-color","#ecf4ff");//隔行变色
	$('.gareas img').click(function(){
		var citys=$(this).parents('.gareas').siblings('.citys');
		if(citys.is(":hidden")){
			citys.css('display','block');
			$(this).parents('.ecity').addClass('showCityPop');
		}else{
			citys.css('display','none');
			$(this).parents('.ecity').removeClass('showCityPop');
		};
		citys.find('input[type=button]').click(function(){
			$(this).parents('.citys').css('display','none');
			$(this).parents('.ecity').removeClass('showCityPop');
		});
	});
	$('.gareas label').click(function(){
		var citysArea=$(this).parents('.gareas').siblings('.citys').find('span.areas');
		var citysLen=citysArea.length;
		if($(this).siblings('input[type=checkbox]:checked').attr("checked")){
			$(this).siblings('.check_num').html('');
			citysArea.find('input[type=checkbox]').attr('checked',false);
		}else{
			$(this).siblings('.check_num').html('('+citysLen+')');
			citysArea.find('input[type=checkbox]').attr('checked',true);
		}
	});
	$('.gareas input[type=checkbox]').click(function(){
		//区域判断
		var liLength=$(this).parents('li').find('.gareas input[type=checkbox]').length;
		var liChkLength=$(this).parents('li').find('.gareas input[type=checkbox]:checked').length;
		//alert(liLength);
		if(liLength==liChkLength){
			$(this).parents('li').find('.group-label input[type=checkbox').attr('checked',true);
		}else{
			$(this).parents('li').find('.group-label input[type=checkbox').attr('checked',false);
		}
		//end
		
		var citysArea=$(this).parents('.gareas').siblings('.citys').find('span.areas');
		var citysLen=citysArea.length;
		if($(this).attr("checked")){
			$(this).siblings('.check_num').html('('+citysLen+')');
			citysArea.find('input[type=checkbox]').attr('checked',true);
		}else{
			$(this).siblings('.check_num').html('');
			citysArea.find('input[type=checkbox]').attr('checked',false);
		}
	});
	
	
	//点击小类
	$('.citys .areas').click(function(){
		$(this).each(function(){
			var citysArea=$(this).parents('.citys').find('span.areas');
			var citysLen=citysArea.length;
			var citysCheckedLen=$(this).parents('.citys').find('input[type=checkbox]:checked').length;
			if($(this).find('input[type=checkbox]').attr("checked") && citysLen==citysCheckedLen){
				$(this).parents('.citys').siblings('.gareas').find('.check_num').html('('+citysCheckedLen+')');
				$(this).parents('.citys').siblings('.gareas').find('input[type=checkbox]').attr('checked',true);
				//$('.gareas input[type=checkbox]').parents('li').find('.group-label input[type=checkbox').attr('checked',true);
			}else{
				$(this).parents('.citys').siblings('.gareas').find('.check_num').html('('+citysCheckedLen+')');
				$(this).parents('.citys').siblings('.gareas').find('input[type=checkbox]').attr('checked',false);
				//$('.gareas input[type=checkbox]').parents('li').find('.group-label input[type=checkbox').attr('checked',false);
				$(this).parents('li').find('.group-label input[type=checkbox').attr('checked',false);
			}
		});
		//区域判断
		var liLength=$(this).parents('li').find('.province-list .gareas input[type=checkbox]').length;
		var liChkLength=$(this).parents('li').find('.province-list .gareas input[type=checkbox]:checked').length;
		//alert(liLength);
		if(liLength==liChkLength){
			$(this).parents('li').find('.group-label input[type=checkbox').attr('checked',true);
		}else{
			$(this).parents('li').find('.group-label input[type=checkbox').attr('checked',false);
		}
		//end
	});
	
	//点击区域
	$('.group-label').click(function(){
		//区域下的省份长度
		if($(this).find('input[type=checkbox]').attr("checked")){
			var pro=$(this).parents('li').find('.ecity').each(function(){
				var pLength=$(this).find('.citys input[type=checkbox]').length;
				$(this).find('.gareas .check_num').html('('+pLength+')');
			});
			$(this).parents('li').find('.province-list').find('input[type=checkbox]').attr('checked',true);
			
		}else{
			var pro=$(this).parents('li').find('.ecity').each(function(){
				//var pLength=$(this).find('.citys input[type=checkbox]').length;
				$(this).find('.gareas .check_num').html('');
			});
			$(this).parents('li').find('.province-list').find('input[type=checkbox]').attr('checked',false);
			
		}
	});
	
	
	
	
	

});
 
 
</script>        
      