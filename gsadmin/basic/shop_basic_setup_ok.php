<?
$mod	= "basic";	
$menu	= "shop_basic_setup";
include('../header.php'); 

$db_name = "cs_admin";

if( $_POST[hidden_bank_cnt] ) {	
// 계좌번호 입력 폼
	for( $i=$_POST[hidden_bank_cnt]; $i<10; $i++ ) {
		$bank1 = "bank_".$i."_1";
		$bank2 = "bank_".$i."_2";	
		$bank3 = "bank_".$i."_3";
		$_POST[$bank1] = ""; 
		$_POST[$bank2] = ""; 
		$_POST[$bank3] = ""; 
	}
	
	// 배송비
	if( $_POST[express_check] == 0 ) {
		$_POST[express_money] = 0;
		$_POST[express_box_money] = 0;
		$_POST[express_free] = 0;
	} else if( $_POST[express_check] == 1) {
		$_POST[express_box_money] = 0;
	} else if( $_POST[express_check] == 2) {
		$_POST[express_money] = 0;		
	}
	
	// 추천회원제
	if( $_POST[member_check] == 0 ) {
		$_POST[member_invite] ="0";
		$_POST[member_register] ="0";
	}
	
	// 디비입력 쿼리
	$sql="shop_ceo='$_POST[shop_ceo]',
		shop_num='$_POST[shop_num]',
		shop_fax='$_POST[shop_fax]',
		shop_phone='$_POST[shop_phone]',
		shop_address='$_POST[shop_address]',
		pg_company='$_POST[pg_company]',
		pg_id='$_POST[pg_id]',
		bank_0_1='$_POST[bank_0_1]',
		bank_0_2='$_POST[bank_0_2]',
		bank_0_3='$_POST[bank_0_3]',
		bank_1_1='$_POST[bank_1_1]',
		bank_1_2='$_POST[bank_1_2]',
		bank_1_3='$_POST[bank_1_3]',
		bank_2_1='$_POST[bank_2_1]',
		bank_2_2='$_POST[bank_2_2]',
		bank_2_3='$_POST[bank_2_3]',
		bank_3_1='$_POST[bank_3_1]',
		bank_3_2='$_POST[bank_3_2]',
		bank_3_3='$_POST[bank_3_3]',
		bank_4_1='$_POST[bank_4_1]',
		bank_4_2='$_POST[bank_4_2]',
		bank_4_3='$_POST[bank_4_3]',
		bank_5_1='$_POST[bank_5_1]',
		bank_5_2='$_POST[bank_5_2]',
		bank_5_3='$_POST[bank_5_3]',
		bank_6_1='$_POST[bank_6_1]',
		bank_6_2='$_POST[bank_6_2]',
		bank_6_3='$_POST[bank_6_3]',
		bank_7_1='$_POST[bank_7_1]',
		bank_7_2='$_POST[bank_7_2]',
		bank_7_3='$_POST[bank_7_3]',
		bank_8_1='$_POST[bank_8_1]',
		bank_8_2='$_POST[bank_8_2]',
		bank_8_3='$_POST[bank_8_3]',
		bank_9_1='$_POST[bank_9_1]',
		bank_9_2='$_POST[bank_9_2]',
		bank_9_3='$_POST[bank_9_3]',
		express_check='$_POST[express_check]',
		express_money='$_POST[express_money]',
		express_box_money='$_POST[express_box_money]',
		express_free='$_POST[express_free]',
		point_basic='$_POST[point_basic]',
		point_register='$_POST[point_register]',
		point_use='$_POST[point_use]',
		member_check='$_POST[member_check]',
		member_invite='$_POST[member_invite]',
		member_register='$_POST[member_register]'";
	
	// 디비입력
	if( $db->cnt($db_name, "")) { 
		if( $db->update($db_name, $sql) ) { 
			$tools->alertJavaGo("저장 완료 되었습니다.", $_POST['return_url']); 
		} else { 
			$tools->errMsg('비상적으로 입력 되었습니다.'); 
		}
	} else { 
		if( $db->insert($db_name, $sql) ) { 
			$tools->alertJavaGo("저장 완료 되었습니다.", $_POST['return_url']); 
		} else { 
			$tools->errMsg('비상적으로 입력 되었습니다.');
		}
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>