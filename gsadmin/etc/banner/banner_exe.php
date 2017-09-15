<?session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$db_name	= "cs_banner";
$file_DIR		= "../../../data/bbsData/";
$return_url	= "banner_list.php";

if($mode=="write"){


	// 파일업로드
	if( $_FILES[bbs_file][size] > 0 ) {
		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
		if( $_FILES[bbs_file][size]  > 1024*1024*20) { $tools->errMsg("업로드 용량 초과입니다\\n\\n20메가 까지 업로드 가능합니다"); exit(); }
		$filename = substr($_FILES[bbs_file][name],-5);
		$fn = explode(".",$filename);
		$EXT_TMP = $fn[1];
		$file_name	= time()."1.".$EXT_TMP;
		$sfile_name = $_FILES[bbs_file][name];
		if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], $file_DIR.$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	}
	} else {
		$file_name 	= "";
	}

	$query = "insert into $db_name set
					cate='$_POST[cate]',
					sday='$_POST[sday]',
					eday='$_POST[eday]',
					display='$_POST[display]',
					title='$_POST[title]',
					link_url='$_POST[link_url]',
					link_open='$_POST[link_open]',
					bbs_file='$file_name',
					sbbs_file='$sfile_name'";

	mysql_query($query);

	$tools->alertJavaGo("입력 하였습니다.",$return_url);

}

if($mode=="edit"){


	$bbs_data_stat = $db->object($db_name, "where idx=$idx", "bbs_file, sbbs_file");


	// 파일업로드
	if($imdel1=="y"){
		$file_name = "";
		$sfile_name = "";
	} else {
		if( $_FILES[bbs_file][size] > 0 ) {
			@unlink( $file_DIR.$bbs_data_stat->bbs_file );
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( $EXT_TMP = explode( ".", $_FILES[bbs_file][name])) {	 foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[bbs_file][size]  > 1024*1024*20) { $tools->errMsg("업로드 용량 초과입니다\\n\\n20메가 까지 업로드 가능합니다"); exit(); }
			$filename = substr($_FILES[bbs_file][name],-5);
			$fn = explode(".",$filename);
			$EXT_TMP = $fn[1];
			$file_name	= time()."1.".$EXT_TMP;
			$sfile_name = $_FILES[bbs_file][name];
			if( !@move_uploaded_file($_FILES[bbs_file][tmp_name], $file_DIR.$file_name) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[bbs_file][tmp_name]);	}
		} else {
			$file_name 	= $bbs_data_stat->bbs_file;
			$sfile_name = $bbs_data_stat->sbbs_file;
		}
	}


	$query = "update $db_name set 
					cate='$_POST[cate]',
					display='$_POST[display]',
					sday='$_POST[sday]',
					eday='$_POST[eday]',
					title='$_POST[title]',
					link_url='$_POST[link_url]',
					link_open='$_POST[link_open]',
					bbs_file='$file_name',
					sbbs_file='$sfile_name' where idx='$idx'";

	mysql_query($query);

	$tools->alertJavaGo("수정 하였습니다.",$return_url);

}

?>