<?
$mod	= "product";	
$menu	= "product_add";
include("../header.php");

if($_GET[goods_data]) {
	$mv_data	= $_GET[goods_data];
	$goods_data	= $tools->decode( $_GET[goods_data] );

	// 넘어온 idx 로 삭제 레코드를 검색한다.
	$goods_stat = $db->object("cs_goods", "where idx=$goods_data[idx]");

	// 상품 리뷰 삭제
	//$db->delete("cs_goods_review", "where goods_code='$goods_stat->code'");

	// 기본 이미지 삭제
	if( $goods_stat->images1) { @unlink("../../data/goodsImages/".$goods_stat->images1); }
	if( $goods_stat->images2) { @unlink("../../data/goodsImages/".$goods_stat->images2); }
	if( $goods_stat->add_images1) { @unlink("../../data/goodsImages/".$goods_stat->add_images1); }
	if( $goods_stat->add_images2) { @unlink("../../data/goodsImages/".$goods_stat->add_images2); }
	if( $goods_stat->add_images3) { @unlink("../../data/goodsImages/".$goods_stat->add_images3); }
	if( $goods_stat->add_images4) { @unlink("../../data/goodsImages/".$goods_stat->add_images4); }
	if( $goods_stat->add_images5) { @unlink("../../data/goodsImages/".$goods_stat->add_images5); }
	if( $goods_stat->goods_file) { unlink("../../data/goodsImages/".$goods_stat->goods_file); }
	if( $db->delete("cs_goods", "where idx=$goods_data[idx]") ) { 
		
	################# plupload 이미지 처리 #################
	$table_name	= "cs_goods";
	$table_idx		= $goods_data[idx];

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
		
		$tools->javaGo("product_list.php?goods_data=$mv_data"); }
} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>
