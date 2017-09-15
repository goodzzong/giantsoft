<?
$mod	= "member";	
$menu	= "member";
include('../header.php');

	$table			= "cs_member";
	$listScale		= 20;
	$pageScale	= 10;
	if( !$startPage ) { $startPage = 0; }
	$totalPage = floor($startPage / ($listScale * $pageScale));

	$query = "select * from $table where exit_check=''";
		if($search_level )		{$query.=" and level ='$search_level'";}
		if($search_order){
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (userid like '%$search_order%' or name like '%$search_order%' or phone like'%$search_order%')";
			}
		}
	$rs			= mysql_query($query);
	$totalList	= mysql_num_rows($rs);

	$query = "select * from $table where exit_check=''";
		if($search_level )		{$query.=" and level ='$search_level'";}
		if($search_order){
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (userid like '%$search_order%' or name like '%$search_order%' or phone like'%$search_order%')";
			}
		}
	$query.="  order by idx desc LIMIT $startPage, $listScale";
	$result = mysql_query($query);
	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }

	$param_url = 
	"search_item=".$search_item.
	"&search_order=".$search_order.
	"&search_level=".$search_level;
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>회원 정보</small>
		</h3>
	</div>


	<div class="text-right"><a href="member_excel.php" class="btn btn-success btn-sm">엑셀 다운로드</a></div><br>
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
					<select name="search_item"  class="form-control input-sm" >
						<option value="">통합검색</option>
						<option value="userid" <?if($search_item=="userid"){?>selected<?}?>>아이디</option>
						<option value="name" <?if($search_item=="name"){?>selected<?}?>>이름</option>
						<option value="phone" <?if($search_item=="phone"){?>selected<?}?>>휴대폰</option>
					</select>
				</div>
			</div>
			<input type="text" name="search_order" class="form-control input-sm" value="<?=$search_order?>">
		</td>
	</tr>
	<tr>	
		<th>회원구분</th>
		<td>
			<select name="search_level" class="form-control2 input-sm">
				<option value="">전체</option>
				<option value="1" <? if( $search_level == 1 ) { echo("selected");} ?>>개인회원</option>
				<option value="2" <? if( $search_level == 2 ) { echo("selected");} ?>>사업자회원</option>
			</select>
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
	<table class="table table-bordered table-hover" >
	<caption class="text-right">전체 회원 : <font color="red"><?=number_format($totalList);?></font> 명&nbsp;&nbsp;</caption>
	<colgroup>
	<col width="5%" title="">
	<col width="5%" title="N O" >
	<col width="15%" title="아이디">
	<col width="10%" title="회원등급">
	<col width="10%" title="이름">
	<col width="10%" title="휴대폰">
	<col width="*" title="이메일">
	<col width="10%" title="가입일자">
	<col width="5%" title="적립금">
	<col width="7%" title="관리하기">
	</colgroup>
	<thead>
	<tr>
		<td colspan="9"></td>
		<th><a href="javascript:;" class="btn btn-default btn-xs ajax-checkbox" data-dbname="<?=$table?>" data-name="delete" data-val="">삭제하기</a></th>
	</tr>
	<tr>
		<th><input type="checkbox" id="allCheck"></th>
		<th>N O</th>
		<th>아이디</th>
		<th>회원등급</th>
		<th>이 름</th>
		<th>휴대폰</th>
		<th>이메일</th>
		<th>가입일자</th>
		<th>적립금</th>
		<th>관리하기</th>
	</tr>
	</thead>
	<tbody>
	<?
	while( $row = mysql_fetch_array($result)) {
	?>
	<tr>
		<td class="text-center"><input type="checkbox" name="check_list" value="<?=$row->idx ?>"></td>
		<td class="text-center"><?=$listNo;?></td>
		<td class="text-center"><?=$row[userid];?></td>
		<td class="text-center">
			<?
			if($row[level]==1){
				echo "개인회원";
			}else if($row[level]==2){
				echo "특별회원";
			}
			?>
		</td>
		<td class="text-center"><?=$row[name];?></td>
		<td class="text-center"><?=$row[phone];?></td>
		<td class="text-center"><?=$row[email];?></td>
		<td class="text-center"><?=$tools->strDateCut($row[register],1);?></td>
		<td class="text-center"><a href="#none" class="btn btn-warning btn-sm" onClick="pointWinOpen('<?=$row[userid];?>');">설정</a></td>
		<td class="text-center"><a href="./member_form.php?idx=<?=$row[idx]?>" class="btn btn-default btn-sm">수정하기</a></td>
	</tr>	
	<?
		$listNo--;
		}
	?>

	<? if(!$totalList) {?>
	<tr>
		<td colspan="12" class="text-center"> 가입한 회원이 없습니다.</td>
	</tr>
	<?}?>

	</tbody>
	</table>
	</div>


	<div class="text-center">
		<ul class="pagination">
		<?
			if( $totalList > $listScale ) {
				if( $startPage+1 > $listScale*$pageScale ) {
					$prePage = $startPage - $listScale * $pageScale;
					echo "<li><a href='$_SERVER[PHP_SELF]?param_url=$param_url&startPage=$prePage'><span aria-hidden='true'>&laquo;</span></a></li>";
				}
				for( $j=0; $j<$pageScale; $j++ ) {
					$nextPage = ($totalPage * $pageScale + $j) * $listScale;
					$pageNum = $totalPage * $pageScale + $j+1;
					if( $nextPage < $totalList ) {
						if( $nextPage!= $startPage ) {
							echo "<li><a href='$_SERVER[PHP_SELF]?param_url=$param_url&startPage=$nextPage'>$pageNum</a></li>";
						} else {
							echo "<li class='active'><a href='javascript:;'>$pageNum</a></li>";
						}
					}
				}
				if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
					$nNextPage = ($totalPage+1) * $listScale * $pageScale;
					echo "<li><a href='$_SERVER[PHP_SELF]?param_url=$param_url&startPage=$nNextPage'><span aria-hidden='true'>&raquo;</span></a></li>";
				}
			}
			if( $totalList <= $listScale) {
				echo "<li class='active'><a href='javascript:;'>1</a></li>";
			}
		?>
		</ul>
	</div>

<? include('../footer.php');?>