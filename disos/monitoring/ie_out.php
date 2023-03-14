<meta charset="UTF-8">
<title>지원하지 않는 브라우저입니다.</title>
<head></head>
<body>
	<center>
	<div style="position:relative; width: 800px; height: 800px;">
		<img style="
      position:absolute; 
      top:130; 
      left:100; 
      z-index:1; 
      width: 600px; 
      height: 600px;" 
		src="../images/ie_out.jpg">
		<img style="
      position:absolute; 
      top:520; 
      left:250; 
      z-index:2; 
      cursor:pointer;" 
		src="../images/btn_edge.png" onclick="downloadFile(1)">
		<img style="
      position:absolute; 
      top:590; 
      left:250;
      z-index:2; 
      cursor:pointer;" 
		src="../images/btn_chrome.png" onclick="downloadFile(2)">
		<img style="
      position:absolute; 
      top:660; 
      left:150;
      z-index:3; 
      cursor:pointer;" 
		src="../images/btn_edge_dwn.png" onclick="downloadFile(3)">
		<img style="
      position:absolute; 
      top:660; 
      left:410;
      z-index:4; 
      cursor:pointer;" 
		src="../images/btn_chrome_dwn.png" onclick="downloadFile(4)">
  	</div>
	</center>
</body>
<script type="text/javascript">
function downloadFile(type) {
  // 파일 다운로드 주소
  var fileUrl;
  if(type == 1){ //엣지 브라우저 설치페이지 바로가기
	fileUrl = "https://www.microsoft.com/ko-kr/edge/download?form=MA13FJ";
	}else if(type == 2){ //크롬 브라우저 설치페이지 바로가기
	fileUrl = "https://www.google.co.kr/chrome/";
  }else if(type == 3){ //엣지 브라우저 설치 다운로드 
	fileUrl = "../MicrosoftEdgeSetup.zip";
  }else if(type == 4){ //크롬 브라우저 설치 다운로드
	fileUrl = "../ChromeSetup.zip";
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