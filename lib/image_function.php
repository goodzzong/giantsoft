<?php

//특정 이미지파일(gif, jpg, png 만 지원)의 경로로 부터 이미지 리소스를 받아온다. 리턴값은 성공시에는 이미지리소스를 반환, 실패시에는 false 를 반환
function get_image_resource_from_file ($path_file){

if (!is_file($path_file)) {//파일이 아니라면

	$GLOBALS['errormsg'] = $path_file . '은 파일이 아닙니다.';

	return Array();
}

$size = @getimagesize($path_file);
if (empty($size[2])) {//이미지 타입이 없다면

	$GLOBALS['errormsg'] = $path_file . '은 이미지 파일이 아닙니다.';

	return Array();
}

if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {//지원하는 이미지 타입이 아니라면

	$GLOBALS['errormsg'] = $path_file . '은 gif 나 jpg, png 파일이 아닙니다.';

	return Array();
}

switch($size[2]){

case 1 : //gif

$im = @imagecreatefromgif($path_file);

break;

case 2 : //jpg

$im = @imagecreatefromjpeg($path_file);

break;

case 3 : //png

$im = @imagecreatefrompng($path_file);

break;

case 4 : //bmp

$im = @imagecreatefrombmp($path_file);

break;

case 5 : //bmp

$im = @imagecreatefromico($path_file);

break;
}

if ($im === false) {//이미지 리소스를 가져오기에 실패하였다면

	$GLOBALS['errormsg'] = $path_file . ' 에서 이미지 리소스를 가져오는 것에 실패하였습니다.';

	return Array();
}
else {//이미지 리소스를 가져오기에 성공하였다면

	$return = $size;
	$return[0] = $im;
$return[1] = $size[0];//너비
$return[2] = $size[1];//높이
$return[3] = $size[2];//이미지타입
$return[4] = $size[3];//이미지 attr

return $return;
}
}


//인수로 받아온 이미지 리소스와 파일 저장 경로를 가지고 이미지를 저장한다. 성공시 true, 실패시 false 반환
function save_image_from_resource ($im, $path_save_file){

	$path_save_dir = dirname($path_save_file);
	if (!is_dir($path_save_dir)) {

		$GLOBALS['errormsg'] = $path_save_dir . '은 디렉토리가 아닙니다.';
		return false;
	}

	if (!is_writable($path_save_dir)){

		$GLOBALS['errormsg'] = $path_save_dir . '에 이미지를 저장할 권한이 없습니다.';
		return false;
	}

	if (is_file($path_save_file) || is_dir($path_save_file)) {

		$GLOBALS['errormsg'] = $path_save_file . '은 이미 존재하는 파일이거나 디렉토리입니다.';
		return false;
	}

	$extension = strtolower(substr($path_save_file, strrpos($path_save_file, '.') + 1));

	switch($extension){

		case 'gif' :
		$result_save = @imagegif($im, $path_save_file);
		break;

		case 'jpg' :
		case 'jpeg' :
		$result_save = @imagejpeg($im, $path_save_file);
		break;

		case 'bmp' :
		$result_save = @imagebmp($im, $path_save_file);
		break;

		case 'ico' :
		$result_save = @imageico($im, $path_save_file);
		break;

		default : //확장자 png 또는 확장자가 없는 경우, 정의되지 않는 확장자인 경우는 모두 png로 저장
		$result_save = @imagepng($im, $path_save_file);
	}

if ($result_save === false) {//이미지 저장에 실패

	$GLOBALS['errormsg'] = $path_save_file . '의 저장에 실패하였습니다.';
	return false;
}
else {//이미지 저장에 성공

	return true;
}
}



//원본의 너비, 원본의 높이, 리사이즈 너비나 높이, 기준값을 받아 기준값을 토대로 정비율의 값을 구함
//성공시 정비율의 값을 반환, 실패시 false를 반환
//기준값은 width 나 height, 기준값은 생략 가능하며 생략시 자동으로 width가 된다.
function get_size_by_rule($src_w, $src_h, $dst_size, $rule='width'){

if (!is_int($src_w) || $src_w < 1 || !is_int($src_h) || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

	$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

	return false;
}

if (!is_int($dst_size) || $dst_size < 1){//리사이즈 될 사이즈가 0보다 큰 정수가 아닐경우

	$GLOBALS['errormsg'] = "리사이즈될 사이즈가 0보다 큰 정수가 아닙니다. ($dst_size)";

	return false;
}

if ($rule != 'height') {//기준값이 높이가 아닌경우, 즉, 너비일 경우

	return ($dst_size / $src_w * $src_h);
}
else {//기준값이 높이일 경우

	return ($dst_size / $src_h * $src_w);
}
}



//원본의 리소스, 원본의 너비, 원본의 높이, 리사이즈 너비, 높이를 받아 이미지 리사이즈 처리
//성공시 리사이즈된 이미지의 리소스를 반환, 실패시 false를 반환
//$dst_h 는 생략가능, 생략시 너비 기준 정비율로 리사이즈 됨
//너비를 기준으로 정비율 생성시는 get_image_resize($src, $src_w, $src_h, $dst_w) 으로 사용
//높이를 기준으로 정비율 생성시는 get_image_resize($src, $src_w, $src_h, 0, $dst_h) 으로 사용
//지정된 크기로 강제 생성시에는 get_image_resize($src, $src_w, $src_h, $dst_w, $dst_h) 으로 사용
function get_image_resize($src, $src_w, $src_h, $dst_w, $dst_h=0){

if (empty($src)) {//원본의 리소스가 빈값일 경우

	$GLOBALS['errormsg'] = '원본 리소스가 없습니다.';

	return false;
}

//정수형이 아니라면 정수형으로 강제 형변환
if (!is_int($src_w)) settype($src_w, 'int');
if (!is_int($src_h)) settype($src_h, 'int');
if (!is_int($dst_w)) settype($dst_w, 'int');
if (!is_int($dst_h)) settype($dst_h, 'int');

if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

	$GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";

	return false;
}

if (empty($dst_w) && empty($dst_h)) {//리사이즈될 너비와 높이 둘다 없을 경우

	$GLOBALS['errormsg'] = '리사이즈될 너비와 높이는 둘중에 하나는 반듯이 있어야 합니다.';

	return false;
}

if (!empty($dst_w) && $dst_w < 1){//리사이즈 될 너비가 존재하는데 0보다 큰 정수가 아닐경우

	$GLOBALS['errormsg'] = "리사이즈될 너비가 0보다 큰 정수가 아닙니다. ($dst_w)";

	return false;
}

if (!empty($dst_h) && $dst_h < 1){//리사이즈 될 높이가 존재하는데 0보다 큰 정수가 아닐경우

	$GLOBALS['errormsg'] = "리사이즈될 높이가 0보다 큰 정수가 아닙니다. ($dst_h)";

	return false;
}


//리사이즈 될 너비와 높이가 둘중에 하나가 없는 경우에는 정비율을 의미하며, 비율데로 너비와 높이를 결정한다.
if (empty($dst_w) || empty($dst_h)) {

	if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
	else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
}

$dst = @imagecreatetruecolor ($dst_w , $dst_h);//만드어질 $dst_w , $dst_h 크기의 이미지 리소스를 생성한다.
//$Background = imagecolorallocate($dst, 255, 255, 255);
//imagefill($dst,0,0,$whiteBackground); // fill the background with white
/*
imagealphablending($dst, 0);
imagesavealpha($dst, 1);
$transparent = 0x7fffffff;
$red = 0x0fff0000;
imagefilledrectangle($dst, 0, 0, $dst_w, $dst_h, $transparent);
imagealphablending($dst, 1);
imagefilledrectangle($dst, 50, 50, 80, 80, $red);
*/


if ($dst === false) {

	$GLOBALS['errormsg'] = "$dst_w , $dst_h 크기의 썸네일 이미지의 리소스를 생성하지 못했습니다.";

	return false;
}

$result_resize = imagecopyresampled ($dst , $src , 0 , 0 , 0 , 0 , $dst_w , $dst_h , $src_w , $src_h );
if ($result_resize === false) {

	$GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 리사이즈에 실패하였습니다.";

	return false;
}

return $dst;
}


function board_images_upload($file_name,$file_size,$file_url,$file_wieght,$file_height,$file_type,$file_rename){

		$EXT_CHECK = array("php", "php3", "htm", "html", "cgi", "perl");	// 업로드 파일 제한 확장자 추가 가능
		if( $EXT_TMP = explode( ".", $_FILES[$file_name][name])) {
			$EXT_TMP = $EXT_TMP[sizeof($EXT_TMP)-1];
			foreach ($EXT_CHECK as $value) { if( strstr( $value, strtolower($EXT_TMP))) { $tools->errMsg( strtoupper($EXT_TMP)." 은 업로드 할수 없습니다." ); } }	}
			if( $_FILES[$file_name][size]  > 1024*1024*$file_size) { $tools->errMsg("업로드 용량 초과입니다\\n\\n ".$file_size."메가 까지 업로드 가능합니다"); exit(); }

			$file_name1	= time().$file_rename."1.".$EXT_TMP;
			$sfile_name1 = $_FILES[$file_name][name];
			if( !@move_uploaded_file($_FILES[$file_name][tmp_name], $file_url.$file_name1) ) { $tools->errMsg("파일 업로드 에러"); } else {


				if($EXT_TMP=="jpg" || $EXT_TMP=="JPG" || $EXT_TMP=="gif" || $EXT_TMP=="GIF" || $EXT_TMP=="png" || $EXT_TMP=="PNG" || $EXT_TMP=="bmp" || $EXT_TMP=="BMP" ){
					$path_file=$file_url.$file_name1;
					$file_name_resize	= time().$file_rename.".".$EXT_TMP;
					$path_resizefile1=$file_url.$file_name_resize;
					$real_file_name="";
					$dst_w = $file_wieght;//만들어질 이미지의 너비 지정, 픽셀단위의 0이상의 정수를 지정
					$dst_h = $file_height;//만들어질 이미지의 높이 지정, 픽셀단위의 0이상의 정수를 지정

					//이미지 리소스를 받아온다.
					list($src, $src_w, $src_h) = get_image_resource_from_file ($path_file);
					if (empty($src)) die($GLOBALS['errormsg'] . "<br />\n");


					if($file_type==1){

						if($src_w > $src_h){

							//너비를 기준으로 정비율 생성
							$dst1 = get_image_resize($src, $src_w, $src_h, $dst_w);
							if ($dst1 === false) die($GLOBALS['errormsg'] . "<br />\n");

							$result_save1 = save_image_from_resource ($dst1, $path_resizefile1);//저장
							if ($result_save1 === false) die($GLOBALS['errormsg'] . "<br />\n");

						}else if($src_w < $src_h){

							//높이를 기준으로 정비율 생성
							$dst1 = get_image_resize($src, $src_w, $src_h, 0, $dst_h);
							if ($dst1 === false) die($GLOBALS['errormsg'] . "<br />\n");

							$result_save1 = save_image_from_resource ($dst1, $path_resizefile1);//저장
							if ($result_save1 === false) die($GLOBALS['errormsg'] . "<br />\n");

						}else{
							//너비를 기준으로 정비율 생성
							$dst1 = get_image_resize($src, $src_w, $src_h, $dst_w);
							if ($dst1 === false) die($GLOBALS['errormsg'] . "<br />\n");

							$result_save1 = save_image_from_resource ($dst1, $path_resizefile1);//저장
							if ($result_save1 === false) die($GLOBALS['errormsg'] . "<br />\n");
						}

						$real_file_name=$file_name_resize;
						@unlink($path_file);

					}else if($file_type==2){

						//강제 생성
						$dst1 = get_image_resize($src, $src_w, $src_h, $dst_w, $dst_h);
						if ($dst1 === false) die($GLOBALS['errormsg'] . "<br />\n");

						$result_save1 = save_image_from_resource ($dst1, $path_resizefile1);//저장
						if ($result_save1 === false) die($GLOBALS['errormsg'] . "<br />\n");

						$real_file_name=$file_name_resize;
						@unlink($path_file);

					}else if($file_type==3){

						$real_file_name=$file_name1;

					}

				}else{
					$real_file_name=$file_name1;
				}

				@imagedestroy($src);
				@imagedestroy($dst1);
				@unlink($_FILES[$file_name][tmp_name]);

				return $real_file_name."^".$sfile_name1;

			}



		}
		?>