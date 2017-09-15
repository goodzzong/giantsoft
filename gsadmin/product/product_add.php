<?
$mod	= "product";	
$menu	= "product_add";
include("../header.php");

include$_SERVER['DOCUMENT_ROOT']."/lib/style_class.php";
include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_script.php";
?>
<script type="text/javascript">
<!--
// 수량 입력 폼 체크
function goodsUnlimit() {	if( document.tx_editor_form.unlimit.checked == true ) { document.tx_editor_form.number.value = ""; }}
function goodsNumber() { document.tx_editor_form.unlimit.checked  = false; }

function partCodeCheck() {
	if(document.tx_editor_form.part_code.value=="카테고리를 선택하세요") {
		alert('카테고리를 선택하세요');
	}
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
//// 입력 품 VIEW 체크  종료 //////////////////////////////////////////////////////////////////////////////


/**************관련 제품 시작**************/		
function res(){	
	var code = $("input[name=code]").val();
	window.open("zzim_list.php?code="+code,"","width=1000,height=600,scrollbars=yes");	
}
/**************관련 제품 종료**************/

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
		tx_editor_form.part_code.value = "카테고리를 선택하세요";
		if ( depth2[sp_value2] != null )
		{
	
			for ( i = 0 ; i <= depth2[sp_value2].length -1 ; i++ )
			{
				f.select2.options[i] = new Option(depth2[sp_value2][i],depth2_value[sp_value2][i] + sep + sp_value2 + sep + i );
			}
		}
		else
		{
//			alert("2차 카테고리는 없습니다.");
			tx_editor_form.part_code.value = depth1_value[sp_value2];
			alert("카테고리 선택 완료\n\n제품을 등록 하세요");
			tx_editor_form.name.focus();
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
		tx_editor_form.part_code.value = "카테고리를 선택하세요";
		if ( depth3[sp_value2][sp_value3] != null )
		{

			for ( i = 0 ; i <= depth3[sp_value2][sp_value3].length -1 ; i++ )
			{
				f.select3.options[i] = new Option(depth3[sp_value2][sp_value3][i],depth3_value[sp_value2][sp_value3][i]);
			}
		}
		else
		{
//			alert("3차 카테고리는 없습니다.");
			tx_editor_form.part_code.value = depth2_value[sp_value2][sp_value3];
			alert("카테고리 선택 완료\n\n제품을 등록 하세요");
			tx_editor_form.name.focus();
		}
	}
	else if ( depth == 3 && index != -1 )
	{
		tx_editor_form.part_code.value = f.select3[index].value;
		alert("카테고리 선택 완료\n\n제품을 등록 하세요");
		tx_editor_form.name.focus();
	}
}
////  카테고리 선택 폼 설정 종료 //////////////////////////////////////////////////////////////////////////
//-->
</script>

	<div class="text-right">
		<h3 class="page-header">
			<small>제품등록</small>
		</h3>
	</div>

	<form name="tx_editor_form" id="tx_editor_form" action="product_add_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="hidden_option1_data">
	<input type="hidden" name="hidden_option2_data">
	<input type="hidden" name="code" value="<?=time();?>" title="제품코드">
	<input type="hidden" name="part_code" value="">
	<input type="hidden" name="icon" value="" title="추가표시">
	<input type="hidden" name="main_position" value="n" title="">
	<input type="hidden" name="sub_position" value="n" title="">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%" title="분류선택">
	<col width="*" title="카테고리">
	</colgroup>		
	<tbody>
	<tr> 
		<th class="text-center">분류선택</th>
		<td>
			<table class="table table-bordered">
			<colgroup>
			<col width="33%">
			<col width="33%">
			<col width="*">
			</colgroup>		
			<tbody>
			<tr> 
				<td class="text-center"><span class="btn btn-primary btn-xs btn-grad btn-rect">1차 카테고리</span></td>
				<td class="text-center"><span class="btn btn-primary btn-xs btn-grad btn-rect">2차 카테고리</span></td>
				<td class="text-center"><span class="btn btn-primary btn-xs btn-grad btn-rect">3차 카테고리</span></td>
			</tr>
			<tr> 
				<td>
					<select  name="select1" onChange='change(1, this.form.select1.selectedIndex, this.form)'  class="form-control"  size="5">
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
			<label class="radio-inline"><input type="radio" name="display" value="1" checked>노출</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="display" value="">미노출</label>&nbsp;&nbsp;
		</td>
	</tr>
	<tr> 
		<th>메인노출1</th>
		<td>
			<label class="radio-inline"><input type="radio" name="main_position" value="1">ON</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="main_position" value="" checked>OFF</label>
		</td>
	</tr>
	<tr> 
		<th>메인노출2</th>
		<td>
			<label class="radio-inline"><input type="radio" name="sub_position" value="1">ON</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="sub_position" value="" checked>OFF</label>
		</td>
	</tr>
	<!-- <tr>
		<th>추가표시</th>
		<td>
			<?
			$rsc = $db->select("cs_cate","where table_name='cs_goods' and code='icon' order by idx asc");
			while($rowc = mysql_fetch_array($rsc)){
			?>
			<label class="checkbox-inline"><input type="checkbox" name="icon_arr" value="<?=$rowc[idx]?>"><?=$rowc[name]?></label>&nbsp;&nbsp;
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
		<td><input name="name" type="text" maxlength="100" class="form-control" onKeyDown="partCodeCheck();"></td>
	</tr>
	<tr> 
		<th>소비자가 <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="- 쉼표없이 숫자만 입력 하세요"><span class="glyphicon glyphicon-question-sign"></span></button></th>
		<td><input type="text" name="old_price" class="form-control2 text-right" size="10"> 원</td>
	</tr>
	<tr> 
		<th>판매가 <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="- 쉼표없이 숫자만 입력 하세요"><span class="glyphicon glyphicon-question-sign"></span></button></th>
		<td><input type="text" name="shop_price" class="form-control2 text-right" size="10"> 원</td>
	</tr>
	<tr style="display:none;"> 
		<th>제품 옵션</td>
		<td>
			<label class="radio-inline"><input type="radio" name="option_check" value="0" checked onClick="optionCheck()">&nbsp;사용안함</label>&nbsp;&nbsp;
			<label class="radio-inline"><input type="radio" name="option_check" value="1" onClick="optionCheck()">&nbsp;옵션1개</label>&nbsp;&nbsp;
			<label class="radio-inline"><input type="radio" name="option_check" value="2" onClick="optionCheck()">&nbsp;옵션2개</label>&nbsp;&nbsp;
		</td>
	</tr>

	<!-- 제품옵션(1) -->
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
				<td><input type="text" name="option1_name" class="form-control input-sm" placeholder="예시) 색상"></td>
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
				<td><input type="text" name="option_name1[]" class="form-control input-sm" placeholder="예시) 빨강"></td>
				<td><input type="text" name="option_price1[]" class="form-control input-sm text-center" placeholder="예시) 10000"></td>
				<td><input type="text" name="option_number1[]" class="form-control input-sm text-center" maxlength="4" placeholder="예시) 9999" value="1000"></td>
				<td class="text-center">
					<label class="checkbox-inline"><input type="checkbox" name="option_sold_out1[]" value="y">품절</label>
					<input type="hidden" name="hidden_option_sold_out1[]" value="">
				</td>
				<td></td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>


	<!-- 제품옵션(2) -->
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
				<td><input type="text" name="option2_name" class="form-control input-sm" placeholder="예시) 색상"></td>
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
				<td><input type="text" name="option_name2[]" class="form-control input-sm" placeholder="예시) 빨강"></td>
				<td><input type="text" name="option_price2[]" class="form-control input-sm text-center" placeholder="예시) 10000"></td>
				<td><input type="text" name="option_number2[]" class="form-control input-sm text-center" maxlength="4" placeholder="예시) 9999" value="1000"></td>
				<td class="text-center">
					<label class="checkbox-inline"><input type="checkbox" name="option_sold_out2[]" value="y">품절</label>
					<input type="hidden" name="hidden_option_sold_out2[]" value="">
				</td>
				<td></td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>

	<tr>
		<th>재고</th>
		<td>
			<!-- <input type="text" name="number" class="form-control2 text-center" size="10" maxlength="4" value="1000">&nbsp;&nbsp; -->
			<label class="checkbox-inline"><input type="checkbox" name="sold_out" value="y">품절</label>
		</td>
	</tr>

	<tr> 
		<th>제품이미지</th>
		<th>
			<table class="table table-bordered">
			<caption></caption>
			<colgroup>
			<col width="15%">
			<col width="*">
			</colgroup>
			<tbody>
			<tr>
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="images1_check" value="1" checked>기본 이미지</label></td>
				<td class="text-left"><input name="images1" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr>
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="images2_check" value="1" checked>확대 이미지</label></td>
				<td class="text-left"><input name="images2" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<!-- <tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images1_check" value="1" checked>추가이미지1</label></td>
				<td class="text-left"><input name="add_images1" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images2_check" value="1" checked>추가이미지2</label></td>
				<td class="text-left"><input name="add_images2" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images3_check" value="1" checked>추가이미지3</label></td>
				<td class="text-left"><input name="add_images3" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images4_check" value="1" checked>추가이미지4</label></td>
				<td class="text-left"><input name="add_images4" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr>
			<tr> 
				<td><label class="checkbox-inline" style="font-weight:bold"><input type="checkbox" name="add_images5_check" value="1" checked>추가이미지5</label></td>
				<td class="text-left"><input name="add_images5" type="file"> [권장 사이즈 OOO x OOO ]</td>
			</tr> -->
			</tbody>
			</table>
		</th>
	</tr>
	<!-- <tr> 
		<th>첨부파일</th>
		<td><input type="file" name="goods_file"></td>
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
			<td><?include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_area.php";?></td>
		</tr>
	</table><br>
	
	<table class="table">
		<tr>
			<td class="text-center"><a href="javascript:;" class="btn btn-primary" onClick="Editor.save();" >저장하기</a></td>
		</tr>
	</table>

	</form>



<script src="/webeditor/webeditor_config.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
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

	if (document.tx_editor_form.part_code.value == '') {
		alert('카테고리를 선택해 주세요');
		return false;
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
	//dataInput();
	return true;
}


//옵션 처리
function  option_arr(cate){
	var no= $('.arr'+cate+'Row').length;
	var html =
	'<tr class="arr'+cate+'Row" id="size'+cate+'Row'+no+'">' +
		'<td><input type="text" name="option_name'+cate+'[]" class="form-control input-sm" placeholder="예시) 빨강"></td>' +
		'<td><input type="text" name="option_price'+cate+'[]" class="form-control input-sm text-center" placeholder="예시) 10000"></td>' +
		'<td><input type="text" name="option_number'+cate+'[]" class="form-control input-sm text-center" maxlength="4" placeholder="예시) 9999" value="1000"></td>' +
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
	var cate =  $(this).attr("data-cate");
	$("#size"+cate+"Row" + $(this).attr("data-del")).remove();
});
//-->
</script>

<? include('../footer.php');?>