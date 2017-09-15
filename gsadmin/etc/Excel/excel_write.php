<?
include('../../header.php'); 
?>

	<div>
		<h4 class="page-header">제품엑셀업로드</h4>
	</div>

	<form action="./excel_dir.php" method="post" name="goods_form" enctype="multipart/form-data">
	<table class="table table-bordered">
		<colgroup>
			<col width="20%">
			<col width="80%">
		</colgroup>
		<tbody>
			<tr>
				<th>파일첨부</th>
				<td><input type="file" name="simage"></td>
			</tr>
			<tr>
				<th>샘플파일</th>
				<td>제품엑셀파일(확장자 : xls)을 등록합니다. --> <a href="sample.xls">[샘플엑셀 다운로드]</a></td>
			</tr>
		</tbody>
	</table>
	</form>

<? include('../../footer.php');?>