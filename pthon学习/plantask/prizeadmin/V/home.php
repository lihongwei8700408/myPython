<?php
	if((!isset($_SESSION['SellerId'])) || ($_SESSION['SellerId'] == '')){	
			include './V/v_login.php';	
			exit;
					
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商家后台</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta http-equiv="MSThemeCompatible" content="Yes">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/index.css">
<script src="<?php echo STATIC_DOMAIN?>/js/common.js" type="text/javascript"></script>
<style>
.wrapper{width: 100%;overflow:hidden;min-width:1200px;}
.top{width:100%; min-width:960px;}
.ding{ height:80px;}
.yincang{ display:none;}
.goTop{ width:13px; height:68px; line-height:16px; color:#fff; background:#666666; padding:2px 3px 0; overflow:hidden; margin-top:120px; float:right; cursor:pointer;}
</style>
</head>
<body id="nv_member" class="pg_CURMODULE"><div class="" style="display: none; position: absolute;"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move;"></div><a class="aui_close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>
<div class="topbg">
<div class="top">
<div class="toplink">
<style>
.topbg{background:url(/shopadmin/resource/images/top.gif) repeat-x; height:101px; /*box-shadow:0 0 10px #000;-moz-box-shadow:0 0 10px #000;-webkit-box-shadow:0 0 10px #000;*/}
.top {
    margin: 0px auto; width: 1200px; height: 101px;
}

.top .toplink{ height:30px; line-height:27px; color:#fff; font-size:12px;}
.top .toplink .welcome{ float:left;}
.top .toplink .memberinfo{ float:right;}
.top .toplink .memberinfo a{ color:#fff;}
.top .toplink .memberinfo a:hover{ color:#F90}
.top .toplink .memberinfo a.green{ background:none; color:#fff}

.top .logo {width: 990px; color: #333; height:70px; font-size:16px;}
.top h1{ font-size:25px;float:left; width:230px; margin:0; padding:0; margin-top:6px; }
.top .navr {WIDTH:750px; float:right; overflow:hidden;}
.top .navr ul{ width:850px;}
.navr li {text-align:center; float: left; height:70px; font-size:1em; width:103px; margin-right:5px;}
.navr li a {width:103px; line-height:70px; float: left; height:100%; color: #333; font-size: 1em; text-decoration:none;}
.navr li a:hover { background:#ebf3e4;}
.navr li.menuon {background:#ebf3e4; display:block; width:103px;}
.navr li.menuon a{color:#333;}
.navr li.menuon a:hover{color:#333;}
.banner{height:200px; text-align:center; border-bottom:2px solid #ddd;}
.hbanner{ background: url(img/h2003070126.jpg) center no-repeat #B4B4B4;}
.gbanner{ background: url(img/h2003070127.jpg) center no-repeat #264C79;}
.jbanner{ background: url(img/h2003070128.jpg) center no-repeat #E2EAD5;}
.dbanner{ background: url(img/h2003070129.jpg) center no-repeat #009ADA;}
.nbanner{ background: url(img/h2003070130.jpg) center no-repeat #ffca22;}
</style>
<div class="welcome">欢迎使用车联网商家服务平台!</div>
    <div class="memberinfo" id="destoon_member">	
					你好,<a href="http://weixin.fenlei168.com/#" hidefocus="true"><span style="color:red"><?php echo $_SELLER->SellerName; ?></span></a>
			<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=logout';?>">退出</a>	
	</div>
</div>
    <div class="logo">
        <div style="float:left"></div>
            <h1><a href="http://weixin.fenlei168.com/" title="多用户微信营销服务平台"><img src="<?php echo STATIC_DOMAIN?>/images/logo.jpg"></a></h1>
            <div class="navr">
        <ul id="topMenu">           
                <li  class="menuon"><a href="<?php echo WEB_SHOPADMIN;?>">首页</a></li>
                <li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order';?>">订单管理</a></li>
                <li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=business';?>">业务管理</a></li>
				 <li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mall';?>">商城管理</a></li>
                <li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=user';?>">个人中心</a></li>
                <li><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=login';?>">帮助中心</a></li>
            
            </ul>
        </div>
        </div>
    </div>
</div>
<div id="aaa"></div>


<div id="mu" class="cl"></div>


<div id="aaa"></div>

<div id="wp" class="wp">
        <link href="<?php echo STATIC_DOMAIN?>/css/style.css" rel="stylesheet" type="text/css"> <div class="contentmanage">
    <div class="developer">
       <div class="appTitle normalTitle">
        <h2>车联网——微信端商家管理平台</h2>
        <div class="accountInfo">
        
        </div>
        <div class="clr"></div>
      </div>
      <div class="tableContent">
        <!--左侧功能菜单-->
        <div class="sideBar">
          <div class="catalogList">
            <ul class="newskin">
            	<li class="subCatalogList"> <a class="secnav_1" href="<?php echo WEB_SHOPADMIN.'/index.php?c=order';?>">订单管理</a> </li>
				<li class=" subCatalogList "> <a class="secnav_2" href="<?php echo WEB_SHOPADMIN.'/index.php?c=business';?>">业务管理</a></li>
				<li class=" subCatalogList "> <a class="secnav_3" href="<?php echo WEB_SHOPADMIN.'/index.php?c=user';?>">个人中心</a> </li>
				<li class=" subCatalogList "> <a class="secnav_3" href="<?php echo WEB_SHOPADMIN.'/index.php?c=addbusiness';?>">添加</a> </li>
				        
       
            </ul>
          </div>
        </div>

<script src="<?php echo STATIC_DOMAIN?>/js/jquery-1.7.2.js"></script>
<!--<link rel="stylesheet" href="http://weixin.fenlei168.com/tpl/static/artDialog/skins/default.css?4.1.6"><script src="./index/jquery.artDialog.js"></script>-->
<script src="<?php echo STATIC_DOMAIN?>/js/iframeTools.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">

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
                            <p><a href="">[ 商家资料 ]</a></p>
                           
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

				
					<!--  <table class="uRight_user_table" style="height:180px;">
                          <tbody>
                                <tr style="height:30px">
                                    <th colspan="4" align="left">推广管理</th>
                                </tr>
                                <tr>
                                	<td style="height:60px">
                                        <b>店铺站内推广 </b> &nbsp;&nbsp;&nbsp;
                                        <span><a href="javascript:;" style="display:inline-block;">了解更多&gt;&gt; </a></span>
                                        <p>黄金位置，精准灵活，最低0.1元起，10倍浏览量，数万客户的共</p>
                                        <p><span><a href="javascript:;" style="display:inline-block;">立即推广&gt;&gt; </a></span></p>
                                	</td>
                                	<td>
                                        <b>店铺高级优化 </b> &nbsp;&nbsp;&nbsp;<a href="javascript:;" style="display:inline-block;">了解更多&gt;&gt; </a>
                                        <p>最低0.5元/小时起，随心所欲，随时置顶，关注大不相同</p>
                                        <p><span><a href="javascript:;" style="display:inline-block;">立即优化&gt;&gt; </a></span></p>
                                	</td>
                                	<td>
                                        <b>搜索引擎全网搜索 </b> &nbsp;&nbsp;&nbsp;<span><a href="javascript:;" style="display:inline-block;">了解更多&gt;&gt; </a></span>
                                        <p>简单高效，大范围曝光，针对性更强，性价比高，轻松上手生意不发愁。</p>
                                        <p><span><a href="javascript:;" style="display:inline-block;">立即推广&gt;&gt; </a></span></p>
                                	</td>
                                </tr>
                               
                          </tbody>
                      </table>-->

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
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
  <!--底部-->
  	</div>




<style>
.IndexFoot {
	WIDTH: 100%; HEIGHT: 30px
}
.foot{ width:988px; margin:0px auto; font-size:14px; line-height:30px;}
.foot .foot_page{ float:left; width:600px;color:#000;}
.foot .foot_page a{ color:#000;}
#copyright{ float:right; width:380px; text-align:right; font-size:14px; color:#000;}
</style>
<div class="IndexFoot" style="height:58px;clear:both;padding-top:8px;">
<div class="foot">
<div class="foot_page">
<a href="http://weixin.fenlei168.com/">车联——微信商家后台管理平台...</a>
</div>
<div id="copyright" style="color:#000;">
	车联(c)版权所有 <a href="http://www.miibeian.gov.cn/" target="_blank" style="color:#000">京ICP备12011035号</a>

</div>
    </div>
</div>

<div style="display:none">

 
 </div>




<script>
$.fn.smartFloat = function() {
	var position = function(element) {
		$(window).scroll(function() {
			$('#ding').removeClass('yincang');
			var scrolls = $(this).scrollTop();
				if (window.XMLHttpRequest) {
					element.css({
						position: "fixed",
						top:0
					});	
				} else {
					element.css({
						top: scrolls
					});	
				}
		});
};
	return $(this).each(function() {
		position($(this));						 
	});
};
//绑定
$(".nav").smartFloat();
</script>
<script type="text/javascript" src="./index/scrolltopcontrol.js"></script><div style="display: none; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; cursor: move; opacity: 0; background: rgb(255, 255, 255);"></div><div id="topcontrol" title="Scroll Back to Top" style="position: fixed; bottom: 5px; right: 5px; opacity: 0; cursor: pointer;"><a href="javascript:void(0)" class="backTop">&nbsp;</a></div></body></html>