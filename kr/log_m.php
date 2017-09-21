<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<style type="text/css">
/* 모바일 레이어팝업 */
.mobile-fixed-pop-wrapper{overflow-y:auto; position:fixed; top:0px; left:0px; width:100%; height:100%; z-index:999999; opacity:1.0;filter:Alpha(opacity=100);}
.mobile-fixed-pop-inner{position:absolute; display:table; width:100%; height:100%; text-align:center; background:rgba(0,0,0,0.75); }
.mobile-fixed-pop-inner-box{ position:relative; display:table-cell; vertical-align:middle; top:0px;}
.mobile-fixed-img-con{display:inline-block; min-width:250px; max-width:92%; margin:4% auto; }
.mobile-fixed-img-con img{max-width:100%; max-height:100%;}
.mobile-popup-btn-controls{overflow:hidden; text-align:center; background-color:#f2f2f2; border-top:1px solid #f2f2f2;}
.mobile-popup-btn-controls button{float:left; border:0; padding:0; margin:0px; background:none; width:50%; height:50px; background-color:#fff; font-size:14px; color:#333; cursor:pointer;}
.mobile-popup-btn-controls .today-close-btn{background-color:#eee;}
</style>
<?
//////////////////////////////////////////////////////////////// 메인 접속정보및 팝업 소스 S /////////////////////////////////////////////////////////////////////////////
// 접속정보 입력
$db->insert("cs_connect", "ip='$_SERVER[REMOTE_ADDR]', url='$_SERVER[HTTP_REFERER]', register=now()");

//=======       POPUP 창 설정 ==========================================================
$popup_result = $db->select("cs_popup", "where kind=2");
$now_time=time();
$left = 80;
while($popup_row=@mysql_fetch_object($popup_result)) {
?>
<? if($popup_row->kind==0){ ?>
<?
	if( $_COOKIE['POPUP_COOKIE_'.$popup_row->idx] != 'NO' ) {
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
	if( $_COOKIE['POPUP_COOKIE_'.$popup_row->idx] != 'NO' ) {
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

function closeWin<?=$popup_row->idx?>(kinds) {

	//var popup_id="#chkbox"+popup_idx;
	//if( document.notice_form<?=$popup_row->idx?>.chkbox.checked ){
	//if( $('input:checkbox[id="'+popup_id+'"]').is(":checked") == true ){

	if( kinds=="cookieclose"){

		<? if($popup_stat->live==0) {?>
			setcookie<?=$popup_row->idx?>( "maindiv<?=$popup_row->idx?>", "done" , 1 );
		<?} else if($popup_stat->live==1) {?>
			setcookie<?=$popup_row->idx?>( "maindiv<?=$popup_row->idx?>", "done" , 365 );
		<?}?>

	}

	document.all['mobilePopupCon<?=$popup_row->idx?>'].style.display = "none";
}

</script>

 <!--레이어팝업 끝-->

<script>
$(document).ready(function() {
  $("#mobilePopupCon<?=$popup_row->idx?>").draggable();
});

function mobilePopClose () {
	$("#mobilePopupCon").fadeOut();
}
</script>

  <!-- ******************  모바일 전용 레이어팝업 ********************** -->
<section id="mobilePopupCon<?=$popup_row->idx?>" style="display:block;">
	<article class="mobile-fixed-pop-wrapper">
		<div class="mobile-fixed-pop-inner">
			<div class="mobile-fixed-pop-inner-box">
				<div class="mobile-fixed-img-con">

					<? if($popup_row->display==0) {?>
						<?=$tools->strHtml($popup_row->content);?>
					<?} else if($popup_row->display==1) {?>
						<? if($popup_row->link_url) {?>
							<span class="mobile-popup-img">
								<a href="http://<?=$popup_row->link_url;?>">
									<img src="/data/designImages/<?=$popup_row->popup_images;?>" alt="팝업이미지" />
								</a>
							</span><!-- 권장사이즈 640 x 680 비율 -->
						<?} else {?>
							<span class="mobile-popup-img">
								<img src='/data/designImages/<?=$popup_row->popup_images;?>' alt="팝업이미지" />
							</span>
						<?}?>
					<?}?>

					<div class="mobile-popup-btn-controls">
						<button class="today-close-btn" id="chkbox<?=$popup_row->idx?>" onclick="javascript:closeWin<?=$popup_row->idx?>('cookieclose');">
							<? if($popup_row->live==0) {?>
							오늘 하루 이창을 열지 않음
							<?} else if($popup_row->live==1) {?>
							이창은 다시는 띄우지 않음
							<?}?>
						</button>
						<button class="mobile-full-popup-close-btn" onclick="javascript:closeWin<?=$popup_row->idx?>('close');">닫기</button>
					</div>


				</div>
			</div>
		</div>
	</article>
</section>



<!-- ******************  // 모바일 전용 레이어팝업 ********************** -->


<script language="Javascript">
cookiedata = document.cookie;
if ( cookiedata.indexOf("maindiv<?=$popup_row->idx?>=done") < 0 ){
    document.all['mobilePopupCon<?=$popup_row->idx?>'].style.visibility = "visible";
    }
    else {
        document.all['mobilePopupCon<?=$popup_row->idx?>'].style.visibility = "hidden";
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