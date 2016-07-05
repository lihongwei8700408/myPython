<?php
	global $_SELLER;

?>

<div class="content">

          <div class="userRight">
                <div class="user_tips2">
                   <p>欢迎您，<?php echo $_SELLER->SellerName;?>，小二在此恭候多时了<img src="<?php echo STATIC_DOMAIN?>/images/lxhlike_thumb.gif"></p>
                </div>
				<div class="uRight_head">
					<div class="uRight_head_1">
						<a href="#" class="touxiang"><?php echo Avator()?></a>
                        <div class="basicInfo">
                        	<h3><a href="#"><?php echo $_SELLER->SellerName;?></a></h3>
                            <p><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=userinfo';?>">[ 商家资料 ]</a></p>
                           
                            <div class="weiqiandao">
                            	<a href="#" id="week"></a>
                            </div>
                        </div>
                        <div class="basicInfo1">
                        	<div class="icon1">
                        	<?php //if($isweb !=1){?>
                            	<!--  <a href="#"><img src="<?php echo STATIC_DOMAIN?>/images/close1.png">未开通分类通会员</a><?php //}?><a href="#"><img src="<?php echo STATIC_DOMAIN?>/images/close1.png">未开通商信透会员</a>-->
                            	
                            	
                            </div>
                            <div class="icon2">
                            	<p><b>账户余额：</b><em><?php echo $_SELLER->Money;?></em>元</p>
                            	<!--<p><b>账户积分：</b><em><?php echo $_SELLER->Money;?></em></p>-->
                            </div>
                        </div>
                      
					</div>
                    <div class="uRight_head_2">
                          <!--账户状态是否认证-->

                          <dl>
                              <dt>账户状态：</dt>
                              <dd>认证</dd>
                          </dl>
                          <!--                      		
                          <dl>
                              <dt>账户状态：</dt>
                              <dd><span class="uindexTel"><a href="#">手机已认证</a><i></i></span><span class="uindexEmail"><a href="#">邮箱已认证</a><i></i></span><span class="uindexTruename"><a href="#">实名已认证</a><i></i></span><span class="uindexCompany"><a href="#">企业已认证</a><i></i></span></dd>
                          </dl>
                          -->  
                                           
                          <dl>
                              <dt>上架中的服务：</dt>
                              <dd><span class=""><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=business&other=onbusiness'?>"><small>[<?php echo CountSellerService('_count','SellerId='.$_SELLER->SellerId.' AND Checked=2');?>个 ]</small></a></span></dd>
                          </dl>
                           <dl>
                              <dt>上架中的商品：</dt>
                              <dd><span class=""><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallproductadmin&other=onproductadmin'?>"><small>[<?php echo CountSellerProduct('_count','SellerId='.$_SELLER->SellerId.' AND State=2 AND Type=2');?>个 ]</small></a></span></dd>
                          </dl>
                          <dl>
                              <dt>待接收服务订单：</dt>
                               <dd><span class=""><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order&other=noreciveorder'?>"><small>[<?php echo CountServiceOrder('_count','SellerId='.$_SELLER->SellerId.' AND State=1');?>个 ]</small></a></span></dd>
                          </dl>
                         
                          <dl>
                              <dt>待发货商城订单：</dt>
                               <dd><span class=""><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=morder&other=postmallorder'?>"><small>[<?php echo CountMallOrder('_count','SellerId='.$_SELLER->SellerId.' AND State=2');?>个 ]</small></a></span></dd>
                          </dl>
                         
                    </div>
                      
                  </div>
  
                <div class="user_tips" >
				
				<div style="float:left;width:220px; margin-left:20px;"><p><b></b><p>您有 <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=message'?>"><?php echo SellerMessageCount();?></a> 条未读的站内信</p><br/>
				<p></p>
				<p>您上次登录时间是 <?php echo SellerLoginLog();?></p><br>
				
				<p>您总计登录 <?php echo SellerLoginCount();?> 次</p><br>
			    
				</div>
				<div style="float:right;width:290px">
				
				<h3 style="color:#A63A3E">近期公告:</h3><br>

				
				<p>
				<?php echo SellerNotice();?>
				</p>
				</div>
				
					
               <div style="clear: both"></div>
               
                  
                  
            </div>
          <br>
         
         
        </div>
        
       