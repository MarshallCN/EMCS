<?php 
$data_string = ["pwd"=>"960618","email"=>"marshallcnliu@gmail.com","tit"=>"Your Food will be Expired Soon!!!","msg"=>"Your Food: Potato. It will be expired in 13 days, Please consume it soon"];
$data = http_build_query($data_string);
$url = "http://cwms.pe.hu/Ques/mail.php?".$data;
ob_start(); 
readfile($url);	
$res = ob_get_contents();
ob_end_clean();

?>
<SCRIPT>
	/* function sendmail (pwd,email,tit,msg){
		$.ajax({
			url:'http://cwms.pe.hu/Ques/mail.php',
			data:{"pwd":pwd,"email":email,"tit":tit,"msg":msg},
			success:function(data){
				console.log(data)
			},
			type:'POST'
		});
	} */
	//sendmail("960618","marshallcnliu@gmail.com","Your Food will be Expired Soon","Your Food: Potato\\nIt will be expired in 3 days, Please consume it soon")
	
</SCRIPT>