<?
function plupload_update($table_name,$table_idx,$url,$filename){
	$query_insert = "insert into cs_plupload values(
		'',
		'$table_name',
		'$table_idx',
		'$url',
		'$filename'
		)";
	$result_insert = mysql_query($query_insert);
}

//맥스값
function max_number($mf,$code){
	$query_select = "select max($mf) from cs_bbs_data where code='$code'";
	$result_select = mysql_query($query_select);
	$max_no = mysql_result($result_select,0,0);
	return $max_no;
}

//맥스값
function max_count($mf,$table_name){
	$query_select = "select max($mf) from $table_name";
	$result_select = mysql_query($query_select);
	$max_no = mysql_result($result_select,0,0);
	return $max_no;
}


$Number_Grade_Array = array(
	"1"	=>	"01",
	"2"	=>	"02",
	"3"	=>	"03",
	"4"	=>	"04",
	"5"	=>	"05",
	"6"	=>	"06",
	"7"	=>	"07",
	"8"	=>	"08",
	"9"	=>	"09",
	"10"	=>	"10",
	"11"	=>	"11",
	"12"	=>	"12"
);
reset($Number_Grade_Array);


// 파일 확장자 체크
$File_Icon_Array = array(
	"png"	=>	"fa-file-image-o",
	"PNG"	=>	"fa-file-image-o",
	"gif"	=>	"fa-file-image-o",
	"GIF"	=>	"fa-file-image-o",
	"jpg"	=>	"fa-file-image-o",
	"JPG"	=>	"fa-file-image-o",
	"pdf"	=>	"fa-file-pdf-o",
	"PDF"	=>	"fa-file-pdf-o",
	"xls"	=>	" fa-file-excel-o",
	"xlsx"	=>	" fa-file-excel-o",
	"hwp"	=>	"fa-file-word-o",
	"HWP"	=>	"fa-file-word-o",
	"zip"	=>	"fa-file-zip-o",
	"ZIP"	=>	"fa-file-zip-o",
	"text"	=>	"fa-file-text",
	"txt"	=>	"fa-file-text",
	"file"	=>	"fa-file"
);
reset($File_Icon_Array);


function weekDayCheck($time){
$dayContent="";
$week = date("w", $time);
if(!$sunday) $sunday = mktime(0, 0, 0, date("m"), date("d") - $week, date("Y"));
for ($L = 0, $day = $sunday; $L < 7; $L++, $day+= 86400) {
	if($dayContent==""){
		$dayContent=date("d ", $day);
	}else{
		$dayContent.="|".date("d ", $day);
	}

	return $dayContent;

}
}




function dayCheck($year,$month,$day){
$inputYear = $year;
$inputMonth = $month;
$inputDay = $day;

$tmp = date("D", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));

Switch ($tmp) {
case "Sun" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+1, date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+2, date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+3, date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+4, date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+5, date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+6, date($inputYear)));
break;
case "Mon" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-1, date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+1, date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+2, date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+3, date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+4, date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+5, date($inputYear)));
break;
case "Tue" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-2, date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-1, date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+1, date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+2, date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+3, date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+4, date($inputYear)));

break;
case "Wed" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-3, date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-2, date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-1, date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+1, date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+2, date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+3, date($inputYear)));
break;
case "Thu" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-4, date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-3, date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-2, date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-1, date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+1, date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+2, date($inputYear)));
break;
case "Fri" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-5, date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-4, date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-3, date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-2, date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-1, date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)+1, date($inputYear)));
break;
case "Sat" :
$Date0 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-6, date($inputYear)));
$Date1 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-5, date($inputYear)));
$Date2 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-4, date($inputYear)));
$Date3 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-3, date($inputYear)));
$Date4 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-2, date($inputYear)));
$Date5 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay)-1, date($inputYear)));
$Date6 = date("Y-m-d", mktime (0,0,0,date($inputMonth), date($inputDay), date($inputYear)));
break;
}
//	$content=$Date0."|".$Date1."|".$Date2."|".$Date3."|".$Date4."|".$Date5."|".$Date6;
	$content=$Date0."|".$Date6;
	return $content;
}




function idxChk($part_idx){

	$part_idx=$part_idx;
	$part_idxS="";
	$part1_idx="";
	$part2_idx="";

	$query="select * from cs_part where idx='$part_idx'";
	$rs=mysql_query($query);
	$row=mysql_fetch_array($rs);

	if($row[part_index]==2){
		$query_sub="select * from cs_part where part_display_check='1' and part_index='1' and part1_code='$row[part1_code]'";
		$rs_sub=mysql_query($query_sub);
		$row_sub=mysql_fetch_array($rs_sub);

		$part1_idx=$row_sub[idx];
		$part2_idx=$row[idx];
	}else{

		$part1_idx=$row[idx];
	}



	$part_idxS=$part1_idx.",".$part2_idx;


	return $part_idxS;
}




function spamCheck($spam_text,$content){

	$numt=$spam_text;
	$content=$content;
	$nu = explode(",",$numt);

	$check='n';
	for($i=0;$i<count($nu);$i++){

		 if($nu[$i]){
			 $num = substr_count($content,$nu[$i]);
			 if($num>0){
				$check='y';
			 }
		 }

	}

	return $check;

}



function categoryFirstRow(){

	$que_category="select no,cat_name,cat_code from cs_edu_category where cat_oc='y' and cat_depth='0' order by cat_sort";
	$rs_category=mysql_query($que_category);

	while($row_category=mysql_fetch_object($rs_category)){
		$edu_categorys[] = $row_category;
	}

	return $edu_categorys;
}

function categorySecondRow($first_category_idx,$first_category_code){

	$que_category_sub="select cat_name,no,cat_code from cs_edu_category where cat_oc='y' and cat_code like '$first_category_code%' and cat_depth='1' order by cat_sort";
	$rs_category_sub=mysql_query($que_category_sub);

	while($row_category_sub=mysql_fetch_object($rs_category_sub)){
		$edu_category_seconds[] = $row_category_sub;
	}

	return $edu_category_seconds;
}

function add_hyphen($tel)
{
    $tel = preg_replace("/[^0-9]/", "", $tel);    // 숫자 이외 제거
    if (substr($tel,0,2)=='02')
        return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
    else if (strlen($tel)=='8' && (substr($tel,0,2)=='15' || substr($tel,0,2)=='16' || substr($tel,0,2)=='18'))
        // 지능망 번호이면
        return preg_replace("/([0-9]{4})([0-9]{4})$/", "\\1-\\2", $tel);
    else
        return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/", "\\1-\\2-\\3", $tel);
}


function MobileCheck() {
    global $HTTP_USER_AGENT;
    $MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone");

    $checkCount = 0;
        for($i=0; $i<sizeof($MobileArray); $i++){
            if(preg_match("/$MobileArray[$i]/", strtolower($HTTP_USER_AGENT))){ $checkCount++; break; }
        }
   return ($checkCount >= 1) ? "Mobile" : "Computer";
}
?>
