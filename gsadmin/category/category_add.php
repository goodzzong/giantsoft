<?
$mod	= "product";	
$menu	= "category_list";
include("../header.php");
include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_script.php";

if($part_index==""){	$part_index = "1";}
$row = $db->object("cs_part", "where idx='$_GET[idx]'");
?>	


	<div class="text-right">
		<h3 class="page-header">
			<small>카테고리관리(등록)</small>
		</h3>
	</div>


	<form action="category_add_ok.php" id="tx_editor_form" method="post" name="part_form" enctype="multipart/form-data">
	<input type="hidden" name="part_index" value="<?=$part_index?>">
	<input type="hidden" name="sum_img" value="">

<?if($part_index==1){?>
	<input type="hidden" name="part1_code" value="<?=time()?>" title="카테고리 코드">
<?}else if($part_index==2){?>
	<input type="hidden" name="part1_code" value="<?=$row->part1_code;?>" title="1차코드">
	<input type="hidden" name="part2_code" value="<?=time();?>" title="2차코드">
<?}else if($part_index==3){?>
	<input type="hidden" name="part1_code" value="<?=$row->part1_code;?>" title="1차코드">
	<input type="hidden" name="part2_code" value="<?=$row->part2_code;?>" title="2차코드">
	<input type="hidden" name="part3_code" value="<?=time();?>" title="3차코드">
<?
	}else{
		$tools->errMsg('잘못된 접근입니다.');
	}
?>


	<table class="table table-bordered">		
	<colgroup>
	<col width="20%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr> 
		<th>카테고리 상태</th>
		<td><?=$part_index;?>차 카테고리 등록</td>
	</tr>
	<tr> 
		<th>카테고리 이름</th>
		<td><input name="part_name" type="text" class="form-control" maxlength="100" placeholder="카테고리 이름을 적어주세요"></td>
	</tr>
	<tr> 
		<th>노출여부</th>
		<td>
			<label class="radio-inline"><input type="radio" name="part_display_check" value="0">&nbsp;미노출</label>
			<label class="radio-inline"><input type="radio" name="part_display_check" value="1" checked>&nbsp;노출</label>
		</td>
	</tr>
	<tr style="display:<?if($part_index >= 3){?>none<?}?>"> 
		<th>하위 카테고리 설정</th>
		<td>
			<label class="radio-inline"><input type="radio" name="part_low_check" value="0" checked>&nbsp;미사용&nbsp;</label>
			<label class="radio-inline"><input type="radio" name="part_low_check" value="1">&nbsp;사용&nbsp;</label>&nbsp;&nbsp;(2, 3차 카테고리를 등록 유무 설정)
		</td>
	</tr>
	<tr style="display:none">
		<th>이미지 첨부</th>
		<td><input type="file" name="bbs_file"></td>
	</tr>
	<tr style="display:none"> 
		<th>내 용</th>
		<td><?include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_area.php";?></td>
	</tr>
	</tbody>
	</table>
	</form>


	<table class="table">
		<tr>
			<td class="text-center">
				<a href="javascript:;" class="btn btn-primary" onClick="Editor.save();">등록</a>
				<a href="./category_list.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>


<script src="/webeditor/webeditor_config.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
<!--
function validForm(editor) {
	var validator = new Trex.Validator();
	var content = editor.getContent();

		if (document.part_form.part_name.value == '') {
			alert('카테고리 이름을 입력해주세요.');
			document.part_form.part_name.focus();
			return false;
	}
	/*
	if (!validator.exists(content)) {
		$("#contents_validate").html('내용을 입력해주세요.');
		Editor.focus();
		return false;
	}
	*/
	return true;
}
//-->
</script>


<? include('../footer.php');?>