<? // 환경 설정
session_start();
require_once ("_lib.php");

define("DB", "0"); // DB 종류(mysql : 0, oracle : 1)
define("HOST", "http://".$_SERVER ['HTTP_HOST']); // URL(http://192.168.1.63:5000)
define("ROOT_USE", "0"); // 루트(미지정 : 0, 지정 : 1)
if(ROOT_USE == "0"){
	define("ROOT", ""); // 루트
	define("ROOT_DIR", str_replace("/", "\\", $_SERVER['DOCUMENT_ROOT'])); // 절대경로 루트(D:\\LMH_TEST\\divas_new)
}else{
	define("ROOT", "/disos_new");
	define('ROOT_DIR', "D:\\APM_Setup\\htdocs\\divas_new");
}
define("IMG_DIR", ROOT."/disos/images/"); // 이미지 경로
define("IMG_DIR2", ROOT."/disos/mobile/images/"); // 이미지 경로

/**
 *  전체 줄 수
 */
define("dtm_cnt", "8");	// 자료관리
define("rpt_cnt", "0");	// 보고서
define("set_cnt", "9");	// 설정

/* 
* 화진 개발자 user_info.user_type
*/
define("DEV", "7");

if(DB == "0"){
	require_once "_db.php";
	require_once ROOT_DIR."/disos/include/DBmanager.php";
	$DB = new DBmanager(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
}else if(DB == "1"){
	require_once "_db_oracle.php";
	require_once ROOT_DIR."/disos/include/OraDBmanager.php";
	$DB = new OraDBmanager(ORA_DSN, ORA_ID, ORA_PW);
}

define("ss_organ_code", '32956');	//지자체 지역코드
define("public_key", '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDpFrdz4NJSmGDVWDjVvIHHTrCn
VXEMXv4XhOQK1DuqwNEJ5X2jD1Ma/maF6BJePK9T4lA99cCAyWZ6ySSUoBVkrEL1
5F2GfzJ9BF31y6HByKYiRc8KUxkMNHesR+00ZvGZsHxfHSYvfRztBffd+IRyy1ep
wd+TfN++aIZJivncuQIDAQAB
-----END PUBLIC KEY-----');	//공개키

require_once ROOT_DIR."/disos/include/class/common.php";

if (is_ie()) {
	// 인터넷 익스플로러에서 실행되는 코드
	echo '<script>window.location.href="'.HOST.'/disos/monitoring/ie_out.php";</script>';
	exit;
}

//공용
$ClassCommon = new ClassCommon($DB);
if(MobileCheck() == "Mobile"){
   //$ClassCommon->setLogout(); //캐시
}
if(MobileCheck() == "Mobile" && $_SESSION['is_login'] != 1){
   $ClassCommon->setLogin();
}
$ClassCommon->getSession();
$ClassCommon->getSetting();

if($_SESSION['is_login'] != 1){
	define("keyUserID", "");
	define("keyOrganID", "");
	define("keyTosRtuID", "");
	define("keyOrganName", "");
	define("keyIsLogin", "");
}else{
	$user_setting = (array) json_decode($ClassCommon->rsa_decrypt($_SESSION['user_setting']));
	define("keyUserID", $user_setting['user_id']);
	define("keyOrganID", $user_setting['organ_id']);
	define("keyTosRtuID", $user_setting['is_rtu_id']);
	define("keyOrganName", $user_setting['organ_name']);
	define("keyIsLogin", $user_setting['is_login']);
}

function round_data($data=0, $num=0.01, $fl=10){
	if($data == "-"){
		return $data;
	}else{
		if($fl == 10){
			$dv = "%.1f";
		}elseif($fl == 100){
			$dv = "%.2f";
		}elseif($fl == 1000){
			$dv = "%.3f";
		}elseif($fl == 10000){
			$dv = "%.4f";
		}
		return sprintf($dv, round(($data*$num)*$fl)/$fl);
	}
}

?>