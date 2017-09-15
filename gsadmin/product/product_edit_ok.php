<?
$mod	= "product";	
$menu	= "product_list";
include("../header.php");

$mv_data=$_POST[goods_data];
$goods_data=$tools->decode( $_POST[goods_data] );

if($_POST[code] ) {

// 관리자 기본설정을 가져온다
//	$admin_row = $db->object("cs_admin", "", "point_basic");

// 넘어온 상품 정보 쿼리
$row=$db->object("cs_goods", "where idx='$goods_data[idx]'");

if($_POST[part_code]){
	$dh_1cha=$db->cnt("cs_part","where part1_code='$_POST[part_code]'");
	$dh_2cha=$db->cnt("cs_part","where part2_code='$_POST[part_code]'");
	$dh_3cha=$db->cnt("cs_part","where part3_code='$_POST[part_code]'");

	if($dh_1cha){//1차카테고리의 코드가 존재할경우.
		$dh=$db->object("cs_part","where part1_code='$_POST[part_code]'");
		$part_idx=$dh->idx;
	}else if($dh_2cha){//2차카테고리의 코드가 존재할경우.
		$dh=$db->object("cs_part","where part2_code='$_POST[part_code]'");
		$part_idx=$dh->idx;
	}else if($dh_3cha){//3차카테고리의 코드가 존재할경우.
		$dh=$db->object("cs_part","where part3_code='$_POST[part_code]'");
		$part_idx=$dh->idx;
	}
}else{
	$part_idx = $goods_data[part_idx];
}

	// 따음표 체크
	$_POST[name]				= $db->stripSlash ( $_POST[name] );
	//$_POST[company]			= $db->stripSlash ( $_POST[company] );
	if( $_POST[option_check] ==1) 	{ $_POST[option1_name]	= $db->stripSlash ( $_POST[option1_name] );}
	if( $_POST[option_check] ==2) 	{ $_POST[option1_name]	= $db->stripSlash ( $_POST[option1_name] ); $_POST[option2_name]	= $db->stripSlash ( $_POST[option2_name] );}

	$_POST[name]				= $db->addSlash ( $_POST[name] );
	//$_POST[company]			= $db->addSlash ( $_POST[company] );
	if( $_POST[option_check] ==1) 	{ $_POST[option1_name]	= $db->addSlash ( $_POST[option1_name] );}
	if( $_POST[option_check] ==2) 	{ $_POST[option1_name]	= $db->addSlash ( $_POST[option1_name] ); $_POST[option2_name]	= $db->addSlash ( $_POST[option2_name] );}

	// 수량 체크
	if( !$_POST[number]) { $_POST[number]=0;}
	if( !$_POST[unlimit]) { $_POST[unlimit]=0;}

	// 포인트에 값이 없을 경우에는 관리자의 기본 포인트를 사용합니다.
	if( !$_POST[point] ) { $_POST[point]=$admin_row->point_basic; }

	// 옵션 체크 ( 구분자 : && )
	if( $_POST[option_check] == 0 ) {						// 사용안함
		$_POST[hidden_option1_data] = "";
		$_POST[hidden_option2_data] = "";
	} else if( $_POST[option_check] == 1 ) {			// 하나 사용
		$_POST[hidden_option1_data]	= $db->addSlash ( $_POST[hidden_option1_data] );
		$_POST[hidden_option2_data] = "";
	} else if( $_POST[option_check] == 2 ) {			// 두개 사용
		$_POST[hidden_option1_data]	= $db->addSlash ( $_POST[hidden_option1_data] );
		$_POST[hidden_option2_data]	= $db->addSlash ( $_POST[hidden_option2_data] );
	}

	//GD함수 업로드
	include $_SERVER['DOCUMENT_ROOT']."/bbs/gd.php";

	$udate = date("YmdHis");
	// 상품 이미지 등록
		if( $_FILES[images1][size] > 0 ) {
			if( $_FILES[images1][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
			$images1name = explode(".",$images1_name);
			$images1 = 'GOODS1_'.$_POST[code].$udate.".".$images1name[1];
			list($width, $height)=getimagesize($_FILES[images1][tmp_name]); 
			if($width>2600){
				$imgwidth=$width*(50/100);//width 값 
				$imgheight=$height*(50/100);//height 값 
				if(!@GDImageResize($_FILES[images1][tmp_name], "../../data/goodsImages/".$images1, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[images1][tmp_name]);	} 
			} else {
				if( !@move_uploaded_file($_FILES[images1][tmp_name], "../../data/goodsImages/".$images1) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[images1][tmp_name]);	} 
			}
		} else {
			$images1=$_POST[hidden_images1];
		}

		if( $_FILES[images2][size] > 0 ) {
			if( $_FILES[images2][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
			$images2name = explode(".",$images2_name);
			$images2 = 'GOODS2_'.$_POST[code].$udate.".".$images2name[1];
			list($width, $height)=getimagesize($_FILES[images2][tmp_name]); 
			if($width>2600){
				$imgwidth=$width*(50/100);//width 값 
				$imgheight=$height*(50/100);//height 값 
				if(!@GDImageResize($_FILES[images2][tmp_name], "../../data/goodsImages/".$images2, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[images2][tmp_name]);	} 
			} else {
				if( !@move_uploaded_file($_FILES[images2][tmp_name], "../../data/goodsImages/".$images2) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[images2][tmp_name]);	} 
			}
		} else {
			$images2=$_POST[hidden_images2];
		}


	// 추가 상품 이미지 등록
	if( $_POST[add_images_check] ) {
		if( $_POST[add_images1_check]) {
			if( $_FILES[add_images1][size] > 0 ) {
				if( $_FILES[add_images1][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
				$add1 = explode(".",$add_images1_name);
				$add_images1 = 'ADD_GOODS1_'.$_POST[code].$udate.".".$add1[1];
				list($width, $height)=getimagesize($_FILES[add_images1][tmp_name]); 
				if($width>2600){
					$imgwidth=$width*(50/100);//width 값 
					$imgheight=$height*(50/100);//height 값 
					if(!@GDImageResize($_FILES[add_images1][tmp_name], "../../data/goodsImages/".$add_images1, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_images1][tmp_name]);	} 
				}else{
					if( !@move_uploaded_file($_FILES[add_images1][tmp_name], "../../data/goodsImages/".$add_images1) ) { 
						$tools->errMsg("파일 업로드 에러");
					}else{ 
						@unlink($_FILES[add_images1][tmp_name]);	
					}
					@unlink("../../data/goodsImages/".$row->add_images1);
				}
			}else{
				$add_images1=$_POST[hidden_add_images1];
			}
		}else{
			@unlink("../../data/goodsImages/".$row->add_images1);
			$add_images1="";
		}

		if( $_POST[add_images2_check]) {
			if( $_FILES[add_images2][size] > 0 ) {
				if( $_FILES[add_images2][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
				$add2 = explode(".",$add_images2_name);
				$add_images2 = 'ADD_GOODS2_'.$_POST[code].$udate.".".$add2[1];
				list($width, $height)=getimagesize($_FILES[add_images2][tmp_name]); 
				if($width>2600){
					$imgwidth=$width*(50/100);//width 값 
					$imgheight=$height*(50/100);//height 값 
					if(!@GDImageResize($_FILES[add_images2][tmp_name], "../../data/goodsImages/".$add_images2, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_images2][tmp_name]);	} 
				}else{
					if( !@move_uploaded_file($_FILES[add_images2][tmp_name], "../../data/goodsImages/".$add_images2) ) {
						@unlink("../../data/goodsImages/".$add_images1);
						$tools->errMsg("파일 업로드 에러");
					}else{ 
						@unlink($_FILES[add_images2][tmp_name]);
					}	
					@unlink("../../data/goodsImages/".$row->add_images2);
				}
			}else{
				$add_images2=$_POST[hidden_add_images2];
			}
		}else{
			@unlink("../../data/goodsImages/".$row->add_images2);
			$add_images2="";
		}

		if( $_POST[add_images3_check]) {
			if( $_FILES[add_images3][size] > 0 ) {
				if( $_FILES[add_images3][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
				$add3 = explode(".",$add_images3_name);
				$add_images3 = 'ADD_GOODS3_'.$_POST[code].$udate.".".$add3[1];
				list($width, $height)=getimagesize($_FILES[add_images3][tmp_name]); 
				if($width>2600){
					$imgwidth=$width*(50/100);//width 값 
					$imgheight=$height*(50/100);//height 값 
					if(!@GDImageResize($_FILES[add_images3][tmp_name], "../../data/goodsImages/".$add_images3, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_images3][tmp_name]);	} 
				}else{
					if( !@move_uploaded_file($_FILES[add_images3][tmp_name], "../../data/goodsImages/".$add_images3) ) {
						@unlink("../../data/goodsImages/".$add_images1);
						@unlink("../../data/goodsImages/".$add_images2);
						$tools->errMsg("파일 업로드 에러");
					}else{ 
						@unlink($_FILES[add_images3][tmp_name]);
					}	
					@unlink("../../data/goodsImages/".$row->add_images3);
				}
			}else{
				$add_images3=$_POST[hidden_add_images3];
			}
		}else{
			@unlink("../../data/goodsImages/".$row->add_images3);
			$add_images3="";
		}

		if( $_POST[add_images4_check]) {
			if( $_FILES[add_images4][size] > 0 ) {
				if( $_FILES[add_images4][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
				$add4 = explode(".",$add_images4_name);
				$add_images4 = 'ADD_GOODS4_'.$_POST[code].$udate.".".$add4[1];
				list($width, $height)=getimagesize($_FILES[add_images4][tmp_name]); 
				if($width>2600){
					$imgwidth=$width*(50/100);//width 값 
					$imgheight=$height*(50/100);//height 값 
					if(!@GDImageResize($_FILES[add_images4][tmp_name], "../../data/goodsImages/".$add_images4, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_images4][tmp_name]);	} 
				}else{
					if( !@move_uploaded_file($_FILES[add_images4][tmp_name], "../../data/goodsImages/".$add_images4) ) {
						@unlink("../../data/goodsImages/".$add_images1);
						@unlink("../../data/goodsImages/".$add_images2);
						@unlink("../../data/goodsImages/".$add_images3);
						$tools->errMsg("파일 업로드 에러");
					}else{ 
						@unlink($_FILES[add_images4][tmp_name]);
					}	
					@unlink("../../data/goodsImages/".$row->add_images4);
				}
			}else{
				$add_images4=$_POST[hidden_add_images4];
			}
		}else{
			@unlink("../../data/goodsImages/".$row->add_images4);
			$add_images4="";
		}

		if( $_POST[add_images5_check]) {
			if( $_FILES[add_images5][size] > 0 ) {
				if( $_FILES[add_images5][size] > 1024*1024*3) { $tools->errMsg("업로드 용량 초과입니다\\n\\n3메가 까지 업로드 가능합니다"); exit(); }
				$add5 = explode(".",$add_images5_name);
				$add_images5 = 'ADD_GOODS5_'.$_POST[code].$udate.".".$add5[1];
				list($width, $height)=getimagesize($_FILES[add_images5][tmp_name]); 
				if($width>2600){
					$imgwidth=$width*(50/100);//width 값 
					$imgheight=$height*(50/100);//height 값 
					if(!@GDImageResize($_FILES[add_images5][tmp_name], "../../data/goodsImages/".$add_images5, $imgwidth, $imgheight)){ $tools->errMsg("파일 업로드 에러"); } else { @unlink($_FILES[add_images5][tmp_name]);	} 
				}else{
					if( !@move_uploaded_file($_FILES[add_images5][tmp_name], "../../data/goodsImages/".$add_images5) ) {
						@unlink("../../data/goodsImages/".$add_images1);
						@unlink("../../data/goodsImages/".$add_images2);
						@unlink("../../data/goodsImages/".$add_images3);
						@unlink("../../data/goodsImages/".$add_images4);
						$tools->errMsg("파일 업로드 에러");
					}else{ 
						@unlink($_FILES[add_images5][tmp_name]);
					}	
					@unlink("../../data/goodsImages/".$row->add_images5);
				}
			}else{
				$add_images5=$_POST[hidden_add_images5];
			}
		}else{
			@unlink("../../data/goodsImages/".$row->add_images5);
			$add_images5="";
		}
	} else {
		$add_images1="";
		$add_images2="";
		$add_images3="";
		$add_images4="";
		$add_images5="";
		@unlink("../../data/goodsImages/".$row->add_images1);
		@unlink("../../data/goodsImages/".$row->add_images2);
		@unlink("../../data/goodsImages/".$row->add_images3);
		@unlink("../../data/goodsImages/".$row->add_images4);
		@unlink("../../data/goodsImages/".$row->add_images5);
	}

	// 상품 첨부파일
	if($_POST[file_Del]=="y"){
		$goods_file_name = "";
	}else{
		if( $_FILES[goods_file][size] > 0 ) {
			$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
			if( !strstr( $_FILES[goods_file][name], ".")) { $tools->errMsg( strtoupper("확장자가 없는 ".$_FILES[goods_file][name])." 은 업로드 할수 없습니다." ); } else if( $EXT_TMP = explode( ".", $_FILES[goods_file][name])) { foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP[1]))) { $tools->errMsg( strtoupper($EXT_TMP[1])." 은 업로드 할수 없습니다." );}}}
			if( $_FILES[goods_file][size]  > 1024*1024*4) { $tools->errMsg("업로드 용량 초과입니다\\n\\n4메가 까지 업로드 가능합니다"); exit(); }
			$goods_file_name	= time()."&&".$_FILES[goods_file][name];
			$upload_file = iconv("utf-8","euc-kr",$goods_file_name);
			if( !@move_uploaded_file($_FILES[goods_file][tmp_name], "../../data/goodsImages/".$upload_file) ) { $tools->errMsg("파일 업로드 에러"); } else { @unlink("../../data/goodsImages/".$row->goods_file); @unlink($_FILES[goods_file][tmp_name]);}
		} else {
			$goods_file_name=$_POST[hidden_goods_file];
		}
	}


	/*옵션 설정*/
	if($option_check > 0){
		//옵션
		for($x=1; $x<=$option_check; $x++){
			$option_cate				= $x;
			$option_idx_arr			= ${'option_idx'.$x};
			$option_name_arr		= ${'option_name'.$x};
			$option_price_arr			= ${'option_price'.$x};
			$option_number_arr			= ${'option_number'.$x};
			$hidden_option_sold_out_arr	= ${'hidden_option_sold_out'.$x};

			for($i=0; $i<count(${'option_name'.$x}); $i++){
				if($option_name_arr[$i]){
					//숫자체크
					if(!is_numeric($option_price_arr[$i])){	
						$option_price_arr[$i] = 0;
					}
					if($option_idx_arr[$i]){
						//업데이트
						$query = "update cs_option set
							code='$_POST[code]',
							cate='$option_cate',
							name='$option_name_arr[$i]',
							price='$option_price_arr[$i]',
							number='$option_number_arr[$i]',
							sold_out='$hidden_option_sold_out_arr[$i]' where idx='$option_idx_arr[$i]'";
						mysql_query($query);
					}else{
						//생성
						$query = "insert into cs_option set
							code='$_POST[code]',
							cate='$option_cate',
							name='$option_name_arr[$i]',
							price='$option_price_arr[$i]',
							number='$option_number_arr[$i]',
							sold_out='$hidden_option_sold_out_arr[$i]'";
						mysql_query($query);
					}
				}
			}
		}
	}




$sql = "display='$_POST[display]',
			display='$_POST[display]',
			code='$_POST[code]',
			icon='$_POST[icon]',
			name='$_POST[name]',
			company='$_POST[company]',
			old_price='$_POST[old_price]',
			shop_price='$_POST[shop_price]',
			sold_out='$_POST[sold_out]',
			number='$_POST[number]',
			point='$_POST[point]',
			option_check='$_POST[option_check]',
			option1_name='$_POST[option1_name]',
			option1_part='$_POST[hidden_option1_data]',
			option2_name='$_POST[option2_name]',
			option2_part='$_POST[hidden_option2_data]',
			images1='$images1',
			images2='$images2',
			add_images1='$add_images1',
			add_images2='$add_images2',
			add_images3='$add_images3',
			add_images4='$add_images4',
			add_images5='$add_images5',
			goods_file='$goods_file_name',
			content='$_POST[content]',
			main_position='$_POST[main_position]',
			sub_position='$_POST[sub_position]',
			register=now(),
			zzim='$_POST[zzim]' where idx=$goods_data[idx]";

	if( $db->update("cs_goods", $sql) ) { 
		

	################# plupload 이미지 처리 #################
	$table_name	= "cs_goods";
	$table_idx		= $goods_data[idx];

	$result_delete = mysql_query("delete from cs_plupload where table_name='$table_name' and table_idx='$table_idx'");
	for($k=0; $k<sizeof($attach_image); $k++){
		plupload_update($table_name,$table_idx,$attach_image[$k],$file_name[$k]);
	}
	################# plupload 이미지 처리 #################	
	
		
		$tools->alertJavaGo("수정 하였습니다.","product_list.php?goods_data=$mv_data"); } else { $tools->errMsg('비상적으로 입력 되었습니다.');}

} else {
	$tools->errMsg('경 고 !!!\n\n비정상적으로 접근했습니다.');
}

include('../footer.php');
?>