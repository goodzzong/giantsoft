<?include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
if( $_POST[title] ) {	

	$_POST[title] = $db->stripSlash ( $_POST[title] );
	$_POST[content] = $db->stripSlash ( $_POST[content] );
	$_POST[title] = $db->addSlash ( $_POST[title] );
	$_POST[content] = $db->addSlash ( $_POST[content] );
	
	$db_name = "cs_mailform";
	
	if( $db->cnt($db_name, "where item='$item'"))		{
			$sql = "title='$_POST[title]',content='$_POST[content]' where item='$_POST[item]'";
			if( $db->update($db_name, $sql) ) { 
				$tools->alertJavaGo("저장 완료 되었습니다.",  $_POST['return_url']);
			} else { 
				$tools->errMsg('비상적으로 입력 되었습니다.'); 
			}

	} else { 
			$sql = "title='$_POST[title]',content='$_POST[content]',item='$_POST[item]'";
			if( $db->insert($db_name, $sql) )	{ 
				$tools->alertJavaGo("저장 완료 되었습니다.",  $_POST['return_url']);
			} else { 
				$tools->errMsg('비상적으로 입력 되었습니다.'); 
			}
	}

} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>