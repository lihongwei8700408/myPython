<?php
	global $_SELLER;
	$upd = WEB_SHOPADMIN.'/index.php?c=addbusiness';
	$del = WEB_SHOPADMIN.'/index.php?c=business&other=deletebusiness';
	$template="
 		<tr>
		<td align='center'><!--{VmSContent('Id[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('Name[]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('Content[]',\$vm_data)}--></td>
    	<td align='center'><a>暂无</a>
		</td>
    	</tr>";
	


?>

<div class="content">

           <div class="userRight">
                <div class="uRight_user">
				   <div class="user_Eva_botTab">
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prize'?>">全部奖品</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prize&other=real'?>" class="curr">实物奖品</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=prize&other=virtual'?>">虚拟奖品</a>	
                    </div>
					<div class="userTitle">
                    	<span>实物奖品</span>
                    </div>
                    
                    
                    <div class="sellerSearch">
                     <div>
						
					   
					 </div>
            
					</div>
                    
                    <table class="bought_table" id="businesstable">
					   
                        <thead>
						  
                            <tr>
			
								<th>编号</th>
                                <th>奖品名称</th>
                                <th width="280">详情</th>
                                <th width="110">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $res=PrizeList('Id!=9 AND Id!=10 AND Id!=6'); echo  VwList($res,$template)?> 
                        
                        </tbody>
                       <tfoot>
                            
                        </tfoot>
                    </table> 

					
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
//单个删除
$('.del').click(function(){
	var id = $(this).attr('data-id');
	$.post("<?php echo WEB_SHOPADMIN.'/index.php?c=business&other=deletebusiness';?>",{Id:id},function(date){
	    
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
					$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=business&other=deletebusiness';?>',{'Id':data}, function (date) {	
						
						if(date==1){
							alert("操作成功！");
							window.location.reload();
						}
						else{
							alert("操作失败！");
							window.location.reload();
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
					
					$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=business&other=upbusiness';?>',{'Id':data}, function (date) {	
						
						if(date==1){
							
							alert("操作成功！");
							window.location.reload();
						}
						else{
							alert("操作失败！");
							window.location.reload();
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
					$.post('<?php echo WEB_SHOPADMIN.'/index.php?c=business&other=downbusiness';?>',{'Id':data}, function (date) {	
						
						if(date==1){
							alert("操作成功！");
							window.location.reload();
						}
						else{
							alert("操作失败！");
							window.location.reload();
						}			
					});
				}else{
					alert("请选择要操作的选项!");
				}
		      	
			 	
});
</script>
