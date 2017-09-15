<?
$mod="ETC";
$menu="store";
include("../../header.php");

if($idx) { 
	$row = $db->object("cs_store","where idx='$idx'");
	$page_mode = "수정";
	$mode = "edit";
}else{
	$page_mode = "등록";
	$mode = "write";
}
?>


<div class="text-right">
	<h3 class="page-header">
		<small>
			매장안내(<?=$page_mode?>)
		</small>
	</h3>
</div>


	<form method="post" action="./store_exe.php" name="tx_editor_form" ENCTYPE="multipart/form-data">
	<input type="hidden" name="mode" value="<?=$mode?>">	
	<input type="hidden" name="idx" value="<?=$idx?>">
	<input type="hidden" name="DB_gugun" value="<?=$row->gugun?>">
	<input type="hidden" name="zip1" id="zip1" value="<?=$row->zip1?>">
	<input type="hidden" name="zip2" id="zip2" value="<?=$row->zip2?>">


	<table class="table table-bordered">
	<colgroup>
	<col width="20%">
	<col width="80%">
	</colgroup>
	<tbody>
	<tr>
		<th>지역</th>
		<td>
			<select name="sido" id="sido" class="form-control2" onchange="javascript:sidoChange();">
			<option value="">광역시/도 선택</option>
			<?
				$query1 = "select * from cs_zip group by sido asc"; 
				$rs1 = mysql_query($query1); 
					while($row1=mysql_fetch_array($rs1)){
			?>
				<option value="<?=$row1[sido]?>" <?if($row1[sido]==$row->sido){ echo "selected";}?>><?=$row1[sido]?></option> 
			<?}?> 
			</select>
			<span id="search-gugun">
				<select name="gugun" id="gugun" class="form-control2">
					<option value="">구/군 선택</option>
				</select>
			</span>
		</td>
	</tr>
	<tr>
		<th>매장명</th>
		<td><input type="text" name="subject" class="form-control col-md-5" value="<?=$row->subject?>"></td>
	</tr>
	<tr>
		<th>우편번호</th>
		<td>
			<input name="zip_new" id="zip_new" type="text" class="form-control2" style="text-align: center;" size="10" value="<?=$row->zip_new?>" readonly>&nbsp;
			<a href="javascript:openDaumPostcode()" class="btn btn-success btn-xs">우편번호찾기</a>&nbsp;
		</td>
	</tr>
	<tr>
		<th>주 소</th>
		<td>
			<input name="add1" id="add1" type="text" class="form-control btn-block" value="<?=$row->add1?>">
			<input name="add2" id="add2" type="text" class="form-control btn-block" value="<?=$row->add2?>"  placeholder="상세정보(번지)">
		</td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><input type="text" name="tel" class="form-control col-md-3" value="<?=$row->tel?>"></td>
	</tr>
	<tr>
		<th>이미지</th>
		<td>
		<?
			if($row->bbs_file){
				echo "<img src='../../data/bbsData/$row->bbs_file'>";
				echo "<br>";
				echo "$row->sbbs_file";
				echo "<br>";
				echo "<label class='checkbox-inline'><input type='checkbox' name='imdel1' value='y'>삭제</label><br><br>";
			}
		?>
		<input type="file" name="bbs_file">[ 권장사이즈 : OOO x OOO ]
		</td>
	</tr>
	</tbody>
	</table>
	</form>


	<table class="table">
		<tr>
			<td class="text-center">
				<a href="javascript:send();" class="btn btn-primary">등록</a>
				<a href="store_list.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>


<script type="text/javascript">
<!--
function send(form){
	var form=document.tx_editor_form;

	if(form.subject.value==""){
		alert("매장명을 입력해주세요.");
		form.subject.focus();
	}else{

		form.submit();
	}
}


function sidoChange(){
	var sido		= $("select[name='sido'] option:selected").val();
    var gugun	= $('input:hidden[name="DB_gugun"]').val();

		$.ajax({
			type: "POST",
			url : "zip_gugun.php",
			data: {"sido":sido,"gugun":gugun}, 
			success:function(html){
				$("#search-gugun").html(html);
			}
		});
		
}

$(window).load(function(){
	// 페이지로드 후 sidoChange함수호출
	sidoChange();
});

//-->
</script>


<? include('../../footer.php');?>