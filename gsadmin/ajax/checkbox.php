<?
include('../header.php'); 

$dbname	= $_POST['dbname'];
$name		= $_POST['name'];
$idx			= $_POST['idx'];
$val				= $_POST['val'];

/***********************************************************************************************************/

if($name=="delete"){
	for($i=0;$i<count($idx);$i++) {

		//회원
		if($dbname=="cs_member"){
			$row = $db->object($dbname, "where idx='$idx[$i]'");

			$db->delete("cs_wishlist", "where userid='$row->userid'");
			$db->delete("cs_point", "where userid='$row->userid'");

		//제품
		}else if($dbname=="cs_goods"){
			$row = $db->object($dbname, "where idx='$idx[$i]'");
			$db->delete("cs_option", "where code='$row->code'");
		
		//주문
		}else if($dbname=="cs_trade"){
			$row = $db->object($dbname, "where idx='$idx[$i]'");
			$db->delete(" cs_trade_goods", "where trade_code='$row->trade_code'");
		}
		
		$db->delete($dbname,"where idx='$idx[$i]'");
	}
}//삭제


if($name=="display"){
	for($i=0;$i<count($idx);$i++) {
		$db->update($dbname,"$name='$val' where idx='$idx[$i]'");
	}
}//노출여부


if($name=="ranking"){
	$ranking=1;
	for($i=0;$i<count($idx);$i++) {
		$db->update($dbname,"$name='$ranking' where idx='$idx[$i]'");
	$ranking++;
	}
}//순위설정

include('../footer.php');
?>