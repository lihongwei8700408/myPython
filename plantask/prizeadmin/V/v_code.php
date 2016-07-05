<?php
	global $_USER;
	$template="
 		<tr>
		<td align='center'><!--{VmSContent('MemberId[11]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('MemberName[]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('Tel[]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('VerifyCode[]',\$vm_data)}--></td>
    	</tr>";
	


?>

<div class="content">

           <div class="userRight">
                <div class="uRight_user">
				   <div class="user_Eva_botTab">
                            <a href="#" class="curr">查看短信验证码</a>
                    </div>
					<div class="userTitle">
                    	<span>查看全部</span>
                    </div>
                    <div class="sellerSearch">
                     <div>
						<form method="get" action="">
						<input type="hidden" value='code' name="c"/>
					   <?php 
						   echo ShowSearchHtml($optionSearch);
				   
						  ?>
					 </div>
            
					</div> 
                    
                   
                    <table class="bought_table" id="businesstable">
					   
                        <thead>
						  
                            <tr>
			
								<th>编号</th>
                                <th width="200">会员昵称</th>
                                <th width="280">手机号码</th>
                                <th width="110">验证码</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $res=CodeList(); echo  VwList($res,$template)?> 
                        
                        </tbody>
                       <tfoot>
                            
                        </tfoot>
                    </table> 

					
                      <?php 
							  $search='';
							  
							  if(isset($_GET['statename'])){
								  $search.= '&statename='.$_GET['statename'];
							  }
							  
							  if(isset($_GET['titletel'])){
								  $search.= '&titletel='.$_GET['titletel'];
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
