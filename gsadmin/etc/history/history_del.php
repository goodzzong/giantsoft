<?
$mod="ETC";
$menu="history";
include("../../header.php");
?>

<?
for($i=0;$i<count($check);$i++) {

	$query = "delete from cs_history where idx='$check[$i]'";
	mysql_query($query);
	
}	
	
	mysql_close();
	
	echo ("<meta http-equiv='Refresh' content='0; URL=history_list.php?start=$start&key=$key&keyfield=$keyfield'>");
	
?>

<? include('../../footer.php');?>