<? 
$mod	= "menu01";	
$menu	= "basic_setup";
include('../header.php');

$db_name = "cs_admin";

if($_POST[mode]=="admin"){
	// 디비입력 쿼리
	$sql="admin_userid='$_POST[admin_userid]',
	admin_passwd='$_POST[admin_passwd]',
	shop_name='$_POST[shop_name]',
	shop_tel='$_POST[shop_tel]',
	shop_email='$_POST[shop_email]',
	shop_domain='$_POST[shop_domain]'";
	
	// 디비입력
	if( $db->cnt($db_name, ""))		{
			if( $db->update($db_name, $sql) ) { 
				$tools->alertJavaGo("저장 완료 되었습니다.",  $_POST['return_url']);
			} else { 
				$tools->errMsg('비상적으로 입력 되었습니다.'); 
			}

	} else { 
			if( $db->insert($db_name, $sql) )	{ 
				$tools->alertJavaGo("저장 완료 되었습니다.",  $_POST['return_url']);
			} else { 
				$tools->errMsg('비상적으로 입력 되었습니다.'); 
			}
	}
}else{
	$tools->errMsg('비상적으로 입력 되었습니다.'); 
}

include('../footer.php');
?>