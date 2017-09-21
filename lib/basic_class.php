<?
class dbConnect {
	var $db_host, $db_name, $db_user, $db_pwd, $db_conn;

	function dbConnect ( $db_host, $db_name, $db_user, $db_pwd) {
		$this->db_host		= $db_host;
		$this->db_name		= $db_name;
		$this->db_user		= $db_user;
		$this->db_pwd		= $db_pwd;

		$this->db_conn = @mysql_connect( $this->db_host, $this->db_user, $this->db_pwd) or die("데이타 베이스에 접속이 불가능합니다.");
		@mysql_select_db( $this->db_name, $this->db_conn);


/*
		$this->db_conn  = new mysqli($this->db_host,$this->db_user,$this->db_pwd,$this->db_name);
		if ( mysqli_connect_errno() ) {
		echo mysqli_connect_error();
		exit;
		}
*/
	}

	function result ( $sql ) {
		$sql				= trim( $sql );
		$result			= @mysql_query( $sql, $this->db_conn ) or die($sql);
		return $result;
	}

	function select ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		return $result;
	}

	function object ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		$row			= @mysql_fetch_object($result);
		return $row;
	}

	function row ( $table, $where, $field = "*" ) {
		$sql				= "Select $field from $table $where";
		$result			= $this->result( $sql );
		$row			= @mysql_fetch_row($result);
		return $row;
	}

	function sum ( $table, $where, $field = "*" ) {
		$sql				= "Select sum($field) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function cnt ( $table, $where) {
		$sql				= "Select count(idx) from $table $where";
		$result			= $this->result( $sql );
		$row			=  @mysql_fetch_row($result);
		if( $row[0] ) { return $row[0]; } else { return 0;}
	}

	function insert ( $table, $data ) {
		$sql				= "insert into $table set $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function update ( $table, $data ) {
		$sql				= "update $table set $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function delete ( $table, $data ) {
		$sql				= "delete from $table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function dropTable ( $data ) {
		$sql				= "drop table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function createTable ( $data ) {
		$sql				= "create table $data";
		if($this->result( $sql )) { return true; } else { return false; }
	}

	function stripSlash ( $str ) {
		$str				= trim( $str );
		$str				= stripslashes( $str );
		return $str;
	}

	function myRealEscapeString ( $str ) {
		$str				= trim( $str );
		$str				= mysql_real_escape_string( $str );
		return $str;
	}

	function addSlash ( $str ) {
		$str				= trim( $str );
		$str				= addslashes( $str );
		if(empty( $str )) {
			$str			= "NULL";
		}
		return $str;
	}
}

class tools {

	// 엔코드
	function encode($data) {
		return base64_encode($data)."||";
	}

	// 디코드
	function decode($data){
		$vars=explode("&",base64_decode(str_replace("||","",$data)));
		$vars_num=count($vars);
		for($i=0;$i<$vars_num;$i++) {
			$elements=explode("=",$vars[$i]);
			$var[$elements[0]]=$elements[1];
		}
		return $var;
	}

	// 문자열 자르는 부분
	function strCut($str, $len) {
		if ($len >= mb_strlen($str)) return $str;
		$klen = $len - 1;
		while(ord($str[$klen]) & 0x80) $klen--;
		return mb_substr($str, 0, $len - (($len + $klen + 1) % 2)) ."..";
	}

	function strCut_utf($str, $len, $suffix="…")
	{
		$charset = 'UTF-8'; //이곳에 홈페이지 charset을 넣어주세요
		//혹은 케릭셋이 변수로 선언되어있다면 윗줄은 지워버리고 아랫줄같이 해주세요
		//global $케릭셋변수
		//$charset = $케릭셋변수;
		$s = mb_substr($str, 0, $len);
		$cnt = 0;
		for ($i=0; $i<mb_strlen($s); $i++)
			if (ord($s[$i]) > 127){
				$cnt++;
		}

		if (strtoupper($charset) == 'UTF-8'){
			$s = mb_substr($s, 0, $len - ($cnt % 3));
		}else{
			$s = mb_substr($s, 0, $len - ($cnt % 2));
		}

		if (mb_strlen($s) >= mb_strlen($str))
			$suffix = "";
		return $s . $suffix;
	}

	// HTML 출력
	function strHtml($str) {
		$str = trim($str);
		$str = stripslashes($str);
		return $str;
	}

	// 문자열 HTML BR 형태 출력
	function strHtmlBr($str) {
		$str = trim($str);
		$str = stripslashes($str);
		$str = str_replace("\n","<br>", $str);
		return $str;
	}

	// 문자열 TEXT 형태 출력
	function strHtmlNo($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		$str = str_replace("\n","<br>", $str);
		return $str;
	}

	// 문자열 TEXT 형태 출력
	function strHtmlNoBr($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		return $str;
	}

	// 날자출력 형태
	function strDateCut($str, $chk = 1) {
		if( $chk==1 ) {
			$year	=	mb_substr($str,0,4);
			$mon	=	mb_substr($str,5,2);
			$day	=	mb_substr($str,8,2);
			$str	=	$year."/".$mon."/".$day;
		} else if( $chk==2 ) {
			$year	=	mb_substr($str,0,4);
			$mon	=	mb_substr($str,5,2);
			$day	=	mb_substr($str,8,2);
			$time	=	mb_substr($str,11,2);
			$minu	=	mb_substr($str,14,2);
			$str	=	$year."/".$mon."/".$day." ".$time.":".$minu;
		} else if( $chk==3 ) {
			$year	=	mb_substr($str,0,4);
			$mon	=	mb_substr($str,5,2);
			$day	=	mb_substr($str,8,2);
			$str	=	$year."-".$mon."-".$day;
		} else if( $chk==4 ) {
			$year	=	mb_substr($str,0,4);
			$mon	=	mb_substr($str,5,2);
			$day	=	mb_substr($str,8,2);
			$time	=	mb_substr($str,11,2);
			$minu	=	mb_substr($str,14,2);
			$str	=	$year."-".$mon."-".$day." ".$time.":".$minu;
		} else if( $chk==5 ) {
			$year	=	mb_substr($str,0,4);
			$mon	=	mb_substr($str,5,2);
			$day	=	mb_substr($str,8,2);
			$str	=	$year."년 ".$mon."월 ".$day."일";
		} else if( $chk==6) {
			$year	=	mb_substr($str,0,4);
			$mon	=	mb_substr($str,5,2);
			$day	=	mb_substr($str,8,2);
			$time	=	mb_substr($str,11,2);
			$minu	=	mb_substr($str,14,2);
			$str	=	$year."년 ".$mon."월 ".$day."일 ".$time."시 ".$minu."분";
		}
		return $str;
	}

	// 숫자로 된 값을 요일로 변환한다. (0:월요일, 1:화요일, 6:일요일)
	function strDateWeek($chk) {
		if( $chk==0 ) {
			$str="월요일";
		} else if( $chk==1 ) {
			$str="화요일";
		} else if( $chk==2 ) {
			$str="수요일";
		} else if( $chk==3 ) {
			$str="목요일";
		} else if( $chk==4 ) {
			$str="금요일";
		} else if( $chk==5 ) {
			$str="토요일";
		} else if( $chk==6) {
			$str="일요일";
		}
		return $str;
	}

	# E-MAIL 주소가 정확한 것인지 검사하는 함수
	#
	# eregi - 정규 표현식을 이용한 검사 (대소문자 무시)
	#         http://www.php.net/manual/function.eregi.php
	# gethostbynamel - 호스트 이름으로 ip 를 얻어옴
	#          http://www.php.net/manual/function.gethostbynamel.php
	# checkdnsrr - 인터넷 호스트 네임이나 IP 어드레스에 대응되는 DNS 레코드를 체크함
	#          http://www.php.net/manual/function.checkdnsrr.php
	function chkMail($email,$hchk=0) {
		$url = trim($email);
		if($hchk) {
			$host = explode("@",$url);
			if(eregi("^[\xA1-\xFEa-z0-9_-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) {
				if(checkdnsrr($host[1],"MX") || gethostbynamel($host[1])) return $url;  else return false;
			}
		} else {
			if(eregi("^[\xA1-\xFEa-z0-9_-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9._-]+$", $url)) return $url;  else return false;
		}
	}
	// 주민등록번호진위여부 확인 함수
	function chkJumin($resno1,$resno2) {
		$resno = $resno1.$resno2;
		$len = mb_strlen($resno);
		if ($len <> 13) return false;
		if (!ereg('^[[:digit:]]{6}[1-4][[:digit:]]{6}$', $resno)) return false;
		$birthYear = ('2' >= $resno[6]) ? '19' : '20';
		$birthYear += mb_substr($resno, 0, 2);
		$birthMonth = mb_substr($resno, 2, 2);
		$birthDate = mb_substr($resno, 4, 2);
		if (!checkdate($birthMonth, $birthDate, $birthYear)) return false;
		for ($i = 0; $i < 13; $i++) $buf[$i] = (int) $resno[$i];
		$multipliers = array(2,3,4,5,6,7,8,9,2,3,4,5);
		for ($i = $sum = 0; $i < 12; $i++) $sum += ($buf[$i] *= $multipliers[$i]);
		if ((11 - ($sum % 11)) % 10 != $buf[12]) return false;
		return true;
	}

	// 사업자등록번호 체크 함수
	function chkCompany($reginum) {
		$weight = '137137135';
		$len = mb_strlen($reginum);
		$sum = 0;
		if ($len <> 10) return false;
		for ($i = 0; $i < 9; $i++) $sum = $sum + (mb_substr($reginum,$i,1)*mb_substr($weight,$i,1));
		$sum = $sum + ((mb_substr($reginum,8,1)*5)/10);
		$rst = $sum%10;
		if ($rst == 0) $result = 0;
		else $result = 10 - $rst;
		$saub = mb_substr($reginum,9,1);
		if ($result <> $saub) return false;
		return true;
	}

	# 문자열에 한글이 포함되어 있는지 검사하는 함수
	function chkHan($str) {
		# 특정 문자가 한글의 범위내(0xA1A1 - 0xFEFE)에 있는지 검사
		$strCnt=0;
		while( mb_strlen($str) >= $strCnt) {
			$char = ord($str[$strCnt]);
			if($char >= 0xa1 && $char <= 0xfe) return true;
			$strCnt++;
		}
	}

	// 문자열 체크(숫자)
	function chkDigit($str) {
		if(ereg("^[1-9]+[0-9]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파)
	function chkAlpha($str) {
		if(ereg("^[a-zA-Z]+[a-zA-Z]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파+숫자)
	function chkAlnum($str) {
		if(ereg("^[1-9a-zA-Z]+[0-9a-zA-Z]*$",$str))  return true;
		else return false;
	}

	// 문자열 체크(알파+숫자+특수문자)
	function chkAlnumAll($str) {
		if(ereg("^[1-9a-zA-Z_-]+[0-9a-zA-Z_-]*$",$str))  return true;
		else return false;
	}

	// 메세지 출력
	function msg($msg) {
		echo "<script language='javascript'> alert('$msg'); </script>";
	}

	// 메세지 출력후 BACK
	function errMsg($msg) {
		echo "<script language='javascript'> alert('$msg'); history.back(); </script>";
		exit();
	}

	// 메세지 출력후 이동하는 자바스크립트
	function alertJavaGo($msg,$url) {
		echo "<script language='javascript'> alert('$msg'); location.replace('$url'); </script>";
		exit();
	}

	// 메세지 출력후 이동하는 메타테그
	function alertMetaGo($msg,$url) {
		echo "<script language='javascript'> alert('$msg'); </script>";
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
		exit();
	}

	// 메타태그로 바로 가기
	function metaGo($url) {
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
		exit();
	}

	// 자바스크립트로 바로 가기
	function javaGo($url) {
		echo "<script language='javascript'> location.href='$url'; </script>";
		exit();
	}

	// 창을 닫기
	function winClose() {
		echo "<script language='javascript'> window.close(); </script>";
		exit();
	}

	// 메세지 출력후 창을 닫기
	function msgClose($msg) {
		echo "<script language='javascript'> alert('$msg'); window.close(); </script>";
		exit();
	}


	// 창을 닫고 가는 함수
	function javaGoClose($url) {
		echo "<script language='javascript'> opener.location.replace('$url'); self.close(); </script>";
		exit();
	}

	// 프레임으로 된 경우 상위 프레임으로 가는 함수
	function javaGoTop($url) {
		echo "<script language='javascript'> parent.frames.top.location.replace('$url'); </script>";
		exit();
	}



	function idxChk($part_idx){

		$part_idx=$part_idx;
		$part_idxS="";
		$part1_idx="";
		$part2_idx="";

		$query="select * from cs_part where idx='$part_idx'";
		$rs=mysql_query($query);
		$row=mysql_fetch_array($rs);

		if($row[part_index]==2){
			$query_sub="select * from cs_part where part_display_check='1' and part_index='1' and part1_code='$row[part1_code]'";
			$rs_sub=mysql_query($query_sub);
			$row_sub=mysql_fetch_array($rs_sub);

			$part1_idx=$row_sub[idx];
			$part2_idx=$row[idx];
		}else{

			$part1_idx=$row[idx];
		}

		$part_idxS=$part1_idx.",".$part2_idx;


		return $part_idxS;
	}
}
?>