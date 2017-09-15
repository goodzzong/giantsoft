<?
$mod	= "product";	
$menu	= "product_list";
include("../header.php");

include $_SERVER['DOCUMENT_ROOT']."/lib/style_class.php";
include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_script.php";

$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );

// 카테고리 이름 출력
$part_stat_row = $db->object("cs_part", "where idx='$goods_data[part_idx]'");
if( $part_stat_row->part_index == 1 ) {
	$part_result = $db->select("cs_part", "where part1_code='$part_stat_row->part1_code' && part_index=1 order by idx asc", "part_name");
} else if( $part_stat_row->part_index == 2 ) {
	$part_result = $db->select("cs_part", "where (part1_code='$part_stat_row->part1_code' && part_index=1) || (part2_code ='$part_stat_row->part2_code' && part_index=2) order by idx asc", "part_name");
} else if( $part_stat_row->part_index == 3 ) {
	$part_result = $db->select("cs_part", "where (part1_code='$part_stat_row->part1_code' && part_index=1) || (part2_code ='$part_stat_row->part2_code' && part_index=2) || (part3_code='$part_stat_row->part3_code' && part_index=3) order by idx asc", "part_name");
}
$i=0;
while( $part_row = @mysql_fetch_object( $part_result )) {
	$i++;
	$part_name.=$i."차 카테고리 : <font color='#FF0000'>".$part_row->part_name."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
	
$row = $db->object("cs_goods", "where idx='$goods_data[idx]'");
// 이미지 사이즈 
$goods_images1_size=@getimagesize("../../data/goodsImages/$row->images1");
$goods_images1_width=$goods_images1_size[0]; $goods_images1_height=$goods_images1_size[1];
$goods_images2_size=@getimagesize("../../data/goodsImages/$row->images2");
$goods_images2_width=$goods_images2_size[0]; $goods_images2_height=$goods_images2_size[1];
if( $row->add_images1 ) { $goods_add_images1_size=@getimagesize("../../data/goodsImages/$row->add_images1");$goods_add_images1_width=$goods_add_images1_size[0]; $goods_add_images1_height=$goods_add_images1_size[1];}
if( $row->add_images2 ) { $goods_add_images2_size=@getimagesize("../../data/goodsImages/$row->add_images2");	$goods_add_images2_width=$goods_add_images2_size[0]; $goods_add_images2_height=$goods_add_images2_size[1];}
if( $row->add_images3 ) { $goods_add_images3_size=@getimagesize("../../data/goodsImages/$row->add_images3");	$goods_add_images3_width=$goods_add_images3_size[0]; $goods_add_images3_height=$goods_add_images3_size[1];}
if( $row->add_images4 ) { $goods_add_images4_size=@getimagesize("../../data/goodsImages/$row->add_images4");	$goods_add_images4_width=$goods_add_images4_size[0]; $goods_add_images4_height=$goods_add_images4_size[1];}
if( $row->add_images5 ) { $goods_add_images5_size=@getimagesize("../../data/goodsImages/$row->add_images5");	$goods_add_images5_width=$goods_add_images5_size[0]; $goods_add_images5_height=$goods_add_images5_size[1];}
?>
<script language="javascript">
<!--
// 수량 입력 폼 체크
function goodsUnlimit() {	if( document.tx_editor_form.unlimit.checked == true ) { document.tx_editor_form.number.value = ""; }}
function goodsNumber() { document.tx_editor_form.unlimit.checked  = false; }


//// 데이타 전송 종료 //////////////////////////////////////////////////////////////////////////////////////////

function goodsImagesView( check, w, h ){
	window.open("product_images_view.php?goods_data=<?=$mv_data?>&images_check="+check,"","scrollbars=no,width="+w+",height="+h+",top=200,left=200");
}

//// 입력 품 VIEW 체크  시작 /////////////////////////////////////////////////////////////////////////////////////////
// 옵션
function optionCheck() {
	var form=document.tx_editor_form;
	if( form.option_check[0].checked ) {
		$(".option1_view").css("display","none");
		$(".option2_view").css("display","none");
	} else if( form.option_check[1].checked ) {
		$(".option1_view").css("display","");
		$(".option2_view").css("display","none");
	} else if( form.option_check[2].checked ) {
		$(".option1_view").css("display","");
		$(".option2_view").css("display","");
	}
}


/**************관련 상품 시작**************/		
function res(){	
	var code = $("input[name=code]").val();
	window.open("zzim_list.php?code="+code,"","width=1000,height=600,scrollbars=yes");	
}
/**************관련 상품 종료**************/

////  카테고리 선택 폼 설정 시작 //////////////////////////////////////////////////////////////////////////
// 배열 선언
depth1 = new Array(); // 리스트1 출력용
depth2 = new Array(); // 리스트2 출력용
depth3 = new Array(); // 리스트3 출력용

depth1_value = new Array(); // 리스트1 값
depth2_value = new Array(); // 리스트2 값
depth3_value = new Array(); // 리스트3 값

var depth1_size = 3;
var depth2_size = 3;
var depth3_size = 3;
var sep = "$$";
// 배열 초기화

i = 0;
// depth1 의 배열 초기화
<?
$part1_result = $db->select( "cs_part", "where part_index=1 order by part_ranking asc");
while( $part1_row = mysql_fetch_object($part1_result) ) {
?>
	depth1[i] = "<?=$part1_row->part_name;?>";
	depth1_value[i] = "<?=$part1_row->part1_code;?>";
	
	j = 0;

	// depth2 의 배열 초기화
	<?
	$part2_result = $db->select( "cs_part", "where part1_code='$part1_row->part1_code' and part_index=2 order by part_ranking asc");
	while( $part2_row = mysql_fetch_object($part2_result) ) 
	{
	?>
		if ( j == 0 )
		{
			depth2[i] = new Array(); 
			depth2_value[i] = new Array();
			depth3[i] = new Array();
			depth3_value[i] = new Array();
		}

		depth2[i][j] = "<?=$part2_row->part_name;?>" ;
		depth2_value[i][j] = "<?=$part2_row->part2_code;?>";
		
		k = 0;
		<?
		$part3_result = $db->select( "cs_part", "where part2_code='$part2_row->part2_code' and part1_code='$part1_row->part1_code' and part_index=3 order by part_ranking asc");
		while( $part3_row = mysql_fetch_object($part3_result) ) 
		{
		?>
			if ( k == 0 )
			{
				depth3[i][j] = new Array();
				depth3_value[i][j] = new Array();
			}
			depth3[i][j][k] = '<?=$part3_row->part_name?>' ;
			depth3_value[i][j][k] = '<?=$part3_row->part3_code?>' ;
		k += 1;
	    <?}?>
	 j += 1;
	<?}?>	
i += 1;		
<? }?>

// 선택되었을때 다음 단계 카테고리 출력
function change(depth, index, target)
{
	f = document.tx_editor_form;   // 선택된 Form;
	
	if ( depth == 1 && index != -1)  // 대분류 선택 시
	{
		sp_value = f.select1[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		
		for ( i = f.select2.length; i >= 0; i-- ) {
			f.select2[i] = null; 
		}
		tx_editor_form.part_code.value = "";
		if ( depth2[sp_value2] != null )
		{
	
			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ )
			{
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
			}
		}
		else
		{
			tx_editor_form.part_code.value = depth1_value[sp_value2];
			alert("카테고리 선택 완료");
		}


		// 카테고리 2를 초기화 되면 카테로기 3은 모두 삭제한다.
		for ( i = f.select3.length; i >= 0; i-- ) {
			f.select3[i] = null; 
		}
	}
	else if ( depth == 2 && index != -1 )   // 중분류 선택 시 
	{
		sp_value = f.select2[index].value;
		sp_value = sp_value.split(sep);
		sp_value2 = sp_value[1];
		sp_value3 = sp_value[2];
		
		for ( i = f.select3.length; i >= 0; i-- ) {
			f.select3[i] = null; 
		}
		tx_editor_form.part_code.value = "";
		if ( depth3[sp_value2][sp_value3] != null )
		{

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ )
			{
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		}
		else
		{
			tx_editor_form.part_code.value = depth2_value[sp_value2][sp_value3];
			alert("카테고리 선택 완료");
		}
	}
	else if ( depth == 3 && index != -1 )
	{
		tx_editor_form.part_code.value = f.select3[index].value;
		alert("카테고리 선택 완료");
	}
}
////  카테고리 선택 폼 설정 종료 //////////////////////////////////////////////////////////////////////////
//-->
</script>

	<div class="text-right">
		<h3 class="page-header">
			<small>
				제품수정
			</small>
		</h3>
	</div>

	<form name="tx_editor_form" id="tx_editor_form"  action="product_edit_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="hidden_option1_data">
	<input type="hidden" name="hidden_option2_data">
	<input type="hidden" name="goods_data" value="<?=$mv_data;?>">
	<input type="hidden" name="hidden_images1" value="<?=$row->images1;?>">
	<input type="hidden" name="hidden_images2" value="<?=$row->images2;?>">
	<input type="hidden" name="hidden_add_images1" value="<?=$row->add_images1;?>">
	<input type="hidden" name="hidden_add_images2" value="<?=$row->add_images2;?>">
	<input type="hidden" name="hidden_add_images3" value="<?=$row->add_images3;?>">
	<input type="hidden" name="hidden_add_images4" value="<?=$row->add_images4;?>">
	<input type="hidden" name="hidden_add_images5" value="<?=$row->add_images5;?>">
	<input type="hidden" name="hidden_goods_file" value="<?=$row->goods_file;?>">
	<input type="hidden" name="code" value="<?=$row->code;?>" title="제품코드">
	<input type="hidden" name="part_code" value="">
	<input type="hidden" name="icon" value="<?=$row->icon?>">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr> 
		<th>카테고리 이름</th>
		<td>&nbsp;&nbsp;<?=$part_name;?> </td>
	</tr>
	<tr> 
		<th class="text-center">
			분류변경 <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="- 카테고리변경시 선택하여 주시기바랍니다."><span class="glyphicon glyphicon-question-sign"></span></button>
		</th>
		<td>
			<table class="table table-bordered">
			<colgroup>
			<col width="33%" title="1차카테고리">
			<col width="33%" title="2차카테고리">
			<col width="*"   title="3차카테고리">
			</colgroup>		
			<tbody>
			<tr> 
				<td class="text-center"><span class="btn btn-primary btn-xs btn-grad btn-rect">&nbsp;&nbsp;1차 카테고리&nbsp;&nbsp;</span></td>
				<td class="text-center"><span class="btn btn-primary btn-xs btn-grad btn-rect">&nbsp;&nbsp;2차 카테고리&nbsp;&nbsp;</span></td>
				<td class="text-center"><span class="btn btn-primary btn-xs btn-grad btn-rect">&nbsp;&nbsp;3차 카테고리&nbsp;&nbsp;</span></td>
			</tr>
			<tr> 
				<td>
					<select name="select1" onChange='change(1, this.form.select1.selectedIndex, this.form)'  class="form-control"  size="5">
						<script language = "javascript">
						for ( i = 0 ; i <= depth1.length -1 ; i++ ){	document.write ("<option value='"+ depth1_value[i] + sep + i + "' >" + depth1[i] + "</option>");}
						</script>
					</select>
				</td>
				<td><select name="select2" onChange='change(2, this.form.select2.selectedIndex, this.form)' class="form-control"  size="5"></select></td>
				<td><select name="select3" onChange='change(3, this.form.select3.selectedIndex, this.form)' class="form-control"  size="5"></select></td>
			</tr>
			</tbody>
			</table>	
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr> 
		<th>노출여부</th>
		<td>
			<label class="radio-inline"><input type="radio" name="display" value="1" <?if($row->display){echo("checked");}?>>노출</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="display" value="" <? if(empty($row->display)){echo("checked");}?>>미노출</label>&nbsp;&nbsp;
		</td>
	</tr>	
	<tr> 
		<th>메인노출1</th>
		<td>
			<label class="radio-inline"><input type="radio" name="main_position" value="1" <?if($row->main_position){echo("checked");}?>>ON</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="main_position" value="" <?if(empty($row->main_position)){echo("checked");}?>>OFF</label>
		</td>
	</tr>	
	<tr> 
		<th>메인노출2</th>
		<td>
			<label class="radio-inline"><input type="radio" name="sub_position" value="1" <?if($row->sub_position){echo("checked");}?>>ON</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="sub_position" value="" <?if(empty($row->sub_position)){echo("checked");}?>>OFF</label>
		</td>
	</tr>
	<!-- <tr>
		<th>추가표시</th>
		<td>
			<?
			$rsc = $db->select("cs_cate","where table_name='cs_goods' and code='icon' order by idx asc");
			while($rowc = mysql_fetch_array($rsc)){
			?>
			<label class="checkbox-inline"><input type="checkbox" name="icon_arr" value="<?=$rowc[idx]?>" <?if(strpos($row->icon, $rowc[idx]) !== false){ echo "checked";}?>><?=$rowc[name]?></label>&nbsp;&nbsp;
			<?}?>
		</td>
	</tr> -->
	</tbody>
	</table><br>


	<h5 class="page-header"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> 제품정보</h5>
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr> 
		<th>제품명</th>
		<td><input name="name" type="text" class="form-control" maxlength="100" value="<?=$db->stripSlash($row->name);?>"></td>
	</tr>
	<tr> 
		<th>소비자가 <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="- 쉼표없이 숫자만 입력 하세요"><span class="glyphicon glyphicon-question-sign"></span></button></th>
		<td><input type="text" name="old_price" class="form-control2 text-right" size="10" value="<?=$row->old_price?>"> 원</td>
	</tr>
	<tr> 
		<th>판매가 <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="- 쉼표없이 숫자만 입력 하세요"><span class="glyphicon glyphicon-question-sign"></span></button></th>
		<td><input type="text" name="shop_price" class="form-control2 text-right" size="10" value="<?=$row->shop_price?>"> 원</td>
	</tr>
	<tr style="display:none;"> 
		<th>제품 옵션</th>
		<td colspan="2">
			<label class="radio-inline">
				<input type="radio" name="option_check" value="0" onClick="optionCheck()" <? if( $row->option_check == 0) { echo("checked");}?>>&nbsp;사용안함
			</label>&nbsp;&nbsp;
			<label class="radio-inline">
				<input type="radio" name="option_check" value="1" onClick="optionCheck()" <? if( $row->option_check == 1) { echo("checked");}?>>&nbsp;옵션1개
			</label>&nbsp;&nbsp;
			<label class="radio-inline">
				<input type="radio" name="option_check" value="2" onClick="optionCheck()" <? if( $row->option_check == 2) { echo("checked");}?>>&nbsp;옵션2개
			</label>&nbsp;&nbsp;
		</td>
	</tr>

	<?
		$option1_db	="cs_option";
		$option1_query = "where code='$row->code' and cate=1 order by idx asc";
		$option1_row = $db->object($option1_db,$option1_query);
		$option1_cnt = $db->cnt($option1_db,$option1_query);
	?>
	<tr class="option1_view" style="display:none;">
		<th>옵션입력[1]</th>
		<td>
			<table class="table table-bordered">
			<caption></caption>
			<colgroup>
			<col width="15%">
			<col width="*">
			</colgroup>
			<tbody>
			<tr>
				<th>옵션명</th>
				<td><input type="text" name="option1_name" class="form-control input-sm" placeholder="예시) 색상" value="<?=$row->option1_name?>"></td>
			</tr>
			</tbody>
			</table>
			<div class="text-right">
				<a href="javascript:option_arr(1);" class="btn btn-success btn-xs">옵션추가</a>
			</div>
			<table class="table table-bordered">
			<caption></caption>
			<colgroup>
			<col width="*">
			<col width="15%">
			<col width="10%">
			<col width="10%">
			<col width="5%">
			</colgroup>
			<thead>
			<tr>
				<th>옵션값</th>
				<th>가격</th>
				<th>재고</th>
				<th>상태</th>
				<th>설정</th>
			</tr>
			</thead>
			<tbody id="option1_arr">
			<tr>
				<td><input type="text" name="option_name1[]" class="form-control input-sm" placeholder="예시) 빨강" value="<?=$option1_row->name?>"></td>
				<td><input type="text" name="option_price1[]" class="form-control input-sm text-center" value="<?=$option1_row->price?>"></td>
				<td><input type="text" name="option_number1[]" class="form-control input-sm text-center" maxlength="4" value="<?=$option1_row->number?><?if(empty($option1_row->number)){?>1000<?}?>"></td>
				<td class="text-center">
					<label class="checkbox-inline"><input type="checkbox" name="option_sold_out1[]"  value="y" <?if($option1_row->sold_out==y){ echo "checked";}?>>품절</label>
					<input type="hidden" name="hidden_option_sold_out1[]" value="<?=$option1_row->sold_out?>">
				</td>
				<td><input type="hidden" name="option_idx1[]" value="<?=$option1_row->idx?>"></td>
			</tr>
			<?
				$k=0;
				$option1_rs = $db->select("cs_option","where code='$row->code' and cate=1 order by idx asc limit 1,$option1_cnt");
				while($option1_row = mysql_fetch_array($option1_rs)){
			?>
			<tr class="arr1Row" id="size1Row<?=$k?>">
				<td><input type="text" name="option_name1[]" class="form-control input-sm" placeholder="예시) 빨강" value="<?=$option1_row[name]?>"></td>
				<td><input type="text" name="option_price1[]" class="form-control input-sm text-center" value="<?=$option1_row[price]?>"></td>
				<td><input type="text" name="option_number1[]" class="form-control input-sm text-center" maxlength="4" value="<?=$option1_row[number]?>"></td>
				<td class="text-center">
					<label class="checkbox-inline"><input type="checkbox" name="option_sold_out1[]"  value="y" <?if($option1_row[sold_out]==y){ echo "checked";}?>>품절</label>
					<input type="hidden" name="hidden_option_sold_out1[]" value="<?=$option1_row[sold_out]?>">
				</td>
				<td class="text-center">
					<a href="javascript:;" class="btnDel btn btn-danger btn-xs" data-cate="1" data-del="<?=$k?>" data-idx="<?=$option1_row[idx]?>">삭제</a>
					<input type="hidden" name="option_idx1[]" value="<?=$option1_row[idx]?>">
				</td>
			</tr>				
			<?
			$k++;
			}
			?>
			</tbody>
			</table>
		</td>
	</tr>

	<?
		$option2_db	="cs_option";
		$option2_query = "where code='$row->code' and cate=2 order by idx asc";
		$option2_row = $db->object($option2_db,$option2_query);
		$option2_cnt = $db->cnt($option2_db,$option2_query);
	?>
	<tr class="option2_view" style="display:none;">
		<th>옵션입력[2]</th>
		<td>
			<table class="table table-bordered">
			<caption></caption>
			<colgroup>
			<col width="15%">
			<col width="*">
			</colgroup>
			<tbody>
			<tr>
				<th>옵션명</th>
				<td><input type="text" name="option2_name" class="form-control input-sm" placeholder="예시) 색상" value="<?=$row->option2_name?>"></td>
			</tr>
			</tbody>
			</table>
			<div class="text-right">
				<a href="javascript:option_arr(2);" class="btn btn-success btn-xs">옵션추가</a>
			</div>
			<table class="table table-bordered">
			<caption></caption>
			<colgroup>
			<col width="*">
			<col width="15%">
			<col width="10%">
			<col width="10%">
			<col width="5%">
			</colgroup>
			<thead>
			<tr>
				<th>옵션값</th>
				<th>가격</th>
				<th>재고</th>
				<th>상태</th>
				<th>설정</th>
			</tr>
			</thead>
			<tbody id="option2_arr">
			<tr>
				<td><input type="text" name="option_name2[]" class="form-control input-sm" placeholder="예시) 빨강" value="<?=$option2_row->name?>"></td>
				<td><input type="text" name="option_price2[]" class="form-control input-sm text-center" value="<?=$option2_row->price?>"></td>
				<td><input type="text" name="option_number2[]" class="form-control input-sm text-center" maxlength="4" value="<?=$option2_row->number?><?if(empty($option2_row->number)){?>1000<?}?>"></td>
				<td class="text-center">
					<label class="checkbox-inline"><input type="checkbox" name="option_sold_out2[]"  value="y" <?if($option2_row->sold_out==y){ echo "checked";}?>>품절</label>
					<input type="hidden" name="hidden_option_sold_out2[]" value="<?=$option2_row->sold_out?>">
				</td>
				<td><input type="hidden" name="option_idx2[]" value="<?=$option2_row->idx?>"></td>
			</tr>
			<?
				$k=0;
				$option2_rs = $db->select("cs_option","where code='$row->code' and cate=2 order by idx asc limit 1,$option2_cnt");
				while($option2_row = mysql_fetch_array($option2_rs)){
			?>
			<tr class="arr1Row" id="size2Row<?=$k?>">
				<td><input type="text" name="option_name2[]" class="form-control input-sm" placeholder="예시) 빨강" value="<?=$option2_row[name]?>"></td>
				<td><input type="text" name="option_price2[]" class="form-control input-sm text-center" value="<?=$option2_row[price]?>"></td>
				<td><input type="text" name="option_number2[]" class="form-control input-sm text-center" maxlength="4" value="<?=$option2_row[number]?>"></td>
				<td class="text-center">
					<label class="checkbox-inline"><input type="checkbox" name="option_sold_out2[]"  value="y" <?if($option2_row[sold_out]==y){ echo "checked";}?>>품절</label>
					<input type="hidden" name="hidden_option_sold_out2[]" value="<?=$option2_row[sold_out]?>">
				</td>
				<td class="text-center">
					<a href="javascript:;" class="btnDel btn btn-danger btn-xs" data-cate="2" data-del="<?=$k?>" data-idx="<?=$option2_row[idx]?>">삭제</a>
					<input type="hidden" name="option_idx2[]" value="<?=$option2_row[idx]?>">
				</td>
			</tr>				
			<?
			$k++;
			}
			?>
			</tbody>
			</table>
		</td>
	</tr>

	<tr>
		<th>재고</th>
		<td>
			<!-- <input type="text" name="number" class="form-control2 text-center" size="10" maxlength="4" value="<?=$row->number?>">&nbsp;&nbsp; -->
			<label class="checkbox-inline"><input type="checkbox" name="sold_out" value="y" <?if($row->sold_out=="y"){echo "checked";}?>>품절</label>
		</td>
	</tr>

	<tr> 
		<th>제품이미지</th>
		<th colspan="2">
			<table class="table table-bordered">
			<caption></caption>
			<colgroup>
			<col width="15%">
			<col width="10%">
			<col width="*">
			</colgroup>
			<tbody>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="images1_check" value="1" <? if( $row->images1) { ?>checked<?}?>>기본 이미지</label></td>
				<td>
					<? if( $row->images1) { ?><a href="javascript:goodsImagesView( 'G1', '<?=$goods_images1_width;?>' , '<?=$goods_images1_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="images1"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="images2_check" value="1" <? if( $row->images2) { ?>checked<?}?>>확대 이미지</label></td>
				<td>
					<? if( $row->images2) { ?><a href="javascript:goodsImagesView( 'G2', '<?=$goods_images2_width;?>' , '<?=$goods_images2_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="images3"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<!-- <tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images1_check" value="1" <? if( $row->add_images1) { ?>checked<?}?>>추가이미지1</label></td>
				<td>
					<? if( $row->add_images1) { ?><a href="javascript:goodsImagesView( 'A1', '<?=$goods_add_images1_width;?>' , '<?=$goods_add_images1_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="add_images1"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images2_check" value="1" <? if( $row->add_images2) { ?>checked<?}?>>추가이미지2</label></td>
				<td>
					<? if( $row->add_images2) { ?><a href="javascript:goodsImagesView( 'A2', '<?=$goods_add_images2_width;?>' , '<?=$goods_add_images2_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="add_images2"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images3_check" value="1" <? if( $row->add_images3) { ?>checked<?}?>>추가이미지3</label></td>
				<td>
					<? if( $row->add_images3) { ?><a href="javascript:goodsImagesView( 'A3', '<?=$goods_add_images3_width;?>' , '<?=$goods_add_images3_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="add_images3"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images4_check" value="1" <? if( $row->add_images4) { ?>checked<?}?>>추가이미지4</label></td>
				<td>
					<? if( $row->add_images4) { ?><a href="javascript:goodsImagesView( 'A4', '<?=$goods_add_images4_width;?>' , '<?=$goods_add_images4_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="add_images4"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images5_check" value="1" <? if( $row->add_images5) { ?>checked<?}?>>추가이미지5</label></td>
				<td>
					<? if( $row->add_images5) { ?><a href="javascript:goodsImagesView( 'A5', '<?=$goods_add_images5_width;?>' , '<?=$goods_add_images5_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a><? }?>
				</td>
				<td class="text-left"><input type="file" name="add_images5"> [권장 사이즈 OOO x OOO ]</td>
			</tr> -->
			</tbody>
			</table>
		</th>
	</tr>

	<!-- <tr> 
		<th>첨부파일</th>
		<td>
			<? if( $row->goods_file ) { 
				$goods_file_arr = explode("&&", $row->goods_file ); ?>
				<a href="./download.php?idx=<?=$row->idx?>"><?=$goods_file_arr[1];?></a>&nbsp;&nbsp;
				<label class="checkbox-inline" ><input type="checkbox" name="file_Del" value="y">삭제</label>
			<? }?>
			<input name="goods_file" type="file" >
		</td>
	</tr> -->
	<!-- <tr> 
		<th>관련상품등록</th>
		<td colspan="2">
			<input type="text" name="zzim" size="30" class="form-control2" value="<? echo $row->zzim ?>" readonly>&nbsp;
			<a href="javascript:res();" class="glyphicon glyphicon-plus-sign btn btn-warning btn-sm">&nbsp;관련상품선택</a>&nbsp;
			<a href="javascript:cle();" class="glyphicon glyphicon-trash btn btn-danger btn-sm">&nbsp;초기화</a>
		</td>
	</tr> -->
	</tbody>
	</table><br><br>

	<!-- 관련제품 -->
	<div id="ajax_zzim"></div>
	<script>
	zzim_load();
	function zzim_load(){
		var code = $("input[name=code]").val();
		$.ajax({
		type: "get",
		url : "zzim.php?code="+code,
		success:function(result){
			$("#ajax_zzim").html(result);
		}
		});
	}
	</script>

	<h5 class="page-header"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> 제품설명</h5>
	<table class="table table-bordered">
	<tr> 
		<td>
		<?
			$table_name	= "cs_goods";
			$table_idx		= $row->idx;

			$plupload_que = "select url,filename from cs_plupload where table_name='$table_name' and table_idx='$table_idx' order by idx";
			$result_plupload = mysql_query($plupload_que);
			$total_plupload = mysql_affected_rows();
		?>
		<textarea id="contents_source" style="display:none;"><?=$row->content;?></textarea>
		<?include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_area.php";?>			
		</td>
	</tr>
	</table><br>

	<table class="table">
		<tr>
			<td class="text-center"><a href="javascript:;" class="btn btn-primary"  onClick="Editor.save();">저장하기</a></td>
		</tr>
	</table>

	</form>


<script src="/webeditor/webeditor_config.js" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
<!--
function validForm(editor) {
	var validator = new Trex.Validator();
	var content = editor.getContent();

	//옵션
	var option_sold_out1 = document.getElementsByName("option_sold_out1[]"); 
	var option_sold_out2 = document.getElementsByName("option_sold_out2[]"); 
	var hidden_option_sold_out1 = document.getElementsByName("hidden_option_sold_out1[]"); 
	var hidden_option_sold_out2 = document.getElementsByName("hidden_option_sold_out2[]"); 

	for (var i = 0 ; i < option_sold_out1.length; i++) { 
		if(option_sold_out1[i].checked==true){
			hidden_option_sold_out1[i].value="y";
		}else if(option_sold_out1[i].checked==false){
			hidden_option_sold_out1[i].value="";
		}
	}
	for (var i = 0 ; i < option_sold_out2.length; i++) { 
		if(option_sold_out2[i].checked==true){
			hidden_option_sold_out2[i].value="y";
		}else if(option_sold_out2[i].checked==false){
			hidden_option_sold_out2[i].value="";
		}
	}

	if (document.tx_editor_form.name.value == '') {
		alert('제품명을 입력해 주세요');
		document.tx_editor_form.name.focus();
		return false;
	}

	if (document.tx_editor_form.shop_price.value == '') {
		alert('판매가를 입력해 주세요');
		document.tx_editor_form.shop_price.focus();
		return false;
	}

	//if (!validator.exists(content)) {
		//$("#contents_validate").html('내용을 입력해주세요.');
		//Editor.focus();
		//return false;
	//}
	return true;
}

// 옵션
var form=document.tx_editor_form;
if( form.option_check[0].checked ) {
	$(".option1_view").css("display","none");
	$(".option2_view").css("display","none");
} else if( form.option_check[1].checked ) {
	$(".option1_view").css("display","");
	$(".option2_view").css("display","none");
} else if( form.option_check[2].checked ) {
	$(".option1_view").css("display","");
	$(".option2_view").css("display","");
}

//옵션 처리
function  option_arr(cate){
	var no= $('.arr'+cate+'Row').length;
	var html =
	'<tr class="arr'+cate+'Row" id="size'+cate+'Row'+no+'">' +
		'<td><input type="text" name="option_name'+cate+'[]" class="form-control input-sm" placeholder="예시) 빨강"></td>' +
		'<td><input type="text" name="option_price'+cate+'[]" class="form-control input-sm text-center"></td>' +
		'<td><input type="text" name="option_number'+cate+'[]" class="form-control input-sm text-center" maxlength="4" value="1000"></td>' +
		'<td class="text-center">' +
			'<label class="checkbox-inline"><input type="checkbox" name="option_sold_out'+cate+'[]" value="y">품절</label>' +
			'<input type="hidden" name="hidden_option_sold_out'+cate+'[]" value="">' +
		'</td>' +
		'<td class="text-center"><a href="javascript:;" class="btnDel btn btn-danger btn-xs" data-cate="'+cate+'" data-del="'+no+'">삭제</a></td>' +
	'</tr>';
	$("#option"+cate+"_arr").append(html);
}

//삭제
$(document).on("click", ".btnDel", function(){
	var cate =	$(this).attr("data-cate");
	var idx	 =	$(this).attr("data-idx");
	if(idx){
		ans = confirm("[삭제] 하시겠습니까?");
		if(ans==true){		
		$.ajax({
			type: "get",
			url : "option_del.php",
			data: {"idx" :idx}, 
			success:function(result){
			}
		});
		}else{
			return;
		}
	}
	$("#size"+cate+"Row" + $(this).attr("data-del")).remove();
});
//-->
</script>
<? include('../footer.php');?>