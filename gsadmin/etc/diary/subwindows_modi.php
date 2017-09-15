<?session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>▒ 일정관리 [<?=$SelectedDay?>] ▒</title>
    <link href="/gsadmin/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="/gsadmin/css/skin/dashboard.css" rel="stylesheet"> -->
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/gsadmin/js/assets/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/gsadmin/js/assets/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/gsadmin/js/bootstrap.min.js"></script>
    <script src="/gsadmin/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/gsadmin/js/assets/ie10-viewport-bug-workaround.js"></script>


</head>
<body>


<?
	$sql = "select * from diary ";
	$sql = $sql."where idx = '$idx' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$idx = trim($row[idx]);
	$id = trim($admin_id);
	$name = trim($admin_name);
	$content = trim($memofield);
	$write_date = date("Y-m-d H:i:s");
	

	if ($save == "ok") {

			$sql = "update diary set
						content='$content',
						write_date='$write_date',
						title='$title' where idx = '$idx'";

			$result = mysql_query($sql);

		if ($result) {
?>
			<script language="javascript">
			opener.document.location.reload();
			window.close();
			</script>
<?
		}
	} else {
?>




	<form name="form" action="<?=$PHP_SELF?>" method="post">
	<script language=javascript>
	<!--
	function send(form){
		
		val = form.title.value;
		l = val.length;
		len = l + 1;
		for(i=1;i < len;i++) {
			temp = val.substring(i-1,i);
			if (temp == " ") l = l -1;
		}
		if (l < 1) { 
			alert("\n제목을 입력하세요!");
			form.title.focus();
			return;
		}
		
		
		val = form.memofield.value;
		l = val.length;
		len = l + 1;
		for(i=1;i < len;i++) {
			temp = val.substring(i-1,i);
			if (temp == " ") l = l -1;
		}
		if (l < 1) { 
			alert("\n내용을 입력하세요!");
			form.memofield.focus();
			return;
		}
		
		form.submit();	
		
	}
	
	function send1(form){
		
		ans = confirm("\n삭제 하시겠습니까?");
		if(ans==true){
			form.action = "subwindows_dele.php";
			form.submit();	
		}
		
	}
	-->
	</script>
	<input type="hidden" name="save" value="ok">
	<input type="hidden" name="admin_id" value="<?=$admin_id?>">
	<input type="hidden" name="admin_name" value="<?=$admin_name?>">
	<input type="hidden" name="SelectedDay" value="<?=$SelectedDay?>">
	<input type="hidden" name="idx" value="<?=$idx?>">


<div class="col-md-6 col-md-offset-3" ><!-- 테이블 위치 -->
	<table class="table table-bordered">
		<colgroup>
			<col width="20%">
			<col width="80%">
		</colgroup>
		<tbody>
			<tr>
				<th>제목</th>
				<td><input name="title" class="form-control" value="<? echo $row[title] ?>"></td>
			</tr>
			<tr>
				<th>내용</th>
				<td><textarea name="memofield" class="form-control" rows="5" ><?=$row[content]?></textarea></td>
			</tr>
			<tr>
				<th>최종 기록</th>
				<td><?=$row[write_date]?></td>
			</tr>
		</tbody>
	</table>

	<table class="table">
		<tr>
			<td class="text-center">
				<a href="javascript:send(this.form);" class="btn btn-primary btn-sm">저 장</a>&nbsp;
				<a href="javascript:send1(this.form);" class="btn btn-danger btn-sm">삭 제</a>
			</td>
		</tr>
	</table>

	</form>

</div>



<?
	}
?>
	</body>