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
                              <dd><span class=""><a href=""><small>[<?php echo CountSellerService('_count','SellerId='.$_SELLER->SellerId.' AND IsMarket=1');?>个 ]</small></a></span></dd>
                          </dl>
                           <dl>
                              <dt>待接收的订单：</dt>
                              <dd><span class=""><a href=""><small>[<?php echo CountSellerService('_count','SellerId='.$_SELLER->SellerId.' AND IsMarket=1');?>个 ]</small></a></span></dd>
                          </dl>
                          <dl>
                              <dt>待确认的订单：</dt>
                               <dd><span class=""><a href=""><small>[<?php echo CountSellerService('_count','SellerId='.$_SELLER->SellerId.' AND IsMarket=1');?>个 ]</small></a></span></dd>
                          </dl>
                         
                          <dl>
                              <dt>待评价订单：</dt>
                               <dd><span class=""><a href=""><small>[<?php echo CountSellerService('_count','SellerId='.$_SELLER->SellerId.' AND IsMarket=1');?>个 ]</small></a></span></dd>
                          </dl>
                         
                    </div>
                      
                  </div>
  
                <div class="user_tips" >
				
				<div style="float:left;width:300px"><p><b></b><p>您有条未读的站内信</p><br/>
				<p></p>
				<p>您上次登录时间是</p><br>
				
				<p>您总计登录次</p><br>
			    <p>您已经在本商城消费元</p>
        		
        		
				</div>
				<div style="float:right;width:390px">
				
				<h3 style="color:#A63A3E">近期公告:</h3><br>
				
				
				
				
				<p>
				
				</p>
				</div>
				
					<div style="float:right;width:200px">
				
				<h3>我的订单:</h3><br>
				<p>
				<span>购物车件商品<br><br>
				<span>您总共有</span>件订单<br><br>
	
				</p>
				</div>
				<div style="clear: both"></div>
				</div>

                <div class="uRight_user">

				
					
                </div> 
                  
                  
				<div class="uRight_browse">
                    <div class="userRight_tit">
                        <div class="userRight_titL">您最近浏览的商品</div>
                    </div>
                    <ul class="uRight_browse_list">
                   
                    	
                    </ul>				                            
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
        
       