<?
$mod	= "product";	
$menu	= "product_qa";
include("../header.php");

$db_name	= "cs_product_qa";
$return_url	= "product_qa.php";

if($_POST[mode]=="edit"){

	$row = $db->object($db_name,"where idx='$idx'");
	
	if($_POST[reply]=="y"){
		$reply_reg_date = date("Y-m-d h:i:s");
	}else{
		$reply_reg_date = "";
	}

	if( $db->update($db_name,
		"
			reply='$_POST[reply]', 
			reply_content='$_POST[reply_content]', 
			reply_reg_date='$reply_reg_date' where idx='$idx'
		"
	))
		{
			$tools->alertJavaGo("등록 하였습니다.", $return_url);
		}
}

include('../footer.php');
?>