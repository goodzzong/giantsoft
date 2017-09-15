<?
$mod	= "bbs";	
include("../header.php");

$mv_data	= $_GET[bbs_data];
$bbs_data	= $tools->decode( $_GET[bbs_data] );
if( $_GET[idx] )			{ $idx = $_GET[idx]; } else { $idx = $bbs_data[idx]; }
if( $_GET[code] )			{ $code = $_GET[code]; } else { $code = $bbs_data[code]; }

if( $_POST[bbs_view_del] ) {
	$row = $db->object("cs_bbs_data", "where idx = $idx", "pwd, bbs_file,bbs_file2,bbs_file3,bbs_file4,bbs_file5");
	if( $row->pwd == $_POST[pwd] || $_SESSION[ADMIN_PASSWD]==$_POST[pwd]) {
		// 자료실 삭제
		if( $row->bbs_file != "none"&&$row->bbs_file ) { @unlink("../../data/bbsData/".$row->bbs_file); }
		if( $row->bbs_file2 != "none"&&$row->bbs_file2 ) { @unlink("../../data/bbsData/".$row->bbs_file2); }
		if( $row->bbs_file3 != "none"&&$row->bbs_file3 ) { @unlink("../../data/bbsData/".$row->bbs_file3); }
		if( $row->bbs_file4 != "none"&&$row->bbs_file4 ) { @unlink("../../data/bbsData/".$row->bbs_file4); }
		if( $row->bbs_file5 != "none"&&$row->bbs_file5 ) { @unlink("../../data/bbsData/".$row->bbs_file5); }

		//plupload 이미지 삭제
		$plupload_que = "select url,filename from cs_plupload_img where code = '$code' and bbs_idx = '$idx' order by no";
		$result_plupload = mysql_query($plupload_que);
		$total_plupload = mysql_affected_rows();

		for($k=1; $k<=$total_plupload; $k++){
			$row_plupload = mysql_fetch_array($result_plupload);

			$attach_real_ext = explode('/',$row_plupload[url]);
			$attach_ext = $attach_real_ext[sizeof($attach_real_ext)-1];
			$delfile_plupload = "../../data/plupload/$attach_ext";

			if(file_exists($delfile_plupload)){
				unlink($delfile_plupload);
			}
		}

		$delete_plupload_query = "delete from cs_plupload_img where code = '$code' and bbs_idx = '$idx'";
		$result_plupload_delete = mysql_query($delete_plupload_query);
		//plupload 이미지 삭제


		// 코멘트 삭제
		$db->delete("cs_bbs_coment", "where link = $idx");
		// 작성글 삭제
		$db->delete("cs_bbs_data", "where idx = $idx");
		$tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?menu=$menu&idx=$idx&startPage=$startPage&listNo=$listNo&table=$table&code=$code&search_item=$search_item&search_order=$search_order");
	} else {
		$tools->errMsg("패스워드가 올바르지 않습니다.");
	}
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>