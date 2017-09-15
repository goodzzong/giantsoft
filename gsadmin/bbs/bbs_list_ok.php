<?
$mod	= "bbs";	
include ("../header.php");
$code = $_GET[code];

if($_GET['arr_del_list']) {
	$arr_idx = explode('@',$_GET['arr_del_list']);
	if(sizeof($arr_idx)) {
		foreach($arr_idx as $key=>$val) {
			if($val) {
				$row = $db->object("cs_bbs_data", "where idx = ".$val, "bbs_file,bbs_file2,bbs_file3,bbs_file4,bbs_file5");
				if( $row->bbs_file != "none"&&$row->bbs_file ) { @unlink("../../data/bbsData/".$row->bbs_file); }
				if( $row->bbs_file2 != "none"&&$row->bbs_file2 ) { @unlink("../../data/bbsData/".$row->bbs_file2); }
				if( $row->bbs_file3 != "none"&&$row->bbs_file3 ) { @unlink("../../data/bbsData/".$row->bbs_file3); }
				if( $row->bbs_file4 != "none"&&$row->bbs_file4 ) { @unlink("../../data/bbsData/".$row->bbs_file4); }
				if( $row->bbs_file5 != "none"&&$row->bbs_file5 ) { @unlink("../../data/bbsData/".$row->bbs_file5); }

	################# plupload 이미지 처리 #################
	$table_name	= "cs_bbs_data";
	$table_idx		= $val;

		//plupload 이미지 삭제
		$plupload_que		= "select url,filename from cs_plupload where table_name = '$table_name' and table_idx = '$table_idx' order by idx";
		$result_plupload	= mysql_query($plupload_que);
		$total_plupload	= mysql_affected_rows();

		for($k=1; $k<=$total_plupload; $k++){
			$row_plupload = mysql_fetch_array($result_plupload);

			$attach_real_ext	= explode('/',$row_plupload[url]);
			$attach_ext			= $attach_real_ext[sizeof($attach_real_ext)-1];
			$delfile_plupload	= $_SERVER['DOCUMENT_ROOT']."/data/plupload/$attach_ext";

			if(file_exists($delfile_plupload)){
				unlink($delfile_plupload);
			}
		}

		//plupload 이미지 삭제
		$delete_plupload_query = "delete from cs_plupload where table_name = '$table_name' and table_idx = '$table_idx'";
		$result_plupload_delete = mysql_query($delete_plupload_query);
	################# plupload 이미지 처리 #################

				if(!$db->delete("cs_bbs_data", "where idx =".$val)) $tools->errMsg('삭제 실패.\n\n다시 시도해주세요');
			}
		}
	}
	$tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?code=$code&menu=$menu&startPage=$startPage&listNo=$listNo&table=$table");
} else {

        $idx=$_GET['del_list'];

		if($idx){

			$row = $db->object("cs_bbs_data", "where idx = ".$idx, "bbs_file,bbs_file2,bbs_file3,bbs_file4,bbs_file5");
			if( $row->bbs_file != "none"&&$row->bbs_file ) { @unlink("../../data/bbsData/".$row->bbs_file); }
			if( $row->bbs_file2 != "none"&&$row->bbs_file2 ) { @unlink("../../data/bbsData/".$row->bbs_file2); }
			if( $row->bbs_file3 != "none"&&$row->bbs_file3 ) { @unlink("../../data/bbsData/".$row->bbs_file3); }
			if( $row->bbs_file4 != "none"&&$row->bbs_file4 ) { @unlink("../../data/bbsData/".$row->bbs_file4); }
			if( $row->bbs_file5 != "none"&&$row->bbs_file5 ) { @unlink("../../data/bbsData/".$row->bbs_file5); }

	################# plupload 이미지 처리 #################
	$table_name	= "cs_bbs_data";
	$table_idx		= $idx;

		//plupload 이미지 삭제
		$plupload_que		= "select url,filename from cs_plupload where table_name = '$table_name' and table_idx = '$table_idx' order by idx";
		$result_plupload	= mysql_query($plupload_que);
		$total_plupload	= mysql_affected_rows();

		for($k=1; $k<=$total_plupload; $k++){
			$row_plupload = mysql_fetch_array($result_plupload);

			$attach_real_ext	= explode('/',$row_plupload[url]);
			$attach_ext			= $attach_real_ext[sizeof($attach_real_ext)-1];
			$delfile_plupload	= $_SERVER['DOCUMENT_ROOT']."/data/plupload/$attach_ext";

			if(file_exists($delfile_plupload)){
				unlink($delfile_plupload);
			}
		}

		//plupload 이미지 삭제
		$delete_plupload_query = "delete from cs_plupload where table_name = '$table_name' and table_idx = '$table_idx'";
		$result_plupload_delete = mysql_query($delete_plupload_query);
	################# plupload 이미지 처리 #################

				if($db->delete("cs_bbs_data", "where idx =".$_GET['del_list'])){

					$tools->alertJavaGo("삭제 하였습니다.", "bbs_list.php?code=$code&menu=$menu&startPage=$startPage&listNo=$listNo&table=$table");

				}

		}else{


			$tools->errMsg('삭제 실패.\n\n다시 시도해주세요');

		}

}

include('../footer.php');
?>