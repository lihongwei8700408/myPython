<link rel="stylesheet" href="<?php echo STATIC_DOMAIN?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo STATIC_DOMAIN?>/css/default_user_com.css" media="all">
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=0DaDOMizA48IQPHGpeusdzCq"></script>
<style>
#allmap{width:600px;height: 400px;overflow: hidden;margin:0;}
</style>   
<div class="content" style="margin-left:10px;">

           <div class="cLineB" style="width:800px;"><h4>商家资料</h4></div>
          <form method="post" action="<?php echo WEB_SHOPADMIN.'/index.php?c=userinfo';?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
                  <th><span class="red">*</span>店铺图像：</th>
                  <!--<td class="setHead">
                        
                        <dd>
                            <div id="upHead">
                            <div class='img_each'><div class='item_img'><?php echo Avator()?></div></div>
                            </div>
                            <div>
                                <span id="spanButtonPlaceHolder"></span>
                                <input id="btnCancel" type="hidden" value="取消所有上传" onClick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
                            </div>
                            
                            <div id="divStatus">图片格式:GIF、JPG、JPEG、PNG,最适合尺寸120*120 像素</div>
                        </dd>
                    </td>-->
					<td><input type="file" id="pic" name="file" onchange="javascript:setImagePreview();"> </td>
                </tr>
                <tr><th></th>
                <td><div id="localImag" ><img id="img" width=-1 height=-1 style="display:none;margin-left:2px;" /></div>
                    <img id="showimg" src="<?php echo $update->ShopLogo;?>"  style="display:none; margin-left:2px;width:100px;height:100px;" />
                </td>
                </tr>
				<tr>
                  <th><span class="red">*</span>企业法人代表：</th>
                   <td><input type="text" required="" name="SellerName" value="<?php if(isset($update)) echo $update->SellerName;?>" class="px" tabindex="1" size="25"></td>
                </tr>
              </thead>
              <tbody>
                                <tr>
                  <th><span class="red">*</span>绑定手机：</th>
                  <td><input type="text"  required="" name="Tel" id="Title" value="<?php if(isset($update)) echo $update->Tel;?>" onmouseup="this.value=this.value.replace(&#39;_430&#39;,&#39;&#39;)" class="px" tabindex="1" size="50">　<a href="http://weixin.fenlei168.com/tpl/static/getoid.htm" target="_blank"><img src="<?php echo STATIC_DOMAIN?>/images/help.png" class="vm helpimg" title="帮助"></a></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>店铺名：</th>
                  <td><input type="text" required="" name="ShopName" value="<?php if(isset($update)) echo $update->ShopName;?>" class="px" tabindex="1" size="50"></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>店铺介绍：</th>
                  <td><textarea name="Content" placeholder="店铺介绍不少于20字"style="min-width:400px;min-height:150px;"><?php if(isset($update)) echo $update->Content;?></textarea></td>
                </tr>
				<tr>
                  <th><span class="red">*</span>所属城市区域：</th>
                   <td><select id="Province" name="ProvinceId">
							<option value="0">请选择</option>
						</select>
                      <select id="City" name="CityId">
                          <option value="0">请选择</option>
                      </select>
                      <select id="District" name="DistrictId">
							<option value="0">请选择</option>
                      </select>
                      <select id="Region" name="RegionId">
                          <option value="0">请选择</option>
                      </select>
					  <script>
					  
						$("#Province").change(function(){
							var selectVal=$("#Province option:selected").val();
							$.getJSON('/shopadmin/index.php?c=userinfo&other=proToCity&id='+selectVal,function(data){
								appendHtml(data[selectVal],'#City',0);
							});
							var text =$('#Province option:selected').text();
							searchByStationName(text);
						});
						$("#City").change(function(){
							var selectVal=$("#City option:selected").val();
							$.getJSON('/shopadmin/index.php?c=userinfo&other=cityToDistrict&id='+selectVal,function(data){
								appendHtml(data[selectVal],'#District',0);
							});
							var text =$('#City option:selected').text();
							searchByStationName(text);
						});

						$("#District").change(function(){
							var selectVal=$("#District option:selected").val();
							$.getJSON('/shopadmin/index.php?c=userinfo&other=districtToRegion&id='+selectVal,function(data){
								appendHtml(data[selectVal],'#Region',0);
							});
							var text =$('#District option:selected').text();
							searchByStationName(text);
						});
						//还原默认值
							function viewUpdate(){
								var proId=<?php echo empty($_SELLER->ProvinceId)?0:$_SELLER->ProvinceId?>;
								var cityId=<?php echo empty($_SELLER->CityId)?0:$_SELLER->CityId?>;
								var disId=<?php echo empty($_SELLER->DistrictId)?0:$_SELLER->DistrictId?>;


								var regId=<?php echo empty($_SELLER->RegionId)?0:$_SELLER->RegionId?>;


								$.getJSON('/shopadmin/index.php?c=userinfo&other=pro',function(data){
									var htmlData='';
									for (var o in data){
										if (o==proId){
											htmlData+='<option selected value="'+o+'">'+data[o]+'</option>';
										}else{
											htmlData+='<option value="'+o+'">'+data[o]+'</option>';
										}
										
									}
									$("#Province").html(htmlData);
								});
								$.getJSON('/shopadmin/index.php?c=userinfo&other=proToCity&id='+proId,function(data){
									if(cityId){
										appendHtml(data[proId],'#City',cityId);//12城市id
									}
								});
								$.getJSON('/shopadmin/index.php?c=userinfo&other=cityToDistrict&id='+cityId,function(data){
									
									if(disId){
										appendHtml(data[cityId],'#District',disId);
									}
								});
								$.getJSON('/shopadmin/index.php?c=userinfo&other=districtToRegion&id='+disId,function(data){
									if(regId){
										appendHtml(data[disId],'#Region',regId);
									}
									
								});
							}
							viewUpdate();
							//追加元素
							function appendHtml(jsonData,domId,selectedId){
								var data=jsonData;
								if(selectedId==0){
									var htmlData='<option value="0">请选择</option>';
								}else{
									var htmlData='';
								}
								
								for (var o in data){
									if (data[o].value==selectedId){
										htmlData+='<option selected value="'+data[o].value+'">'+data[o].name+'</option>';
									}else{
										htmlData+='<option value="'+data[o].value+'">'+data[o].name+'</option>';
									}
									
								}
								$(domId).html(htmlData);
							}
					  </script>
					 </td>
				  
                </tr>
                <tr>
                  <th><span class="red">*</span>详细地址：</th>
                   <td><input type="text" required="" name="Address" value="<?php if(isset($update)) echo $update->Address;?>" class="px" tabindex="1" size="50"></td>
				  
                </tr>
				
                <tr>
                  <th><span class="red">*</span>店铺地图位置：</th>
                  <td> <input id="Lng" type="text" name="Lon" value="<?php if(isset($update)) echo $update->Lon;?>"/><input id="Lat" type="text" name="Lat" value="<?php if(isset($update)) echo $update->Lat;?>"/><button type="button" id="Map" class="various3">在地图标注</button></td>
				   
                </tr>
				 <tr>
				    <th></th>
				    <td><div id="allmap"></div></td>
				 </tr>
                <tr>
                  <th><span class="red">*</span>服务电话：</th>
                   <td><input type="text" required="" name="TelOne" value="<?php if(isset($update)) echo $update->TelOne;?>" class="px" tabindex="1" size="50"></td>
                </tr>
                <tr>
                  <th></th>
                  <td><button type="submit" class="btnGreen" name="submit" id="saveSetting">保存</button></td>
                </tr>
              </tbody>
            </table>
            
          </div>
         </form>
        </div>
<?php 
	if($update->ShopLogo)
	{
	    
		echo "<script>$('#showimg').css('display','block');</script>";
	}
?>

<script>
function setImagePreview() {
	    var show=document.getElementById("showimg");
		show.style.display="none";
        var docObj=document.getElementById("pic");
 
        var imgObjPreview=document.getElementById("img");
                if(docObj.files &&    docObj.files[0]){
                        //火狐下，直接设img属性
                        imgObjPreview.style.display = 'block';
                        imgObjPreview.style.width = '100px';
                        imgObjPreview.style.height = '100px';                    
                        //imgObjPreview.src = docObj.files[0].getAsDataURL();

      //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式  
      imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);

                }else{
                        //IE下，使用滤镜
                        docObj.select();
                        var imgSrc = document.selection.createRange().text;
                        var localImagId = document.getElementById("localImag");
                        //必须设置初始大小
                        localImagId.style.width = "100px";
                        localImagId.style.height = "100px";
                        //图片异常的捕捉，防止用户修改后缀来伪造图片
try{
                                localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
                        }catch(e){
                                alert("您上传的图片格式不正确，请重新选择!");
                                return false;
                        }
                        imgObjPreview.style.display = 'none';
                        document.selection.empty();
                }
                return true;
        }	
</script>
<script type="text/javascript">
//$('#Map').click(function(){
	//$('#allmap').css('display','block');
//})
	var map = new BMap.Map("allmap");            // 创建Map实例
//有默认值

    if(document.getElementById("Lng")!==null && document.getElementById("Lat")!==null &&document.getElementById("Lng").value !== "" && document.getElementById("Lat").value !== ""){  
          	    	
    	map.clearOverlays();     	
    	var new_point = new BMap.Point(document.getElementById("Lng").value/Math.pow(10,6),document.getElementById("Lat").value/Math.pow(10,6));
    	map.centerAndZoom(new_point,15);
    	
    	var marker = new BMap.Marker(new_point);  // 创建标注
    	map.addOverlay(marker);              // 将标注添加到地图中
    	map.panTo(new_point);      
    	
    }else{
		//var val ='<?php echo $_SESSION['City'];?>';			// 初始化地图,设置中心点坐标和地图级别。
		map.centerAndZoom('北京', 15);	    	   
    }
	var localSearch = new BMap.LocalSearch(map);
    function searchByStationName(key) {
		map.clearOverlays();//清空原来的标注
		var keyword=key;
		localSearch.setSearchCompleteCallback(function (searchResult) {
			var poi = searchResult.getPoi(0);
            console.log(poi);
			//给横纵坐标赋值
			document.getElementById("Lat").value=(poi.point.lat)*Math.pow(10, 6);
			document.getElementById("Lng").value=(poi.point.lng)*Math.pow(10, 6);
	 
			map.centerAndZoom(poi.point, 15);
			var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
			map.addOverlay(marker);
		  
		});
		localSearch.search(keyword);
	}                 
	map.enableScrollWheelZoom();                            //启用滚轮放大缩小
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
	//获取详细信息
	function showInfo(e){
	
    //给横纵坐标赋值
     document.getElementById("Lat").value=e.point.lat*Math.pow(10, 6);
     document.getElementById("Lng").value=e.point.lng*Math.pow(10, 6);
		map.clearOverlays(); 
		var new_point = new BMap.Point(e.point.lng,e.point.lat);
		var marker = new BMap.Marker(new_point);  // 创建标注
		map.addOverlay(marker);              // 将标注添加到地图中
		map.panTo(new_point);  
		var geoc = new BMap.Geocoder(); 
		geoc.getLocation(e.point, function(rs){
// 			var addComp=rs.getName;
// 			var addComp = rs.point;
// 			var addComp = rs.address  ;
			var addComp = rs.addressComponents;
			
			var disname=addComp.district;
			//截取掉区
			var disname = disname.replace('区','');
// 			alert(disname);
			var DistrictId = document.getElementById('DistrictId');

			
			for(var i=0;i<DistrictId.options.length;i++){
				if(DistrictId.options[i].innerHTML == disname){
					DistrictId.options[i].selected = true;
					break;
				}
			}

		}); 
		
	}

	//点击事件监听事件
	map.addEventListener("click", showInfo);

</script>
