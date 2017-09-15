<?session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<?
$query_admin="select * from cs_admin where 1";
$rs_admin=mysql_query($query_admin);
$admin_stat=mysql_fetch_object($rs_admin);

$site_url		= "http://" . $_SERVER['HTTP_HOST'];
$admin_stat = $db->object("cs_admin","");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '/gsadmin/');}?>

    <title><?=$admin_stat->shop_name;?></title>
    <link href="<?=$site_url?>/gsadmin/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?=$site_url?>/gsadmin/css/skin/dashboard.css" rel="stylesheet"> -->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?=$site_url?>/gsadmin/js/assets/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?=$site_url?>/gsadmin/js/assets/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?=$site_url?>/gsadmin/js/bootstrap.min.js"></script>
    <script src="<?=$site_url?>/gsadmin/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=$site_url?>/gsadmin/js/assets/ie10-viewport-bug-workaround.js"></script>

</head>
<body>

<script language=javascript>
<!--
function sendit() {
	var form=document.pop_form;
	if(form.name.value=="") {
		alert("카테고리명을 입력해주세요.");
		form.name.focus();
	} else {
		form.submit();
	}
}

//수정
function popupEdit( table_name,code,idx ){
	var name = $('#cate'+idx).val();
	var mode = "edit";
	var choose = confirm( '수정하시겠습니까?');
	if(choose) {
	$.ajax({
		type: "GET",
		url : "cate_popup_ok.php",
		data: 
			{
			"table_name":table_name,
			"idx":idx,
			"name":name,
			"code":code,
			"mode":mode
			}, 
		success:function(){
			alert("수정 하였습니다.");
			location.reload();
		}
	});
	}else { return; }
}

// 삭제
function popupDel( table_name,code,idx ) {
	var choose = confirm( '삭제하시겠습니까?');
		if(choose) {	location.href='cate_popup_del.php?table_name='+table_name+'&code='+code+'&idx='+idx; }
		else { return; }
}
//-->
</script>

<div class="col-md-12" >

	<div>
		<h3 class="page-header">카테고리관리</h3>
	</div>

	<form name="pop_form" method="post" action="cate_popup_ok.php" onsubmit="return false" onkeypress="if(event.keyCode==13){sendit();return false;}">
	<input type="hidden" name="mode" value="write">
	<input type="hidden" name="table_name" value="<?=$table_name?>">
	<input type="hidden" name="code" value="<?=$code?>">
		<div class="row">
			<div class="col-xs-10"><input type="text" class="form-control"name="name" placeholder="추가하는 카테고리를 입력해주세요."></div>
			<div class="col-xs-2"><a href="javascript:sendit();" class="btn btn-default">등록</a></div>
		</div><br>
	</form>


	<form name="form_edit" method="post" action="cate_popup_ok.php">
	<input type="hidden" name="mode" value="edit">
	<table class="table table-bordered table-hover ">
	<colgroup>
	<col width="10%">
	<col width="*">
	<col width="20%">
	</colgroup>
	<thead>
	<tr>
		<th>N O</th>
		<th>카테고리</th>
		<th>관리</th>
	</tr>
	</thead>
	<tbody>
	<?
	$no=1;
	$rs = $db->select("cs_cate","where table_name='$table_name' and code='$code' order by idx asc");
	while($row = mysql_fetch_array($rs)){
	?>
	<tr>
		<td class="text-center"><?echo $no?></td>
		<td class="text-center"><input type="text" name="name" class="form-control input-sm"  id="cate<?=$row[idx]?>" value="<?=$row[name]?>"></td>
		<td class="text-center">
			<a href="javascript:popupEdit('<?=$row[table_name]?>','<?=$row[code]?>','<?=$row[idx]?>');" class="btn btn-primary btn-xs">수정</a>&nbsp;|&nbsp;
			<a href="javascript:popupDel('<?=$row[table_name]?>','<?=$row[code]?>','<?=$row[idx]?>');" class="btn btn-danger btn-xs">삭제</a>
		</td>
	</tr>
	<? 
	$no++;	
	} 
	?>			
	</tbody>
	</table>
	</form>

</div>

</body>
</html>