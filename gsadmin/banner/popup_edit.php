<?
$mod	= "banner";	
$menu	= "popup";
include ("../header.php");
include $_SERVER['DOCUMENT_ROOT']."/lib/style_class.php";
include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_script.php";
$row = $db->object("cs_popup", " where idx='$_GET[idx]'");
$popup_images_size=@getimagesize("../../data/designImages/$row->popup_images");// 이미지 사이즈
$popup_width=$popup_images_size[0];// 가로 길이
$popup_height=$popup_images_size[1];// 세로 길이
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>팝업배너(수정)</small>
		</h3>
	</div>

	<form name="tx_editor_form" id="tx_editor_form" action="popup_edit_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idx" value="<?=$_GET[idx];?>">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th>팝업 종류</th>
		<td>
			<label class="radio-inline"><input type="radio" name="kind" value="0" <? if($row->kind==0){ echo "checked"; } ?> onClick="popupReg()">팝업</label>
			<label class="radio-inline"><input type="radio" name="kind" value="1" <? if($row->kind==1){ echo "checked"; } ?> onClick="popupReg()">레이어</label>
			<label class="radio-inline"><input type="radio" name="kind" value="2" <? if($row->kind==2){ echo "checked"; } ?> onClick="popupReg()">모바일</label>
		</td>
	</tr>
	<tr>
		<th>형태 선택</th>
		<td>
			<label class="radio-inline"><input type="radio" name="display" value="0" onClick="popupReg2()" <? if( $row->display == 0 ) { echo("checked");}?>>HTML</label>
			<label class="radio-inline"><input type="radio" name="display" value="1" onClick="popupReg2()" <? if( $row->display == 1 ) { echo("checked");}?>>이미지</label>
		</td>
	</tr>
	<tr>
		<th>기간설정</th>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
			<tbody>
			<tr>
				<td>
					<div class="input-group datetime">
						<input type="text" name="start_day" class="form-control input-sm text-center" value="<?=date("Y-m-d", $row->start_day);?>">
						<span class="input-group-addon">
							<span class="glyphicon-calendar glyphicon"></span>
						</span>
					</div>		
				</td>
				<td>&nbsp;~&nbsp;</td>
				<td>
					<div class="input-group datetime">
						<input type="text" name="end_day" class="form-control input-sm text-center" value="<?=date("Y-m-d", $row->end_day);?>">
						<span class="input-group-addon">
							<span class="glyphicon-calendar glyphicon"></span>
						</span>
					</div>			
				</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr class="popup_view">
		<th>팝업크기</th>
		<td>
			가로 <input name="width" type="text" class="form-control2 input-sm text-right" size="5" value="<?=$row->width;?>">&nbsp;픽셀,&nbsp;
			세로 <input name="height" type="text" class="form-control2 input-sm text-right" size="5" value="<?=$row->height;?>">&nbsp;픽셀 
		</td>
	</tr>
	<tr class="popup_view">
		<th>팝업 표시 위치</th>
		<td>
			화면 위로부터 <input name="tops" type="text"  class="form-control2 input-sm text-right" size="5" value="<?=$row->tops;?>">&nbsp;픽셀,&nbsp;
			왼쪽부터 <input name="lefts" type="text"  class="form-control2 input-sm text-right" size="5" value="<?=$row->lefts;?>">&nbsp;픽셀에서 노출
		</td>
	</tr>
	<tr>
		<th>팝업제목</th>
		<td><input name="title_bar" type="text" class="form-control input-sm" value="<?=$row->title_bar;?>"></td>
	</tr>
	<tr>
		<th>창닫기 방법</th>
		<td>
			<label class="radio-inline"><input type="radio" name="live" value="0" <? if( $row->live == 0 ) { echo("checked");}?>>오늘 하루 열지 않음</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="live" value="1" <? if( $row->live == 1 ) { echo("checked");}?>>다시 열지 않음</label>
		</td>
	</tr>
	<tr class="popup_images" style="display:none;">
		<th>URL</th>
		<td>http://<input name="link_url" type="text" class="form-control input-sm" value="<?=$row->link_url;?>"></td>
	</tr>
	<tr class="popup_images" style="display:none;">
		<th>이미지</th>
		<td>
			<input name="popup_images" type="file" >
			<span class="popup_mobile" style="display:none;">[ 권장사이즈 : 640 x 680 ]</span>
			<? if( $row->popup_images) { ?> 
				<a href="javascript:imagesView( '<?=$row->idx;?>', '<?=$popup_width;?>', '<?=$popup_height;?>' );" class="glyphicon glyphicon-picture btn btn-default btn-sm" aria-hidden="true"> View</a>
			<? }?>&nbsp;

		</td>
	</tr>
	<tr class="popup_html" style="display:none;">
		<td colspan="2">
			<?
				$table_name	= "cs_popup";
				$table_idx		= $bbs_stat->idx;

				$plupload_que = "select url,filename from cs_plupload where table_name='$table_name' and table_idx='$table_idx' order by idx";
				$result_plupload = mysql_query($plupload_que);
				$total_plupload = mysql_affected_rows();
			?>
			<textarea id="contents_source" style="display:none;"><?=$row->content;?></textarea>
			<?include $_SERVER['DOCUMENT_ROOT']."/webeditor/webeditor_area.php";?>
		</td>
	</tr>
	</tbody>
	</table>
	</form>

	<p class="popup_images" style="display:none;">※ 이미지 업로드시 링크URL 을 입력하시면 이미지를 클릭할 경우 해당페이지로 이동시킵니다. </p>

	<table class="table">
		<tr>
			<td class="text-center">
				<a href="#" class="btn btn-primary" onClick="Editor.save();">등록</a>&nbsp;
				<a href="./popup.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>


<script src="/webeditor/webeditor_config.js" type="text/javascript" charset="utf-8"></script>
<script language="JavaScript">
<!--
popupReg();
/*팝업 종류*/
function popupReg(){
	var form=document.tx_editor_form;
	if( form.kind[2].checked ) {
		$(".popup_view").css("display","none");
		$(".popup_mobile").css("display","");
		form.display[1].checked = true;
		form.display[0].disabled= true;
		popupReg2();		
	}else{
		form.display[0].disabled= false;
		$(".popup_view").css("display","");
		$(".popup_mobile").css("display","none");
	}
}
/*형태 선택*/
function popupReg2() {
	var form=document.tx_editor_form;
	if( form.display[0].checked ) {
		$(".popup_html").css("display","");
		$(".popup_images").css("display","none");
	} else if( form.display[1].checked ) {
		$(".popup_html").css("display","none");
		$(".popup_images").css("display","");		
	}
}

/*출력이미지*/
function imagesView( idx, w, h ){
	window.open("popup_images_view.php?idx="+idx,"","scrollbars=no,width="+w+",height="+h+",top=200,left=200");
}

/*폼체크*/
function validForm(editor) {
	var validator = new Trex.Validator();
	var content = editor.getContent();

	if (document.tx_editor_form.width.value == '' && document.tx_editor_form.kind[2].checked==false) {
			alert('가로 사이즈를 입력해 주세요.');
			document.tx_editor_form.width.focus();
			return false;
		}
		if (document.tx_editor_form.height.value == '' && document.tx_editor_form.kind[2].checked==false) {
			alert('세로 사이즈를 입력해 주세요.');
			document.tx_editor_form.height.focus();
			return false;
		}
		if (document.tx_editor_form.title_bar.value == '') {
			alert('팝업 제목을 입력해 주세요.');
			document.tx_editor_form.title_bar.focus();
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