<?
$mod	= "product";	
$menu	= "category_list";
include("../header.php");

if($_POST[part1_code] ) {	

	$bbs_data_stat = $db->object("cs_part", "where idx=$idx", "bbs_file, sbbs_file");

	// 따음표 체크
	if($_POST[part_name]) { $_POST[part_name] = $db->addSlash ( $_POST[part_name] );}
	if($_POST[part1_code]) { $_POST[part1_code]= $db->addSlash ( $_POST[part1_code] );}
	if($_POST[part2_code]) { $_POST[part2_code]= $db->addSlash ( $_POST[part2_code] );}
	if($_POST[part3_code]) { $_POST[part3_code]= $db->addSlash ( $_POST[part3_code] );}

	// 파일업로드
	if($imdel1=="y"){
		$file_name = "";
		$sfile_name = "";
	} else {
		if( $_FILES[bbs_file][size] > 0 ) {
			@unlink( "../../data/bbsData/".$bbs_data_stat->bbs_file );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[bbs_file][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$filename = substr($_FILES[bbs_file][name],-5);
			$fn = explode(".",$filename);
			$EXT_TMP = $fn[1];
			$file_name	= time()."1.".$EXT_TMP;
			$sfile_name = $_FILES[bbs_file][name];
			if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	}
		} else {
			$file_name 	= $bbs_data_stat->bbs_file;
			$sfile_name = $bbs_data_stat->sbbs_file;
		}
	}


	$sql="part_name='$_POST[part_name]',
		part_display_check='$_POST[part_display_check]',
		part_low_check='$_POST[part_low_check]',
		bbs_file='$file_name',
		sbbs_file='$sfile_name',
		content='$_POST[content]' where idx='$_POST[idx]'";
	
	if( $db->update("cs_part", $sql) ) { 
		$tools->alertMetaGo($part_index."차 카테고리 수정 되었습니다.", "category_list.php"); 
	} else {
		$tools->errMsg('비상적으로 입력 되었습니다.');
	}

} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>