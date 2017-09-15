<?include $_SERVER['DOCUMENT_ROOT']."/common.php";
if($_GET[hidden_goods_list]) {
	$arr_goods_list = explode("&&", $_GET[hidden_goods_list] );
	foreach($arr_goods_list as $key=>$val) {
		if($val) $db->update('cs_goods','ranking='.$key.' where idx='.$val);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<TITLE>&nbsp;제품순위설정 </TITLE>
<script language="JavaScript">
<!--
// 순위 변경 ( up or down )
function cateMove(index,to)
{
	var list = index;
	var total = list.length-1;
	var index = list.selectedIndex;

	if (index==-1){
		alert("상품을 선택하세요.");
		return;
	}
	
	if (to == +1 && index == total) return alert('이동이 불가능합니다');
	if (to == -1 && index == 0) return alert('이동이 불가능합니다');
	
	var items = new Array;
	var values = new Array;
	
	for (i = total; i >= 0; i--) {
		items[i] = list.options[i].text;
		values[i] = list.options[i].value;
	}
		
	for (i = total; i >= 0; i--) {
		if (index == i) {
			list.options[i + to] = new Option(items[i],values[i], 0, 1);
			list.options[i] = new Option(items[i + to], values[i + to]);
			i--;
		}
		else
		{
			list.options[i] = new Option(items[i], values[i]);
		}
	}
	return;
}

// 옵션 데이타 입력
function dataInput() {
	var form=document.myform;
	var data_cnt=0;
	form.hidden_goods_list.value="";
	for( data_cnt=0; data_cnt < form.goods_list.length; data_cnt ++) {
		form.hidden_goods_list.value =form.hidden_goods_list.value + form.goods_list.options[data_cnt].value;
		form.hidden_goods_list.value= form.hidden_goods_list.value + "&&";
	}
}

// 폼 전송
function sendit(f) {
	if(confirm("정말 저장하시겠습니까?")) {
		dataInput();
		f.submit();
	}
}

//-->
</script>
</head>

<body>

	<form method="get" name="myform">
	<input type="hidden" name="hidden_goods_list">
	<input type="hidden" name="part_idx" value="<?=$_GET[part_idx];?>">
	<table class="table table-bordered">
	<tr>
		<td class="glyphicon btn  btn-xs btn-danger" aria-hidden="true" style="width:100%;">순위설정</td>
	</tr>
	<tr>
		<td class="text-center">
			<select name="goods_list" style="width:100%;height:300px;" multiple>
			<?
			$no=0;
			$result=$db->select("cs_goods", "where part_idx='$_GET[part_idx]' order by ranking asc, idx desc","idx,name,ranking");
			while($row=mysql_fetch_object($result)) {
				++$no;
			?>
				<option value="<?=$row->idx;?>"><?=$no;?> : <?=$row->name;?></option>
			<?}?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="text-right">
			<a href="javascript:cateMove(document.myform.goods_list,-1);" class="glyphicon btn btn-sm btn-default">∧</a>&nbsp;
			<a href="javascript:cateMove(document.myform.goods_list,1);" class="glyphicon btn btn-sm btn-default">∨</a>&nbsp;&nbsp;&nbsp;
			<a href="javascript:sendit(document.myform);" class="glyphicon btn btn-sm btn-danger" aria-hidden="true">저장</a>&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	</table>
	</form>

</body>
</html>