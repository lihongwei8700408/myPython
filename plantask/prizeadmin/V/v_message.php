<?php 
    global $_SELLER;
	$template="
 		<tr>
		<td align='center'><!--{VmSContent('Id[11]',\$vm_data)}--></td>
		<td align='center'><a class='apop' data-id = '<!--{VmSContent('Id[11]',\$vm_data)}-->' href='javascript:;'><!--{VmSContent('NewsTitle[]',\$vm_data)}--></a></td>
    	<td align='center'><!--{VmSContent('CreatTime[]:_fun->DealTime',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('State[]:_fun->MessageState',\$vm_data)}--></td>
    	</tr>";

     

?>
<script language="javascript" type="text/javascript" src="<?php echo STATIC_DOMAIN ?>/js/laydate/laydate.js"></script>
<div class="content">

          <div class="userRight">
                <div class="uRight_user">
				    
					<div class="userTitle">
                    	<span>站内信管理</span>
                    </div>
                    
                    
                    <div class="sellerSearch">
                     <div>
						<form method="get" action="">
						<input type="hidden" value='message' name="c"/>
					   <?php 
						   echo ShowSearchHtml($optionSearch);
				   
						  ?>
					 </div>
            
					</div>
                    
                    <table class="bought_table">
                        <thead>
                            <tr><th style="text-align:center;">编号</th>
                                <th style="text-align:center;">标题</th>
                                <th width="200" style="text-align:center;">时间</th>
                                <th style="text-align:center;">状态</th>
                            </tr>
                        </thead>
                        
 		                <tbody>
                        <?php  $res= SellerMessage();echo  VwList($res,$template)?> 
                        
                        
 		                </tbody>
                        <tfoot>
                        </tfoot>
                    </table> 
                   
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
                       <div class="grey"></div>
                    <div class="msg_tanchu">
                        <h3>我的消息<span></span></h3>
                        <div class="msg_all">
                            <dl>
                                <dt>主题：</dt>
                                <dd class="msg_title"></dd>
                            </dl>
                            <dl>
                                <dt>时间：</dt>
                                <dd class="msg_time"></dd>
                            </dl>
                            <dl>
                                <dt>发件人：</dt>
                                <dd class="msg_person">管理员</dd>
                            </dl>
                            <dl>
                                <dt>内容：</dt>
                                <dd class="msg_con"></dd>
                            </dl>
                            <dl>
                                <dt>&nbsp;</dt>
                                <dd class="msg_red">系统消息不能回复</dd>
                            </dl>
                        </div>
                    </div>
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
$('.apop').click(function(){
	var id = $(this).attr('data-id');
	$(".grey").css("display","block");
	$(".msg_tanchu").css("display","block");
	$(".msg_tanchu h3 span").click(function(){
			
			$(".grey").css("display","none");
			$(".msg_tanchu").css("display","none");
		
		});
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=message&other=updatestate';?>",{Id:id},function(data){
		//console.log(data);
	    var json=eval("("+data+")");
		$(".msg_title").html(json['NewsTitle']);
		$(".msg_time").html(json['CreatTime']);
		$(".msg_con").html(json['NewsContent']);
	});
})

</script>       
      