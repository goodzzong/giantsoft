<?session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	$sql = "delete from diary where idx='$idx'";
	mysql_query($sql);
	mysql_close();
?>

<script type="text/javascript">
	<!--
		opener.document.location.reload();
		window.close();
	//-->
</script>