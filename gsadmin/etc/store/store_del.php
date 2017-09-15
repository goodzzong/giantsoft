<?
$mod="ETC";
$menu="store";
include("../../header.php");
include($ROOT_DIR."/lib/page_class.php");
?>
<?

for($i=0;$i<count($check);$i++) {

	$query = "delete from cs_store where idx='$check[$i]'";
	mysql_query($query);
	
}	
	
	mysql_close();
	
	echo ("<meta http-equiv='Refresh' content='0; URL=store_list.php?start=$start&key=$key&keyfield=$keyfield'>");
	
?>
<? include('../../footer.php');?>