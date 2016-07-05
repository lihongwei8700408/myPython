<?php
	global $_USER;
	$template="
 		<tr>
		<td align='center'><!--{VmSContent('Id[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('OrderId[]',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('Price[11]',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('UsePoint[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('MemberId[11]:_fun->GetMemberName',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('Id[11]:_fun->ChargeState',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('OilCard[]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('LastTime[11]:_fun->DealTime',\$vm_data)}--></td>
    	</tr>";
	


?>
<script language="javascript" type="text/javascript" src="<?php echo STATIC_DOMAIN ?>/js/laydate/laydate.js"></script>
<div class="content">

           <div class="userRight">
                <div class="uRight_user">
				   <div class="user_Eva_botTab">
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=chargerecord'?>" class="curr">全部充值记录</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=chargerecord&other=suc'?>">已成功记录</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=chargerecord&other=return'?>">等待退款记录</a>	
                    </div>
					<div class="userTitle">
                    	<span>全部充值记录</span>
                    </div>
                    <div class="sellerSearch">
                     <div>
						<form method="get" action="">
						<input type="hidden" value='chargerecord' name="c"/>
					   <?php 
						   echo ShowSearchHtml($optionSearch);
				   
						  ?>
					 </div>
            
					</div> 
                    
                   
                    <table class="bought_table" id="businesstable">
					   
                        <thead>
						  
                            <tr>
			
								<th>编号</th>
                                <th>订单编号</th>
								   <th>订单总额</th>
								   <th>抵用油金</th>
								    <th>会员名称</th>
                                 <th >订单状态</th>
								   <th width="180">充值卡号</th>
                                <th width="110">下单时间</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $res=ChargeRecordList('',''); echo  VwList($res,$template)?> 
                        
                        </tbody>
                       <tfoot>
                            
                        </tfoot>
                    </table> 

					
                      <?php 
							  $search='';
							  
							 
							 if(isset($_GET['obegin'])){
								  $search.= '&obegin='.$_GET['obegin'];
							  }
							  if(isset($_GET['oend'])){
								  $search.= '&oend='.$_GET['oend'];
							  }
							  if(isset($_GET['title'])){
								  $search.= '&title='.$_GET['title'];
							  }
							  if(isset($_GET['card'])){
								  $search.= '&card='.$_GET['card'];
							  }
							  if(isset($_GET['tel'])){
								  $search.= '&tel='.$_GET['tel'];
							  }
							  
							 echo  NewPage($search);
							 

						?>
					
                    <!-- 分页 结束 -->
            
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
$('.sellbutton').click(function(){
	var id = $(this).attr('data-id')
	location.href='<?php echo WEB_SHOPADMIN;?>/index.php?c=prizedelivery&Id='+id;
}) 
</script>    