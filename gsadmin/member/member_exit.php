<?
$mod	= "member";	
$menu	= "member_exit";
include('../header.php');
?>
<?
	$table			= "cs_member";
	$listScale		= 10;
	$pageScale	= 10;
	if( !$startPage ) { $startPage = 0; }
	$totalPage = floor($startPage / ($listScale * $pageScale));

	$query		= "select * from $table where exit_check='y'";
		if($search_sday)	{$query.=" and DATE_FORMAT(exit_register,'%Y-%m-%d')>='$search_sday'";}
		if($search_eday)	{$query.=" and DATE_FORMAT(exit_register,'%Y-%m-%d')<='$search_eday'";}
		if($search_order){
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (userid like '%$search_order%' or name like '%$search_order%' or content like '%$search_order%')";
			}
		}

	$rs			= mysql_query($query);
	$totalList	= mysql_num_rows($rs);

	$query		= "select * from $table where exit_check='y'";
		if($search_sday)	{$query.=" and DATE_FORMAT(exit_register,'%Y-%m-%d')>='$search_sday'";}
		if($search_eday)	{$query.=" and DATE_FORMAT(exit_register,'%Y-%m-%d')<='$search_eday'";}
		if($search_order){
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (userid like '%$search_order%' or name like '%$search_order%' or content like '%$search_order%')";
			}
		}

	$query.="  order by exit_register desc, idx desc LIMIT $startPage, $listScale";
	$result = mysql_query($query);
	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }

	$param_url = 
	"search_item=".$search_item.
	"&search_order=".$search_order.
	"&search_sday=".$search_sday.
	"&search_eday=".$search_eday;
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>회원탈퇴 정보</small>
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
					<select name="search_item"  class="form-control input-sm" >
						<option value="">통합검색</option>
						<option value="name" <?if($search_item=="name"){?>selected<?}?>>이름</option>
						<option value="userid" <?if($search_item=="userid"){?>selected<?}?>>아이디</option>
					</select>
				</div>
			</div>
			<input type="text" name="search_order" class="form-control input-sm" value="<?=$search_order?>">
		</td>
	</tr>
	<tr>
		<th>탈퇴일</th>
		<td>
			<div class="input-group datetime">
				<input type="text" name="search_sday" class="form-control input-sm text-center" value="<?=$search_sday?>"/>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
			~
			<div class="input-group datetime">
				<input type="text" name="search_eday" class="form-control input-sm text-center" value="<?if(empty($search_eday)){echo date("Y-m-d");}else{echo $search_eday;}?>"/>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
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

	<div class="table-responsive" >
	<form name="member_form" class="form-inline"  method="post" action="<?=$_SERVER[PHP_SELF];?>">
	<table class="table table-bordered table-hover" >
	<caption></caption>
	<colgroup>
	<col width="5%" title="checkbox" >
	<col width="5%" title="N O" >
	<col width="10%" title="이름" >
	<col width="*" title="아이디">
	<col width="7%" title="관리">
	</colgroup>
	<thead>
	<tr>
		<td colspan="4"></td>
		<th><a href="javascript:;" class="btn btn-default btn-xs ajax-checkbox" data-dbname="<?=$table?>" data-name="delete" data-val="">삭제하기</a></th>
	</tr>
	<tr>
		<th><input type="checkbox" id="allCheck"></th>
		<th>N O</th>
		<th>이름</th>
		<th>아이디</th>
		<th>탈퇴일</th>
	</tr>
	</thead>
	<tbody>
	<?
		while( $row = mysql_fetch_array($result)) {
			$exit_register	= $tools->strDateCut($row[exit_register], 3);
	?>
	<tr>
		<td class="text-center"><input type="checkbox" name="check_list" value="<? echo $row[idx] ?>"></td>
		<td class="text-center"><?=$listNo;?></td>
		<td class="text-center"><?=$row[name];?></td>
		<td class="text-center"><?=$row[userid];?></td>
		<td class="text-center"><?=$exit_register;?></td>
	</tr>	
	<?
		$listNo--;
		}
	?>
	<? if(empty($totalList)) {?>
	<tr>
		<td colspan="5" class="text-center"> 탈퇴한 회원이 없습니다.</td>
	</tr>
	<?}?>

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
					echo "<li><a href='$_SERVER[PHP_SELF]?param_url=$param_url&startPage=$prePage'><span aria-hidden='true'>&laquo;</span></a></li>";
				}
				for( $j=0; $j<$pageScale; $j++ ) {
					$nextPage = ($totalPage * $pageScale + $j) * $listScale;
					$pageNum = $totalPage * $pageScale + $j+1;
					if( $nextPage < $totalList ) {
						if( $nextPage!= $startPage ) {
							echo "<li><a href='$_SERVER[PHP_SELF]?param_url=$param_url&startPage=$nextPage&'>$pageNum</a></li>";
						} else {
							echo "<li class='active'><a href='javascript;'>$pageNum</a></li>";
						}
					}
				}
				if( $totalList > (($totalPage+1) * $listScale * $pageScale)) {
					$nNextPage = ($totalPage+1) * $listScale * $pageScale;
					echo "<li><a href='$_SERVER[PHP_SELF]?param_url=$param_url&startPage=$nNextPage'><span aria-hidden='true'>&raquo;</span></a></li>";
				}
			}
			if( $totalList <= $listScale) {
				echo "<li class='active'><a href='javascript:;' >1</a></li>";
			}
		?>
		</ul>
	</div>

<? include('../footer.php');?>