<?
include("../header.php");

$db_name = "cs_zzim";

for($i=0;$i<count($check);$i++) {

	$query = "insert into $db_name set
					code='$code',
					goods_idx='$check[$i]'";
	mysql_query($query);
}
$tools->alertJavaGo(count($check)."개의 제품이 추가되었습니다.",$return_url);

include('../footer.php');
?>