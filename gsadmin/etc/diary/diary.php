<?
$mod="ETC";
$menu="diary";
include('../../header.php');
?>

<?
	if (!$year) {
		$year	= date("Y");
		$month	= date("m");
	}

	$prev		= date("Y-m",mktime(0,0,0,$month-1,1,$year));
	$prevArray	= split("-",$prev);
	$prevYear	= $prevArray[0];
	$prevMonth	= $prevArray[1];

	$next		= date("Y-m",mktime(0,0,0,$month+1,1,$year));
	$nextArray	= split("-",$next);
	$nextYear	= $nextArray[0];
	$nextMonth	= $nextArray[1];

	$FirstDayPosition	= date("w",mktime(0,0,0,$month,1,$year)) + 1;  
	$TotalDay			= date("t", mktime(0, 0, 0, $month, 1, $year));

?>	


<div class="text-right">
	<h3 class="page-header">
		<small>
			일정관리
		</small>
	</h3>
</div>


	<div class="text-center">
		<h3>
			<a href="<?echo $PHP_SELF?>?year=<?=$prevYear?>&month=<?=$prevMonth?>" class="btn btn-primary btn-sm active glyphicon glyphicon-chevron-left"></a>&nbsp;&nbsp;
				<?=$year?>년<?=$month?>월&nbsp;&nbsp;
			<a href="<?echo $PHP_SELF?>?year=<?=$nextYear?>&month=<?=$nextMonth?>" class="btn btn-primary btn-sm active glyphicon glyphicon-chevron-right"></a>
		</h3>
	</div>

	<table class="table table-bordered">
		<colgroup>
		<col width="14%" />
		<col width="14%" />
		<col width="14%" />
		<col width="14%" />
		<col width="14%" />
		<col width="14%" />
		<col width="14%" />
		</colgroup>
		<thead>
			<tr>
				<th class="sun">일</th>
				<th>월</th>
				<th>화</th>
				<th>수</th>
				<th>목</th>
				<th>금</th>
				<th class="sat">토</th>
			</tr>
		</thead>
		<tbody>
			<tr>
								
<?
	$line = 5;
	if (($FirstDayPosition > 5) && (ceil($TotalDay/5) == 7)) $line = 6;
	if (($FirstDayPosition == 1) && ($TotalDay == 28)) $line =4;

	$k = 0;

	for ($i=1; $i<=$line; $i++) {
?>
		<tr>
<?
		for ($j=1; $j<=7; $j++) {
			if ((!$day) && ($j == $FirstDayPosition)) $day = 1;

			$classValue = "";
			if ($j == 1) $classValue = "red";
			if ($j == 7) $classValue = "blue";
			if ($day > 0){
?>
					<td style="color:<?=$classValue?>;vertical-align:top;WORD-BREAK:break-all;" ><h5><?=$day?></h5>
						<? if($day>0){ ?>
							<a href="javascript:SelectedDay('<?=$admin_id?>','<?=$admin_name?>','<?=$year."-".$month."-".$day?>');" class="btn btn-success btn-xs">입력</a>
						<? } ?>
							<dd class="text-left" style="WORD-BREAK:break-all;">				
							<?
							$monthlen = strlen($month);
							if($monthlen==1){ $month = "0".$month; }
							
							$daylen = strlen($day);
							if($daylen==1){ $day = "0".$day; }
							
							$dates = $year."-".$month."-".$day;
							$query = "select * from diary where calendar_date='$dates' order by idx asc";
							$rs = mysql_query($query);
							$counts = mysql_num_rows($rs);
							
							if($counts==0){} else {?>
								<br>
								<?
								$kk=1;
								while($row1 = mysql_fetch_array($rs)){
									$gub = $row1[idx].$day;
								?>
									<span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;
									<a href="javascript:SelectDaym('<?=$row1[idx]?>');" ><? echo $row1[title] ?></a><br>					
								<? $kk++; } ?>
							<? } ?>


									
									</dd>
								</td>
		<?	} else {?>

			<td><h5><?=$day?></h5>
				<? if($day>0){ ?>
				<a href="javascript:SelectedDay('<?=$admin_id?>','<?=$admin_name?>','<?=$year."-".$month."-".$day?>');" class="btn btn-success btn-xs">입력</a>
				<? } ?>			
			</td>
		<?
			}
			if ($day != $TotalDay) {
				if (($day > 0) && ($day < $TotalDay)) $day++;
			} else {
				$day = "&nbsp;";
			}
		}
?>
		</tr>
<?
	}
?>

	</tbody>
</table>


<script language="javascript">

	/*일정등록*/
	function SelectedDay(admin_id,admin_name,SelectedDay) {
		var URL = "subwindows.php?admin_id=" + admin_id + "&admin_name=" + admin_name + "&SelectedDay=" + SelectedDay
		window.open(URL,"subwindows","top=128, left=190, width=500, height=310");
	}
	
	/*일정수정*/
	function SelectDaym(text) {
		var URL = "subwindows_modi.php?idx=" + text
		window.open(URL,"subwindows","top=128, left=190, width=500, height=310");
	}
</script>

	

<? include('../../footer.php');?>
