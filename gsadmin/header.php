<?
session_cache_limiter("");
session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";

$site_url		= "http://" . $_SERVER['HTTP_HOST'];
//$site_url		= $_SERVER['DOCUMENT_ROOT'];
$admin_stat = $db->object("cs_admin","");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<?if( !$_SESSION['ADMIN_USERID'] || !$_SESSION['ADMIN_PASSWD']) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '/gsadmin/');}?>

    <title><?=$admin_stat->shop_name;?></title>

    <link href="<?=$site_url?>/gsadmin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$site_url?>/gsadmin/css/skin/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/gsadmin/js/assets/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?=$site_url?>/gsadmin/js/assets/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?=$site_url?>/gsadmin/js/bootstrap.min.js"></script>
    <script src="<?=$site_url?>/gsadmin/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=$site_url?>/gsadmin/js/assets/ie10-viewport-bug-workaround.js"></script>

	<!-- ETC JavaScript
	==================================================-->
	<script src="<?=$site_url?>/gsadmin/js/admin.js"></script>
	<script src="<?=$site_url?>/gsadmin/js/holder.js"></script>

	<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>


	 <!-- calendar
	 ==================================================-->
	<link rel="stylesheet" type="text/css" media="screen" href="<?=$site_url?>/gsadmin/calendar/css/bootstrap-datetimepicker.min.css" />
	<script type="text/javascript" src="<?=$site_url?>/gsadmin/calendar/js/moment.js"></script>
	<script type="text/javascript" src="<?=$site_url?>/gsadmin/calendar/js/bootstrap-datetimepicker.js"></script>


  </head>
  <body>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><font color=white><?=$admin_stat->shop_name;?></font></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/" class="navbar-link" target="_blank">사용자 메인</a></li>
            <li><?if($_SESSION['ADMIN_USERID']){?><a href="<?=$site_url?>/gsadmin/ajax_progress.php?logout=1" class="navbar-link">로그아웃</a><?}?></li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
			<!-- 상단메뉴 -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">설정관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/basic/basic_setup.php">관리자 기본정보</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/basic/shop_basic_setup.php">쇼핑몰 기본정보</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/basic/page.php">이용약관 설정</a></li>
					<li><a href="<?=$site_url?>/gsadmin/basic/seo_setup.php">검색엔진 최적화(SEO)</a></li>
                    <!-- <li class="divider"></li>
                    <li class="dropdown-header">Nav header</li> -->
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">게시판관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				<li><a href="<?=$site_url?>/gsadmin/bbs/bbs_admin.php">게시판생성</a></li>
					<?
						$query = "select * from cs_bbs  where 1 order by idx asc";
						$rs = mysql_query($query);
						$i=1;
						while($row = mysql_fetch_array($rs)){
					 ?>
				<li><a href="<?=$site_url?>/gsadmin/bbs/bbs_list.php?code=<?=$row[code];?>"><?=$row[name];?></a></li>
				<?$i++;}?>
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">회원관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/member/member.php">회원리스트 : 전체</a></li>
					<li><a href="<?=$site_url?>/gsadmin/member/member_exit.php">회원 : 탈퇴 및 삭제</a></li>
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">제품관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/product/product_add.php">제품등록</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/product/product_list.php">제품검색 및 수정</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/category/category_list.php">카테고리관리</a></li>
					<!-- <li><a href="<?=$site_url?>/gsadmin/category/category_ranking.php">카테고리 순위설정</a></li> -->

					<li><a href="<?=$site_url?>/gsadmin/product/product_qa.php">상품문의</a></li>
					<li><a href="<?=$site_url?>/gsadmin/product/product_review.php">구매후기</a></li>
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">주문관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=1">결제대기</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=2">결제완료</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=3">상품배송중</a></li>
					<li><a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=4">배송완료</a></li>
					<li><a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=5">주문취소</a></li>
					<li><a href="<?=$site_url?>/gsadmin/order/trade.php">전체보기</a></li>
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">신청서관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/online/online_list.php">온라인 신청서</a></li>
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">배너관리 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/banner/banner.php">홈/제품 배너 관리</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/banner/popup.php">팝업배너 관리</a></li>
               </ul>
			</li>


			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">접속통계 <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                    <li><a href="<?=$site_url?>/gsadmin/stat/crm0.php">인기상품</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/stat/crm1.php">상품별매출</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/stat/crm2.php">기간별매출</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/stat/crm3.php">베스트 고객</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/stat/crm4.php">지역별통계</a></li>
                    <li><a href="<?=$site_url?>/gsadmin/stat/crm5.php">접속로그</a></li>
               </ul>
			</li>

			 <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ETC <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="<?=$site_url?>/gsadmin/etc/email/mailform.php">메일설정</a></li>
               </ul>
			 </li>


			 <!-- //상단메뉴 -->
          </ul>

        </div>
      </div>
    </nav>


	<div class="col-sm-3 col-md-2 sidebar">
		<div class="row">
            <div class="panel panel-default">

				<?if( $mod == "" ){?>
				<div class="panel-heading"><h3 class="panel-title">관리자</h3></div>
				<?}?>


				<?if( $mod == "basic" ){?>
				<div class="panel-heading"><h3 class="panel-title">설정관리</h3></div>
					<a href="<?=$site_url?>/gsadmin/basic/basic_setup.php" class="list-group-item <?if($menu=="basic_setup"){?>active<?}?>">관리자 기본정보</a>
					<a href="<?=$site_url?>/gsadmin/basic/shop_basic_setup.php" class="list-group-item <?if($menu=="shop_basic_setup"){?>active<?}?>">쇼핑몰 기본정보</a>
					<a href="<?=$site_url?>/gsadmin/basic/page.php" class="list-group-item <?if($menu=="page"){?>active<?}?>">이용약관 설정</a>
					<a href="<?=$site_url?>/gsadmin/basic/seo_setup.php" class="list-group-item <?if($menu=="seo_setup"){?>active<?}?>">검색엔진 최적화(SEO)</a>
				<?}?>


				<?if( $mod == "bbs" ){?>
				<div class="panel-heading"><h3 class="panel-title">게시판관리</h3></div>
				<?
				$query = "select * from cs_bbs order by idx asc";
				$rs = mysql_query($query);
				$i=1;
				while($row = mysql_fetch_array($rs)){
				?>
					<a href="<?=$site_url?>/gsadmin/bbs/bbs_list.php?code=<?=$row[code]?>" class="list-group-item <?if($row[code]==$code){?>active<?}?>"><?=$row[name]?></a>
				<? $i++;} ?>
				<?}?>


				<?if( $mod == "member" ){?>
				<div class="panel-heading"><h3 class="panel-title">회원관리</h3></div>
					<a href="<?=$site_url?>/gsadmin/member/member.php" class="list-group-item <?if($menu=="member"){?>active<?}?>">회원리스트 : 전체</a>
					<a href="<?=$site_url?>/gsadmin/member/member_exit.php" class="list-group-item <?if($menu=="member_exit"){?>active<?}?>">회원 : 탈퇴 및 삭제</a>
				<?}?>


				<?if( $mod == "product" ){?>
				<div class="panel-heading"><h3 class="panel-title">제품관리</h3></div>
					<a href="<?=$site_url?>/gsadmin/product/product_add.php" class="list-group-item <?if($menu=="product_add"){?>active<?}?>">제품등록</a>
					<a href="<?=$site_url?>/gsadmin/product/product_list.php" class="list-group-item <?if($menu=="product_list"){?>active<?}?>">제품검색 및 수정</a>
					<a href="<?=$site_url?>/gsadmin/category/category_list.php" class="list-group-item <?if($menu=="category_list"){?>active<?}?>">카테고리관리</a>
					<!-- <a href="<?=$site_url?>/gsadmin/category/category_ranking.php" class="list-group-item <?if($menu=="category_ranking"){?>active<?}?>">카테고리 순위설정</a> -->

					<a href="<?=$site_url?>/gsadmin/product/product_qa.php" class="list-group-item <?if($menu=="product_qa"){?>active<?}?>">상품문의</a>
					<a href="<?=$site_url?>/gsadmin/product/product_review.php" class="list-group-item <?if($menu=="product_review"){?>active<?}?>">구매후기</a>
				<?}?>


				<?if( $mod == "order" ){?>
				<div class="panel-heading"><h3 class="panel-title">주문관리</h3></div>
					<a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=1" class="list-group-item <?if($trade_stat==1){?>active<?}?>">결제대기</a>
					<a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=2" class="list-group-item <?if($trade_stat==2){?>active<?}?>">결제완료</a>
					<a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=3" class="list-group-item <?if($trade_stat==3){?>active<?}?>">상품배송중</a>
					<a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=4" class="list-group-item <?if($trade_stat==4){?>active<?}?>">배송완료</a>
					<a href="<?=$site_url?>/gsadmin/order/trade.php?trade_stat=5" class="list-group-item <?if($trade_stat==5){?>active<?}?>">주문취소</a>
					<a href="<?=$site_url?>/gsadmin/order/trade.php" class="list-group-item <?if(empty($trade_stat)){?>active<?}?>">전체보기</a>
				<?}?>


					 <?if( $mod == "online" ){?>
						<div class="panel-heading"><h3 class="panel-title">신청서관리</h3></div>
							<a href="<?=$site_url?>/gsadmin/online/online_list.php" class="list-group-item <?if($menu=="online_list"){?>active<?}?>">온라인 신청서</a>
					  <?}?>


				<?if( $mod == "banner" ){?>
				<div class="panel-heading"><h3 class="panel-title">배너관리</h3></div>
					<a href="<?=$site_url?>/gsadmin/banner/banner.php" class="list-group-item <?if($menu=="banner"){?>active<?}?>">홈/제품 배너 관리</a>
					<a href="<?=$site_url?>/gsadmin/banner/popup.php" class="list-group-item <?if($menu=="popup"){?>active<?}?>">팝업배너 관리</a>
				<?}?>


				<?if( $mod == "stat" ){?>
				<div class="panel-heading"><h3 class="panel-title">통계관리</h3></div>
					<a href="<?=$site_url?>/gsadmin/stat/crm0.php" class="list-group-item <?if($menu=="crm0"){?>active<?}?>">인기상품</a>
					<a href="<?=$site_url?>/gsadmin/stat/crm1.php" class="list-group-item <?if($menu=="crm1"){?>active<?}?>">상품별매출</a>
					<a href="<?=$site_url?>/gsadmin/stat/crm2.php" class="list-group-item <?if($menu=="crm2"){?>active<?}?>">기간별매출</a>
					<a href="<?=$site_url?>/gsadmin/stat/crm3.php" class="list-group-item <?if($menu=="crm3"){?>active<?}?>">베스트 고객</a>
					<a href="<?=$site_url?>/gsadmin/stat/crm4.php" class="list-group-item <?if($menu=="crm4"){?>active<?}?>">지역별통계</a>
					<a href="<?=$site_url?>/gsadmin/stat/crm5.php" class="list-group-item <?if($menu=="crm5"){?>active<?}?>">접속로그</a>
				 <?}?>


		</div><!-- /.panel panel-default -->

    </div><!-- /.row -->
 </div><!-- /.col-sm-3 col-md-2 sidebar -->


	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" ><!-- 테이블 위치 -->