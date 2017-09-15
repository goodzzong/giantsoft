<?
$mod	= "product";	
$menu	= "product_qa";
include("../header.php");

$row = $db->object("cs_product_qa","where idx='$idx'");
//제품정보
$goods_row	= $db->object("cs_goods","where idx='$row->product_idx'");
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>상품 문의</small>
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
		<th>고객명</th>
		<td><? echo $row->name ?></td>
	</tr>
	<tr>
		<th>연락처</th>
		<td><? echo $row->phone ?></td>
	</tr>
	<tr>
		<th>메일주소</th>
		<td><? echo $row->email ?></td>
	</tr>
	<tr>
		<th>제 목</th>
		<td><? echo $row->subject ?></td>
	</tr>
	<tr>
		<th>내 용</th>
		<td><? echo nl2br($row->content) ?></td>
	</tr>
	</tbody>
	</table>


	<form name="tx_editor_form" action="product_qa_ok.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idx" value="<?=$row->idx?>">
	<input type="hidden" name="mode" value="edit">
	<table class="table table-bordered">
	<colgroup >
	<col width="15%"/>
	<col width="*" />
	</colgroup>
	<tbody>
	<tr>
		<th>답변 완료일</th>
		<td><?if(strtotime($row->reply_reg_date) > 1){ echo $row->reply_reg_date; }else{ echo "-"; }?></td>
	</tr>
	<tr>
		<th>답변 여부</th>
		<td>
			<label class="radio-inline"><input type="radio" name="reply" value="y" <? if( $row->reply=="y") echo("checked"); ?>>답변완료</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="reply" value="n" <? if( $row->reply=="n") echo("checked"); ?>>답변대기</label>
		</td>
	</tr>
	<tr>
		<th>답변하기</th>
		<td><textarea name="reply_content" rows="10" class="form-control"><?=$row->reply_content?></textarea></td>		
	</tr>
	</tbody>
	</table>
	</form><br>


	<table class="table">
		<tr>
			<td class="text-center">
				<a href="#" class="btn btn-primary" onClick="sendit();">등록</a>
				<a href="./product_qa.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>


<script type="text/javascript">
<!--
function sendit() {
	var form=document.tx_editor_form;
	if(form.reply_content.value==""){
		alert("[답변하기] 내용을 입력해주세요.");
		form.reply_content.focus();
	} else {
		form.submit();
	}
}
//-->
</script>

<? include('../footer.php');?>