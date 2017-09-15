<?
include('../header.php');

	$query = "delete from cs_cate where idx='$idx'";
	mysql_query($query);

	$tools->alertJavaGo("삭제 하였습니다.", "cate_popup.php?table_name=".$table_name."&code=".$code);

include('../footer.php');
?>