/* Navigation active label */
	function activeclass(ele){
		$('.fplace').children().removeClass('active')
		$(ele).children().addClass('active');
		if((location.href.indexOf("page="))>0){
			page = $(ele).children().html().split(' ')[0]
			p = 'fp-'+page
			location.href="index.php?p="+p;
		}
	}
	function activeclass1(ele){
		$('.fplace').children().removeClass('active')
		$(ele).children().addClass('active');
	}
	function activelabel(page){
		$('.panel-heading').parent().removeClass('active')
		$('#menu_'+page).parent().addClass('active');
	}
	function hideMenu(ele){
		/**$('.nav *').animate({width:'0px',opacity:'0'});$('.nav').animate({width:'0px',opacity:'0'},'fast','swing')**/
		//$('.menuLabel').hide()
		//$('.nav').hide(300,'swing')
		$('.left_wraps').hide();
		$(ele).attr('onclick','showMenu(this)');
		$(ele).attr('class','fa fa-3x fa-arrow-circle-right icona hidden-xs');
		$('.main-contain').attr('class','col-md-10 col-md-offset-1 main-contain')
		
	}
	function showMenu(ele){
		//$('.menuLabel').show()
		$('.left_wraps').show();
		$(ele).attr('onclick','hideMenu(this)');
		$(ele).attr('class','fa fa-3x fa-arrow-circle-left icona hidden-xs');
		$('.main-contain').attr('class','col-sm-8 col-sm-offset-3 main-contain main-contain_left')
	}

/* Show real password */
	function seepwd(e){
		pwd = $('[name="'+e+'"]');
		pwd.attr('type','text');
		this.onmouseup = function(){
			pwd.attr('type','password');
		};
	}
/* only input integer */
function onlynum(ele){
	if($(ele).val() != parseInt($(ele).val())){
		$(ele).val('')
	}
}
/* Check password when create new account */
	function checkpwd(log=1){
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
				btnsubmit.attr('disabled',false);
				pwd.attr('class','form-control alert-success');
				pwdconf.attr('class','form-control alert-success');
				if(log==1){
					checkEmail();
					checkNewName(); //avoid bypass the disable button :)
				}
			}else{
				pwdconf.attr('class','form-control alert-danger');
				pwdconf.val('');
				btnsubmit.attr('disabled',true);
			}
		}
	}
/* use ajax to Check if newusername exist */
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
isemail = false;
/* use ajax to Check if email exist */
	function checkNewEmail(){
		$('[name="newemail"]').val($('[name="newemail"]').val().replace(" ",""))
		if($('[name="newemail"]').val().length>0){
			$.ajax({
				url:'ajax.php',
				data:{"emailcheck":encodeURI($('[name="newemail"]').val())},
				success:function(data){
					if(data.used=='used'){
						$('[name="newemail"]').attr('class','form-control alert-danger')
						$('[name="newemail"]').next().attr('class','seepwd alert-danger')
						$('[name="newemail"]').next().children('i').attr('class','fa fa-close')
						$('[name="signup"]').attr('disabled',true)
						$('#sendemailbtn').attr('disabled',true)
					}else if(data.used=='ok'){
						$('[name="newemail"]').attr('class','form-control alert-success')
						$('[name="newemail"]').next().attr('class','seepwd alert-success')
						$('[name="newemail"]').next().children('i').attr('class','fa fa-check')
						$('[name="signup"]').attr('disabled',false)
						isemail = true
						$('#sendemailbtn').attr('disabled',false)
					}else if(data.used=='empty'){
						$('[name="newemail"]').attr('class','form-control')
						$('[name="newemail"]').next().attr('class','seepwd hidden')
						$('[name="signup"]').attr('disabled',true)
						$('#sendemailbtn').attr('disabled',true)
					}
				},
				type:'POST',
				dataType:'json',
				beforeSend:function(){
					$('[name="newemail"]').next().attr('class','seepwd btn-warning')
					$('[name="newemail"]').next().children('i').attr('class','fa fa-spinner fa-spin')
				}
			});
		}else{
			$('[name="newemail"]').attr('class','form-control')
			$('[name="newemail"]').next().attr('class','seepwd hidden')
		}
	}
/* Send Email */
	function sendemail (email,subject,body,altbody){
		$.ajax({
			url:'https://marshal1.tech/FYP/mailer.php',
			data:{"email":email,"subject":subject,"body":body,"altbody":altbody},
			success:function(data){
				console.log(data)
			},
			type:'POST'
		});
	}
/* Get random 0-9 number */
	function getRandom(){
		return Math.floor(Math.random()*10).toString()
	}
/* Send Verify Email */
	function sendverifyemail(){
		if(isemail){
			var email = $('[name="newemail"]').val()
			code = getRandom()+getRandom()+getRandom()+getRandom()
			subject = "EMCS: Your Verify Code"
			body = "<div style='background:#1E3E57;width:100%;min-height=100px;border-radius:5px;'><h3>Thanks for registering EMCS, Your Verify Code is </h3><h2>"+code+"</h2></div>";
			altbody = "Thanks for registering EMCS, Your Verify Code is: "+code;
			$('#v').val(code)
			sendemail (email,subject,body,altbody)
		}
	}
/* Change Vol Range bar*/
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
/* Change Food exp date unit */
	function changeunit(ele){
		$('#expbtn').html($(ele).html());
		$('[name="expopenunit"]').val($(ele).html());
	}
/* use ajax to submit form which add/edit/ food into storage */
	function submitform(){
		$.ajax({
			url:'ajax.php',
			data: new FormData($('#foodeditform')[0]),
			success:function(data){
				setTimeout(function(){
						$('#modal-editfood').modal('hide')
						vm.getall()
					$('#submitting').html('Submit')
					$('#submitting').removeClass("fa fa-spinner fa-spin fa-3x")
				},200);
			},
			beforeSend:function(){
				$('#submitting').html('')
				$('#submitting').addClass("fa fa-spinner fa-spin fa-3x")
			},
			type:'POST',
			processData: false,
			contentType: false,
			dataType:'json'
		});
	}
/* Check Shopping List */
	function checkshop(ele,id,ischeck){
		$.ajax({
			url:'ajax.php',
			data:{"splistid":id,"ischeck":ischeck},
			success:function(data){
				ele.onclick=function(){checkshop(ele,id,data.newstatus)};
				if(data.newstatus==1){
					$(ele).attr('class','fa fa-check-circle-o fa-3x');
					$(ele).parent().next().children('.btn-info').attr('disabled',false)
				}else if(data.newstatus==0){
					$(ele).attr('class','fa fa-circle-o fa-3x');
					$(ele).parent().next().children('.btn-info').attr('disabled',true)
				};
			},
			beforeSend:function(){
				$(ele).attr('class','fa fa-spinner fa-spin fa-3x')
			},
			type:'POST',
			dataType:'json'
		});
	}
/* Move Item from shopping list */
	function moveitem(id,name){
		$('[name="fname"]').val(name);
		$('[name="spitemid"]').val(id);
	}
/* Edit shopping list item */
	function edititem(id){
		$('#splabel').html('Edit ');
		$.ajax({
			url:'ajax.php',
			data:{"spitemid":id},
			success:function(data){
				$('#add').click()
				$('[name="newname"]').val(data.name)
				$('[name="newnote"]').val(data.note)
				$('[name="editspitemid"]').val(id)
				$('#spsubmit').hide()
				$('#editspbtns').show()
			},
			type:'POST',
			dataType:'json'
		});
	}
/* Remove shoppling list item */
	function rmitem(id){
		if(confirm("Do you want to remove this item?")){
			$.ajax({
				url:'ajax.php',
				data:{"rmitemid":id},
				success:function(data){
					if(data.suc==1){
						$('#sptr'+id).hide();
					}
				},
				beforeSend:function(){
					$('#sptr'+id).html("<td><i class='fa fa-spinner fa-spin fa-3x'></i></td>")
				},
				type:'POST',
				dataType:'json'
			});
		}
	}
/* upload picture function */
	function fileSelected(page,path,uid) {
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
					data.append("uid",uid)
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
/* Switch button */
	function dragbtncolor(ele){
		ele.style.background=ele.value>50?'#337ab7':'#ccc';
	}
	function dragbtn(ele){
		ele.value=ele.value>50?100:0;
		type = ele.name
		if(type=='msgchrome'){
			var status
			if(ele.value>50){
				subscribe()
			}else{
				unsubscribe()
				$.ajax({
					url:'ajax.php',
					data:{"ispush":'del'},
					success:function(data){
						console.log(data)
					},
					type:'POST',
					dataType:'json'
				});
			}
			
		}
			$.ajax({
				url:'ajax.php',
				data:{"switchbtn":ele.value,"type":type},
				success:function(data){
					if(data.res!=1){console.log('error')}
					vmsetting.getall();
				},
				type:'POST',
				dataType:'json'
			});
	}
	function switchbtn(ele,val){
		ele.value = val
		dragbtncolor(ele)		
	}

