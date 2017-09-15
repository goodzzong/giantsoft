<? 
$mod	= "basic";	
$menu	= "basic_setup";
include('../header.php');
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>관리자 기본정보</small>
		</h3>
	</div>

	<form action="basic_setup_ok.php" method="post" name="admin_form" id="admin_form" ENCTYPE="multipart/form-data">
	<input type="hidden" name="mode" value="admin" />
	<input type="hidden" name="return_url" value="<?=$_SERVER["REQUEST_URI"]; ?>">
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="35%">
	<col width="15%">
	<col width="35%">
	</colgroup>
	<tbody>
	<tr>
		<th>관리자 아이디</td>
		<td><input name="admin_userid" type="text" maxlength="30" class="form-control col-md-10" value="<?=$admin_stat->admin_userid;?>"></td>
		<th>관리자 비밀번호</td>
		<td>
			<input name="admin_passwd" type="text" maxlength="30" class="form-control col-md-10" value="<?=$admin_stat->admin_passwd;?>">
			<?if($admin_stat->admin_passwd=="admin"){?><br><br>
				<font color="red">※ 비밀번호를 변경해주시기 바랍니다.</font>
			<?}?>
		</td>
	</tr>
	<tr>
		<th>상호명</th>
		<td><input type="text" name="shop_name" class="form-control col-md-10" value="<?=$admin_stat->shop_name;?>"></td>
		<th>대표 전화
		</th><td><input type="text" name="shop_tel" class="form-control col-md-10" placeholder="ex) 00-0000-0000" value="<?=$admin_stat->shop_tel;?>"></td>
	</tr>
	<tr>
		<th>이메일</th>
		<td colspan="3"><input name="shop_email" type="text" maxlength="200" class="form-control" value="<?=$admin_stat->shop_email;?>"></td>
	</tr>
	<tr>
		<th>도메인</th>
		<td  colspan="3">HTTP://<input name="shop_domain" type="text" class="form-control" maxlength="200" value="<?=$admin_stat->shop_domain;?>" /></td>
	</tr>
	</tbody>
	</table>
	</form>

	<table class="table">
		<tr>
			<td class="text-center"><a href="javascript:sendit();" class="btn btn-primary">저장하기</a></td>
		</tr>
	</table>

<script type="text/javascript">
<!--
function sendit() {
	var form=document.admin_form;
	if(form.admin_userid.value=="") {
		alert("관리자 아이디를 입력해 주세요.");
		form.admin_userid.focus();
	} else if(form.admin_passwd.value=="") {
		alert("관리자 패스워드를 입력해 주세요.");
		form.admin_passwd.focus();
	} else {
		ans = confirm("저장하시겠습니까?");
		if(ans==true){		
		form.submit();
		}
	}
}
//-->
</script>

<? include('../footer.php');?>