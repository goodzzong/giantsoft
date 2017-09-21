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
		// 팝업
		}else if($dbname=="cs_popup"){
			$row = $db->object($dbname, "where idx='$idx[$i]'");

			// 파일 삭제
			if( $row->popup_images) { @unlink("../../data/designImages/".$row->popup_images); }


			################# plupload 이미지 처리 #################
			$table_name	= $dbname;
			$table_idx		= $_GET[idx];

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

		// 게시판
		}else if($dbname=="cs_bbs_data"){

			$row = $db->object($dbname, "where idx='$idx[$i]'");

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