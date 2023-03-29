<?
require_once "../_conf/_common.php";
require_once "./head.php";
?>

<!--우측섹션-->
<div id="right">
	<!--본문내용섹션-->
	<div class="product_state">
	<div id="content">
	<textarea id="publicKey" cols="66" rows="7" style="display:none;">-----BEGIN PUBLIC KEY-----
	MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDpFrdz4NJSmGDVWDjVvIHHTrCn
	VXEMXv4XhOQK1DuqwNEJ5X2jD1Ma/maF6BJePK9T4lA99cCAyWZ6ySSUoBVkrEL1
	5F2GfzJ9BF31y6HByKYiRc8KUxkMNHesR+00ZvGZsHxfHSYvfRztBffd+IRyy1ep
	wd+TfN++aIZJivncuQIDAQAB
	-----END PUBLIC KEY-----</textarea>
	</div>
	</div>
	<!--본문내용섹션 끝-->
</div>
<!--우측문섹션 끝-->

<script type="text/javascript">
$(document).ready(function(){

	history.pushState(null, null, "");
 
	window.onpopstate = function(event) {
		history.go(1);
	};

	// 객체 생성
	var crypt = new JSEncrypt();

	var key = $("#publicKey").val();
	// 키 설정
	crypt.setKey(key);

	var pwFlag = false;

	swal({
		title: "<div class='alpop_top'><div class='alpop_title'>관리자설정</div>\n\
				<div id='btn_emer_del' class='alpop_btn'>취소</div></div>\n\
				<div class='alpop_mes'><span style='color:#f30'>비밀번호 확인</div>",
		text: "로그인시 사용한 비밀번호를 입력해 주세요",
		type: 'input',
		inputType: 'password',
		showCancelButton: false,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "확인",
		cancelButtonText: "취소",
		closeOnConfirm: false,
		html: true,
		inputPlaceholder: "비밀번호 입력",
	}, function(inputValue){
		// console.log(inputValue);
		if(inputValue){
			// 암호화
			var l_pw = CryptoJS.CRT(inputValue).toString();
			l_pw = crypt.encrypt(l_pw);
			data = {
				"mode" : "recheck_pass",
				"l_pw" : l_pw
			}
			$.ajax({
				type: "POST",
				url: "../_info/json/_tms_json.php",
				data: data,
				cache: false,
				dataType: "json",
				success : function(data){
					if(data.result == 0){
						swal({
							title: "체크",
							text: "비밀번호가 확인됐습니다.", 
							type: "success",
							timer: 1000,
							showConfirmButton: false,
							allowOutsideClick: false
						}, function(){
							swal.close();
							
							let f = document.createElement('form');
							f.setAttribute('method', 'post');
							f.setAttribute('action', 'set_user.php');
							document.body.appendChild(f);
							f.submit();

						}); 
					}else if(data.result == 1){
						swal({
							title: "체크",
							text: "아이디와 비밀번호를 다시 확인해 주세요.",
							type: "warning",
							confirmButtonText: "확인"
						}, function() {
							location.reload();
						});
					}else if(data.result == 3){
						swal({
							title: "체크",
							text: "로그인 시도 횟수 초과입니다. 5분 후에 다시 시도해 주세요.",
							type: "warning",
							confirmButtonText: "확인"
						}, function() {
							parent.location.reload();
						});
					}else if(data.result == 4){
						swal({
							title: "체크",
							text: data.msg,
							type: "warning",
							confirmButtonText: "확인"
						}, function() {
							location.reload();
						});
					}else if(data.result == 5){
						location.reload();
					}else{
						swal({
							title: "체크",
							text: "로그인에 실패하였습니다.",
							type: "warning",
							confirmButtonText: "확인"
						}, function() {
							location.reload();
						});
					}
				}
			});
		}else{
			swal({
				title: "체크",
				text: "비밀번호를 입력해 주세요.",
				type: "warning",
				confirmButtonText: "확인"
			}, function() {
				location.reload();
			});
		}
	});
	$('#btn_emer_del').click(function(){
		parent.location.href = "main.php";
	});
	setTimeout(function(){
		if($(".sweet-alert").css('display') == "none"){
			location.reload();
		}
	},1000);
});
</script>

</body>
</html>


