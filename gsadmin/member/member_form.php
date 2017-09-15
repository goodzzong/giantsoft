<?
$mod	= "member";	
$menu	= "member";
include('../header.php');

$row = $db->object("cs_member", "where idx='$idx'");
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>회원정보(수정)</small>
		</h3>
	</div>

	<form action="member_ok.php" method="post" name="join_form" >
	<input type="hidden" name="idx" value="<?=$row->idx;?>">	
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="35%">
	<col width="15%">
	<col width="35%">
	</colgroup>
	<tbody>
	<tr>
		<th>아이디</th>
		<td><?=$row->userid;?></td>
		<th>회원등급</th>
		<td>
			<select name="level" class="form-control input-sm">
				<option value="1" <?if($row->level==1){echo "selected";}?>>개인회원</option>
				<option value="2" <?if($row->level==2){echo "selected";}?>>특별회원</option>
			</select>
		</td>
	</tr>
	<tr style="display:<?if($row->sns){?>none<?}?>;">
		<th>비밀번호</th>
		<td colspan="3">
			<input type="hidden" name="passwd" class="form-control2 col-md-2 input-sm" value="<?=$row->passwd;?>" readonly>
			<a href="#" class="btn btn-default btn-sm" onClick="pwd_reset(<?=$row->idx?>);">비밀번호 초기화</a>
		</td>
	</tr>
	<tr>
		<th>이름</th>
		<td  colspan="3"><input name="name" type="text"class="form-control input-sm" value="<?=$row->name;?>"></td>
	</tr>
	<tr>
		<th>이메일</th>
		<td colspan="3"><input name="email" type="text" class="form-control input-sm" value="<?=$row->email;?>"></td>
	</tr>
	<tr>
		<th>주소</th>
		<td colspan="3">
			<input name="zip_new" id="zip_new" type="text" class="form-control2 input-sm text-center" value="<?=$row->zip_new;?>" size="10" readonly>&nbsp;
			<a href="javascript:;" class="btn btn-success btn-xs" onClick="openDaumPostcode();">우편번호찾기</a><br><br>
			<input name="add1" id="add1" type="text" class="form-control input-sm btn-block" value="<?=$row->add1;?>" >
			<input name="add2" id="add2" type="text" class="form-control input-sm btn-block" value="<?=$row->add2;?>"  placeholder="상세정보(번지)">
		</td>
	</tr>
	<tr>
		<th>휴대폰 번호</th>
		<td>
			<?$phone=explode("-",$row->phone);?>
			<input name="phone1" type="text" class="form-control2 input-sm text-center" size="4" maxlength="4" value="<?=$phone[0];?>"> - 
			<input name="phone2" type="text" class="form-control2 input-sm text-center" size="4" maxlength="4" value="<?=$phone[1];?>"> - 
			<input name="phone3" type="text" class="form-control2 input-sm text-center" size="4" maxlength="4" value="<?=$phone[2];?>">
		</td>
		<th>전화번호</th>
		<td>
			<?$tel=explode("-",$row->tel);?>
			<input name="tel1" type="text" class="form-control2 input-sm" size="4" maxlength="4" style="text-align: center;" value="<?=$tel[0];?>"> -
			<input name="tel2" type="text" class="form-control2 input-sm" size="4" maxlength="4" style="text-align: center;" value="<?=$tel[1];?>"> - 
			<input name="tel3" type="text" class="form-control2 input-sm" size="4" maxlength="4" style="text-align: center;" value="<?=$tel[2];?>">
		</td>
	</tr>
	<tr>
		<th>생년월일</th>
		<td colspan="3">
			<?$birth=explode("-",$row->birth);?>
			<input name="birth1" type="text" class="form-control2 input-sm text-center" value="<?=$birth[0];?>"  size="4" maxlength="4">년&nbsp;
			<input name="birth2" type="text" class="form-control2 input-sm text-center" value="<?=$birth[1];?>"  size="2" maxlength="2">월&nbsp;
			<input name="birth3" type="text" class="form-control2 input-sm text-center" value="<?=$birth[2];?>"  size="2" maxlength="2">일
		</td>
	</tr>
	<tr>
		<th>이메일 수신여부</th>
		<td colspan="3">
			<?
			if($row->mailing=="y"){echo "수신동의";}
			if($row->mailing=="n"){echo "수신하지 않음";}	
			?>
		</td>
	</tr>
	<tr>
		<th>회원가입일</th>
		<td><?=$tools->strDateCut($row->register,1);?></td>
		<th>적립금</th>
		<td>
		<font color="#FF0000"><?$total_point = $db->sum("cs_point", "where userid='$row->userid'", "point"); echo(number_format($total_point));?></font> 원
		&nbsp;&nbsp;<a href="#none" class="btn btn-warning btn-xs" onClick="pointWinOpen('<?=$row->userid;?>');">내역보기</a>
		</td>
	</tr>
	<tr>
		<th>최종로그인</th>
		<td><?=$row->register_login?></td>
		<th>로그인접속수</th>
		<td><?=number_format($row->connect);?>&nbsp;번</td>
	</tr>
	<tr>
		<th>총 주문건수</th>
		<td><?$total_cnt = $db->cnt("cs_trade", "where userid='$row->userid' and trade_stat=4"); echo(number_format($total_cnt));?> 건</td>
		<th>총 구매금액</th>
		<td><font color="#FF0000"><?$total_price = $db->sum("cs_trade", "where userid='$row->userid' and trade_stat=4", "trade_total_price"); echo(number_format($total_price));?></font> 원 
	</tr>
	</tbody>
	</table>	
	</form>


	<table class="table">
		<tr>
			<td align="center">
				<a href="#" class="btn btn-primary" onClick="sendit();">등록</a>
				<a href="member.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>
				
	
<script type="text/javascript">
<!--
function sendit() {
	var form=document.join_form;

	if(form.name.value=="") {
		alert("이름을 선택해 주세요.");
		form.name.focus();
	}else if(form.email.value=="") {
		alert("이메일을 입력해 주세요.");
		form.email.focus();
	}else if(form.zip_new.value=="") {
		alert("주소를 입력해 주세요.");
		form.zip_new.focus();
	}else if(form.add1.value=="") {
		alert("주소를 입력해 주세요.");
		form.add1.focus();
	}else if(form.phone1.value=="") {
		alert("휴대폰번호를 입력해 주세요.");
		form.phone1.focus();
	}else if(form.phone2.value=="") {
		alert("휴대폰번호를 입력해 주세요.");
		form.phone2.focus();
	}else if(form.phone3.value=="") {
		alert("휴대폰번호를 입력해 주세요.");
		form.phone3.focus();
	} else {
		form.submit();
	}
}

function pwd_reset(pwd){
	var popUrl = "pwd_popup.php?"+"idx="+pwd;
	var popOption = "width=400, height=130, resizable=no, scrollbars=no, status=no;";
	if(!confirm("비밀번호를 초기화 하시겠습니까? \n\n(이메일로 임시비밀번호가 발송됩니다.)")){
		return
	}else{
		window.open(popUrl,"",popOption);
	}
}
//-->
</script>

<? include('../footer.php');?>