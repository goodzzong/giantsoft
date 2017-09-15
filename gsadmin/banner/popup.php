<?
$mod	= "banner";	
$menu	= "popup";
include('../header.php'); 


	$table			= "cs_popup";
	$listScale		= 10;
	$pageScale	= 10;
	if( !$startPage ) { $startPage = 0; }
	$totalPage = floor($startPage / ($listScale * $pageScale));

	$query		= "select * from $table where 1";
	$rs				= mysql_query($query);
	$totalList	= mysql_num_rows($rs);

	$query = "select * from $table where 1";
	$query.="  order by idx desc LIMIT $startPage, $listScale";
	$result = mysql_query($query);

	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>팝업배너 관리</small>
		</h3>
	</div>

	<div class="table-responsive">
	<form method="post" name="form">
	<table class="table table-bordered table-hover">
	<colgroup>
	<col width="5%">
	<col width="5%">
	<col width="10%">
	<col width="*">
	<col width="10%">
	<col width="20%">
	<col width="10%">
	<col width="7%">
	</colgroup>
	<thead>
	<tr>
		<td colspan="7"></td>
		<th><a href="javascript:;" class="btn btn-default btn-xs ajax-checkbox" data-dbname="<?=$table?>" data-name="delete" data-val="">삭제하기</a></th>
	</tr>
	<tr>
		<th><input type="checkbox" id="allCheck"></th>
		<th>N O</th>
		<th>종류 /형태</th>
		<th>제목</th>
		<th>상태</th>
		<th>기간</th>
		<th>등록일</th>
		<th>관리하기</th>
	</tr>
	 </thead>
	 <tbody>
	<?
		while($row = mysql_fetch_array($result)){
			
			$reg_date	= $tools->strDateCut($row[reg_date], 3);
	?>
	<tr>
		<td class="text-center"><input type="checkbox" name="check_list" value="<? echo $row[idx] ?>"></td>
		<td class="text-center"><?=$listNo;?></td>
		<td class="text-center">
			<? if( $row[kind]==0 ) { echo('팝업');} else if( $row[kind]==1 ) { echo('레이어');} else if( $row[kind]==2 ) { echo('모바일');}?>
			/
			<? if( $row[display]==0 ) { echo('HTML');} else if( $row[display]==1 ) { echo('이미지');}?>
		</td>
		<td class="text-center"><?=$row[title_bar];?></td>
		<td class="text-center"><? if($row[end_day] < time()) { echo "종료"; } else if(($row[start_day] < time()) && ($row[end_day] > time())) { echo "사용중";} else if($row[start_day] > time()) { echo "미사용";}?></td>
		<td class="text-center"><?=date("Y-m-d", $row[start_day]);?> ~ <?=date("Y-m-d", $row[end_day]);?></td>
		<td class="text-center"><?=$reg_date;?></td>
		<td class="text-center"><a href="./popup_edit.php?idx=<? echo $row[idx] ?>" class="btn btn-default btn-sm">수정하기</a></td>
	</tr>
	<?
		$listNo--;
		}
	?>
	</tbody>
	</table>
	</form>
	</div>


	<div class="text-center">
		<ul class="pagination">
			<?
			if( $totalList > $listScale ) {
				if( $startPage+1 > $listScale*$pageScale ) {
					$prePage = $startPage - $listScale * $pageScale;

					echo "<li><a href='$_SERVER[PHP_SELF]?startPage=$prePage'><span aria-hidden='true'>&laquo;</span></a></li>";
				}

				for( $j=0; $j<$pageScale; $j++ ) {
					$nextPage = ($totalPage * $pageScale + $j) * $listScale;
					$pageNum = $totalPage * $pageScale + $j+1;
					if( $nextPage < $totalList ) {
						if( $nextPage!= $startPage ) {

							echo "<li><a href='$_SERVER[PHP_SELF]?startPage=$nextPage'>$pageNum</a></li>";
						} else {
							echo " <li class='active'><a href='javascript:;'>$pageNum</a></li>";
						}
					}
				}

				if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
					$nNextPage = ($totalPage+1) * $listScale * $pageScale;

					echo "<li><a href='$_SERVER[PHP_SELF]?startPage=$nNextPage'><span aria-hidden='true'>&raquo;</span></a></li>";
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
			<td class="text-center"><a href="./popup_add.php" class="btn btn-primary">등록하기</a></td>
		</tr>
	</table>
	

<? include('../footer.php');?>