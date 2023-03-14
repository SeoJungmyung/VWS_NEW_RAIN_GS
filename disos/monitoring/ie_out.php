<meta charset="UTF-8">
<title>지원하지 않는 브라우저입니다.</title>
<head></head>
<body>
	<center>
		<div>
			<img style="width: 800px; height: 800px;" src="../images/ie_out.jpg">
			<img style="position:absolute; top : 560px; left : 430px; cursor:pointer;" 
			src="../images/btn_edge.png"
			onclick="downloadFile(1)"
			/>
			<img style="position:absolute; top : 630px; left : 430px; cursor:pointer;" 
			src="../images/btn_chrome.png"
			onclick="downloadFile(2)"
			/>
		</div>
	</center>
</body>
<script type="text/javascript">
function downloadFile(type) {
  // 파일 다운로드 주소
  var fileUrl;
  if(type == 1){
	fileUrl = "https://www.example.com/file.pdf";
	}else if(type == 2){
	fileUrl = "https://www.example.com/file.pdf";
  }else{
	fileUrl = "";
  }

  // a 태그를 동적으로 생성하여 다운로드 링크 설정
  var link = document.createElement("a");
  link.href = fileUrl;
  link.download = "";
  document.body.appendChild(link);
  
  // 클릭 이벤트 발생시키기
  link.click();
  
  // 다운로드 후 a 태그 제거
  document.body.removeChild(link);
}
</script>