var vm =  new Vue({
		el:'#foodinfo',
		data: {
			place: '1=1',
			fooddata:"",
			foodstatus: ["Opened","Unopened"],
			exptype: ["Best Before","Used By"],
			
			
		},
		mounted(){
			this.$nextTick(()=>{
				this.getall();
			})
		},
		methods:{
			getall: function(){
				var that=this;
				var place = this.place;
				$.ajax({
					url:'ajax.php',
					data:{"foods":'all',"place":place},
					success:function(data){
						var foodall = []
						for(x=0;x<data.length;x++){
							foodall.push(JSON.parse(data[x]))
						}
						that.fooddata = foodall
						if(foodall.length==0){
							$('.emptystate').html("No Food in this area")
						}else{
							$('.emptystate').html("")
						}
					},
					type:'POST',
					dataType:'json'
				});
			},
			/* Edit Food */
			editfood: function(id) {
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
						$('#volrate').html(data.vol)
					},
					type:'POST',
					dataType:'json'
				});
			},
			/* Remove Food */
			removefood: function(id) {
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
		}
});