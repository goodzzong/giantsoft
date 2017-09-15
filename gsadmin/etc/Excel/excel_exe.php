<?
include('../../header.php'); 
?>

	<div>
		<h4 class="page-header">제품엑셀업로드</h4>
	</div>

	<table class="table table-bordered">
	<colgroup>
	<col width="20%">
	<col width="80%">
	</colgroup>
	<tbody>
	<tr>
		<th>엑셀데이터 업로드 완료</th>
		<td><a href="./excel_write.php">[다시넣기]</a></td>
	</tr>
	</tbody>
	</table>
<?

/////////////////////////////////////////////////////////////////////////////////////////////////
require_once $_SERVER['DOCUMENT_ROOT']."/gsadmin/Excel/reader.php";
$data = new Spreadsheet_Excel_Reader();
//$data->setOutputEncoding('CP949'); //한글 코드
$data->setOutputEncoding("UTF-8//IGNORE");
$data->read("../../data/csv/$simage_name"); 

$j=1;
for ($i = 1; $i <= $data->sheets[0]["numRows"]; $i++){
   
	$excel1 = $data->sheets[0]["cells"][$i][1];//part_idx
	$excel2 = $data->sheets[0]["cells"][$i][2];//name
	$excel3 = $data->sheets[0]["cells"][$i][3];//images1


	$code = time().$j;
	if($i>1){
	$query = "insert into cs_goods set 
		display='1',
		code='$code',
		part_idx='$excel1',
		name='$excel2',
		images1='$excel3',
		zzim='',
		register=now()";

	//	echo $query."<br>";
	mysql_query($query);
	}

$j++;
}



?>
엑셀데이타 넣기 성공!!!
<br><br>
<a href="snumber_write.php">[다시넣기]</a>

		</td>
	</tr>
</table>
<? include('../../footer.php');?>