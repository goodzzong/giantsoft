<?
$mod	= "member";	
$menu	= "member";
include('../header.php');

if( $_POST[idx]) {
	
	//이메일 중복 검색
	$mail_check = $db->cnt("cs_member", "where email='$_POST[email]' and not idx='$_POST[idx]'"); if( $mail_check ) { $tools->errMsg('이미 사용중인 이메일주소입니다.');}

	if($_POST[tel1])			{$tel		= $_POST[tel1]."-".$_POST[tel2]."-".$_POST[tel3];}
	if($_POST[phone1])	{$phone= $_POST[phone1]."-".$_POST[phone2]."-".$_POST[phone3];	}
	if($_POST[birth1])		{$birth	= $_POST[birth1]."-".$_POST[birth2]."-".$_POST[birth3];	}

	if($_POST[name])			{$_POST[name]		= $db->addSlash( $_POST[name] );}
	if($_POST[add1])			{$_POST[add1]		= $db->addSlash( $_POST[add1] );}
	if($_POST[add2])			{$_POST[add2]		= $db->addSlash( $_POST[add2] );}

	if( $db->update("cs_member",
		"level='$_POST[level]',
		name='$_POST[name]',
		email='$_POST[email]',
		zip_new='$_POST[zip_new]',
		add1='$_POST[add1]',
		add2='$_POST[add2]',
		phone='$phone',
		tel='$tel',
		birth='$birth' where idx='$idx'")) {
		$tools->alertJavaGo('회원정보 변경이 되었습니다.', 'member.php'); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>