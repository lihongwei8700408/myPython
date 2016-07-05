<?php 
    global $_SELLER;
	$template="
 		
 		 
 		<tr><th  class='heng' colspan='7' align='left'>订单编号：<!--{VmSContent('Id[11]',\$vm_data)}-->
		&nbsp;&nbsp;成交时间：<!--{VmSContent('CreatTime[11]:_fun->DealTime',\$vm_data)}-->&nbsp;&nbsp;订单状态：<!--{VmSContent('State[11]:_fun->OrderState',\$vm_data)}-->&nbsp;&nbsp;买家：<!--{VmSContent('MemberId[11]:_fun->GetMemberName',\$vm_data)}-->&nbsp;&nbsp;支付金额：<!--{VmSContent('PayMoney[]',\$vm_data)}-->&nbsp;&nbsp;积分抵扣：<!--{VmSContent('UserPoint[11]',\$vm_data)}-->&nbsp;&nbsp;<!--{VmSContent('Id[11]:_fun->OrderDeal',\$vm_data)}--></th></tr>
 		<tr>
    	<!--{VmSContent('Id[11]:_fun->OrderSmallTemp',\$vm_data)}-->
		";

     

?>
<script language="javascript" type="text/javascript" src="<?php echo STATIC_DOMAIN ?>/js/laydate/laydate.js"></script>
<div class="content">

          <div class="userRight">
                <div class="uRight_user">
				   <div class="user_Eva_botTab">
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order'?>">全部订单</a>
                          	<a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order&other=noreciveorder'?>">待接收订单</a>
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order&other=noconfirmorder'?>">待服务订单</a>
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order&other=norevieworder' ?>"  class="curr">待评价订单</a>
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order&other=endorder'?>">交易完成</a>
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=order&other=closeorder'?>">交易关闭</a>	
                    </div>
					<div class="userTitle">
                    	<span>待评价订单</span>
                    </div>
                    
                    
                    <div class="sellerSearch">
                     <div>
						<form method="get" action="">
						<input type="hidden" value='order' name="c"/>
					   <?php 
						   echo ShowSearchHtml($optionSearch);
				   
						  ?>
					 </div>
            
					</div>
                    
                    <table class="bought_table">
                        <thead>
                            <tr>
                                <th style="text-align:center">服务名称</th>
								   <th  style="text-align:center">服务类别</th>
                                <th width="80"  style="text-align:center">门市价（元）</th>
								   <th width="80"  style="text-align:center">网络价（元）</th>
                                <th width="80"  style="text-align:center">服务时间</th>
                                
                            </tr>
                        </thead>
                        
 		                <tbody>
                        <?php  $res=OrderList(2,$_SELLER->SellerId);
           						echo  VwList($res,$template)?> 
                        
                        
 		                </tbody>
                        <tfoot>
                        </tfoot>
                    </table> 
                   <!-- <div class="bought_shanchu">
                        <div class="grey"></div>
                        <div class="bought_tanchu">
                            <p>确定要删除么？</p>
                            <a href="javascript:;" class="queding">确定</a>
                            <a href="javascript:;" class="quxiao">取消</a>
                        </div>
                           <div class="bought_tanchu2" id="bought_tanchu">
                            <p>确定要删除么？</p>
                            <a href="javascript:;" class="queding2" id="queding">确定</a>
                            <a href="javascript:;" class="quxiao2" id="quxiao">取消</a>
                        </div>
                    </div>   
                    <input type="hidden" id="orderdel"/>
                    <!-- 分页 开始 -->
                      <?php 
							  $search='';
							  
							  if(isset($_GET['state'])){
								  $search.= '&state='.$_GET['state'];
							  }
							 
							  if(isset($_GET['obegin'])){
								  $search.= '&obegin='.$_GET['obegin'];
							  }
							  if(isset($_GET['oend'])){
								  $search.= '&oend='.$_GET['oend'];
							  }
							 
							 echo  NewPage($search);
							 

						?>
                    <!-- 分页 结束 -->
            
                </div> 
                  
                  
            </div>
          <br>
		 
         
        
        </div>
	</div>
<script>
//时间插件
var start = {
    elem: '#fk_obegin',
    format: 'YYYY/MM/DD hh:mm:ss',
    min: '', //设定最小日期为当前日期
    max: laydate.now(), //最大日期
    istime: true,
    istoday: true,
    festival: true,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#fk_oend',
    format: 'YYYY/MM/DD 23:59:59',
    min: '',
    max: laydate.now(),
    istime: true,
    istoday: true,
    festival: true,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};
laydate(start);
laydate(end);   
</script>    
        
       
