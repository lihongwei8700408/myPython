<?php
	global $_SELLER;
	$upd = WEB_SHOPADMIN.'/index.php?c=addmallcoupon';
	$template="
 		<tr>
		<td align='left'><input class='check-one check_each'  name='Id[]' type='checkbox' value='<!--{VmSContent('Id[11]',\$vm_data)}-->'/></td>
    	<td align='left'><img  class='orderpic' src='<!--{VmSContent('TitlePic[]',\$vm_data)}-->'><a href='' class='title'><!--{VmSContent('Title[50]',\$vm_data)}--></a></td>
    	<td align='center'><!--{VmSContent('Price[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('CheapPrice[11]',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('BaseNum[11]',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('SaleNum[11]',\$vm_data)}--></td>
		<td align='center'><!--{VmSContent('State[]:_fun->GoodsState',\$vm_data)}--></td>
    	<td align='center'><a href=".$upd."&Id=<!--{VmSContent('Id[11]',\$vm_data)}--> class='ordetail' data-id=<!--{VmSContent('Id[11]',\$vm_data)}-->>修改</a>
		</td>
    	</tr>";
	


?>
<div class="content">

           <div class="userRight">
                <div class="uRight_user">
				   <div class="user_Eva_botTab">
                           <a  href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin';?>">全部代金券</a>
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=oncouponadmin';?>" >上架中</a>
                            <a  href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=offcouponadmin';?>">未上架</a>
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=selleroffcouponadmin';?>">手动下架</a>
                            <a  class="curr" href="<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=autooffcouponadmin';?>">售完下架</a>
                    </div>
					<div class="userTitle">
                    	<span>售完下架</span>
                    </div>
                    
                    
                    <div class="sellerSearch">
                     <div>
						<form method="get" action="">
						<input type="hidden" value='mallcouponadmin' name="c"/>
					   <?php 
						   echo ShowSearchHtml($optionSearch);
				   
						  ?>
					   </div>
            
						</div>
                    
                    <table class="bought_table" id="businesstable">
					   
                        <thead>
						  
                            <tr><th width=""  colspan="9" align="left"><input class='check-one check_all' type='checkbox' />全选<a href="javascript:;" class="sellbutton delall">删除</a></th></tr>
                          
                            <tr>
							    <th align="center">编号</th>
                                <th align="center">商品名称</th>
                                <th align="center" width="80">门市价（元）</th>
								<th align="center" width="80">网络价（元）</th>
								<th align="center" width="60">库存</th>
                                <th align="center" width="60">销量</th>
                                <th align="center" width="60">状态</th>
                                <th align="center" width="110">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $res=CouponList('(3)',$_SELLER->SellerId); echo  VwList($res,$template)?> 
                        
                        </tbody>
                       <tfoot>
                            
                        </tfoot>
                    </table> 
					<div style="margin-top:10px;"><strong>备注：</strong>您可以将希望上架的服务打钩，然后按"<span style="color:red">上架</span>"的确认键，您的服务马上就会和大家见面了。</div>
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
							  if(isset($_GET['classid'])){
								  $search.= '&classid='.$_GET['classid'];
							  }
							  if(isset($_GET['title'])){
								  $search.= '&title='.$_GET['title'];
							  }
							  if(isset($_GET['obegin'])){
								  $search.= '&obegin='.$_GET['obegin'];
							  }
							  if(isset($_GET['oend'])){
								  $search.= '&oend='.$_GET['oend'];
							  }
							  if(isset($_GET['project'])){
								  $search.= '&project='.$_GET['project'];
							  }
							  
							  global $count;
							  $prm = (object)array();
							  $prm->total = $count; //总数
							  $prm->perNum = PAGE; //每页显示条数
							  $prm->showBtn = '5'; //最大显示按钮数量
							  $prm->nowPage = !isset($_GET['page']) ? 1 : $_GET['page']; //当前所处页码数
							  $prm->preUrl = 'index.php?c='.$_GET['c'].$search.'&page='; //跳转地址前缀
							  $prm->zhCss = 'color:purple;width:50px;';//中文样式可分页
							  $prm->zhCssNo = 'width:50px;color:#ccc';//中文样式不可分页
							  $prm->commonCss = 'color:red;text-decoration:none;width:24px;'; //公共样式
							  $prm->specialCss = 'font-weight:bold;color:red;width:24px;'; //当前页样式

							  VW_Page($prm);	

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
      



<script>

//全选
	$("input.check_all").click(function(){
		
		var $this=$(this);
		if($this.attr("checked")){
			$('.check_each').attr("checked",true);
		}else{
			$('.check_each').attr("checked",false);
		};
		
	});	
	$(".check_each").click(function(){
		var $this=$(this);
		var len=$(".check_each[type=checkbox]:checked").length;
		var tlen=$(".check_each[type=checkbox]").length;
		if(len==tlen){
			$("input.check_all").attr("checked",true);	
		}else{
			$("input.check_all").attr("checked",false);
		}
	});
//单个上架
$('.del').click(function(){
	var id = $(this).attr('data-id');
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=upbusiness';?>",{Id:id},function(date){
	    
		if(date==1){
			alert("操作成功！");
			window.location.reload();
		}
        else{
			alert("操作失败！");
			window.location.reload();
		}			
	   
	  
	});
});
//批量删除
$('.delall').click(function(){
	           
				var data=new Array();
				
				var t_tr=$('#businesstable tr')
						t_tr.each(function(){
							var t_input=$(this).find("td input[name='Id[]']:checked");
							var val=t_input.val();
							
							if (!isNaN(Number(val)))
							{
								data.push(val);
							}
		                 });
		
				if(data.length > 0){
					$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=deletegoods';?>',{'Id':data}, function (date) {	
						
						if(date==1){
							alert("操作成功！");
							window.history.go(-3);window.location.reload();
						}
						else{
							alert("操作失败！");
							window.history.go(-3);window.location.reload();
						}			
					});
				}else{
					alert("请选择要操作的选项!");
				}
		      	
			 	
});
//批量上架
$('.upall').click(function(){
	           
				var data=new Array();
				
				var t_tr=$('#businesstable tr')
						t_tr.each(function(){
							var t_input=$(this).find("td input[name='Id[]']:checked");
							var val=t_input.val();
							
							if (!isNaN(Number(val)))
							{
								data.push(val);
							}
		                 });
		
				if(data.length > 0){
					
					$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=upgoods';?>',{'Id':data}, function (date) {	
						
						if(date==1){
							
							alert("操作成功！");
							window.history.go(-3);window.location.reload();
						}
						else{
							alert("操作失败！");
							window.history.go(-3);window.location.reload();
						}			
					});
				}else{
					alert("请选择要操作的选项!");
				}
		      	
			 	
});
//批量下架
$('.downall').click(function(){
	           
				var data=new Array();
				
				var t_tr=$('#businesstable tr')
						t_tr.each(function(){
							var t_input=$(this).find("td input[name='Id[]']:checked");
							var val=t_input.val();
							
							if (!isNaN(Number(val)))
							{
								data.push(val);
							}
		                 });
		
				if(data.length > 0){
					$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=mallcouponadmin&other=downgoods';?>',{'Id':data}, function (date) {	
						
						if(date==1){
							alert("操作成功！");
							window.history.go(-3);window.location.reload();
						}
						else{
							alert("操作失败！");
							window.history.go(-3);window.location.reload();
						}			
					});
				}else{
					alert("请选择要操作的选项!");
				}
		      	
			 	
});

</script>
