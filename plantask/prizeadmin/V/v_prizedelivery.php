<?php 
	$template = "<td align='left' width='420'><a href='' class='left'><img src='<!--{VmSContent('TitlePic[]',\$vm_data)}-->' style='display:inline;'/></a>
		<a href='' class='left'><!--{VmSContent('Title[30]',\$vm_data)}--></a><span class='left'><!--{VmSContent('Price[]',\$vm_data)}-->*<!--{VmSContent('BuyNum[]',\$vm_data)}--></span></td>";
	$templates = "<form action='' method='post'><tr>
                                        	<td><!--{VmSContent('CompanyName[]',\$vm_data)}--></td>
                                        	<td><input type='text' name='PostNumber'></td>
                                        	<td></td>
	
											<input type='hidden' name='PostCompany' value='<!--{VmSContent('Id[]',\$vm_data)}-->'/>
                                        	<td><input type='submit' value='确认' name='submit' class='qr'></td>
                </form></tr>";
	
	$info = GetMemInfo($res->MemberId);
?>

<div class="content">

         <div class="userRight">
				<div class="uRight_user">
					<div class="userTitle">
                    	<span>发货</span>
                    </div>
					
					
                    <div class="deliverGoods">
                    	<h2><b>第一步</b>确认收货信息及交易详情</h2>
                         <table class="tables Confirm_good">
                        	<thead>
                            	<tr>
                              		<th align="left" colspan="2">奖品记录编号：<?php echo $res->Id;?> &emsp; 创建时间：<?php echo date('Y-m-d H:i:s',$res->Time);?></th>
                                </tr>
                             </thead>
                             <tbody>
                            <!--	<tr>
                              		
                              	<td align='left' width='420'><a href='' class='left'><img src='' style='display:inline;'/></a>
										<a href='' class='left'><?php echo $res->GameName;?></a><span class='left'>* 1 </span></td>
                              		<td align="left" width="410">
                                    	<p>买家选择：</p>
                                        <p><span class="left">我的备忘：</span><textarea class="left" disabled="disabled"></textarea></p>
                                    
                                    </td>
                                </tr>-->
                                <tr>
                                	<td colspan="2" height="30">买家收货信息：姓名：<?php echo $info->RealName;?>&nbsp;手机：<?php echo $info->Tel;?>&nbsp;收货地址：<?php echo MemberAddress($res->MemberId);?> <a id="update" href="javascript:;">修改</a>
									<div id="address" style="display:none;"><form method="post" action=""><input type="hidden" name="MemberId" value="<?php echo $res->MemberId;?>"/><input type="text" name="PrizeAddress" style="width:200px;" value="<?php echo MemberAddress($res->MemberId);?>"/>&nbsp;&nbsp;<input type="submit" name="submitaddress"/></form></div>
									</td>
                                </tr>
                             </tbody>
                        </table>
                    	<h2><b>第二步</b>确认发货信息</h2>
                        <table class="tables">
                             <tbody>
                                <tr>
                                	<td>我的发货信息：江西车联</td>
                                </tr>
                                <!--<tr>
                                	<td>
                                    	我的退货信息：江西车联
                                    
                                    </td>
                                </tr>-->
                             </tbody>
                        </table>
                    	<h2><b>第三步</b>选择物流服务</h2>
                        <div style="width:700px;">
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
										
                                    	<?php $res =  MallPostCompany(); echo  VwList($res,$templates);?>
                                    <!--	<form action='' method='post'>
                                    	<tr>
                                        	<td>其他 <input type="text" name="PostCompany"/></td>
                                        	<td><input type='text' name='PostNumber'></td>
                                        	<td></td>
                                        	<td><input type="button" name="submit" value="确认" class="qr"></td>
											
                                        </tr>
										</form>-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
<script>
$('#update').click(function(){
	$('#address').css('display','block');
})
</script>        
      
