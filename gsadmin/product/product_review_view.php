<?
$mod	= "product";	
$menu	= "product_review";
include("../header.php");

$row = $db->object("cs_product_review","where idx='$idx'");
//제품정보
$goods_row	= $db->object("cs_goods","where idx='$row->product_idx'");
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>구매후기</small>
		</h3>
	</div>
	
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th>등록일</th>
		<td><? echo $row->reg_date ?></td>
	</tr>
	<tr>
		<th>상품명</th>
		<td><? echo $goods_row->name ?></td>
	</tr>
	<tr>
		<th>이름</th>
		<td><? echo $row->name ?></td>
	</tr>
	<tr>
		<th>제 목</th>
		<td><? echo $row->subject ?></td>
	</tr>
	<tr>
		<th>평점</th>
		<td>
			<?for($i=0;$i<$row->star; $i++){?>
			<span class="glyphicon glyphicon-star"></span>
			<?}?>
		</td>
	</tr>
	<tr>
		<th>사진 첨부</th>
		<td><?if($row->bbs_file){?><img src="<?=$site_url?>/data/bbsData/<?=$row->bbs_file?>" alt="" style="max-width:100%;"><?}?></td>
	</tr>
	<tr>
		<th>내용</th>
		<td><? echo nl2br($row->content) ?></td>
	</tr>
	</tbody>
	</table>


	<table class="table">
		<tr>
			<td class="text-center">
				<a href="#" class="btn btn-default" onClick="history.back();return false;">목록</a>
			</td>
		</tr>
	</table>


<? include('../footer.php');?>