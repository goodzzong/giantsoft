<?
$mod="ETC";
$menu="banner";
include("../../header.php");


if($idx) { 
	$row = $db->object("cs_banner","where idx='$idx'");
	$page_mode = "수정";
	$mode = "edit";
}else{
	$page_mode = "등록";
	$mode = "write";
}
$cate_cnt = $db->cnt("cs_cate","where table_name='cs_banner'");
?>


<div class="text-right">
	<h3 class="page-header">
		<small>
			배너관리(<?=$page_mode?>)
		</small>
	</h3>
</div>


	<form method="post" action="./banner_exe.php" name="tx_editor_form" ENCTYPE="multipart/form-data">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="idx" value="<?=$idx?>">

	<table class="table table-bordered">
	<colgroup>
	<col width="20%">
	<col width="80%">
	</colgroup>
	<tbody>
	<?
	if($cate_cnt > 0) {
	?>
	<tr>
		<th>카테고리</th>
		<td>
			<select name="cate" class="form-control2">
			<option value="">선택</option>
			<?
				$rsc = $db->select("cs_cate","where table_name='cs_banner' order by idx asc");
				while($rowc = mysql_fetch_array($rsc)){
			?>
			<option value="<?=$rowc[idx]?>"><?=$rowc[name]?></option>
			<?}?>
			</select>
		</td>
	</tr>
	<? 
		}
	?>
	<tr>
		<th>노출여부</th>
		<td>
			<label class="radio-inline"><input type="radio" name="display" value="1" <?if($row->display=="1"){ echo "checked";}?>  <?if($idx==""){ echo "checked";}?>>노출</label>&nbsp;
			<label class="radio-inline"><input type="radio" name="display" value="0" <?if($row->display=="0"){ echo "checked";}?>>미노출</label>
		</td>
	</tr>
	<tr>
		<th>사용 기간</th>
		<td>
			<table border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td>
						<div class="input-group" id='datetimepicker1'>
							<input type="text" name="sday" class="form-control" data-date-format="YYYY.MM.DD" value="<?=$row->sday?>"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>		
					</td>
					<td>&nbsp;~&nbsp;</td>
					<td>
						<div class="input-group" id='datetimepicker2'>
							<input type="text" name="eday" class="form-control" data-date-format="YYYY.MM.DD" value="<?=$row->eday?>"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>			
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>제목</th>
		<td><input type="text" name="title" class="form-control" value="<?=$row->title?>" ></td>
	</tr>
	<tr>
		<th>링크</th>
		<td>http://<input type="text" name="link_url" class="form-control" value="<?=$row->link_url?>" ></td>
	</tr>
	<tr>
		<th>링크열기</th>
		<td>
			<label class="radio-inline"><input type="radio" name="link_open" value="1" <?if($row->link_open=="1"){ echo "checked";}?>  <?if($idx==""){ echo "checked";}?>> 새 창에서 열기</label>
			<label class="radio-inline"><input type="radio" name="link_open" value="2" <?if($row->link_open=="2"){ echo "checked";}?>> 현재 창에서 열기</label>
			<label class="radio-inline"><input type="radio" name="link_open" value="3" <?if($row->link_open=="3"){ echo "checked";}?>> 링크 없음</label>
		</td>
	</tr>
	<tr>
		<th>이미지</th>
		<td>
		<?
			if($row->bbs_file){
				echo "<img src='../../../data/bbsData/$row->bbs_file'>";
				echo "<br>";
				echo "$row->sbbs_file";
				echo "<br>";
				echo "<label class='checkbox-inline'><input type='checkbox' name='imdel1' value='y'>삭제</label><br><br>";
			}
		?>
		<input type="file" name="bbs_file">[ 권장사이즈 : OOO x OOO ]
		</td>
	</tr>
	</tbody>	
	</table>
	</form>


	<table class="table">
		<tr>
			<td class="text-center">
				<a href="javascript:send();" class="btn btn-primary">등록</a>
				<a href="./banner_list.php" class="btn btn-default">목록</a>
			</td>
		</tr>
	</table>


<script type="text/javascript">
<!--
function send(form){
	var form=document.tx_editor_form;
	form.submit();
}
//-->
</script>


<? include('../../footer.php');?>