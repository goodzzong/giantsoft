<?
$mod	= "bbs";	
include ("../header.php");

// 게시판 환경
$bbs_admin_stat	= $db->object("cs_bbs", "where code='$code'", "bbs_cate, bbs_pds, bbs_pds_ea, header, footer, bbs_secret,editor,bbs_type");
if( $_GET[reWrite] ) {
  	$view_row		= $db->object("cs_bbs_data", "where idx=$idx");
	//$subject2			= "[답글]".$db->stripSlash($view_row->subject);
	$subject2			= "답변입니다.";
	$content			= $db->stripSlash($view_row->content);
	$re_content		= "$view_row->name 님 쓰신글\n\n"."제목 : ".$view_row->subject."\n".$content."<br><br>"."[답변]<br><br>";
}
//에디터 스크립트
include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_script.php";
?>


	<form name="tx_editor_form" id="tx_editor_form" class="form-horizontal"  action="bbs_write_ok.php" method="post" enctype="multipart/form-data" >
	<input type="hidden" name="code" value="<?=$code;?>">
	<input type="hidden" name="ref" value="<?=$view_row->ref;?>">
	<input type="hidden" name="re_step" value="<?=$view_row->re_step;?>">
	<input type="hidden" name="re_level" value="<?=$view_row->re_level;?>">

	<input type="hidden" name="pwd" value="<?=$admin_stat->admin_passwd ;?>">
	<input type="hidden" name="name" value="관리자">

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
				$rsc = $db->select("cs_cate","where code='$code' order by idx asc");
				while($rowc = mysql_fetch_array($rsc)){
			?>
			<option value="<?=$rowc[idx]?>"><?=$rowc[name]?></option>
			<?}?>
			</select>
		</td>
	</tr>
	<? } ?>

	<tr>
		<th>제 목</th>
		<td><input type="text" name="subject" class="form-control" value="<?=$subject2?>"></td>
	</tr>

	<?
	/*****비밀글*****/
	if($bbs_admin_stat->bbs_secret==1){ ?>
	<tr>
		<th>비밀글</th>
		<td><label class="checkbox-inline"><input type="checkbox" class="uniform" name="secret"  value="y">(비밀글 기능 사용시 체크 해 주세요)</label></td>
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
		<td colspan="2">
			<textarea id="contents_source" style="display:none;"><?=$re_content;?></textarea>
			<?include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_area.php";?>
		</td>
	</tr>
	<?}else{?>
	<tr>
		<th>내용</th>
		<td><textarea id="wr_content" name="tx_content" rows="20" class="form-control"></textarea></td>
	</tr>
	<?}?>

	<?
	/*****공지기능*****/
	if($bbs_admin_stat->bbs_type==2) {?>
	<tr>
		<th>공지기능</th>
		<td>
			<label class="radio-inline"><input type="radio" name="notice" value="1">사용</label>
			<label class="radio-inline"><input type="radio" name="notice" value="0" checked>미사용</label>
		</td>
	</tr>
	<? } ?>

	<?
	/*****썸네일 업로드*****/
	if( $bbs_admin_stat->bbs_type==3) { ?>
	<tr>
		<th>썸네일<br><small>리스트 이미지 (최대 5MB)</small></th>
		<td><input type="file" name="sum_file" ></td>
	</tr>
	<? } ?>

	<?
	/*****파일 업로드*****/
	if( $bbs_admin_stat->bbs_pds ) {
		if($bbs_admin_stat->bbs_pds_ea==1){ ?>
	<tr>
		<th>첨부파일</td>
		<td><input type="file" name="bbs_file" ></td>
	</tr>
	<? } else { ?>
	<? for($i=1;$i<=$bbs_admin_stat->bbs_pds_ea;$i++){ ?>
	<tr>
		<th>첨부파일 #<?=$i?></th>
		<td>
		<? if($i==1){ ?>
		<input type="file" name="bbs_file" >
		<? } else { ?>
		<input type="file" name="bbs_file<?=$i?>">
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
				<a href="javascript:;" class="btn btn-primary" onClick="Editor.save();">
			<?}else{?>
				<a href="javascript:;" class="btn btn-primary" onClick="tx_editor_form.submit()">
				<?}?>등록</a>
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
	ans = confirm("등록하시겠습니까?");
	if(ans==true){
	return true;
	}
}
//-->
</script>


<? include('../footer.php');?>