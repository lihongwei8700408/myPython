<style>
.check_each{float:left;}
.postpic{width:90px; height:50px; float:left;}
</style>

<div class="content">
	
<div class="userRight">
                <div class="uRight_user">
				   <div class="userTitle">
                    	<span>物流工具 > 运单模板设置</span>
                    </div>
                    <div class="user_Eva_botTab">
                      <!--<a href="/user/sellposttools">服务商设置</a>-->
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates'?>">运费模板设置</a>
						<!--<a href="/<?php echo WEB_CITY?>/user/sellposttools">运费/时效查看器</a>
						<a href="/<?php echo WEB_CITY?>/user/sellposttools">物流跟踪信息</a>
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=address'?>" >地址库</a>-->
						<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=posttemplates&other=book'?>" class="curr">运单模板设置</a>		
                    </div>
                     <div class="waybill">
                    	<div class="waybill_list">
                        	<dl>
                            	<dt>选择模板：</dt>
                                <dd>
                                	<select>
                                    	<option>请选择系统模板</option>
                                    	<option>请选择系统模板</option>
                                    	<option>请选择系统模板</option>
                                    	<option>请选择系统模板</option>
                                    	<option>请选择系统模板</option>
                                    	<option>请选择系统模板</option>
                                    </select>
                                </dd>
                            </dl>
                        	<dl>
                            	<dt>模板名称：</dt>
                                <dd><input type="text"></dd>
                            </dl>    
                        	<dl>
                            	<dt>快递公司：</dt>
                                <dd>
                                	<select>
                                    	<option>安能物流</option>
                                    	<option>安能物流</option>
                                    	<option>安能物流</option>
                                    	<option>安能物流</option>
                                    	<option>安能物流</option>
                                    </select>
                                </dd>
                            </dl>
                        	<dl>
                            	<dt>运单图片：</dt>
                                <dd>
                                	<form action="" method="post">
                                        <input type="file">
                                        <input type="submit" value="上传">
                                    </form>
                                </dd>
                            </dl>
                        	<dl>
                            	<dt>模板尺寸：</dt>
                                <dd class="mbcc">
                                	<select>
                                    	<option>自定义尺寸</option>
                                    	<option>300*200</option>
                                    	<option>200*150</option>
                                    </select>
                                    <span>宽：<input type="text" style="width:50px;">mm</span>
                                    <span>高：<input type="text" style="width:50px;">mm</span>
                                    <input type="button" value="重设高度">
                                </dd>
                            </dl>
                        	<dl>
                            	<dt>选择打印项：</dt>
                                <dd>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                	<label><input type="checkbox"> 订单编号</label>
                                </dd>
                            </dl>
                        </div>
                        <div class="waybill_box">
                        	<h2>打印偏移校正</h2>
                            <div class="waybill_box_mb">
                            	<img src="<?php echo STATIC_DOMAIN?>/images/ydmb.JPG" style="width:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
</div>
        
      