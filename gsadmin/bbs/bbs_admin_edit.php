<?
$mod	= "bbs";	
include("../header.php");
$row = $db->object("cs_bbs", "where idx=$_GET[idx]");
?>

<script language="JavaScript">
<!--
// 폼 전송
function bbsSendit() {
	var form=document.bbs_reg_form;
	if(form.name.value=="") {
		alert("게시판 제목을 입력해 주십시오.");
		form.name.focus();
	} else if( form.code.value=="") {
		alert("게시판 코드를 입력해 주십시오.");
		form.code.focus();
	} else {
		form.submit();			
	}
}

// 뉴 마크
function newCheck() {
	var form=document.bbs_reg_form;
	if(form.new_check.checked  == true ) {
		form.new_mark.disabled = false;
	} else {
		form.new_mark.disabled = true;
	}
}

// 쿨 마크
function coolCheck() {
	var form=document.bbs_reg_form;
	if(form.cool_check.checked  == true ) {
		form.cool_mark.disabled = false;
	} else {
		form.cool_mark.disabled = true;	
	}
}


// 게시판 형태
function artCheck() {
	var form=document.bbs_reg_form;
	if(form.bbs_type[0].checked ) {
		form.list_width.disabled = true;
		form.list_width.value="0";
		form.list_height.value = 10;
	} else if(form.bbs_type[1].checked ) {
		form.list_width.value="0";
		form.list_width.disabled = true;
		form.bbs_coment[1].checked = true;
		form.bbs_pds[1].checked = true;
		form.list_height.value = 10;
	} else if(form.bbs_type[2].checked ) {
		form.bbs_pds[0].checked = true;
		form.list_width.disabled = false;
		form.list_width.value = 4;
		form.list_height.value = 16;
	}
}
//-->
</script>
			
	<form name="bbs_reg_form" action="bbs_admin_edit_ok.php" method="post">
	<input type="hidden" name="idx" value="<?=$row->idx;?>">
	<input type="hidden" name="bbs_admin_edit" value="true">
	<input type="hidden" name="view" value="0">
	<input type="hidden" name="new_check" value="1">
	<input type="hidden" name="new_mark" value="24">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="35%">
	<col width="15%">
	<col width="35%">
	</colgroup>
	<tbody>
	<tr> 
		<th>게시판명</th>
		<td><input name="name" type="text" class="form-control" value="<?=$row->name;?>"></td>
		<th>게시판코드</th>
		<td><input name="code" type="text" class="form-control2"  value="<?=$row->code;?>"  readonly>  (수정불가)</td>
	</tr>
	<tr> 
		<th>게시판타입</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="1" <? if( $row->bbs_type == 1) echo("checked"); ?> onClick="artCheck()"> 답변형</label>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="2" <? if( $row->bbs_type == 2) echo("checked"); ?> onClick="artCheck()"> 공지사항형</label>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="3" <? if( $row->bbs_type == 3) echo("checked"); ?> onClick="artCheck()"> 갤러리형</label>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="4" <? if( $row->bbs_type == 4) echo("checked"); ?> onClick="artCheck()"> FAQ형</label>
		</td>
		<th>비밀글기능</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_secret" value="1" <? if( $row->bbs_secret ==1) echo("checked"); ?>> 사용함</label>
			<label class="radio-inline"><input type="radio" name="bbs_secret" value="0" <? if( $row->bbs_secret ==0) echo("checked"); ?>> 사용안함</label>
		</td>
	</tr>
	<tr> 
		<th>카테고리</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_cate" value="0" <? if( $row->bbs_cate ==0) echo("checked"); ?>> 미사용</label>
			<label class="radio-inline"><input type="radio" name="bbs_cate" value="1" <? if( $row->bbs_cate ==1) echo("checked"); ?>> 사용</label>
		</td>
		<th></th>
		<td></td>
	</tr>
	<tr> 
		<th>자료실사용</th>
		<td> 
			<label class="radio-inline"><input type="radio" name="bbs_pds" value="1" <? if( $row->bbs_pds ) echo("checked"); ?>> 사용함</label>
			<select name="bbs_pds_ea" class="form-control2">
				<option value="1" <? if($row->bbs_pds_ea==1){ echo "selected"; } ?>>1</option>
				<option value="2" <? if($row->bbs_pds_ea==2){ echo "selected"; } ?>>2</option>
				<option value="3" <? if($row->bbs_pds_ea==3){ echo "selected"; } ?>>3</option>
				<option value="4" <? if($row->bbs_pds_ea==4){ echo "selected"; } ?>>4</option>
				<option value="5" <? if($row->bbs_pds_ea==5){ echo "selected"; } ?>>5</option>
			</select>개&nbsp;
			<label class="radio-inline"><input type="radio" name="bbs_pds" value="0" <? if( ! $row->bbs_pds ) echo("checked"); ?>> 사용안함</label>
		</td>
		<th>코멘트기능</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_coment" value="1" <? if( $row->bbs_coment ) echo("checked"); ?>> 사용함</label>
			<label class="radio-inline"><input type="radio" name="bbs_coment" value="0" <? if( ! $row->bbs_coment ) echo("checked"); ?>> 사용안함</label>
		</td>
	</tr>
	<tr> 
		<th>접근권한</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_access" value="0" <? if( $row->bbs_access == 0) echo("checked"); ?>> 비회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_access" value="1" <? if( $row->bbs_access == 1) echo("checked"); ?>> 회원</label>
		</td>
		<th>읽기권한</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_read" value="0" <? if( $row->bbs_read == 0) echo("checked"); ?>> 비회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_read" value="1" <? if( $row->bbs_read == 1) echo("checked"); ?>> 회원</label>
		</td>
	</tr>
	<tr> 
		<th>쓰기권한</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_write" value="0" <? if( $row->bbs_write == 0) echo("checked"); ?>> 비회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_write" value="1" <? if( $row->bbs_write == 1) echo("checked"); ?>> 회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_write" value="9" <? if( $row->bbs_write == 9) echo("checked"); ?>> 관리자</label>
		</td>
		<th>가로목록수</td>
		<td>
			<input name="list_width" type="text" class="form-control2"  value="<?=$row->list_width;?>">개 (갤러리형 경우)
			<script language="javascript">	
			document.bbs_reg_form.list_width.disabled = true;
			if( document.bbs_reg_form.bbs_type[2].checked) { 
				document.bbs_reg_form.list_width.disabled = false; 
			}
			</script>
		</td>
	</tr>
	<tr> 
		<th>리스트수</th>
		<td><input name="list_height" type="text" class="form-control2"  value="<?=$row->list_height;?>" >줄</td>
		<th>페이지수</th>
		<td><input name="list_page" type="text" class="form-control2"  value="<?=$row->list_page;?>" >페이지</td>
	</tr>
	<tr> 
		<th>편집게시판사용</th>
		<td><label class="checkbox-inline"><input type="checkbox" name="editor" value="1" <? if($row->editor=="1"){ echo "checked"; } ?>> 사용함</label></td>
		<th></th>
		<td></td>
	</tr>
	</thead>
	</table>
	</form>
					
	<table class="table">
		<tr>
			<td class="text-center"><a href="javascript:bbsSendit();" class="btn btn-primary btn-large">수정하기</a></td>
		</tr>
	</table>

<? include('../footer.php');?>