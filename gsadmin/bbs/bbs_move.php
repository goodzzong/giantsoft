<?
$mod	= "bbs";	
include ("../header.php");

if($code){

	$row	= @mysql_fetch_row( $db->result("select max(idx) from cs_bbs_data where code='$code'"));
	$ref = $row[0]+1;
	
	$query = "update cs_bbs_data set code='$code', ref='$ref' where idx='$idx'";
	mysql_query($query);

	$tools->alertJavaGo("성공적으로 이동 했습니다.","bbs_list.php?code=".$code);

} else {

	$tools->errMsg("게시판을 선택 하세요.");
}

include('../footer.php');
?>