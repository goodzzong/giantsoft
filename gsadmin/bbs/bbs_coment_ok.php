<?
$mod	= "bbs";	
include("../header.php");

$idx = $_GET[idx];
$code = $_GET[code];

if( $_POST[coment_reg] ) {	
	// 코멘트 등록
	$_POST[name]	= $db->addSlash( $_POST[name] );		
	$_POST[coment]	= $db->addSlash( $_POST[coment] );		
	$db->insert("cs_bbs_coment", "link = $idx, coment = '$_POST[coment]', name = '$_POST[name]', pwd = '$_POST[pwd]', reg_date = now()");
	$tools->alertJavaGo("등록 하였습니다.", "bbs_view.php?code=$code&idx=$idx");
} else if( $_POST[coment_del] ) {
	// 코멘트 삭제
	$co_row	= $db->object("cs_bbs_coment", "where idx=$_POST[coment_idx]", "pwd");
	if( $co_row->pwd == $_POST[pwd] || $_SESSION[ADMIN_PASSWD]==$_POST[pwd] ) {
		$db->delete("cs_bbs_coment", "where idx = $_POST[coment_idx]");
		$tools->alertJavaGo("삭제 하였습니다.", "bbs_view.php?code=$code&idx=$idx");
	} else {
		$tools->errMsg("패스워드가 올바르지 않습니다.");			
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>