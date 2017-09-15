<?session_start();
include ("../common.php");

if($_POST[login]==1){
$query="select * from cs_admin where admin_userid='$_POST[admin_userid]' and admin_passwd='$_POST[admin_passwd]'";
$rs=mysql_query($query);
$cnt=mysql_num_rows($rs);

	if($cnt){
		$row=mysql_fetch_object($rs);
		/*
		@session_register("ADMIN_USERID")	or die("session_register err");
		@session_register("ADMIN_PASSWD")	or die("session_register err");
		@session_register("ADMIN_EMAIL")	or die("session_register err");
		@session_register("ADMIN_NAME")	or die("session_register err");
		*/
		$ADMIN_USERID			= $row->admin_userid;
		$ADMIN_PASSWD			= $row->admin_passwd;
		$ADMIN_EMAIL				= $row->shop_email;
		$ADMIN_NAME				= "관리자";

		$_SESSION['ADMIN_USERID']	= $ADMIN_USERID;
		$_SESSION['ADMIN_NAME']		= $ADMIN_NAME;
		$_SESSION['ADMIN_EMAIL']		= $ADMIN_EMAIL;
		$_SESSION['ADMIN_PASSWD']	= $ADMIN_PASSWD;

		echo "y";
	}else{
		echo "n";

	}

}else if($_GET[logout]==1){

	$_SESSION['ADMIN_USERID'] = "";
	$_SESSION['ADMIN_NAME'] = "";
	$_SESSION['ADMIN_EMAIL'] = "";
	$_SESSION['ADMIN_PASSWD'] = "";
	$tools->javaGo('index.php');
}


if($mode=="admin"){

	// 디비입력 쿼리
	$sql="update cs_admin set
		admin_userid='$admin_userid',
		admin_passwd='$admin_passwd',
		shop_name='$shop_name',
		shop_email='$shop_email',
		shop_domain='$shop_domain',
		shop_url='$shop_url',
		spam_text='$spam_text',
		title_bar='$title',
		meta_desc='$meta_desc',
		meta_keyw='$meta_keyw',
		link_cano='$link_cano',
		meta_author='$meta_author' where idx=1";

	if(mysql_query($sql)){
		echo "y";
	}else{
		echo "n";
	}



}
?>