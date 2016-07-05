<?php


function Page2($prm)
	{
		if(!$prm->total)
		{
			return ;
		}
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
		$nextPage = $totalPage;
		$prevPage = 1;
		
		echo '<div class="pagnation" id="pagnation">';
		$queryStr = '';
		$prm->isQuery = $prm->isQuery ? $prm->isQuery : false;
		if($prm->isQuery && $_SERVER['QUERY_STRING']) //追加 query string
		{
			$queryStr = '?'.$_SERVER['QUERY_STRING'];
			$prevPage .= $queryStr;
		}
		if($prm->nowPage != 1) 
		{
			echo '<a href="'.$prm->preUrl.$prevPage.'" class="page-prev"></a>';
		}
		//echo $prm->nowPage - floor($prm->showBtn/2);
		//输出  ... 
		//($prm->nowPage - floor($prm->showBtn/2)) > 1
		if(($prm->nowPage - $prm->showBtn) > 1)
		{
			echo '<a href="'.$prm->preUrl.'1" >1</a><a href="javascript:;"><strong>···</strong></a>';
		}
		
		for($i = $min;$i <= $max;$i++)
		{
			if($i == $prm->nowPage) //当前页
			{
				echo '<a href="'.$prm->preUrl.$i.$queryStr.'" class="current">'.$i.'</a>';
				continue;
			}
			//普通页
			echo '<a href="'.$prm->preUrl.$i.$queryStr.'">'.$i.'</a>'; 
		}
		if($prm->nowPage != $totalPage) //到达最终数
		{
			echo '<a href="'.$prm->preUrl.$nextPage.$queryStr.'" class="page-next">下一页</a>';
		}
		echo '</div>';
	}
	
	?>