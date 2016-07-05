<?php
	function actionV_index(){
		global $_SELLER;
	     if(isset($_GET['Id'])&&!empty($_GET['Id'])){
			$other = 'Images,IsPost,Content';
			$update = GetUpdateMallData('*','cl_mall_goods','Id='.$_GET['Id'],$other,'cl_mall_realgoods','GoodsId='.$_GET['Id']);
			
		
		}
		$layout_content = './V/v_addproduct.php';
		include './V/layout.php';
	}
   
	function actionV_getmallclass(){
	   if(isset($_POST['ParentId'])){
	       $id = $_POST['ParentId'];
		   $sid = $_POST['ClassId'];
		   
		   echo  MallProductSecondClass($id,$sid);
		   
	   }
	}
	
	function UploadPic($data = ''){
	
	echo '<div class="pub-group">
                        	
                            <div>
                            	<div class="input-wrap">';
	
	$picTemp1 = '<div class="img_each first_img">
					<span class="close"></span>
					<div class="feng" style="display: block;"></div>
					<div class="item_img"><img src="{IMG}"></div>
					<div class="move" style="display:none;">
						<a class="lftMove" href="javascript:;"></a>
						<a class="firstImg" href="javascript:;"></a>
						<a class="rhtMove" href="javascript:;"></a>
					</div>
				</div>';
	$picTemp2 = '<div class="img_each">
					<span class="close"></span>
					<div class="feng"></div>
					<div class="item_img"><img src="{IMG}"></div>
					<div class="move" style="display:none;">
						<a class="lftMove" href="javascript:;"></a>
						<a class="firstImg" href="javascript:;"></a>
						<a class="rhtMove" href="javascript:;"></a>
					</div>
				</div>';
	$picStr = '';
	if($data)
	{
		$data = array_filter(explode('|', $data));
       
	   


		$flag = 1;
		foreach($data as $v)
		{
			$v=strtr($v,array(' '=>''));
			if($v!==''){
				if($flag)
				{
					$picStr .= str_replace('{IMG}', $v, $picTemp1);

					$flag = 0;
				}
				else
				{
					$picStr .= str_replace('{IMG}', $v, $picTemp2);

				}
			}
		}


	}
	echo '
		<div>
			<span id="spanButtonPlaceHolder"></span><span class="err_tip_style" id="Pic_Err"></span>
			
			<input id="btnCancel" type="hidden" value="取消所有上传" onClick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
		</div>
		<div id="upImg">
		'.$picStr.'
		</div>
		<div class="clear"></div>
		<div id="divStatus">已上传图片<span>0</span>/24,第一张默认为封面,每张最大2MB,支持jpg/gif/png格式.</div>

		<input id="TitlePic" name="TitlePic" type="hidden">
        <input id="Images" name="Images" type="hidden">
	';
	
	echo '</div>
                            </div>
                        </div>';
}
	if(isset($_POST['submit'])){
		
		if(isset($_POST['Title'])&&$_POST['Title']==''){
			echo '<script>alert("商品名称不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ParentId'])&&$_POST['ParentId']==''){
			echo '<script>alert("商品大类不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['ClassId'])&&$_POST['ClassId']==''){
			echo '<script>alert("商品小类不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['BaseNum'])&&$_POST['BaseNum']==''){
			echo '<script>alert("库存数量不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Price'])&&$_POST['Price']==''){
			echo '<script>alert("门市价格不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['CheapPrice'])&&$_POST['CheapPrice']==''){
			echo '<script>alert("网络价格不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Images'])&&$_POST['Images']==''){
			echo '<script>alert("商品图片不能为空");history.go(-1);</script>';
			exit;
		}
		if(isset($_POST['Content'])&&$_POST['Content']==''){
			echo '<script>alert("商品详情不能为空");history.go(-1);</script>';
			exit;
		}
		$_POST['SellerId'] = $_SELLER->SellerId;
		$_POST['AddTime'] = time();
		unset($_POST['submit']);
		unset($_POST['editorValue']);
		if($_POST['update']){
			$prm = (object)array();
			$prm->table = 'cl_mall_goods';
			$prm->update = glurSql($_POST,array('update','Content','Images','IsPost','AddTime'),',');
			$prm->where = 'Id='.$_POST['update'];
			$ret = dbUpdateOne($prm,$con);
			
			if($ret){
				$_POST['UpdateTime'] = time();
				$prm = (object)array();
				$prm->table = 'cl_mall_realgoods';
				$prm->update = glurSql($_POST,array('update','AddTime'),',');
				$prm->where = 'GoodsId='.$_POST['update'];
				$rets = dbUpdateOne($prm,$con);
			}
			else{
				echo '<script>alert("操作失败");history.go(-1);</script>';
			}
			if($rets){
				echo '<script>alert("操作成功");history.go(-1);</script>';
			}
			else{
				echo '<script>alert("操作失败");history.go(-1);</script>';
			}
		}
		else{
			unset($_POST['update']);
			$indexArray = array(
				'Type' => '2',
				'BusinessType' => '2',
				'DetailTable' => 'cl_mall_realgoods',
				'Title'=> $_POST['Title'],
				'SellerId'=> $_SELLER->SellerId,
				'ParentId'=> $_POST['ParentId'],
				'ClassId'=> $_POST['ClassId'],
				'TitlePic'=> $_POST['TitlePic'],
				'Price'=> $_POST['Price'],
				'CheapPrice'=> $_POST['CheapPrice'],
				'State'=> $_POST['State'],
				'BaseNum'=> $_POST['BaseNum'],
			
			);
			$prm = (object)array();
			$prm->table = 'cl_mall_goods';
			$prm->insert = $indexArray;
			$ret = dbInsertOne($prm,$con);
			if($ret){
				$_POST['GoodsId'] = $ret;
				$prm = (object)array();
				$prm->table = 'cl_mall_realgoods';
				$prm->insert = $_POST;
				$rets = dbInsertOne($prm,$con);
				if($rets){
					echo '<script>alert("操作成功");history.go(-1);</script>';
				}
				else{
					echo '<script>alert("操作失败");history.go(-1);</script>';//应该数据回滚删除主表数据
				}
				
			}
			else{
				echo '<script>alert("操作失败");history.go(-1);</script>';
			}
		}
	}
   
?>