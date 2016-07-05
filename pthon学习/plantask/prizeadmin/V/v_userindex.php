<?php 
	$o = strtotime(date('Y-m-d'));
	$e = time();
	$y = strtotime(date('Y-m-d',strtotime('-1 day')));
	$ye = $o - 1;
?>
<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/shopInfo.css">
<div class="contentright">
         <div class="con_top">
                <div class="con_topLt">
                    <p class="info_pic"><?php echo Avator();?></p>
                    <div class="info_con">
                        <h2>欢迎您的访问！</h2>
                        <!-- <p class="alipay">我的支付宝: <a href="#">459485299@qq.com</a></p> -->
                        <p class="alipay">用户名称: <a href="#"><?php echo $_USER->UserName;?></a></p>
                        <p class="insurance">
                           
                        </p>
                    </div>
                </div>
                <div class="con_topRt">
                    <h3>登录动态</h3>
                    <div class="comm_con">
                       <p>总计登录次数：<span><?php echo CountLogin();?></span> 次</p>
					     <p>上次登录时间：<span><?php echo PreLoginTime();?></span></p>
                    </div>
                </div>
            </div><!-- con_top -->
            <div class="con_center">
                <div class="conCenterLt">
                    <p class="sort1">待办事务</p>
                    <div class="sectionA">
                        <p class="item_con">奖品管理</p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prize'?>">开心转盘实物奖品: <span>7</span> 件</a></p>
                       
                    </div>
                    <div class="sectionB">
                    	<p class="item_con">待发奖品管理</p>
						  <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=nopost'?>">待发奖品总数: <span><?php echo ListPrizeCount('cl_game','Type!=10 AND Type!=9  AND Type!=6 AND State=0','Id')?></span> 件</a></p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=nopost'?>">今日待发奖品: <span><?php echo ListPrizeCount('cl_game','Type!=10 AND Type!=9  AND Type!=6 AND State=0 and Time >='.$o,'Id')?></span> 件</a></p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=alreadypost'?>">今日已发奖品: <span><?php echo CountPostRecord('CreatTime >='.$o);?></span> 件</a></p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=nopost'?>">今日剩余待发奖品: <span><?php $a = ListPrizeCount('cl_game','Type!=10 AND Type!=9 AND State=0 and Time >='.$o,'Id');$b = CountPostRecord('CreatTime between '.$o.' and '.$e); echo $a-$b;?><?php echo CountServiceOrder('_count','SellerId='.$_SELLER->SellerId.' AND State=2');?></span> 件</a></p>
                        
                    </div>
                    <div class="sectionA">
                        <p class="item_con">近期统计</p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prizerecord&other=alreadypost'?>">近期已发送奖品: <span><?php echo ListPrizeCount('cl_game','Type!=10 AND Type!=9 AND State=1','Id');?></span> 件</a></p>
                        <p class="item">昨日已发奖品: <span><?php echo CountPostRecord('CreatTime between '.$y.' and '.$ye);?></span> 件</p>
                    </div>
                </div>
                <!--<div class="conCenterRt">
                    <p class="sort1">商城待办</p>
                    <div class="sectionA">
                        <p class="item_con">商品管理</p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallproductadmin&other=onproductadmin'?>">出售中的实物商品: <span><?php echo CountSellerProduct('_count','SellerId='.$_SELLER->SellerId.' AND State=2 AND Type=2');?></span></a></p>
                         <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallproductadmin&other=offproductadmin'?>">等待上架的实物商品: <span><?php echo CountSellerProduct('_count','SellerId='.$_SELLER->SellerId.' AND State=1 AND Type=2');?></span></a></p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=oncouponadmin'?>">出售中的代金券: <span><?php echo CountSellerProduct('_count','SellerId='.$_SELLER->SellerId.' AND State=2 AND Type=1');?></span></a></p>
                        <p class="item"><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=offcouponadmin'?>">等待上架的代金券: <span><?php echo CountSellerProduct('_count','SellerId='.$_SELLER->SellerId.' AND State=1 AND Type=1');?></span></a></p>
                       
                    </div>
                    <div class="sectionB">
                        <p class="item_con">订单管理</p>
                        <p class="item"> <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=morder&other=nopaymallorder';?>">待付款订单: <span><?php echo CountMallOrder('_count','SellerId='.$_SELLER->SellerId.' AND State=1');?></span></a></p>
                        <p class="item"> <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=morder&other=postmallorder';?>">待发货订单: <span><?php echo CountMallOrder('_count','SellerId='.$_SELLER->SellerId.' AND State=2');?></span></a></p>
                        <p class="item"> <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=morder&other=reviewmallorder';?>">待评价订单: <span><?php echo CountMallOrder('_count','SellerId='.$_SELLER->SellerId.' AND State=4');?></span></a></p>
                        
                    </div>
                    <div class="sectionA">
                        <p class="item_con">活动订购</p>
                        <p class="item">新活动申请: <span>21</span></p>
                        <p class="item">在线活动续费: <span>0</span></p>
                    </div>
                </div>
        </div>-->
	</div>
 </div>
