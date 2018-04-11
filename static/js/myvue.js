var vm =  new Vue({
		el:'#foodinfo',
		data: {
			place: '1=1',
			fooddata:"",
			foodstatus: ["Opened","Unopened"],
			exptype: ["Best Before","Used By"],
			threshold: '',
			reptimes: '',
			cid:'all'
			
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
					data:{"threshold":true},
					success:function(data){
						that.threshold = data.threshold
						that.reptimes = data.reptimes
					},
					type:'POST',
					dataType:'json'
				});
				$.ajax({
					url:'ajax.php',
					data:{"foods":'all',"place":place},
					success:function(data){
						var foodall = []
						var warnfood = 0;
						for(x=0;x<data.length;x++){
							jsondata = JSON.parse(data[x])
							if(jsondata.days < that.threshold){
								warnfood ++;
							}
							foodall.push(jsondata)
						}
						$('#panel-element-storage div span').html('')
						if(warnfood>0&&warnfood<10){
							$('#'+that.cid+' div span').html("<span class='icon_notification' style='width: 20px'><span class='icon_num' style='margin-left: -4.5px;'>"+warnfood+"</span></span>");
							$('#foodnotidot').show()
						}else if(warnfood>10){
							$('#'+that.cid+' div span').html("<span class='icon_notification' style='width: 28px'><span class='icon_num' style='margin-left: -8px;'>"+warnfood+"</span></span>");
							$('#foodnotidot').show()
						}else{
							if(that.place=='1=1'){
								$('#foodnotidot').hide()
							}
						}
						that.fooddata = foodall
						if(foodall.length==0){
							$('.emptystate').html("<td><h3 style='margin:50px'>No Food in this area</h3></td>")
							$('.emptystate').show()
						}else{
							$('.emptystate').html("")
							$('.emptystate').hide()
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
							setTimeout(function(){$('#food'+id).hide(300,'swing')},100)
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