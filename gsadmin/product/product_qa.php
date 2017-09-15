<?
$mod	= "product";	
$menu	= "product_qa";
include("../header.php");


	$table			= "cs_product_qa";
	$listScale		= 10;
	$pageScale	= 10;
	if( !$startPage ) { $startPage = 0; }
	$totalPage = floor($startPage / ($listScale * $pageScale));

	$query		= "select * from $table where 1";
		if($search_reply)	{$query.=" and reply ='$search_reply'";}//답변여부
		if($search_order)	{
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (subject like '%$search_order%' or name like '%$search_order%')";
			}
		}
	$rs			= mysql_query($query);
	$totalList	= mysql_num_rows($rs);

	$query		= "select * from $table where 1";
		if($search_reply)	{$query.=" and reply ='$search_reply'";}//답변여부
		if($search_order)	{
			if($search_item){
				$query.=" and $search_item like '%$search_order%'";
			}else{
				$query.=" and (subject like '%$search_order%' or name like '%$search_order%')";
			}
		}

	$query.="  order by idx desc LIMIT $startPage, $listScale";
	$result = mysql_query($query);
	if( $startPage ) { $listNo = $totalList - $startPage; } else { $listNo = $totalList; }

	$param_url = 
	"search_reply=".$search_reply.
	"&search_item=".$search_item.
	"&search_order=".$search_order.
	"&search_sday=".$search_sday.
	"&search_eday=".$search_eday;
?>

	<div class="text-right">
		<h3 class="page-header">
			<small>상품 문의</small>
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
		<th>등록일</th>
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
		<th>검색어</th>
		<td>
			<div class="form-group">
				<div class="input-group-btn">
					<select name="search_item"  class="form-control input-sm">
						<option value="">통합검색</option>
						<option value="subject" <?if($search_item=="subject"){ echo "selected";}?>>제목</option>
						<option value="name" <?if($search_item=="name"){ echo "selected";}?>>고객명</option>
					</select>
				</div>
			</div>
			<input type="text" name="search_order" class="form-control input-sm" value="<?=$search_order?>">
		</td>
	</tr>
	<tr>
		<th>답변여부</th>
		<td>
			<select name="search_reply" class="form-control input-sm">
				<option value="" <?if(empty($search_reply))	{ echo "selected";}?>>전체</option>
				<option value="y" <?if($search_reply=="y")	{ echo "selected";}?>>답변완료</option>
				<option value="n" <?if($search_reply=="n")	{ echo "selected";}?>>미답변</option>
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


	<table class="table table-bordered table-hover">
	<colgroup>
	<col width="5%">
	<col width="5%" title="문의제품">
	<col width="15%" title="문의제품">
	<col width="*" title="제목">
	<col width="7%" title="고객명">
	<col width="7%" title="등록일">
	<col width="10%" title="답변여부">
	<col width="7%" title="답변완료일">
	</colgroup>
	<thead>
	<tr>
		<td colspan="7"></td>
		<th><a href="javascript:;" class="btn btn-default btn-xs ajax-checkbox" data-dbname="<?=$table?>" data-name="delete" data-val="">삭제하기</a></th>
	</tr>
	<tr>
		<th><input type="checkbox" id="allCheck"></th>
		<th colspan="2">문의상품</th>
		<th>제 목</th>
		<th>고객명</th>
		<th>등록일</th>
		<th>답변여부</th>
		<th>답변완료일</th>
	</tr>
	</thead>
	<tbody>
	<?
		$odate = date("Y-m-d");
		while($row = mysql_fetch_array($result)){

			$reg_date				=		$tools->strDateCut( $row[reg_date],3 ); 	
			$reply_reg_date	=		$tools->strDateCut( $row[reply_reg_date],3 );

		//제품정보
		$goods_row		= $db->object("cs_goods","where idx='$row[product_idx]'");
	?>
	<tr>
		<td class="text-center"><input type="checkbox" name="check_list" value="<? echo $row[idx] ?>"></td>
		<td class="text-center"><img src="<?=$site_url?>/data/goodsImages/<?=$goods_row->images1?>" alt="" class="img-thumbnail"></td>
		<td class="text-center"><?=$goods_row->name?></td>
		<td>
			<? echo $row[subject] ?><? if($odate==$reg_date){ ?>&nbsp;<span class="label label-danger">New</span><? } ?>
			<? if($row[secret]=="y"){ ?><span class="glyphicon glyphicon-lock" aria-hidden="true"></span><? } ?>
		</td>
		<td class="text-center"><?echo $row[name]?></td>
		<td class="text-center"><? echo $reg_date ?></td>
		<td class="text-center">
			<?
			if($row[reply]=="n"){
				echo "<b><font color='red'>답변대기</font></b>";
			}
			?>
			<a href="./product_qa_view.php?idx=<?=$row[idx]?>" class="btn btn-default btn-xs btn-block">내용보기</a>
		</td>
		<td class="text-center"><?if(strtotime($row[reply_reg_date]) > 1){ echo $reply_reg_date; }else{ echo "-"; }?></td>
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
								echo " <li class='active'><a href='javascript:;'>$pageNum</a></li>";
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

 <? include('../footer.php');?>       