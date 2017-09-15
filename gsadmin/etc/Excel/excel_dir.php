<?
include("../../header.php");
include($ROOT_DIR."/lib/page_class.php");
?>
<?
if(strcmp($simage,"")) {

	$savedir7 = $_SERVER['DOCUMENT_ROOT']."/data/csv";
        
	   $full_filename7 = explode(".", "$simage_name");
	   $extension7 = $full_filename7[sizeof($full_filename7)-1];	   
	
	   if(!strcmp($extension7,"html") || 
	      !strcmp($extension7,"htm") ||
	      !strcmp($extension7,"php") ||
	      !strcmp($extension7,"php3") ||
	      !strcmp($extension7,"pl") ||
	      !strcmp($extension7,"cgi") ||
	      !strcmp($extension7,"txt") ||
	      !strcmp($extension7,"asp") ||
	      !strcmp($extension7,"") ||
	      !strcmp($extension7,"phtml")) 
	   { 
	      error("NOACCESS_EXTENSION");
	      exit;
	   }

	   $j = "1";
	   $i = date("YmdHis");
	   $simage_name=$j."$i.".$extension7;

	   if(!copy($simage,"$savedir7/$simage_name")) {
	      error("UPLOAD_FAILURE");
	      exit;
	   }

	   if(!unlink($simage)) {
	      error("DELETE_FAILURE");
	      exit;
	   }

	
}
?>

<script language=javascript>
location.href="excel_exe.php?simage_name=<?=$simage_name?>";
</script>