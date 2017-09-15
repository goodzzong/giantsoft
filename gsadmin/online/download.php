<?
include $_SERVER['DOCUMENT_ROOT']."/common.php";

// 파일 다운로드
if( $_GET[download] ) {
	$row	= $db->object( "cs_online", "where idx=$idx", "file" );
	$row->file = iconv("UTF-8", "EUC-KR", $row->file); //파일명이 한글인경우 변환
	$file = explode( "&&", $row->file );
	$file_dir = "../../data/upload";
    $ftype = "application/octet-stream";
	if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)){ 
		Header("Content-type: $ftype"); 
		Header("Content-Length: ".filesize("$file_dir/$row->file"));     
		Header("Content-Disposition: attachment;  filename=$file[1]");   
		Header("Content-Transfer-Encoding: binary");   
		Header("Pragma: no-cache");   
		Header("Expires: 0");   
	} else { 
		Header("Content-type: file/unknown");     
		Header("Content-Length: ".filesize("$file_dir/$row->file"));     
		Header("Content-Disposition: attachment;  filename=$file[1]");   
		Header("Content-Description: PHP3 Generated Data"); 
		Header("Pragma: no-cache"); 
		Header("Expires: 0"); 
	}
	if ($fp = fopen("$file_dir/$row->file", "rb")) { 
		if (!fpassthru($fp)) fclose($fp); 
		exit(); 
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}
?>
