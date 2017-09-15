<?
include('../../header.php');

if(!$_GET[item]) { $_GET[item]=1;}

// 메일 폼 값들 불려 오기
$mailform_stat=$db->object("cs_mailform", "where item='$_GET[item]'");
?>
<script language="javascript">
<!--
function formCheck(chk) {
	var form=document.mail_check_form;
	form.action="<?=$_SERVER[PHP_SELF];?>?item="+chk;
	form.submit();
}

function sendit() {
	var form=document.mail_form;
	if(form.title.value=="") {
		alert("메일 제목을 입력해 주세요.");
		form.title.focus();
	} else if(form.content.value=="") {
		alert("메일 내용을 입력해 주세요.");
		form.content.focus();
	} else {
		form.target="";
		form.action="mailform_ok.php";
		form.submit();
	}
}

// 메일폼 새창 오픈
function newmir() {
	var form=document.mail_form;
	if(form.title.value=="") {
		alert("메일 제목을 입력해 주세요.");
		form.title.focus();
	} else if(form.content.value=="") {
		alert("메일 내용을 입력해 주세요.");
		form.content.focus();
	} else {
		window.open("","mailform_mir","scrollbars=yes, width=650, height=650, left=150, top=100");
		form.target="mailform_mir";
		form.action="mailform_mir.php";
		form.submit();
	}
}

function ftpWinOpen() {
	window.open("../webftp.php","","scrollbars=yes, width=500, height=600");
}

// TEXTAREA 입력 폼 크기 조정
function textarea_resize( formname, size ) {
	if( size=='reset' ){
		formname.rows = 15;
	}else{
		var value = formname.rows + size;
		if(value>16) formname.rows = value;
		else return;
	}
}
//-->
</script>

<!--  -->

	<h4 class="page-header">메일 설정</h4>


	<form method="post" name="mail_check_form">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th>분류선택</th>
		<td>
			<label class="radio-inline"><input type="radio" name="mailform" value="1" onclick="formCheck(1);" <? if($_GET[item]==1) { echo('checked');}?>>회원가입</label>
			<label class="radio-inline"><input type="radio" name="mailform" value="2" onclick="formCheck(2);" <? if($_GET[item]==2) { echo('checked');}?>>아이디 패스워드 찾기</label>
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="2" onclick="formCheck(2);" <? if($_GET[item]==2) { echo('checked');}?>>주문메일(회원)</label> -->
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="3" onclick="formCheck(3);" <? if($_GET[item]==3) { echo('checked');}?>>결제완료(회원)</label> -->
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="4" onclick="formCheck(4);" <? if($_GET[item]==4) { echo('checked');}?>>배송메일(회원)</label> -->
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="6" onclick="formCheck(6);" <? if($_GET[item]==6) { echo('checked');}?>>주문메일(관리자)</label> -->
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="7" onclick="formCheck(7);" <? if($_GET[item]==7) { echo('checked');}?>>결제완료(관리자)</label> -->
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="8" onclick="formCheck(8);" <? if($_GET[item]==8) { echo('checked');}?>>배송메일(관리자)</label> -->
			<!-- <label class="radio-inline"><input name="mailform" type="radio" value="9" onclick="formCheck(9);" <? if($_GET[item]==9) { echo('checked');}?>>상품 추천메일</label> -->
			<!-- <label class="radio-inline"><input type="radio" name="mailform" value="5" onclick="formCheck(5);" <? if($_GET[item]==5) { echo('checked');}?>>회원가입(관리자)</label> -->
		</td>
	</tr>
	<tr>
		<th>사용자 정보<br>치환 코드</th>
		<td class="bg-warning">
			<? if($_GET[item]==1) {?>
				[{USER_NAME}] : 이름(회원명)<br>
				[{USER_ID}] : 회원 아이디<br>
				[{USER_PASSWD}] : 회원패스워드<br>
				[{USER_EMAIL}] : 회원이메일<br>
				[{USER_TEL}] : 회원전화번호<br>
				[{USER_ADDRESS}] : 회원주소
			<?} else if($_GET[item]==2) {?>
				[{USER_NAME}] : 이름(회원명)<br>
				[{USER_ID}] : 회원 아이디<br>
				[{USER_PASSWD}] : 회원패스워드<br>
				[{USER_EMAIL}] : 회원이메일<br>
				[{USER_TEL}] : 회원전화번호<br>
				[{USER_ADDRESS}] : 회원주소
			<?}?>
		</td>
	</tr>
	<tr>
		<th>쇼핑몰 정보<br>치환 코드</th>
		<td class="bg-warning">
			[{SHOP_NAME}] : 쇼핑몰 상호<br>
			[{SHOP_DOMAIN}] : 쇼핑몰 도메인<br>
			[{SHOP_CEO}] : 쇼핑몰 대표자<br>
			[{SHOP_TEL}] : 쇼핑몰 전화번호<br>
			[{SHOP_EMAIL}] : 쇼핑몰 이메일<br>
			[{SHOP_ADDRESS}] : 쇼핑몰 주소<br>
		</td>
	</tr>
	</tbody>
	</form>


	<form method="post" action="mailform_ok.php" name="mail_form">
	<input type="hidden" name="item" value="<?=$_GET[item];?>">
	<input type="hidden" name="return_url" value="<?=$_SERVER["REQUEST_URI"]; ?>">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th>메일제목</th>
		<td><input type="text" name="title" class="form-control" value="<?=$mailform_stat->title;?>"></td>
	</tr>
	<tr>
		<th>메일내용</th>
		<td><textarea name="content" class="form-control" rows="15"><?=$mailform_stat->content;?></textarea></td>
	</tr>
	</tbody>
	</table>
	</form>


	<table class="table">
		<tr>
			<td class="text-center">
				<a href="javascript:;" class="btn btn-default" onClick="newmir();">미리보기</a>
				<a href="javascript:;" class="btn btn-primary" onClick="sendit();">저장</a>
			</td>
		</tr>
	</table>


<? include('../../footer.php');?>