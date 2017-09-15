<?
$mod	= "banner";	
$menu	= "banner";
include("../header.php");

if($idx) { 
	$row = $db->object("cs_banner","where idx='$idx'");
	$page_mode = "수정";
	$mode = "edit";
}else{
	$page_mode = "등록";
	$mode = "write";
}
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>홈/제품 배너 (<?=$page_mode?>)</small>
		</h3>
	</div>

	<form method="post" action="banner_ok.php" name="tx_editor_form" ENCTYPE="multipart/form-data">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr> 
		<th>노출여부</th>
		<td>
			<label class="radio-inline"><input type="radio" name="display" value="1" <?if($row->display){echo "checked";}?>>노출</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="display" value="0" <?if(empty($row->display)){echo "checked";}?>>미노출</label>&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<th>제목</th>
		<td><input name="subject" class="form-control" value="<?=$row->subject?>"></td>
	</tr>
	<tr>
		<th>링크</th>
		<td>http://<input type="text" name="link_url" class="form-control" value="<?=$row->link_url?>"></td>
	</tr>
	<tr>
		<th>링크열기</th>
		<td>
			<label class="radio-inline"><input type="radio" name="link_open" value="1" <?if($row->link_open=="1"){ echo "checked";}?>  <?if(empty($idx)){ echo "checked";}?>> 새 창에서 열기</label>
			<label class="radio-inline"><input type="radio" name="link_open" value="2" <?if($row->link_open=="2"){ echo "checked";}?>> 현재 창에서 열기</label>
			<label class="radio-inline"><input type="radio" name="link_open" value="3" <?if($row->link_open=="3"){ echo "checked";}?>> 링크 없음</label>
		</td>
	</tr>
	<tr>
		<th>이미지</th>
		<td>
		<?
			if($row->bbs_file){
				echo "<img src='../../data/bbsData/$row->bbs_file' style='max-width:100%;'>";
				echo "<br>";
				echo "$row->sbbs_file";
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
				<a href="javascript:;" class="btn btn-primary" onClick="sendit();">등록</a>
				<a href="banner.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>

<script type="text/javascript">
<!--
function sendit() {
	var form=document.tx_editor_form;
	if(form.subject.value=="") {
		alert("제목을 선택해 주세요.");
		form.subject.focus();
	} else {
		form.submit();
	}
}
//-->
</script>

<? include('../footer.php');?>