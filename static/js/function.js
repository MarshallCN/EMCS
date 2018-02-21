/* Show real password */
	function seepwd(e){
		pwd = $('[name="'+e+'"]');
		pwd.attr('type','text');
		this.onmouseup = function(){
			pwd.attr('type','password');
		};
	}
/* Check password when create new account */
	function checkpwd(){
		var pwd = $('[name="newpwd"]');
		var pwdconf =  $('[name="newpwdconf"]');
		var btnsubmit = $('[name="signup"]');
		if(pwd.val().length<4){
			alert("Your password length is too short! Please type more than 3 word");
			pwd.attr('class','form-control alert-danger');
			pwdconf.attr('class','form-control');
			pwd.val('');
			pwdconf.val('');
			pwd.focus();
			btnsubmit.attr('disabled',true);
		}else{
			if(pwd.val() == pwdconf.val()){
				pwd.attr('class','form-control alert-success');
				pwdconf.attr('class','form-control alert-success');
				btnsubmit.attr('disabled',false);
				checkNewName(); //avoid bypass the disable button :)
			}else{
				pwdconf.attr('class','form-control alert-danger');
				pwdconf.val('');
				btnsubmit.attr('disabled',true);
			}
		}
	}
/* use ajax to Check newusername if exist */
	function checkNewName(){
		$('[name="newusername"]').val($('[name="newusername"]').val().replace(" ",""))
		if($('[name="newusername"]').val().length>0){
			$.ajax({
				url:'ajax.php',
				data:{"usercheck":encodeURI(encodeURI($('[name="newusername"]').val()))},
				success:function(data){
					if(data.used=='used'){
						$('[name="newusername"]').attr('class','form-control alert-danger')
						$('[name="newusername"]').next().attr('class','seepwd alert-danger')
						$('[name="newusername"]').next().children('i').attr('class','fa fa-close')
						$('[name="signup"]').attr('disabled',true)
					}else if(data.used=='ok'){
						$('[name="newusername"]').attr('class','form-control alert-success')
						$('[name="newusername"]').next().attr('class','seepwd alert-success')
						$('[name="newusername"]').next().children('i').attr('class','fa fa-check')
						$('[name="signup"]').attr('disabled',false)
					}else if(data.used=='empty'){
						$('[name="newusername"]').attr('class','form-control')
						$('[name="newusername"]').next().attr('class','seepwd hidden')
						$('[name="signup"]').attr('disabled',true)
					}
				},
				type:'POST',
				dataType:'json',
				beforeSend:function(){
					$('[name="newusername"]').next().attr('class','seepwd btn-warning')
					$('[name="newusername"]').next().children('i').attr('class','fa fa-spinner fa-spin')
				}
			});
		}else{
			$('[name="newusername"]').attr('class','form-control')
			$('[name="newusername"]').next().attr('class','seepwd hidden')
		}
	}
/* Vol Range */
	function volrange(ele,id){
		vol = $(ele).val()
		$('#'+id).html(vol)
	}
/* Date must be later than tomorrow */
	function checkDate(ele){
		reqDate = ele.valueAsDate
		reqDate = reqDate.setDate(reqDate.getDate())
		if(reqDate < new Date().getTime()){
			alert("The Expiration date must be later than today");
			ele.valueAsDate = new Date(new Date().setDate(new Date().getDate()))
		}
	}
/* Remove Food */
	function removefood(id){
		$.ajax({
			url:'ajax.php',
			data:{"delfoodid":id},
			success:function(data){
				setTimeout(function(){$('#food'+id).hide(300,'swing')},200)
			},
			type:'POST',
			dataType:'json',
			beforeSend:function(){
				$('#food'+id).html('<center><i class="fa fa-refresh fa-spin fa-5x"></i></center>')
			}
		});
		
	}
/* Check Shopping List */
	function checkshop(ele){
		ele.className = 'fa fa-check-circle-o fa-3x';
		ele.onclick = function(){
			this.className = 'fa fa-circle-o fa-3x';
			this.onclick = function(){checkshop(this)}
		}
	}
/* upload picture function */
	function fileSelected(page,path) {
		file = $('#img')[0].files[0];
		if (file) {
			if (file.size > 20*1024*1024){
				alert('Warning: Picture must be less than 20 MB!');
				window.location.href='index.php?page='+page;
			}else{
				var ext=file.name.substring(file.name.lastIndexOf('.'),file.name.length).toUpperCase();
				if(ext!='.BMP'&&ext!='.GIF'&&ext!='.JPG'&&ext!='.JPEG'&&ext!='.PNG'){
					alert('Please upload image file!(png,gif,jpg,bmp)');
					window.location.href='index.php?page='+page;
				}else{
					var data = new FormData();
					data.append("img",file)
					data.append("path",path)
					var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function(){
						if(xhr.readyState==4 && xhr.status==200){
							 resp=JSON.parse(xhr.responseText);
							 switch(resp.status){
								case 0:filename = $('#imgname').val(resp.filename);break; 
								case 1:alert('Upload Fail');break;
								case 2:alert('No File');break;
							 }
							 $('#thumbnail').attr('src',window.URL.createObjectURL($('#img')[0].files[0]))
							 $('#thumbnail').show();
						}
					}
					xhr.upload.onprogress = function(evt){
						//console.log(evt)
						var loaded = evt.loaded;
						var tot = evt.total;
						var per = Math.floor(100*loaded/tot);
						$('#upres').show();
						$('#upres label').html(per+'%')
						$('#upres div').css('width',per+'%')
					}
					xhr.open('post','ajax.php');
					xhr.send(data)
				}
			}
		}
	}
	
