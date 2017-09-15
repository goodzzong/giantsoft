<?
include('../header.php');

if($_POST['mode']=="write"){
	// 숫자 체크
	if( !$tools->chkDigit($_POST[point])) { $tools->errMsg('포인트는 숫자로 입력해주세요.');}

	if( $_POST[title] ) {	
		$_POST[title] = $db->addSlash ( $_POST[title] );
		$point = $_POST[sum].$_POST[point];

		// 디비 입력
		if( $db->insert("cs_point", "userid='$_POST[userid]', title='$_POST[title]', point='$point', register=now()")) {
			$tools->metaGo("point.php?userid=$_POST[userid]"); 
		} else { $tools->errMsg('포인트 등록에러');}
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
}


if($_GET['mode']=="del"){
	if($_GET[idx]) {
		if( $db->delete("cs_point", "where idx=$_GET[idx]")) {
			$tools->metaGo("point.php?userid=$_GET[userid]"); 
			}
	} else {
		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}
}

include('../footer.php');
?>