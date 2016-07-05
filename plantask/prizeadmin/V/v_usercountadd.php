<?php 
    global $_SELLER;
	$template="
 		<tr>
		<td align='left'><!--{VmSContent('Id[11]',\$vm_data)}--></td>
		<td align='left'><!--{VmSContent('Title[]',\$vm_data)}--></td>
    	<td align='left'><!--{VmSContent('Money[]',\$vm_data)}--></td>
		<td align='left'><!--{VmSContent('Source[]',\$vm_data)}--></td>
    	<td align='center'><!--{VmSContent('CreatTime[]:_fun->DealTime',\$vm_data)}--></td>
    	</tr>";

     

?>

<div class="content">

          <div class="userRight">
                <div class="uRight_user">
				    <div class="user_Eva_botTab">
                            <a href="<?php echo WEB_SHOPADMIN.'/index.php?c=usercount';?>">收支明细</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=usercount&other=accountadd';?>" class="curr">收入明细</a><a href="<?php echo WEB_SHOPADMIN.'/index.php?c=usercount&other=accountdrop';?>">支出明细</a>		
                    </div>
					<div class="userTitle">
                    	<span>收入明细</span>
                    </div>
                    
                    
                    <div class="sellerSearch">
            
               <?php 
             //echo ShowSearchHtml($optionSearch);
           //var_dump($optionSearch);
             
             ?>
            
						</div>
                    
                    <table class="bought_table">
                        <thead>
                            <tr><th style="text-align:center;">编号</th>
                                <th style="text-align:center;">详情</th>
                                <th width="80" style="text-align:center;">金额（元）</th>
								   <th width="80" style="text-align:center;">来源</th>
                                <th width="200" style="text-align:center;">时间</th>
                                
                            </tr>
                        </thead>
                        
 		                <tbody>
                        <?php  $res= AccountList('1',$_SELLER->SellerId);
           						echo  VwList($res,$template)?> 
                        
                        
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
            
                </div> 
                  
                  
            </div>
          <br>
		
        </div>
	</div>
        
      