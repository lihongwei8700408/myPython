<?php
/*
共8个方法
 *VW_Crumb
 *VW_Form
 *VW_Grid
 *VW_page
 *VW_SContent
 *VW_SList
 *VW_SListByData
 *VW_Template
*/
	
	/**
	 * FUN   VW_Grid
	 * EFF   输出数据的多行列表，含复选框和操作项 
	 * PRM   $res     resource      数据查询资源集
	 * PRM   $option  array         数据呈现配置
	 * RET   无，直接输出表格了
	 * REL   
	    ===================================
	    OB_Substr
		===================================
     ****************************************************
	 * WHO   闫总
	 * TIME  2014-11-20	 
	 +++++++++++++++++++++++++++++++++++++++++++++
	 $option = array(
		'_frameWidth'=>'900',			//框架表格总宽度 只需输入数字，单位是PX
		'_frameLineWidth'=>'5',			//框架边线宽度 只需输入数字，单位是PX。默认为1
		'_rulesLineWidth'=>'2',			//内线宽度 只需输入数字，单位是PX。默认为1
		'_frameLineType'=>'double',		//框架边线类型 solid：实线：none：无边框；dotted：点状；dashed：虚线；double：双线。默认为实线
		'_rulesLineType'=>'solid',		//内线类型 solid：实线：none：无边框；dotted：点状；dashed：虚线double：双线。默认为实线
		'_LineColor'=>'blue',			//线颜色 颜色名称或颜色值。默认为黑色
		'_tableType'=>'0',				//表格类型 0：无线条；1：所有线；2：全外框+横线；3：全外框+竖线；4：横+竖线；5：横线；6：竖线
													//7：上下外框+横线；8：左右外框+竖线。默认无线条
		'_fontSize'=>'14',				//字体大小 默认等于页面字体大小
		'_rowHeight'=>'32',				//默认行高度 只需输入数字，单位是PX。默认是24
		'_titleRowHeight'=>'48',		//标题行高度 只需输入数字，单位是PX。默认是24
		'_titleFontColor'=>'red',		//标题字体颜色 颜色名称或颜色值。默认为页面字体颜色
		'_titleBackColor'=>'#C7C7E2',	//标题背景颜色 颜色名称或颜色值。默认为页面背景颜色
		'_titleRowAlign'=>'center',		//标题行对其方式 垂直均是居中，水平方向left：居左；center居中；right：居右。默认居左
		'_rulesRowAlign'=>'left',		//默认内容行对其方式 垂直均是居中，水平方向left：居左；center居中；right：居右。默认居左
		'_oddFontColor'=>'#4D0000',		//奇数行字体颜色 颜色名称或颜色值。默认为页面字体颜色
		'_oddBackColor'=>'#D1E9E9',		//奇数行背景颜色 颜色名称或颜色值。默认为页面字体颜色
		'_evenFontColor'=>'#4D0000',	//偶数行字体颜色 颜色名称或颜色值。默认为页面字体颜色
		'_evenBackColor'=>'#6FB7B7',	//偶数行背景颜色 颜色名称或颜色值。默认为页面字体颜色
		'_primary'=>'InfoId',			//唯一主键。若要显示复选框则必需设置此项，一般为记录ID，用于组合连接地址和复选框传值
		'_isCheckBox'=>'0',			//是否显示复选框 留空：不显示；大于0：显示，数值为列宽度(必需设置_primary)。默认为不显示

		'InfoId'=>array(
			'label'=>'编号',
			'type'=>'',  //空白直接输出 
			//'type'=>'fl_class(ClassId)->ClassName',  //VW_SContent('InfoId:fl_class(ClassId)->ClassName')
			//'type'=>'_fun->test',                    //VW_SContent('InfoId:_fun->test')
			
			'length'=>'5',//内容截取长度
			'width'=>'90',//宽度
			'font-color'=>'red',//文字色
			'back-color'=>'green',//背景色
			'align'=>'',//1 左 2 中 3 右  均垂直居中
		),
		'ClassId'=>array(
			'label'=>'类别',
			'type'=>'',
			'type'=>'fl_class(ClassId)->ClassName',
			'length'=>'6',//内容截取长度
			'width'=>'90',//宽度
	//		'font-color'=>'red',//文字色
			'back-color'=>'red',//背景色
			'align'=>'center',//1 左 2 中 3 右  均垂直居中
		),
		
		'Title'=>array(
			'label'=>'标题',
			'type'=>'_fun->test',
			'width'=>'80',//宽度
	//		'font-color'=>'red',//文字色
	//		'back-color'=>'green',//背景色
			'align'=>'',//1 左 2 中 3 右  均垂直居中
		),
		
		'_Operate'=>array(
			'label'=>'操作',
			'width'=>'40',
			'align'=>'center',//1 左 2 中 3 右  均垂直居中
			'check'=>array(
				'urlPre'=>'abcdefg.php?ip=',//前缀
				'image'=>'./Auditing.png',//图像路径
				'alt' =>'通过',//图像鼠标移入效果
				'padding'=>'9',
			),
			'delete'=>array(
				'urlPre'=>'abcdefg.php?did=',//前缀
				'image'=>'./delete.png',//图像路径
				'alt' =>'删除',//图像鼠标移入提示
			),
		),
	);

	VW_Grid($option,$res);
	 +++++++++++++++++++++++++++++++++++++++++++++
	 */
	function VW_Grid($option,$res)
	{
		if(!isset($option['_frameWidth']))			//表格框架总宽度为必填项
		{
			return 0;
		}

		//组装表格外框线条样式，_tableType存在并有值才画外框边线
		$tableCss = 'cellspacing="0" width="'.$option['_frameWidth'].'px"';
		if(isset($option['_tableType']) && $option['_tableType'])
		{
			$tableCss .= 'style="';
			$tdCss = 'style="';
			$tableCss .= isset($option['_frameLineType']) ? (' border-style:'.$option['_frameLineType'].';') : (' border-style:solid;');
			$tdCss .= isset($option['_rulesLineType']) ? (' border-style:'.$option['_rulesLineType'].';') : (' border-style:solid;');
			$tdCss .= isset($option['_LineColor']) ? (' border-color:'.$option['_LineColor'].';') : ' border-color:black;';
			$titleTdCss = $tdCss;
			$firstTdCss = $tdCss;
			$width = isset($option['_frameLineWidth']) ? $option['_frameLineWidth'] : 1;
			if($option['_tableType'] > 0 && $option['_tableType'] < 4)
			{
				$tableCss .= ' border-width:'.$width.'px '.$width.'px '.$width.'px '.$width.'px;';
			}
			else if($option['_tableType'] == 7)
			{
				$tableCss .= ' border-width:'.$width.'px 0px '.$width.'px 0px;';
			}
			else if($option['_tableType'] == 8)
			{
				$tableCss .= ' border-width:0px '.$width.'px 0px '.$width.'px;';
			}
			else
			{
				$tableCss .= ' border-width:0px;';
			}
			$tableCss .= isset($option['_LineColor']) ? (' border-color:'.$option['_LineColor'].';"') : ' border-color:black;"';


			//组装表格内线条样式
			$width = isset($option['_rulesLineWidth']) ? $option['_rulesLineWidth'] : 1;
			if($option['_tableType'] == 1 || $option['_tableType'] == 4)
			{
				$tdCss .= ' border-width:'.$width.'px 0px 0px '.$width.'px;';
				$firstTdCss .= ' border-width:'.$width.'px 0px 0px 0px;"';
				$titleTdCss .= ' border-width:0px 0px 0px '.$width.'px;"';
			}
			else if($option['_tableType'] == 2 || $option['_tableType'] == 5 || $option['_tableType'] == 7)
			{
				$tdCss .= ' border-width:'.$width.'px 0px 0px 0px;';
				$firstTdCss .= ' border-width:'.$width.'px 0px 0px 0px;"';
				$titleTdCss .= ' border-width:0px;"';
			}
			else if($option['_tableType'] == 3 || $option['_tableType'] == 6 || $option['_tableType'] == 8)
			{
				$tdCss .= ' border-width:0px 0px 0px '.$width.'px;';
				$firstTdCss .= ' border-width:0px;"';
				$titleTdCss .= ' border-width:0px 0px 0px '.$width.'px;"';
			}
			else
			{
				$tdCss .= ' border-width:0px;';
				$firstTdCss .= ' border-width:0px;"';
				$titleTdCss .= ' border-width:0px;"';
			}
		}
		else
		{
			$tableCss .= ' style="border-width:0px;"';
			$tdCss = 'style="border-width:0px;';
			$firstTdCss = 'style="border-width:0px;"';
			$titleTdCss = 'style="border-width:0px;"';
		}
		
		//设定标题字体及背景颜色
		$color = isset($option['_titleFontColor']) ? (' color:'.$option['_titleFontColor'].';') : '';
		$color .= isset($option['_titleBackColor']) ? (' background-color:'.$option['_titleBackColor'].';') : '';
		
		//组装标题行对齐方式
		$align = isset($option['_titleRowAlign']) ? $option['_titleRowAlign'] : 'center';
		$height = isset($option['_titleRowHeight']) ? $option['_titleRowHeight'] : 24;
		$titleTrCss = 'align="'.$align.'"  height="'.$height.'px" style="'.$color;

		//组装内容行对齐方式
		$align = isset($option['_rulesRowAlign']) ? $option['_rulesRowAlign'] : 'center';
		$height = isset($option['_rowHeight']) ? $option['_rowHeight'] : 24;
		$trCss = 'align="'.$align.'"  height="'.$height.'px"';



		//设定奇数行偶数行内容字体及背景颜色
		$color1 = isset($option['_oddFontColor']) ? (' style="color:'.$option['_oddFontColor'].';') : '';
		$color1 .= isset($option['_oddBackColor']) ? (' background-color:'.$option['_oddBackColor'].';') : '';
		$color2 = isset($option['_evenFontColor']) ? (' style="color:'.$option['_evenFontColor'].';') : '';
		$color2 .= isset($option['_evenBackColor']) ? (' background-color:'.$option['_evenBackColor'].';') : '';
		
		//设定字体大小
		if(isset($option['_fontSize']))
		{
			$color1 .= ' font-size:'.$option['_fontSize'].'px;"';
			$color2 .= ' font-size:'.$option['_fontSize'].'px;"';
			$titleTrCss .= ' font-size:'.$option['_fontSize'].'px;"';
		}
		else
		{
			$color1 .= $color1 != '' ? '"' : '';
			$color2 .= $color2 != '' ? '"' : '';
			$titleTrCss .= $titleTrCss != '' ? '"' : '';
		}

		/*******************************开始输出表格*******************************/
		//定义全选操作的JS代码
		$js = array('allchecked'=>"<script language='javascript' >
			function checkAll(form1,checked)		//全选/全不选
			{
				var elements = form1.getElementsByTagName('input');
				for(var i=0; i<elements.length; i++)
				{
					if(elements[i].type == 'checkbox')
					{
						elements[i].checked=checked;
					}
				}	
			}
			
			</script>
			",
		);

		$checkbox = 0;
		if(isset($option['_primary']) && isset($option[$option['_primary']]) && isset($option['_isCheckBox']))
		{
			if($option['_isCheckBox'])
			{
				$checkbox = 1;
				echo $js['allchecked'];
			}
		}
		//输出表格框架
		echo '<table id="flh_tab_checkbox" '.$tableCss.'>';
		
		/********输出标题行********/
		echo '<tr '.$titleTrCss.'>';
		//输出复选框全选(在标题行)
		if($checkbox == 1)
		{
				//出现在左上角第一个单元不输出任何内线，否则会加粗边线
				echo '<td width="'.$option['_isCheckBox'].'" style="border-width:0px;">';
				echo '<input type="checkbox" name="flh_checkbox" id="flh_checkbox" value="" class="checkbox" onClick="checkAll(flh_tab_checkbox,this.checked)"/></td>';
		}
		$_sequenceTr = array(); //解决表格错乱问题
		//输出标题
		$j = 0;
		foreach($option as $k=>$v)
		{
			if(is_array($v))
			{
	//			$v['label']
				$j++;
				if(($j == 1) && ($checkbox == 0))
				{	//出现在左上角第一个单元不输出任何内线，否则会加粗边线
					echo '<td style="border-width:0px;">'.$v['label'].'</td>';
				}
				else
				{
					echo '<td '.$titleTdCss.'>'.$v['label'].'</td>';
				}
				$_sequenceTr[$k] = 0;
			}
		}
		//剔除 _Operator
		unset($_sequenceTr['_Operate']);
		echo '</tr>';
		
		/********输出数据内容行********/
		$h = 0;
		if($res)
		{
			while($each = mysql_fetch_assoc($res))
			{
				
				$h++;
				$css = ($h % 2 == 0) ? ($trCss.$color2) : ($trCss.$color1);
				echo '<tr '.$css.'>';
				//输出复选框(在内容行)
				if($checkbox == 1)
				{
					$tmpKey = $option['_primary'];
					//出现在左侧第一列单元不输出左边线，否则会加粗边线
					echo '<td '.$firstTdCss.' align="center"><input type="checkbox" name="y_id[]" value="'.$each[$tmpKey ].'" class="checkbox" /></td>';
				}
				$j = 0;
				//输出数据内容行
				foreach($_sequenceTr as $k=>$v)
				{
					$j++;
					$_len = 0;
					if(array_key_exists($k,$option))
					{
						$thisCss = isset($option[$k]['font-color']) ? ($tdCss.' color:'.$option[$k]['font-color'].';') : ($tdCss);
						$thisCss .= isset($option[$k]['truewidth']) ? (' width:'.$option[$k]['truewidth'].'px') : '';
						$thisCss .= isset($option[$k]['back-color']) ? (' background-color:'.$option[$k]['back-color'].';"') : '"';
						$_align = is_numeric($option[$k]['align']) ? strtr($option[$k]['align'],array('1'=>'left','2'=>'center','3'=>'right')) : 'center';
						
						$thisCss .= isset($option[$k]['align']) ? (' align="'.$_align.'"') : '';
						
						
						if(($j == 1) && ($checkbox == 0))
						{
							//出现在左侧第一列单元不输出左边线，否则会加粗边线
							echo '<td '.$firstTdCss.'>';
						}
						else
						{
							echo '<td  '.$thisCss.'>';
						}
						
						$_type = isset($option[$k]['type']) ? $option[$k]['type'] : '';
						
						if(isset($option[$k]['width']))
						{
							$_len = $option[$k]['width'];
						}
						if($_type)
						{
							
							$_params = $k.'['.$_len.']:'.$_type;
							
							//$_params = $k.'['.$option[$k]['width'].']:'.$_type;
							echo VW_SContent($_params,$each);
						}else{
							echo OB_Substr($each[$k],0,$_len);
						}
						
						echo '</td>';
					}
				}
				//输出操作单元
				if((isset($option['_Operate'])) && (isset($option['_primary']))){
					$common = $option['_Operate'];
					$_align = is_numeric($common['align']) ? strtr($common['align'],array('1'=>'left','2'=>'center','3'=>'right')) : 'center';
					$thisCss = isset($common['align']) ? ($tdCss.'" align="'.$_align.'"') : '';
					
					$button = '<td  '.$thisCss.' class="_Operate">';
					foreach($common as $ck=>$cv)
					{
						if(is_array($cv))
						{
							if(isset($cv['_field']) && array_key_exists($cv['_field'], $each))
							{
								$cvKey = $each[$cv['_field']];
								if(array_key_exists($cvKey, $cv))
								{
									$cv = $cv[$cvKey];
									$attr = isset($cv['attr']) ? $cv['attr'] : '';
									//$padding = isset($cv['padding']) ? ('style="margin:0px '.$cv['padding'].'px"') : '';
									$padding = '';
									$button .= '<a title ="'.$cv['alt'].'" href="'.$cv['urlPre'].$each[$option['_primary']].'" '.$attr.' ><img src="'.$cv['image'].'" alt="'.$cv['alt'].'" '.$padding.'/></a>';
								}
							}else{
								$attr = isset($cv['attr']) ? $cv['attr'] : '';
								//$padding = isset($cv['padding']) ? ('style="margin:0px '.$cv['padding'].'px"') : '';
								$padding = '';
								$button .= '<a title ="'.$cv['alt'].'" href="'.$cv['urlPre'].$each[$option['_primary']].'" '.$attr.' ><img src="'.$cv['image'].'" alt="'.$cv['alt'].'" '.$padding.'/></a>';
							}
						}
							
					}
					$button .= '</td>';
				}
	
				echo $button;
				echo '</tr>';
			}
		}else{
			echo '<td>暂无记录</td>';
		}
		echo '</table>';
	}

	/**
	 * FUN   VW_page
	 * EFF   分页 
	 * PRM   total      string        总数
	 * PRM   perNum     string        每页显示条数
	 * PRM   nowPage    string        当前所处页码数
	 * PRM   showBtn    string        最大显示按钮数量
	 * PRM   preUrl     string        跳转地址前缀
	 * PRM   zhCss      string        中文样式可分页
	 * PRM   zhCssNo    string        中文样式不可分页
	 * PRM   commonCss  string        公共样式
	 * PRM   specialCss string        当前页样式
	 * RET   分页    
	 * *********************************************
	 * time	2014-11-14
     * who	谢伟
	  +++++++++++++++++++++++++++++++++++++++++++++
	  $prm = (object)array();
	  $prm->total = '85'; //总数
	  $prm->perNum = '5'; //每页显示条数
	  $prm->showBtn = '3'; //最大显示按钮数量
	  $prm->nowPage = !isset($_GET['id']) ? 1 : $_GET['id']; //当前所处页码数
	  $prm->preUrl = 'page.php?id='; //跳转地址前缀
	  $prm->zhCss = 'color:purple;width:50px;';//中文样式可分页
	  $prm->zhCssNo = 'width:50px;color:#ccc';//中文样式不可分页
	  $prm->commonCss = 'color:red;text-decoration:none;width:24px;'; //公共样式
	  $prm->specialCss = 'font-weight:bold;color:red;width:24px;'; //当前页样式
	  VW_Page($prm);
	  +++++++++++++++++++++++++++++++++++++++++++++
	 */
	function VW_Page($prm)
	{
		$totalPage = ceil($prm->total/$prm->perNum);               
		$limit = floor($prm->showBtn/2);
		
		$max = ($prm->nowPage+$limit);
		$min = ($prm->nowPage-$limit);
		if($min < 1){ 
			$min = 1; 
			$max = $prm->showBtn;
		}
		
		if($max > $totalPage){
			$min = ($totalPage - $prm->showBtn)+1;
			$max = $totalPage;
		}
		if($min < 1){ $min = 1; }
		if($prm->nowPage >= $totalPage){$prm->nowPage = $totalPage;}
		//上一页 下一页
		$nextPage = ($prm->nowPage == $totalPage)? $totalPage : $prm->nowPage+1;
		$prevPage = ($prm->nowPage == 1)? 1 : $prm->nowPage-1;
		
		echo '<div id="vw_page"><table cellspacing=3 border=0><tr>';
		if($prm->nowPage == 1)
		{
			echo '<td ><a href="javascript:;" style="'.$prm->zhCssNo.'">首页</a></td>';
			echo '<td ><a href="javascript:;" style="'.$prm->zhCssNo.'">上一页</a></td>';
		}else{
			echo '<td ><a href="'.$prm->preUrl.'1" style="'.$prm->zhCss.'">首页</a></td>';
			echo '<td ><a href="'.$prm->preUrl.$prevPage.'" style="'.$prm->zhCss.'">上一页</a></td>';
		}
		
		for($i = $min;$i <= $max;$i++)
		{
			if($i == $prm->nowPage)
			{
				echo '<td ><a href="'.$prm->preUrl.$i.'" style="'.$prm->specialCss.'">'.$i.'</a></td>';
				continue;
			}
			echo '<td ><a href="'.$prm->preUrl.$i.'" style="'.$prm->commonCss.'">'.$i.'</a></td>'; 
		}
		if($prm->nowPage == $totalPage)
		{
			echo '<td ><a href="javascript:;" style="'.$prm->zhCssNo.'">下一页</a></td>';
			echo '<td ><a href="javascript:;" style="'.$prm->zhCssNo.'">尾页</a></td>';
		}else{
			echo '<td ><a href="'.$prm->preUrl.$nextPage.'" style="'.$prm->zhCss.'">下一页</a></td>';
			echo '<td ><a href="'.$prm->preUrl.$totalPage.'" style="'.$prm->zhCss.'">尾页</a></td>';
		}
		echo '<td style="'.$prm->zhCss.';width:90px">共<span style="color:green;">'.$prm->total.'</span>条</td>';
		
		echo '<td style="'.$prm->zhCss.';width:70px">'.$prm->nowPage.'/'.$totalPage.'</span></td>';
		echo '<td style="'.$prm->zhCss.';width:150px">去第<input type="text" size="1" maxlength="3" id="_jump" value="'.$nextPage.'"/>页<input type="button" value="确定" onclick="_jump()"/></td>';
		echo '<script>function _jump(){var _page = document.getElementById("_jump").value;if(isNaN(_page) || _page < 1 || _page > '.$totalPage.'){return;} window.location.href="'.$prm->preUrl.'"+_page}</script>';
		echo '</tr></table></div>';
	}
	
	/**
	 * FUN  VW_SContent
	 * EFF  模板标签  列表页适用
	 * PRM  $prm	string     解析的字符串(支持多种格式)
				[]中括号不是必须的
				ClassId[6]   截取映射关系中长度为6的数据并返回
				ClassId[6]:_fun->test  调用用户自定义函数test
				id[5]:fl_class(ClassId)->ClassName  查fl_class表中ClassId=id的记录，返回ClassName字段值
				
				_where[8]:fl_member(MemberId=1)->MemberName  获取fl_member表中 满足MemberId=1的记录，返回MemberName字段值
				注:解析结果值来源字传入的第二个参数中键相同的值
	 * PRM  $data    array    解析字段与数组的映射关系
	 * RET  无   直接输出解析字符串
	 * REL 
           ====================================================	 
	        OB_Subst() 函数 中文字符串截取
			DB_*       系列函数  需要实现查询功能
		   ====================================================
	 * *********************************************
	 * time	2014-11-10
     * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 VW_SContent('ClassId[6]',$array);
	 VW_SContent('ClassId[6]:_fun->test',$array);
	 VW_SContent('ClassId[6]:fl_class(ClassId)->ClassName',$array);
	 VW_SContent('_where[6]:fl_member（MemberId=1）->MemberName',$array);
	 +++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function VW_SContent($prm,$data=array() )
	{
		$prm = str_replace(' ','',$prm);
		
		@list($prm1,$prm2) = explode(':', $prm);

		
		$chunk = explode('[',strtr($prm1,array(' '=>'',']'=>'')));
		
		$chnkLen = isset($chunk[1]) ? $chunk[1] : '';
		
		$chnkLen = strtr($chnkLen,array(','=>''));
		
		if((strpos($prm1, '_where') !== false))
		{	
			//_where[6]:   fl_member(MemberId=1)->MemberName
			
			@list($table,$field) = explode('->', $prm2);
			@list($table,$where) = explode('(', $table);
			$where = substr($where,0,-1);
		
		}else{
			$content = $data[$chunk[0]];
			if(!$chnkLen)
				$chnkLen = strlen($content);
			if(!$prm2)
			{
				return OB_Substr($content,0,$chnkLen);
			}else{
				list($prm3,$prm4) = explode('->', $prm2);
				
				$string = $prm1;
				
				if($prm3 == '_fun')
				{
				
					return OB_Substr($prm4($data,$chunk[0]),0,$chnkLen);
				}else{
				
					@list($table,$field) = explode('(', $prm3);
					
					if($field)
					{
						$where = substr($field,0,-1).' = "'.$content.'"';
						$field = $prm4;
					}
				}
			}
		}
		
		$_prm = (object)array();
		
		$_prm->table = $table;
		$_prm->select = $field;
		$_prm->where = $where;
		
		if($obj = DB_SelectOne($_prm))
		{
			unset($_prm);
			return OB_Substr($obj->$field,0,$chnkLen);
		}
	}
	
	/**
	 * FUN VW_SList
	 * EFF 模板标签  列表页适用
	 * PRM $table    string     表名[字段名,字段名]  member[name,email,phone,address,id,postid]
	 * PRM $where    string     where 条件           id >0 ;o: phone desc    ;o:    排序    ;g: 分组
	 * PRM $num 	 int		提取数量 
	 * PRM $templateKey   模版字符串键
	 * PRM $templateArr   模版字符串一维数组  与 $templateKey  键对应
	 * PRM $field    string     决定是否是当前记录的字段名
	 * PRM $value    int        决定是当前记录的对应字段值
	 * PRM $templateKeyOn   string		当前记录使用的模版字符串键 
	 * RET 无   直接输出解析字符串
	 ****************************************************
	 * WHO   谢伟
	 * TIME  2014-11-10
	 * REL
		  ====================================================
			VW_SContent() 
		  =====================================================	  
	 * ********************************************************
	 * time	2014-11-10
	 * who	谢伟
	 +++++++++++++++++++++++++++++++++++++++++++++++++++
	 VW_SList('fl_member[memberName,]','MemberId > 1 & IsPhone !=""', 20, 't1', array('t1'=>'dd'))
	 +++++++++++++++++++++++++++++++++++++++++++++++++++
	 */
	function VW_SList($table,$where,$num,$templateKey,$templateArr = array(),$field='',$value='',$templateKeyOn='')
	{
		//处理where
		$where = strtr($where,array('&'  =>' AND ','|'  =>' OR ',';g:'=>' GROUP BY ',
									';o:'=>' ORDER BY ',';'=>' ',':'  =>'',
									));
		$table = strtr($table,array(']'=>''));
		@list($table,$fields) = explode('[',$table);
		$fields = $fields ? $fields : '*';
		$sql = 'SELECT '.$fields.' FROM '.$table.' WHERE '.$where.' LIMIT '.$num;

		$res = mysql_query($sql);

		while($vm_data = mysql_fetch_assoc($res))
		{
			if(($field != '') && ($vm_data[$field]==$value))
			{
				$templateStr = isset($templateArr[$templateKeyOn]) ? $templateArr[$templateKeyOn] : '';
			}
			else
			{
				$templateStr = isset($templateArr[$templateKey]) ? $templateArr[$templateKey] : '';
			}
			eval($templateStr);
		}
	}
	
	/**
	 * 根据数据呈现内容页
	 */
	function VW_SListByData($data,$templateKey,$templateArr = array(),$field='',$value='',$templateKeyOn='')
	{
		foreach ($data as $v) 
		{
			$vm_data = (array)$v;
			if(($field != '') && ($vm_data[$field]==$value))
			{
				$templateStr = isset($templateArr[$templateKeyOn]) ? $templateArr[$templateKeyOn] : '';
			}
			else
			{
				$templateStr = isset($templateArr[$templateKey]) ? $templateArr[$templateKey] : '';
			}
			$templateStr = '?>'.strtr($templateStr,array('<!--{'=>'<?php echo ','}-->'=>';?>'));
			eval($templateStr);
		}
	}


	
	/**
	* FUN   VW_Template
	* EFF   模板解析 (分别解析首尾标记转换成视图--混编文件) 在(——-_-++) 与(——_-_++)中会被分离成php
	        小模板内容数组 用于VW_SList
	* PRM   $code    string    模板字串 格式参看 举例
	*    
	* RET   string   将模板标签替换成视图的字串
	       
	****************************************************
	* WHO   谢伟
	* TIME  2014-11-18
	++++++++++++++++++++++++++++++++++++++++++++++++++
	 
	       (——-_-++)
	       $prmd = array('t1'=>"<li>
		   会员组:<!--{VW_SContent('ClassName[6,]:fl_Class(ClassId = 3)')}-->
		   名称:<!--{VW_SContent('MemberName[8,]')}--><br />
		   登陆时间:<!--{VW_SContent('LoginTime:&func')}--><br />
		   会员组:<!--{VW_SContent('GroupId[6,]:fl_member_group{GroupId}=GroupName')}-->
		   城市:<!--{VW_SContent('CityId[6,]:fl_city{CityId}=City')}-->   
	       </li>
	       <br />",);
	      (——_-_++)
	      <ul>
		  <!--{VW_SList('fl_member','MemberId < 20 & GroupId != ""','50','t1',$prmd)}-->;
	      </ul>
	++++++++++++++++++++++++++++++++++++++++++++++++++
	
	*/
    function VW_Template($code)
	{
		//解析头部
		@list($code,$headPhp) = array_reverse(array_filter(explode('(——_-_++)',$code)));
		if($headPhp)
		{
			$headPhp = strtr($headPhp.'(——_-_++)',array('(——-_-++)'=>'<?php ','(——_-_++)'=>'; ?>','$vm_data'=>'\$vm_data'));
		}
		$replace = array(
			'<!--{'=>'<?php ',
			'}-->'=>'; ?>',
		);
		return $headPhp.strtr($code,$replace);
	}
?>