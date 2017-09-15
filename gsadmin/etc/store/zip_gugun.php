<?
include $_SERVER['DOCUMENT_ROOT']."/common.php";

$sido		= $_POST['sido'];
$gugun	= $_POST['gugun'];
	/*넘어온 sido가 있는경우 실행*/
	if(isset($sido)){
?>
			<select name="gugun" id="gugun" class="form-control2">
				<option value="">구/군 선택</option>
			<?
				$query2 ="select * from cs_zip where sido='$sido' order by gugun asc";
				$rs2 = mysql_query($query2);
				while($row2 = mysql_fetch_array($rs2)){
			?>
				<option value="<?=$row2['gugun']?>" <?if($row2['gugun']==$gugun){ echo "selected";}?>><?=$row2['gugun']?></option>
			<?
				}
			?>
			</select>

<?
	}
?>
