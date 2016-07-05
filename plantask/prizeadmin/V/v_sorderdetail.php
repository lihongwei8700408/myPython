<?php 
	if(isset($_GET['Id'])){
		$id = $_GET['Id'];
		$res = MallPostInfo($id);
	}
	
?>
<style>
.sold_stateBtn{display:none}

</style>
<div class="FLuser">
	<div class="wrapper">
					
        <div class="seller_sold">
            <div class="seller_sold_state">
                <h4>当前订单状态：<?php echo $res->State;?></h4>
                <div class="sold_stateBtn delivery">
                    <a href="" class="fh">发货</a>
                    <a href="javascript:;" class="words" >填写备注</a>
					
                    <!--<a href="javascript:;">标记</a>-->
                </div>
				
				<div class="sold_stateBtn delay">
                    <a href="javascript:;" data="" class="fh yan">延迟收货</a>
					<a href="javascript:;" class="words" >填写备注</a>
                    <!--<a href="javascript:;">标记</a>-->
                </div>
				<div class="sold_stateBtn cancel">
                    <a href="javascript:;" data="" class="fh qu">取消订单</a>
                    <a href="javascript:;" class="words">填写备注</a>
                    <!--<a href="javascript:;">标记</a>-->
                </div>
				<div class="sold_stateBtn del">
                    <a href="javascript:;" data="" class="fh shan">删除订单</a>
                     <a href="javascript:;" class="words">填写备注</a>
                    <!--<a href="javascript:;">标记</a>-->
                </div>
				<div class="sold_stateBtn return">
                    <a href="" class="fh">去管理退款/退货</a>
                    <a href="javascript:;" class="words">填写备注</a>
                    <!--<a href="javascript:;">标记</a>-->
                </div>
				 
                <hr>
                <h6>车联集团提醒您</h6>
                <p>1.买家已付款，请尽快发货，否则买家有权申请退款。</p>
                <p>2.如果无法发货，请及时与买家联系并说明情况。</p>
                <p>3.买家申请退款后，须征得买家同意后再操作发货，否则买家有权拒收货物。</p>
                
            </div>
            <div class="mt20" style="margin-left: 5px; margin-top:5px;">
                <div class="sellerSold_tab">
                    <a href="javascript:;" class="curr">订单信息</a><a href="javascript:;">收货和物流信息</a>
                </div>
                <div class="sellerSold_box">
					
                    <div class="sellerSold_Each ddxx">
					    <h6>订单信息</h6>
						 <div class="ddxx_info">
                           <?php 
							if($res->AutoOverTime){
								
								echo 
								   " <dl>
                                    <dt>订单到期日期：</dt>
                                    <dd>".date('Y-m-d h:i:s',$res->AutoOverTime)."</dd>
                                    </dl>";
							}?>
							<dl>
                                    <dt>卖家备注：</dt>
                                    <dd> </dd>
                                    </dl>
						</div>
                        <h6>买家信息</h6>
                        <div class="ddxx_info">
                            <dl>
                                <dt>昵称：</dt>
                                <dd></dd>
                            </dl>
                            <dl>
                                <dt>真实姓名：</dt>
                                <dd></dd>
                            </dl>
                            <dl><dt>所在城市：</dt>
                                <dd></dd>
                            </dl>
                            <dl>
                                <dt>联系电话：</dt>
                                <dd></dd>
                            </dl>
                            <dl>
                                <dt>电子邮箱：</dt>
                                <dd></dd>
                            </dl>
                            <dl>
                                <dt>支付宝：</dt>
                                <dd></dd>
                            </dl>
							
                        </div>
                        <table class="tables">
                            <thead>
                                <tr>
                                    <th>宝贝</th>
                                  
                                    <th width="150">状态</th>
                                    <th width="100">单价</th>
                                    <th width="100">数量</th>
                                    <th width="100">小计</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <td align="center"><img src="" longdesc="#" /><a href="" class="shop_name"><?php echo $info['Title']?></a></td>
    
                            <td align="center"></td>
                            <td align="center" class="danjia"></td>
                            <td align="center"></td>
                            <td align="center"><span class="zongjia"></span></td>
                            
                        </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                     <th colspan="6" align="right"><form action=''class="saleform" method='post' style="display:none;">优惠：<input name="sale" class = 'salemoney' type="text"/>元<input type="submit" class="sale" value="确认"/></form>应付款：<span id="span1" class="zongjia"><?php echo $info['Num']*$info['Price']?></span>元&nbsp;实付款：<span id="span1" class="total"><?php echo  $info['OrderMoney'];?></span>元</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="sellerSold_Each wlxx">
                        <h6>物流信息</h6>
                        <p>收货地址：</p>
                        <p>运送方式：</p>
						<p>物流跟踪：</p>
                    </div>
                </div>
            </div>
           <!--  <div class="site_shanchu">
                        <div class="grey"></div>
                        <div class="site_tanchu delc">
                            <p>确定删除订单吗？</p>
                            <a href="javascript:;" class="queding" >确定</a>
                            <a href="javascript:;" class="quxiao">取消</a>
                             <input type="hidden" id="deleteid" >
                        </div>
                    </div>
					
					<div class="site_shanchu">
                        <div class="grey"></div>
                        <div class="site_tanchu cancelc">
                            <p>确定取消订单吗？</p>
                            <a href="javascript:;" class="queding" >确定</a>
                            <a href="javascript:;" class="quxiao">取消</a>
                             <input type="hidden" id="deleteid" >
                        </div>
                    </div>
                    <div class="site_shanchu">
                        <div class="grey"></div>
                        <div class="site_tanchu delayc">
                            <p>确定延迟收货吗？</p>
                            <a href="javascript:;" class="queding" >确定</a>
                            <a href="javascript:;" class="quxiao">取消</a>
                             <input type="hidden" id="deleteid" >
                        </div>
                    </div>	-->
        </div>
    </div>
</div>
<script>
$(function(){
	$('.sellerSold_Each:gt(0)').hide();
	var sellerSold_tab = $('.sellerSold_tab a');
	sellerSold_tab.click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
		
		$('.sellerSold_Each').eq(sellerSold_tab.index(this)).show().siblings().hide();
	});
	$('.sale').click(function(){
		var sale = $('.salemoney').val();
		var total ="<?php echo $info['OrderMoney']?>";
		var orderMoney = total - sale;
		$('.total').text(orderMoney);
			
	});
	var c = Number(<?php echo $c;?>);
	
	switch(c){
		case 1:
		$('.cancel').css('display','block');
		$('.saleform').css('display','inline-block');
		
		break;
		case 2:
		$('.delivery').css('display','block');
		break;
		case 3:
		$('.delay').css('display','block');
		break;
		case 4:
		$('.del').css('display','block');
		break;
		case 8:
		$('.return').css('display','block');
		break;
		case 9:
		$('.return').css('display','block');
		break;
	}
	var _this=''
	  	$('.del_site').click(function(){
	  		_this=$(this);
	  		 var dIde=_this.attr("data");
	  		 document.getElementById('deleteid').value=dIde;
	  		$('.grey').css('display','block');
	  		$('.delc').css('display','block');
	  		
	  		$('.quxiao').click(function(){
	  			$('.grey').css('display','none');
	  			$('.delc').css('display','none');
	  		});
	  		$('.queding').click(function(){
	           
				 var data=new Array();
				
				var t_tr=$('#selltable tr')
						t_tr.each(function(){
							var t_input=$(this).find("th input[name='S_id[]']:checked");
							var val=t_input.val();
						
							if (!isNaN(Number(val)))
							{
								data.push(val);
							}
				});
				
				if(data.length > 0){
					$.post('<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout/del',{'S_id[]':data}, function (data) {	
						
						if (data != null && data){
							location.reload();
						}else{
							alert("操作失败！");
						}
					});
				}else{
					alert("请选择要操作的选项!");
				}
		      	
			  })	
		});
		$('.qu').click(function(){
	  		_this=$(this);
	  		
	  		$('.grey').css('display','block');
	  		$('.cancelc').css('display','block');
	  		
	  		$('.quxiao').click(function(){
	  			$('.grey').css('display','none');
	  			$('.cancelc').css('display','none');
	  		});
	  		$('.queding').click(function(){
	           
				var d = _this.attr("data");
				
				if(d > 0){
						$.post('<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout/cancel',{'id':d}, function (data) {	
							
							if (data != null && data){
								location.href="<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout";
							}else{
								alert("操作失败！");
							}
						});
					}
							
			  })	
		});
		$('.shan').click(function(){
	  		_this=$(this);
	  		
	  		$('.grey').css('display','block');
	  		$('.delc').css('display','block');
	  		
	  		$('.quxiao').click(function(){
	  			$('.grey').css('display','none');
	  			$('.delc').css('display','none');
	  		});
	  		$('.queding').click(function(){
	           
				var d = _this.attr("data");
	
				if(d > 0){
						$.post('<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout/del',{'S_id[]':d}, function (data) {	
							
							if (data != null && data){
								location.href="<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout";
							}else{
								alert("操作失败！");
							}
						});
					}
							
			  })	
		});
		$('.yan').click(function(){
	  		_this=$(this);
	  		
	  		$('.grey').css('display','block');
	  		$('.delayc').css('display','block');
	  		
	  		$('.quxiao').click(function(){
	  			$('.grey').css('display','none');
	  			$('.delayc').css('display','none');
	  		});
	  		$('.queding').click(function(){
	           
				var d = _this.attr("data");
	
				if(d > 0){
						$.post('<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout/delay',{'id':d}, function (data) {	
							
							if (data != null && data){
								location.href="<?php echo MALLDOMAIN ?>/<?php echo WEB_CITY?>/user/sellout";
							}else{
								alert("操作失败！");
							}
						});
					}
							
			  })	
		});
	
$('.words').click(function(){
	
	
	
	
})

});
</script>