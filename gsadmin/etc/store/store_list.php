<?
$mod="ETC";
$menu="store";
include("../../header.php");


	$table			= "cs_store";
	$listScale		= 10;
	$pageScale	= 10;
	if( !$startPage ) { $startPage = 0; }
	$totalPage = floor($startPage / ($listScale * $pageScale));

	$query		= "select * from $table where 1";
	if($key){ $query.=" and $keyfield like '%$key%'"; }
	$rs				= mysql_query($query);
	$totalList	= mysql_num_rows($rs);

	$query = "select * from $table where 1";
		if($key){ $query.=" and $keyfield like '%$key%'"; }
	$query.="  order by idx desc LIMIT $startPage, $listScale";
	$result = mysql_query($query);

	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
?>


<div class="text-right">
	<h3 class="page-header">
		<small>
			매장안내
		</small>
	</h3>
</div>


	<div class="well well-small text-center">
		<form name="formch" class="form-inline" method="post" action="<?=$_SERVER[PHP_SELF];?>">
		<div class="form-group input-group">
			<div class="input-group-btn">
				<select name="keyfield" class="form-control">
					<option value="subject">매장명</option>
				</select>
			</div>
		</div>
		<div class="form-group input-group">
			<input type="text" name="key" class="form-control" placeholder="Search" value="<?=$key?>">
			<div class="input-group-btn">
				<a href="javascript:search(this.form);" class="btn btn-primary" title="검색" > <span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
				<a href="<?=$PHP_SELF?>" class="btn btn-default" title="새로고침"> <span class="glyphicon glyphicon-refresh"></span></a>
			</div>
		</div>
		</form>
	</div>


	<form method="post" name="form">
	<table class="table table-bordered table-hover ">
	<colgroup>
	<col width="5%">
	<col width="5%">
	<col width="15%">
	<col width="*%">
	<col width="10%">
	<col width="5%">
	</colgroup>
	<thead>
	<tr>
		<th><input type="checkbox" id="allCheck" onChange="javascript:all_checkbox();"></th>
		<th>No</th>
		<th>매장명</th>
		<th>주소</th>
		<th>전화번호</th>
		<th>설정</th>
	</tr>
	</thead>
	<tbody>
	<?
		while($row = mysql_fetch_array($result)){
	?>
	<tr>
		<td class="text-center"><input type="checkbox" class="check_list" value="<? echo $row[idx] ?>" name="check[]"></td>
		<td class="text-center"><? echo $listNo ?></td>
		<td class="text-center"><?=$row[subject]?></td>
		<td class="text-left"><?=$row[add1]?> <?=$row[add2]?></td>
		<td class="text-center"><?=$row[tel]?></td>
		<td class="text-center"><a href="./store_form.php?idx=<?=$row[idx]?>" class="btn btn-default btn-sm">상세</a></td>
	</tr>
	<? 
		$listNo--;
		} 
	?>
	</tbody>
	</table>
	</form>


	<div class="text-center">
		<ul class="pagination">
			<?
				if( $totalList > $listScale ) {
					if( $startPage+1 > $listScale*$pageScale ) {
						$prePage = $startPage - $listScale * $pageScale;
						echo "<li><a href='$_SERVER[PHP_SELF]?key=$key&keyfield=$keyfield&startPage=$prePage'><span aria-hidden='true'>&laquo;</span></a></li>";
					}
					for( $j=0; $j<$pageScale; $j++ ) {
						$nextPage = ($totalPage * $pageScale + $j) * $listScale;
						$pageNum = $totalPage * $pageScale + $j+1;
						if( $nextPage < $totalList ) {
							if( $nextPage!= $startPage ) {
								echo "<li><a href='$_SERVER[PHP_SELF]?key=$key&keyfield=$keyfield&startPage=$nextPage'>$pageNum</a></li>";
							} else {
								echo " <li class='active'><a href='javascript:;'>$pageNum</a></li>";
							}
						}
					}
					if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
						$nNextPage = ($totalPage+1) * $listScale * $pageScale;

						echo "<a href='$_SERVER[PHP_SELF]?key=$key&keyfield=$keyfield&startPage=$nNextPage'><span aria-hidden='true'>&raquo;</span></a></li>";
					}
				}
				if( $totalList <= $listScale) {
					echo "<li class='active'><a href='javascript:;'>1</a></li>";
				}
				mysql_close();
			?>
		</ul>
	</div>


	<table class="table">
		<tr>
			<td class="text-left"><a href="javascript:send(this.form);" class="btn btn-danger btn-sm">삭제</a></td>
			<td class="text-right"><a href="./store_form.php" class="btn btn-primary btn-sm">글쓰기</a></td>
		</tr>
	</table>



<script language="JavaScript">
<!--
function send(form){
	
		var count=0;
	
		for(var i=0; i<form.elements.length; i++) 
		{ 
			if(form.elements[i].checked == true) 
			{ 
				count++; 
			} 
		} 
		
		if ( count == 0 ) 
		{ 
			   alert('삭제할것을 체크하세요'); 
			   return; 
		} else {
	
			ans = confirm("\n정말 삭제 하시겠습니까?");
			
			if(ans==true){
				
				form.action = "store_del.php?start=<? echo $start ?>&key=<? echo $key ?>&keyfield=<? echo $keyfield ?>";
				form.submit();
			}
		}

}

/*검색*/
function search(form){
	val = formch.key.value;
	l = val.length;
	len = l + 1;
	for(i=1;i < len;i++) {
		temp = val.substring(i-1,i);
		if (temp == " ") l = l -1;
	}
	if (l < 1) { 
		alert("검색어를 입력하세요.");
		formch.key.focus();
		return;
	}
	formch.submit();
}
// -->
</script>


<? include('../../footer.php');?>