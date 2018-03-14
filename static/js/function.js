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
					checkNewName(); //avoid bypass the disable button :)
				}
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
		if(confirm("Do you want to remove this food from your storage?")){
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
		
	}
/* Edit Food */
	function editfood(id){
		$.ajax({
			url:'ajax.php',
			data:{"editfoodid":id},
			success:function(data){
				$('[name=fname]').val(data.name)
				$('[name=fcate]').val(data.allfood_id)
				$('[name=exp]').val(data.exp)
				$('[name=exptype]').val(data.exp_type)
				$('[name=expopen]').val(data.openday)
				$('[name=status]').val(data.open_date===null?0:1)
				$('[name=place]').val(data.place)
				$('[name=imgname]').val(data.picpath)
				$('#thumbnail').attr('src',"static/img/foodupload/"+data.picpath)
				$('#thumbnail').show();
				$('[name=vol]').val(data.vol)
				$('[name=editfoodid]').val(data.id)
			},
			type:'POST',
			dataType:'json'
		});
	}
/* Change Food exp date unit */
	function changeunit(ele){
		$('#expbtn').html($(ele).html());
		$('[name="expopenunit"]').val($(ele).html());
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
	
