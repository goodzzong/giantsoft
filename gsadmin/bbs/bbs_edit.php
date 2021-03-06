<?
$mod	= "bbs";	
include("../header.php");

// 게시판 환경
$bbs_admin_stat	= $db->object("cs_bbs", "where code='$code'", "bbs_cate, bbs_pds, bbs_pds_ea, header, footer, bbs_secret, editor,bbs_type");
$bbs_stat	= $db->object("cs_bbs_data", "where idx=$idx");

$subject = $bbs_stat->subject;
$subject = str_replace('"','&#34;',$subject);
$subject = str_replace("'","&#39;",$subject);

//에디터 스크립트
include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_script.php";
?>


	<form name="tx_editor_form" id="tx_editor_form" action="bbs_edit_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="code" value="<?=$code;?>">
	<input type="hidden" name="table" value="<?=$table;?>">
	<input type="hidden" name="idx" value="<?=$bbs_stat->idx;?>">
	<input type="hidden" name="startPage" value="<?=$startPage;?>">
	<input type="hidden" name="listNo" value="<?=$listNo;?>">
	<input type="hidden" name="search_item" value="<?=$search_item;?>">
	<input type="hidden" name="search_item" value="<?=$search_item;?>">
	<input type="hidden" name="sum_img" value="<?=$bbs_stat->sum_img?>">
	<input type="hidden" name="menu" value="<?=$menu?>">

	<input type="hidden" name="pwd" value="<?=$bbs_stat->pwd;?>">
	<input type="hidden" name="name" value="<?=$bbs_stat->name;?>">

	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<?
	/*****카테고리*****/
	if($bbs_admin_stat->bbs_cate==1) {?>
	<tr>
		<th>카테고리</th>
		<td>
			<select name="cate" class="form-control2">
			<option value="">선택</option>
			<?
				$rsc = $db->select("cs_cate","where code='$code'");
				while($rowc = mysql_fetch_array($rsc)){
			?>
			<option value="<?=$rowc[idx]?>" <?if($rowc[idx]==$bbs_stat->cate){ echo "selected";}?>><?=$rowc[name]?></option>
			<?}?>
			</select>
		</td>
	</tr>
	<? } ?>

	<tr>
		<th>제 목</th>
		<td><input type="text" name="subject" class="form-control" value="<?=stripslashes($subject)?>"></td>
	</tr>

	<?
	/*****비밀글*****/
	if($bbs_admin_stat->bbs_secret==1){ ?>
	<tr>
		<th>비밀글</th>
		<td><label class="checkbox-inline"><input type="checkbox" name="secret"  value="y" <? if($bbs_stat->secret=="y"){ echo "checked"; } ?>>(비밀글 기능 사용시 체크 해 주세요)</label></td>
	</tr>
	<? } ?>

	</tbody>
	</table>


	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<? if($bbs_admin_stat->editor=="1"){ ?>
	<tr>
		<td align="center" colspan='2'>
			<?
				$table_name	= "cs_bbs_data";
				$table_idx		= $bbs_stat->idx;

				$plupload_que = "select url,filename from cs_plupload where table_name='$table_name' and table_idx='$table_idx' order by idx";
				$result_plupload = mysql_query($plupload_que);
				$total_plupload = mysql_affected_rows();
			?>
			<textarea id="contents_source" style="display:none;"><?=$bbs_stat->content;?></textarea>
			<?include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_area.php";?>
		</td>
	</tr>
	<?}else{?>
	<tr>
		<th>내용</th>
		<td><textarea name="tx_content" rows="20" class="form-control"><?=$bbs_stat->content;?></textarea></td>
	</tr>
	<?}?>

	<?
	/*****공지기능*****/
	if($bbs_admin_stat->bbs_type==2) {?>
	<tr>
		<th>공지기능</th>
		<td>
			<label class="radio-inline"><input type="radio" name="notice" value="1" <? if( $bbs_stat->notice==1 ) echo("checked"); ?>>사용</label>
			<label class="radio-inline"><input type="radio" name="notice" value="0" <? if( $bbs_stat->notice==0 ) echo("checked"); ?>>미사용</label>
		</td>
	</tr>
	<? } ?>

	<?
	/*****썸네일 업로드*****/
	if( $bbs_admin_stat->bbs_type==3) { ?>
	<tr>
		<th>썸네일<br><small>리스트 이미지 (최대 5MB)</small></small></th>
		<td>
			<? if($bbs_stat->sum_file!="none"){ ?>&nbsp;<?=$bbs_stat->sum_sfile?>&nbsp;&nbsp;
				<label class="checkbox-inline"><input type="checkbox" name="sumdel" value="y">삭제</label><br>
			<? } ?>
			&nbsp;<input type="file" name="sum_file" >
		</td>
	</tr>
	<? } ?>

	<?
	/*****파일 업로드*****/
	if( $bbs_admin_stat->bbs_pds ) {
		if($bbs_admin_stat->bbs_pds_ea==1){ ?>
	<tr>
		<th>첨부파일</th>
		<td>
		<? if($bbs_stat->bbs_file!="none"){ ?>&nbsp;<?=$bbs_stat->sbbs_file?>&nbsp;&nbsp;
			<label class="checkbox-inline"><input type="checkbox" name="imdel1" value="y">삭제</label><br>
		<? } ?>
		&nbsp;<input type="file" name="bbs_file" ></td>
	</tr>

	<? } else { ?>

		<? for($i=1;$i<=$bbs_admin_stat->bbs_pds_ea;$i++){ ?>
		<tr>
			<th>첨부파일 #<?=$i?></th>
			<td>
			<? if($i==1){ ?>
			<? if($bbs_stat->bbs_file!="none"){ ?>&nbsp;<?=$bbs_stat->sbbs_file?>&nbsp;&nbsp;
				<label class="checkbox-inline"><input type="checkbox" name="imdel1" value="y">삭제</label><br>
			<? } ?>
			&nbsp;<input type="file" name="bbs_file" >
			<? } else { ?>
			<?
			if($i==2){ $bbsf = $bbs_stat->sbbs_file2; }
			if($i==3){ $bbsf = $bbs_stat->sbbs_file3; }
			if($i==4){ $bbsf = $bbs_stat->sbbs_file4; }
			if($i==5){ $bbsf = $bbs_stat->sbbs_file5; }
			if($bbsf){ ?>&nbsp;<?=$bbsf?>&nbsp;<input type="checkbox" name="imdel<?=$i?>" value="y">삭제<br><? } ?>
			&nbsp;<input type="file" name="bbs_file<?=$i?>" >
			<? } ?>
			</td>
		</tr>
	<?} } }?>

	</tbody>
	</table>


	<table class="table">
		<tr>
			<td class="text-center">
				<? if($bbs_admin_stat->editor=="1"){ ?>
					<a href="javascript:;" class="btn btn-primary" onClick="Editor.save();">등록</a>
				<?}else{?>
					<a href="javascript:;" class="btn btn-primary" onClick="tx_editor_form.submit()">등록</a>
				<?}?>
				 <a href="bbs_list.php?startPage=<?=$startPage;?>&code=<?=$code;?>&search_item=<?=$search_item;?>&search_order=<?=$search_order;?>" class="btn btn-default">목록</a>
			 </td>
		</tr>
	</table>

	</form>


<script src="/webeditor/webeditor_config.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
<!--

function validForm(editor) {
	var validator = new Trex.Validator();
	var content = editor.getContent();

	<?if($bbs_admin_stat->bbs_cate==1){?>
	if (document.tx_editor_form.cate.value =="") {
		alert('카테고리를 선택해주세요.');
		document.tx_editor_form.cate.focus();
		return false;
	}
	<?}?>

	if (document.tx_editor_form.subject.value =="") {
		alert('제목을 입력해 주세요');
		document.tx_editor_form.subject.focus();
		return false;
	}

	if (!validator.exists(content)) {
		$("#contents_validate").html('내용을 입력해주세요.');
		Editor.focus();
		return false;
	}
	return true;
}
//-->
</script>


<? include("../footer.php");?>