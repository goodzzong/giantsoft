<?
$mod	= "online";	
$menu	= "online_list";
include("../header.php");

$row = $db->object("cs_online","where idx='$idx'");
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>온라인 신청서</small>
		</h3>
	</div>

	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th>접수일</th>
		<td><? echo $row->reg_date ?></td>
	</tr>
	<tr>
		<th>제 목</th>
		<td><? echo $row->subject ?></td>
	</tr>
	<tr>
		<th>이 름</th>
		<td><? echo $row->name ?></td>
	</tr>
	<tr>
		<th>주소</th>
		<td>
			<?echo $row->zip_new?><br>
			<?echo $row->add1?><br>
			<?echo $row->add2?>
		</td>
	</tr>
	<tr> 
		<th>첨부파일</th>
		<td><? if( $row->file != "none" )  { $file = explode( "&&", $row->file ); ?><a href="./download.php?idx=<?=$row->idx?>&download=1"><?=$file[1]?></a><? } else {	echo("자료 미등록");	}  ?></td>
	</tr>
	<tr>
		<th>문의사항</th>
		<td><? echo $row->content ?></td>
	</tr>
	</tbody>
	</table>


	<table class="table">
		<tr>
			<td class="text-center"><a href="#" class="btn btn-default" onClick="history.back();return false;">목록</a></td>
		</tr>
	</table>


<? include('../footer.php');?>