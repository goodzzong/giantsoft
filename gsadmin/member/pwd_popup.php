<?
session_start();
include $_SERVER['DOCUMENT_ROOT']."/common.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<?
if( !$_SESSION[ADMIN_USERID] || !$_SESSION[ADMIN_PASSWD]) { $tools->alertJavaGo('경고! 잘못된 접근입니다\n\n로그인 하세요', '/gsadmin/');}
?>
<title>패스워드 초기화</title>
</head>
<body>
<?
	$md5_passwd = substr(md5(rand()),0,8);
	$passwd = md5($md5_passwd);
?>

	<table width="100%">
		<tr>
			<td align="center">
				 <p style="font-size:15px; font-weight:bold;">
					초기화된 비밀번호 : <span style="color:Red;"><?echo $md5_passwd?></span>
				</p>					
			</td>
		</tr>
	</table>
         
<?
	$querym = "update  cs_member set passwd='$passwd' where idx=$idx"; 
	mysql_query($querym);
?>		   
</body>
</html>