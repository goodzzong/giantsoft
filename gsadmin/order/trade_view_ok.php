<?
$mod	= "order";	
include('../header.php');

if($_SESSION['ADMIN_USERID']) {

$db_name	= "cs_trade";
$return_url = "trade.php?trade_stat=".$trade_stat.
"&search_trade_method=".$search_trade_method.
"&search_device=".$search_device.
"&search_item=".$search_item.
"&search_order=".$search_order.
"&search_sday=".$search_sday.
"&search_eday=".$search_eday;
	
	if($_POST[tel1])				{$tel = $_POST[tel1]."-".$_POST[tel2]."-".$_POST[tel3];	}
	if($_POST[phone1])		{$phone = $_POST[phone1]."-".$_POST[phone2]."-".$_POST[phone3];	}
	if($_POST[content])		{$_POST[content]=$db->addSlash ( $_POST[content] );} else { $_POST[content]='';}
	
	$db->update($db_name,
		"
			name='$_POST[name]',
			email='$_POST[email]',
			tel='$tel',
			phone='$phone',
			zip_new='$_POST[zip_new]',
			add1='$_POST[add1]',
			add2='$_POST[add2]',
			content='$_POST[content]',
			trade_number='$_POST[trade_number]',
			trade_delivery='$_POST[trade_delivery]',
			trade_delivery2='$_POST[trade_delivery2]',
			delivery_url='$_POST[delivery_url]' where idx=$idx
		"
	);
	$tools->javaGo($return_url);
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>