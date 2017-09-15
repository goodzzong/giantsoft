<?
$mod	= "bbs";	
include("../header.php");
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
	
	<form name="bbs_reg_form" action="bbs_admin_reg_ok.php" method="post">
	<input type="hidden" name="bbs_admin_reg" value="true">
	<input type="hidden" name="new_check" value="1">
	<input type="hidden" name="new_mark" value="24">
	<input type="hidden" name="view" value="0">
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
		<td><input name="name" type="text" class="form-control" maxlength="50" ></td>
		<th>게시판코드</th>
		<td><input name="code" type="text" class="form-control2" maxlength="20" ></td>
	</tr>
	<tr> 
		<th>게시판타입</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="1" onClick="artCheck()" checked> 답변형</label>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="2" onClick="artCheck()"> 공지사항형</label>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="3" onClick="artCheck()"> 갤러리형</label>
			<label class="radio-inline"><input type="radio" name="bbs_type" value="4" onClick="artCheck()"> FAQ형</label>
		</td>
		<th>비밀글기능</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_secret" value="1"> 사용함</label>
			<label class="radio-inline"><input type="radio" name="bbs_secret" value="0" checked> 사용안함</label>
		</td>
	</tr>
	<tr> 
		<th>카테고리</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_cate" value="0" checked> 미사용</label>
			<label class="radio-inline"><input type="radio" name="bbs_cate" value="1" > 사용</label>
		</td>
		<th></th>
		<td></td>
	</tr>
	<tr> 
		<th>자료실사용</td>
		<td> 
			<label class="radio-inline"><input type="radio" name="bbs_pds" value="1"> 사용함</label>
			<select name="bbs_pds_ea" class="form-control2">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>개&nbsp;
			<label class="radio-inline"><input type="radio" name="bbs_pds" value="0" checked> 사용안함</label>
		</td>
		<th>코멘트기능</td>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_coment" value="1"> 사용함</label>
			<label class="radio-inline"><input type="radio" name="bbs_coment" value="0" checked> 사용안함</label>
		</td>
	</tr>
	<tr> 
		<th>접근권한</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_access" value="0" checked> 비회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_access" value="1"> 회원</label>
		</td>
		<th>읽기권한</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_read" value="0" checked> 비회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_read" value="1"> 회원</label>
		</td>
	</tr>
	<tr>
		<th>쓰기권한</th>
		<td>
			<label class="radio-inline"><input type="radio" name="bbs_write" value="0" checked> 비회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_write" value="1"> 회원</label>
			<label class="radio-inline"><input type="radio" name="bbs_write" value="9"> 관리자</label>
		</td>
		<th>가로목록수</td>
		<td height="25">
			<input name="list_width" type="text" class="form-control2" > 개 (갤러리형 경우) 
			<script language="javascript">	document.bbs_reg_form.list_width.disabled = true;	document.bbs_reg_form.list_width.value="0";</script>
		</td>
	</tr>
	<tr> 
		<th>리스트수</th>
		<td><input name="list_height" type="text" class="form-control2" value="10" >줄(갤러리는 개수)</td>
		<th>페이지수</th>
		<td><input name="list_page" type="text" class="form-control2"  value="10" >페이지</td>
	</tr>
	<tr> 
		<th>편집게시판사용</th>
		<td><label class="checkbox-inline"><input type="checkbox" name="editor" value="1" checked> 사용함</label></td>
		<th></th>
		<td></td>
	</tr>
	</thead>
	</table>
	</form>

	<table class="table">
		<tr>
			<td class="text-center"><a href="javascript:bbsSendit();" class="btn btn-primary btn-large">저장하기</a></td>
		</tr>
	</table>


<? include('../footer.php');?>