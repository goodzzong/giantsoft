<?session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

if($mode=="write"){

	// 파일업로드 
	if( $_FILES[bbs_file][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[bbs_file][size]  > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
		$filename = substr($_FILES[bbs_file][name],-5);
		$fn = explode(".",$filename); 
		$EXT_TMP = $fn[1]; 
		$file_name	= time()."1.".$EXT_TMP;
		$sfile_name = $_FILES[bbs_file][name];
		if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], "../../data/bbsData/".$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	} 
	} else {
		$file_name 	= "";
	}


	$query = "insert into cs_store set
					sido='$_POST[sido]',
					gugun='$_POST[gugun]',
					subject='$_POST[subject]',
					zip1='$_POST[zip1]',
					zip2='$_POST[zip2]',
					zip_new='$_POST[zip_new]',
					add1='$_POST[add1]',
					add2='$_POST[add2]',
					tel='$_POST[tel]',
					bbs_file='$file_name',
					sbbs_file='$sfile_name',
					udate=now()";

	mysql_query($query);

	$tools->alertJavaGo("입력 하였습니다.","store_list.php");

}

if($mode=="edit"){

		$bbs_data_stat = $db->object("cs_store", "where idx=$idx", "bbs_file, sbbs_file");

	// 파일업로드
	if($imdel1=="y"){
		$file_name = "";
		$sfile_name = "";
	} else {
		if( $_FILES[bbs_file][size] > 0 ) {
			@unlink( "../../data/bbsData/".$bbs_data_stat->bbs_file );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[bbs_file][size]  > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
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

	
	$query = "update cs_store set 
					sido='$_POST[sido]',
					gugun='$_POST[gugun]',
					subject='$_POST[subject]',
					zip1='$_POST[zip1]',
					zip2='$_POST[zip2]',
					zip_new='$_POST[zip_new]',
					add1='$_POST[add1]',
					add2='$_POST[add2]',
					tel='$_POST[tel]',
					bbs_file='$file_name',
					sbbs_file='$sfile_name' where idx='$idx'";

	mysql_query($query);

	$tools->alertJavaGo("수정 하였습니다.","store_list.php");

}

?>