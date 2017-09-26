<?
	@include($_SERVER['DOCUMENT_ROOT']."/config.php");
	@include($_SERVER['DOCUMENT_ROOT'].'/lib/basic_class.php');
	$db = new dbConnect($DB_HOST, $DB_NAME, $DB_USER, $DB_PWD);
	$tools = new tools();

	@include($_SERVER['DOCUMENT_ROOT'].'/lib/function.php');
	include $_SERVER['DOCUMENT_ROOT']."/lib/config_etc.php";

	@extract($_POST);
	@extract($_GET);
	@extract($_SERVER);

?>
