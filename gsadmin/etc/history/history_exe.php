<?session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	
	if($_POST[day]){
		$day = explode(".",$_POST[day]);
	
		$year		= $day[0];
		$month	= $day[1].".".$day[2];
	}

if($mode=="write"){

	$query = "insert into cs_history set
					year='$year',
					month='$month',
					title='$title'";

	mysql_query($query);

	$tools->alertJavaGo("입력 하였습니다.","./history_list.php");

}

if($mode=="edit"){

	$query = "update cs_history set 
					year='$year',
					month='$month',
					title='$title' where idx='$idx'";

	mysql_query($query);

	$tools->alertJavaGo("수정 하였습니다.","./history_list.php");

}

?>