<?

$que_admin_config="select * from cs_seo where idx='1'";
$rs_admin_config=mysql_query($que_admin_config);
$row_admin_config=mysql_fetch_object($rs_admin_config);



$site_directory = "/kr";
$site_url = $site_host.$site_directory;
$site_head_title = $row_admin_config->title;
$site_title = $row_admin_config->title;
$site_subject = $row_admin_config->title;
$site_author = $row_admin_config->author;
$site_keywords = $row_admin_config->keywords;
$site_description = $row_admin_config->description;
$site_robots = "INDEX,FOLLOW";
$og_type = "website";
$og_title = $site_title;
$og_description	= $site_description;
$og_image = $site_host."/images/logo.png";
$og_url = $site_host.$_SERVER["REQUEST_URI"];
$sns_card = "summary";
$sns_title = $site_title;
$sns_description = $site_description;
$sns_image = $site_host."/images/logo.png";
$sns_domain = $site_host.$_SERVER["REQUEST_URI"];
$google_verification = $row_admin_config->google_meta;
$naver_verification = $row_admin_config->naver_meta;
/*
?>
