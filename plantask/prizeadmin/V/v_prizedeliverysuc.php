<?php 
   
?>

<div class="content">

        <div class="userRight">
				<div class="uRight_user">
					<div class="userTitle">
                    	<span>发货成功</span>
                    </div>
                    <div class="deliverGoods">
						<div class="deliGood_succ">恭喜您，操作成功！</div>
                        <div class="deliGood_detail">
                        	<h4>物流信息</h4>
                            <dl>
                            	<dt>发货方式：</dt>
                                <dd>自己联系</dd>
                            </dl>
                            <dl>
                            	<dt>物流编号：</dt>
                                <dd><?php echo $res->Id;?></dd>
                            </dl>
                            <dl>
                            	<dt>物流公司：</dt>
                                <dd><?php echo GetCName($res->PostCompany);?></dd>
                            </dl>
                            <dl>
                            	<dt>运单号码：</dt>
                                <dd><?php echo $res->PostNumber;?></dd>
                            </dl>
                            <dl>
                            	<dt>下单信息：</dt>
                                <dd> 订单创建</dd>
                            </dl>
                            <dl>
                            	<dt>&nbsp;</dt>
                                <dd> 发货完成</dd>
                            </dl>
                            <dl>
                            	<dt>物流跟踪：</dt>
                                <dd>暂无消息</dd>
                            </dl>
                            <dl>
                            	<dt>&nbsp;</dt>
                                <dd><p class="f_Tips">以上部分信息来自第三方，您可以点击展开每条信息并查看其来源</p></dd>
                            </dl>
						</div>
                        
                        	
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
        
      
