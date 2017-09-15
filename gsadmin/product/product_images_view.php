<?
$mod	= "product";	
$menu	= "product_list";
include $_SERVER['DOCUMENT_ROOT']."/common.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
$mv_data	= $_GET[goods_data];
$goods_data	= $tools->decode( $_GET[goods_data] );
$row=$db->object("cs_goods", "where idx=$goods_data[idx]", "name, images1, images2, add_images1, add_images2, add_images3, add_images4, add_images5");
if( $_GET[images_check] == 'G1' ) {
	$images_view = "<img src='../../data/goodsImages/$row->images1' border='0'>";
} else if( $_GET[images_check] == 'G2' ) {
	$images_view = "<img src='../../data/goodsImages/$row->images2' border='0'>";
} else if( $_GET[images_check] == 'A1' ) {
	$images_view = "<img src='../../data/goodsImages/$row->add_images1' border='0'>";
} else if( $_GET[images_check] == 'A2' ) {
	$images_view = "<img src='../../data/goodsImages/$row->add_images2' border='0'>";
} else if( $_GET[images_check] == 'A3' ) {
	$images_view = "<img src='../../data/goodsImages/$row->add_images3' border='0'>";
} else if( $_GET[images_check] == 'A4' ) {
	$images_view = "<img src='../../data/goodsImages/$row->add_images4' border='0'>";
} else if( $_GET[images_check] == 'A5' ) {
	$images_view = "<img src='../../data/goodsImages/$row->add_images5' border='0'>";
}
?>

<html>
<head>
<title>&nbsp;<?=$row->name;?> 상품 이미지 </title>
</head>

<body bgcolor="FFFFFF" text="000000" leftmargin="0" topmargin="0">

	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" valign="middle"><a href="javascript:window.close();" onfocus="this.blur()"><?=$images_view?></a></td>
		</tr>
	</table>

</body>
</html>
