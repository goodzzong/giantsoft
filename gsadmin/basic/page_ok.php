<?
$mod	= "basic";
$menu	= "page";
include('../header.php');

if($_POST['content']) {

		if( $db->cnt("cs_page", "where page_index='$_POST[page_index]'")) {

			if( $db->update("cs_page", "title='$_POST[title]', content='$_POST[content]' where page_index='$_POST[page_index]'")) {

					################# plupload 이미지 처리 #################
					$table_name	= "cs_page";
					$table_idx		= $idx;

					$result_delete = mysql_query("delete from cs_plupload where table_name='$table_name' and table_idx='$table_idx'");

					for($k=0; $k<sizeof($attach_image); $k++){
						plupload_update($table_name,$table_idx,$attach_image[$k],$file_name[$k]);
					}
					################# plupload 이미지 처리 #################

				$tools->alertJavaGo("저장 완료 되었습니다.", $_POST['return_url']); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }} else {

			if( $db->insert("cs_page",  "page_index='$_POST[page_index]', title='$_POST[title]', content='$_POST[content]'") ) {

					################# plupload 이미지 처리 #################
					$table_name = "cs_page";

					$table_idx = max_count("idx",$table_name);
					for($k=0; $k<sizeof($attach_image); $k++){
						plupload_update($table_name,$table_idx,$attach_image[$k],$file_name[$k]);
					}
					################# plupload 이미지 처리 #################

				$tools->alertJavaGo("저장 완료 되었습니다.", $_POST['return_url']); } else { $tools->errMsg('비상적으로 입력 되었습니다.'); }}
	} else {

		$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
	}

include('../footer.php');
?>