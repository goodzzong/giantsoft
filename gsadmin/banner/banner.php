<?
$mod	= "banner";	
$menu	= "banner";
include("../header.php");


	$table			= "cs_banner";
	$listScale		= 10;
	$pageScale	= 10;
	if( !$startPage ) { $startPage = 0; }
	$totalPage = floor($startPage / ($listScale * $pageScale));

	$query		= "select * from $table where 1";
		if($search_order){
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (subject like '%$search_order%' or link_url like '%$search_order%')";
			}
		}

	$rs				= mysql_query($query);
	$totalList	= mysql_num_rows($rs);

	$query = "select * from $table where 1";
		if($search_order){
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (subject like '%$search_order%' or link_url like '%$search_order%')";
			}
		}

	$query.="  order by idx desc LIMIT $startPage, $listScale";
	$result = mysql_query($query);

	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }

	$param_url = 
	"search_item=".$search_item.
	"&search_order=".$search_order;
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>홈/제품 배너 관리</small>
		</h3>
	</div>

	<form method="post" name="search_form" class="form-inline" action="<?=$_SERVER['PHP_SELF'];?>" >
	<table class="table table-bordered">
	<colgroup>
	<col width="15%">
	<col width="*">
	</colgroup>
	<tbody>
	<tr>
		<th>검색어</th>
		<td>
			<div class="form-group">
				<div class="input-group-btn">
					<select name="search_item" class="form-control input-sm" >
						<option value="">통합검색</option>
						<option value="name" <?if($search_item=="name"){?>selected<?}?>>제목</option>
						<option value="link_url" <?if($search_item=="link_url"){?>selected<?}?>>링크</option>
					</select>
				</div>
			</div>
			<input type="text" name="search_order" class="form-control input-sm" value="<?=$search_order?>">
		</td>
	</tr>
	<tr>
		<td colspan="2" class="text-center">
			<button type="submit" class="btn btn-primary btn-sm">검색</button>&nbsp;
			<a href="<?=$_SERVER['PHP_SELF']?>" class="btn btn-default btn-sm">초기화</a>
		</td>
	</tr>
	</tbody>
	</table>
	</form>


	<div class="table-responsive">
	<table class="table table-bordered table-hover">
	<colgroup>
	<col width="5%">
	<col width="5%">
	<col width="5%">
	<col width="15%">
	<col width="*">
	<col width="10%">
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
		<th>이미지</th>
		<th>제목</th>
		<th>링크</th>
		<th>노출여부</th>
		<th>등록일</th>
		<th>설정</th>
	</tr>
	</thead>
	<tbody>
	<?
		while($row = mysql_fetch_array($result)){

			$reg_date	= $tools->strDateCut($row[reg_date], 3);
	?>
	<tr>
		<td class="text-center"><input type="checkbox" name="check_list" value="<? echo $row[idx] ?>"></td>
		<td class="text-center"><? echo $listNo ?></td>
		<td class="text-center"><img src="<?=$site_url?>/data/bbsData/<?=$row[bbs_file]?>" class="img-thumbnail"></td>
		<td class="text-center"><? echo $row[subject] ?></td>
		<td class="text-center"><? echo $row[link_url] ?></td>
		<td class="text-center">
			<div class="btn-group">
				<span data-dbname="<?=$table?>" data-name="display" data-idx="<?=$row[idx]?>" data-val="1" class="btn btn-<?if($row[display]){echo"danger active btn-xs";}else{ echo"default btn-xs ajax-button";}?>">ON</span>
				<span data-dbname="<?=$table?>" data-name="display" data-idx="<?=$row[idx]?>" data-val="0" class="btn btn-<?if(empty($row[display])){echo "danger active btn-xs";}else{ echo "default btn-xs ajax-button";}?>">OFF</span>
			</div>
		</td>
		<td class="text-center"><? echo $reg_date?></td>
		<td class="text-center"><a href="./banner_form.php?idx=<?=$row[idx] ?>" class="btn btn-default btn-sm">수정하기</a></td>
	</tr>
	<? 
		$listNo--;
		}
	?>
	</tbody>
	</table>
	</div>


	<div class="text-center">
		  <ul class="pagination">
			<?
				if( $totalList > $listScale ) {
					if( $startPage+1 > $listScale*$pageScale ) {
						$prePage = $startPage - $listScale * $pageScale;

						echo "<li><a href='$_SERVER[PHP_SELF]?$param_url&startPage=$prePage'><span aria-hidden='true'>&laquo;</span></a></li>";
					}

					for( $j=0; $j<$pageScale; $j++ ) {
						$nextPage = ($totalPage * $pageScale + $j) * $listScale;
						$pageNum = $totalPage * $pageScale + $j+1;
						if( $nextPage < $totalList ) {
							if( $nextPage!= $startPage ) {

								echo "<li><a href='$_SERVER[PHP_SELF]?$param_url&startPage=$nextPage'>$pageNum</a></li>";
							} else {
								echo "<li class='active'><a href='javascript:;'>$pageNum</a></li>";
							}
						}
					}

					if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
						$nNextPage = ($totalPage+1) * $listScale * $pageScale;

						echo "<li><a href='$_SERVER[PHP_SELF]?$param_url&startPage=$nNextPage'><span aria-hidden='true'>&raquo;</span></a></li>";
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
			<td class="text-center"><a href="banner_form.php" class="btn btn-primary">등록하기</a></td>
		</tr>
	</table>


 <? include('../footer.php');?>