<?
$mod	= "basic";
$menu	= "seo_setup";
include('../header.php');

$db_name = "cs_seo";

if($_POST['mode']=="seo"){
	// 디비입력 쿼리
	$sql="title='$_POST[title]',
	author='$_POST[author]',
	description='$_POST[description]',
	keywords='$_POST[keywords]',
	naver_meta='$_POST[naver_meta]',
	google_meta='$_POST[google_meta]'";

	// 디비입력
	if( $db->cnt($db_name, ""))		{
			if( $db->update($db_name, $sql) ) {
				$tools->alertJavaGo("저장 완료 되었습니다.", $_POST['url']);
			} else {
				$tools->errMsg('비상적으로 입력 되었습니다.');
			}

	} else {
			if( $db->insert($db_name, $sql) )	{
				$tools->alertJavaGo("저장 완료 되었습니다.", $_POST['url']);
			} else {
				$tools->errMsg('비상적으로 입력 되었습니다.');
			}
	}
}else{
	$tools->errMsg('비상적으로 입력 되었습니다.');
}

include('../footer.php');
?>