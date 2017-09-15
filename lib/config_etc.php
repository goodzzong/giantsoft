<?
/**
 * 대메뉴
 * @var array
 */
$mainMenu_array = array(
	"1"	=>	"설정관리",
//	"gallery"	=>	"제품갤러리",
	"board"	=>	"게시판관리",
	"2"	=>	"회원관리",
	"3"	=>	"PRODUCTS",
	"4"	=>	"온라인 문의",
	"5"	=>	"팝업창 관리",
	"6"	=>	"접속로그"
);
reset($mainMenu_array);

$mainMenu_link_array = array(
	"1"	=>	"#",
//	"gallery"	=>	"#",
	"board"	=>	"#",
	"2"	=>	"#",
	"3"	=>	"/product/product_list.php",
	"4"	=>	"/etc/online_list.php",
	"5"	=>	"/design/popup.php",
	"6"	=>	"/stat/crm5.php"
);
reset($mainMenu_link_array);

$mainMenu_icon_array = array(
	"1"	=>	"fa-cog",
//	"gallery"	=>	"fa-image",
	"board"	=>	"fa-table",
	"2"	=>	"fa-user",
	"3"	=>	"fa-magic",
	"4"	=>	"fa-file-text-o",
	"5"	=>	"fa-clipboard",
	"6"	=>	"fa-random"
);
reset($mainMenu_icon_array);




/**
 *  설정관리 메뉴
 */
$subMenu_1_array = array(
	"1"	=>	"기본환경설정",
	"2"	=>	"메타태그",
	"3"	=>	"회원설정",
	"4"	=>	"약관관리"
);
reset($subMenu_1_array);
$subMenu_1_link_array = array(
	"1"	=>	"/basic/basic_setup.php",
	"2"	=>	"/basic/metatag.php",
	"3"	=>	"/basic/member_setup.php",
	"4"	=>	"/basic/agreement.php"
);
reset($subMenu_1_link_array);

$subMenu_2_array = array(
	"1"	=>	"회원정보",
	"2"	=>	"탈퇴신청회원"
);
reset($subMenu_2_array);
$subMenu_2_link_array = array(
	"1"	=>	"/member/member.php",
	"2"	=>	"//member/member_exit.php",
);
reset($subMenu_2_link_array);


/**
 * 게시판 그룹
 */
$bbs_group_array = array(
	"1"	=>	"board"
);
reset($bbs_group_array);

$subMenu_3_array = array(
	"1"	=>	"Infusion",
	"2"	=>	"Patient Monitoring",
	"3"	=>	"Catheter Fecurement"
);
reset($subMenu_3_array);

?>
