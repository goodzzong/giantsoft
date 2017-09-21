<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

<?
//////////////////////////////////////////////////////////////// 메인 접속정보및 팝업 소스 S /////////////////////////////////////////////////////////////////////////////
// 접속정보 입력
$db->insert("cs_connect", "ip='$_SERVER[REMOTE_ADDR]', url='$_SERVER[HTTP_REFERER]', register=now()");



//=======       POPUP 창 설정 ==========================================================
$popup_result = $db->select("cs_popup", "where kind < 2");
$now_time=time();
$left = 80;
while($popup_row=@mysql_fetch_object($popup_result)) {
?>
<? if($popup_row->kind==0){ ?>
<?
	if( $HTTP_COOKIE_VARS['POPUP_COOKIE_'.$popup_row->idx] != 'NO' ) {
		if($popup_row->start_day <=$now_time && $popup_row->end_day >= $now_time) {
			$popup_row->height=$popup_row->height+24;
			echo"<script> window.open('/etc/popup.php?idx=$popup_row->idx','$popup_row->idx','scrollbars=no,width=$popup_row->width,height=$popup_row->height,top=$popup_row->tops,left=$popup_row->lefts'); </script>";

			$left = $left + $popup_row->width;

		}
	}
?>

<? } else { ?>



<!-- 레이어POPUP 시작-->
<?
	if( $HTTP_COOKIE_VARS['POPUP_COOKIE_'.$popup_row->idx] != 'NO' ) {
		if($popup_row->start_day <=$now_time && $popup_row->end_day >= $now_time) {
			$popup_row->height=$popup_row->height+24;
?>


<!--레이어팝업-->

<script language="JavaScript">

function setcookie<?=$popup_row->idx?>( name, value, expirehours ) {
var todayDate = new Date();
todayDate.setHours( todayDate.getHours() + expirehours );
document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function closeWin<?=$popup_row->idx?>() {
if ( document.notice_form<?=$popup_row->idx?>.chkbox.checked ){
	<? if($popup_stat->live==0) {?>
		setcookie<?=$popup_row->idx?>( "maindiv<?=$popup_row->idx?>", "done" , 1 );
	<?} else if($popup_stat->live==1) {?>
		setcookie<?=$popup_row->idx?>( "maindiv<?=$popup_row->idx?>", "done" , 365 );
	<?}?>
}

document.all['divpop<?=$popup_row->idx?>'].style.display = "none";

}

</script>

 <!--레이어팝업 끝-->

<script>
$(document).ready(function() {
  $("#divpop<?=$popup_row->idx?>").draggable();
});
</script>


<div id="divpop<?=$popup_row->idx?>" class="ui-widget-content" style="width:<?=$popup_row->width?>px; height:<?=$popup_row->height?>px; position:absolute; left:<?=$popup_row->lefts?>px; top:<?=$popup_row->tops?>px; z-index:1000; visibility:hidden;">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="black">
<tr>
	<td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="white">
	  <tr>
		<td width="100%" height="100%" valign="top"><? if($popup_row->display==0) {?><?=$tools->strHtml($popup_row->content);?><?} else if($popup_row->display==1) {?><? if($popup_row->link_url) {?><a href="http://<?=$popup_row->link_url;?>"><img src='../data/designImages/<?=$popup_row->popup_images;?>' border='0'></a><?} else {?><img src='/data/designImages/<?=$popup_row->popup_images;?>' border='0'><?}?><?}?></td>
	  </tr>
	  <tr>
		<td height="2" bgcolor="D6D7D6"></td>
	  </tr>
	<form name="notice_form<?=$popup_row->idx?>">
	  <tr>
		<td height="20" align="right" bgcolor="D6D7D6" class="menu" valign="bottom"><input type=checkbox name="chkbox" onclick="closeWin<?=$popup_row->idx?>();"><? if($popup_row->live==0) {?>
	오늘 하루 열지 않음<?} else if($popup_row->live==1) {?>이창은 다시는 띄우지 않음<?}?>&nbsp;&nbsp;<a href="javascript:closeWin<?=$popup_row->idx?>();"><img src="/images/bt_pop_close.gif" width="60" height="19" align="absbottom" border="0"></a>&nbsp;</td>
	  </tr>
	  <tr>
		<td height="2" bgcolor="D6D7D6"></td>
	  </tr>
	  </form>
	</table>
	</td>
</tr>
</table>
</div>

<script language="Javascript">
cookiedata = document.cookie;
if ( cookiedata.indexOf("maindiv<?=$popup_row->idx?>=done") < 0 ){
    document.all['divpop<?=$popup_row->idx?>'].style.visibility = "visible";
    }
    else {
        document.all['divpop<?=$popup_row->idx?>'].style.visibility = "hidden";
}
</script>

<?
	$left = $left + $popup_row->width;

		}
	}
//=====================================================================================
?>

<!-- 레이어POPUP 끝-->

<? } ?>

<?
}
//////////////////////////////////////////////////////////////// 메인 접속정보및 팝업 소스 E /////////////////////////////////////////////////////////////////////////////
?>