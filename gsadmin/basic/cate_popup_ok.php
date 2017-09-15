<?
include('../header.php');

if($mode=="write"){

	$query = "insert into cs_cate set table_name='$table_name', code='$code', name='$name'";
	mysql_query($query);


	$tools->alertJavaGo("입력 하였습니다.","cate_popup.php?table_name=".$table_name."&code=".$code);
}

if($mode=="edit"){

	$query = "update cs_cate set name='$name' where idx='$idx'";
	mysql_query($query);

	$tools->alertJavaGo("수정 하였습니다.","cate_popup.php?table_name=".$table_name."&code=".$code);
}

include('../footer.php');
?>