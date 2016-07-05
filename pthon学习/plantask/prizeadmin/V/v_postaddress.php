<?php 

$template="<tr> <td align='center'><!--{VmSContent('Consignee[50]', \$vm_data)}--></td>
                                <td align='center'><!--{VmSContent('ProvinceId[10]:_fun->FindNamePro', \$vm_data)}--><!--{VmSContent('CityId[10]:_fun->FindNamePro', \$vm_data)}--><!--{VmSContent('TownId[10]:_fun->FindNamePro', \$vm_data)}--><!--{VmSContent('TownId[10]:jf_city(RegionId)->RegionName', \$vm_data)}--></td>
                                <td align='center'><!--{VmSContent('Address[200]', \$vm_data)}--></td>
                                <td align='center'><!--{VmSContent('Code[20]', \$vm_data)}--></td>
                                <td align='center'><!--{VmSContent('Tel[20]', \$vm_data)}--></td>
                                <td align='center'><a href='javascript:;' data=<!--{VmSContent('Id[11]', \$vm_data)}--> class='xiu'>修改</a><a href='javascript:;' class='del_site' data=<!--{VmSContent('Id[11]', \$vm_data)}-->>删除</a></td>
                                <td align='center' class='caozuo'>
                                    <span class='set_def' data=<!--{VmSContent('Id[11]', \$vm_data)}-->><a href='javascript:;' >设为默认</a></span>
                                    <span class='is_def' style='<!--{VmSContent('IsDefault[60]:_fun->CssShow', \$vm_data)}-->'><img 
		
		
		src='<!--{STATIC_DOMAIN}-->/images/default.png' ></span>
                                </td>
                            </tr>";


?>      
<div class="content">	
<div class="userRight">
                <div class="uRight_user">
				 <div class="userTitle">
                    	<span>物流工具 > 地址库</span>
                    </div>
				    
                    <div class="user_Eva_botTab">
                      <!--<a href="/user/sellposttools">服务商设置</a>-->
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates'?>">运费模板设置</a>
						<!--<a href="/<?php echo WEB_CITY?>/user/sellposttools">运费/时效查看器</a>
						<a href="/<?php echo WEB_CITY?>/user/sellposttools">物流跟踪信息</a>-->
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=address'?>" class="curr" >地址库</a>
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=book'?>" >运单模板设置</a>		
                    </div>
                    <div class="set_site">
                                    <form>
                            <dl>
                                <dt><font color="#f00">新增收货地址</font></dt>
                                <dt><i>*</i>收货地址</dt>
                                <script>var ProvinceId_default = '';var CityId_default = '';var TownId_default = '';</script>
                                
                                <dd>	
                       <?php echo $pcc?>           
					<select id="ProvinceId" name="ProvinceId">
						<option selected="selected" >--请选择--</option>
					</select>
	                <select id="CityId" name="CityId" style="display:none;">
	                    <option selected="selected">--请选择--</option>
	                </select>
	                <select id="TownId" name="TownId" style="display:none;">
	                    <option selected="selected">--请选择--</option>
	                </select><span id="CityId_Err"></span>
                            </select>	
                            
                	                  
								                  
                               </dd>
                                 	<dt><i>*</i>详细地址</dt>
				                    <dd><textarea id="adress" name='Address'></textarea></dd>
				                  
				                	<dt><i>*</i>邮政编码</dt>
				                    <dd><input type="text" id="code" name="Code" onblur="IsCode()"><span id="ttt" style="display: none;color:red;" name="eee"></span></dd>
				                	<dt><i>*</i>收货人姓名</dt>
				                    <dd><input type="text" id='name' class="notice_title" name="Consignee" ></dd>
				                	<dt><i>*</i>手机电话</dt>
				                    <dd><input type="text" id="telphone" name="Tel" onblur="IsTel()"><span id="tt" style="display: none;color:red;" name="ee"></span></dd>
				              
				                    <label>
				                	<dt> <input type="checkbox" name="IsDefault" id="isde" value="2"></dt>
				                    <dd>设为默认</dd>
				                    </label>
                                <dt>&nbsp;</dt>
                                <dd>
                                 <input type="hidden" id="iid" name="Id" >
                                 <input type="button" name='savebtn' value="保存" class="dizhi_baocun" id='tijiao2'>
                                </dd>
                            </dl>
                        </form>
                    </div>
                    <table class="tables site_table" id="site_table" >
                        <thead>
                            <tr>
                                <th width="100">收货人</th>
                                <th width="160">所在地区</th>
                                <th width="">详细地址</th>
                                <th width="70">邮编</th>
                                <th width="100">电话/手机</th>
                                <th width="80">操作</th>
                                <th width="100"></th>
                            </tr>
                        </thead>
                        <tbody>
                     <?php 	//$res=MEMAddressFind(); echo  VwList($res,$template);?>

                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" >提示：您最多可以保存4条地址哦</span></th>
                            </tr>
                        </tfoot>
                    </table>         
           
			
					

                </div> 
                  
                  
            </div>
         
</div>
        
      