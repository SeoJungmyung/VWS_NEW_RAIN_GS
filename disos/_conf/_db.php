<?
define('DB_HOST',		"192.168.1.7");
define('DB_USER',		"root");  
define('DB_PASSWORD',	"123456");
define('DB_DATABASE',	"vws"); 

define("DIFF", ""); // 해당 수치만큼 뺀 기준으로 데이터 표출
// define("DIFF", "-1 hour");
define("TEST", "0"); // 테스트(open : 0, test : 1)
define("TEST_y", "2019");
define("TEST_m", "05");
define("TEST_d", "31");
define("TEST_h", "23");
define("DISP_GROUP", "0"); // 0 : rtu_info에 변위센서 전부 등록, 1 : rtu_info에는 대표 하나만 등록 후 displacement_group에 자식 센서 등록

// 시간 정보
if(TEST == "0"){
	define('O_NOW_START',	"CAST('".strftime("%Y-%m-%d %H",strtotime('now')).':00:00'."' AS DATETIME)");				//현재시간 시작
	define('O_NOW_END',		"CAST('".strftime("%Y-%m-%d %H",strtotime('now')).':59:59'."' AS DATETIME)");				//현재시간 끝
	define('O_BEF_START',	"CAST('".strftime("%Y-%m-%d %H",strtotime('-1 hour')).':00:00'."' AS DATETIME)");			//전시간 시작
	define('O_BEF_END',		"CAST('".strftime("%Y-%m-%d %H",strtotime('-1 hour')).':59:59'."' AS DATETIME)");			//전시간 끝
	define('R_NOW_START',	"CAST('".strftime("%Y-%m-%d %H",strtotime('now '.DIFF)).':00:00'."' AS DATETIME)");			//현재시간 시작
	define('R_NOW_END',		"CAST('".strftime("%Y-%m-%d %H",strtotime('now '.DIFF)).':59:59'."' AS DATETIME)");			//현재시간 끝
	define('R_BBBEF_START',	"CAST('".strftime("%Y-%m-%d %H",strtotime('-3 hour '.DIFF)).':00:00'."' AS DATETIME)");		//전전전시간 시작
	define('R_BBBEF_END',	"CAST('".strftime("%Y-%m-%d %H",strtotime('-3 hour '.DIFF)).':59:59'."' AS DATETIME)");		//전전전시간 끝
	define('R_BBEF_START',	"CAST('".strftime("%Y-%m-%d %H",strtotime('-2 hour '.DIFF)).':00:00'."' AS DATETIME)");		//전전시간 시작
	define('R_BBEF_END',	"CAST('".strftime("%Y-%m-%d %H",strtotime('-2 hour '.DIFF)).':59:59'."' AS DATETIME)");		//전전시간 끝
	define('R_BEF_START',	"CAST('".strftime("%Y-%m-%d %H",strtotime('-1 hour '.DIFF)).':00:00'."' AS DATETIME)");		//전시간 시작
	define('R_BEF_END',		"CAST('".strftime("%Y-%m-%d %H",strtotime('-1 hour '.DIFF)).':59:59'."' AS DATETIME)");		//전시간 끝
	define('R_DAY_START',	"CAST('".strftime("%Y-%m-%d",strtotime('now')).' 00:00:00'."' AS DATETIME)");				//금일 시작
	define('R_DAY_END',		"CAST('".strftime("%Y-%m-%d",strtotime('now')).' 23:59:59'."' AS DATETIME)");				//금일 끝
	define('R_BDAY_START',	"CAST('".strftime("%Y-%m-%d",strtotime('-1 day')).' 00:00:00'."' AS DATETIME)");			//전일 시작
	define('R_BDAY_END',	"CAST('".strftime("%Y-%m-%d",strtotime('-1 day')).' 23:59:59'."' AS DATETIME)");			//전일 끝
	define('R_BBDAY_START',	"CAST('".strftime("%Y-%m-%d",strtotime('-2 day')).' 00:00:00'."' AS DATETIME)");			//전전일 시작
	define('R_BBDAY_END',	"CAST('".strftime("%Y-%m-%d",strtotime('-2 day')).' 23:59:59'."' AS DATETIME)");			//전전일 끝
	define('R_MONTH_START',	"CAST('".strftime("%Y-%m",strtotime('now')).'-01 00:00:00'."' AS DATETIME)");				//월간 시작
	define('R_MONTH_END',	"CAST('".strftime("%Y-%m",strtotime('now')).'-31 23:59:59'."' AS DATETIME)");				//월간 끝
	define('R_YEAR_START',	"CAST('".strftime("%Y",strtotime('now')).'-01-01 00:00:00'."' AS DATETIME)");				//연간 시작
	define('R_YEAR_END',	"CAST('".strftime("%Y",strtotime('now')).'-12-31 23:59:59'."' AS DATETIME)");				//연간 끝
}else{
	define('O_NOW_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":00:00"))."' AS DATETIME)");
	define('O_NOW_END',		"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":59:59"))."' AS DATETIME)");
	define('O_BEF_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":00:00 -1 hour"))."' AS DATETIME)");
	define('O_BEF_END',		"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":59:59 -1 hour"))."' AS DATETIME)");
	define('R_NOW_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":00:00"))."' AS DATETIME)");
	define('R_NOW_END',		"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":59:59"))."' AS DATETIME)");
	define('R_BBEF_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":00:00 -2 hour"))."' AS DATETIME)");
	define('R_BBEF_END',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":59:59 -2 hour"))."' AS DATETIME)");
	define('R_BEF_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":00:00 -1 hour"))."' AS DATETIME)");
	define('R_BEF_END',		"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." ".TEST_h.":59:59 -1 hour"))."' AS DATETIME)");
	define('R_DAY_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." 00:00:00"))."' AS DATETIME)");
	define('R_DAY_END',		"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." 23:59:59"))."' AS DATETIME)");
	define('R_BDAY_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." 00:00:00 -1 day"))."' AS DATETIME)");
	define('R_BDAY_END',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." 23:59:59 -1 day"))."' AS DATETIME)");
	define('R_BBDAY_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." 00:00:00 -2 day"))."' AS DATETIME)");
	define('R_BBDAY_END',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-".TEST_d." 23:59:59 -2 day"))."' AS DATETIME)");
	define('R_MONTH_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-01 00:00:00"))."' AS DATETIME)");
	define('R_MONTH_END',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-".TEST_m."-31 23:59:59"))."' AS DATETIME)");
	define('R_YEAR_START',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-01-01 00:00:00"))."' AS DATETIME)");
	define('R_YEAR_END',	"CAST('".date("Y-m-d H:i:s", strtotime(TEST_y."-12-31 23:59:59"))."' AS DATETIME)");
}
?>