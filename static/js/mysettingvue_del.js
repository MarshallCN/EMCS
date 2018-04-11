var vmsetting =  new Vue({
	el:'#panel-preferences',
		data: {
			notiplan:'',
			notitype:['Chrome','Email'],
			notidiable:['fa-circle-o','fa-check-circle-o'],
			cursor: ['not-allowed','pointer'],
			
		},
		mounted(){
			this.$nextTick(()=>{
				this.getall();
			})
		},
		methods:{
			getall: function(){
				var that=this;
				$.ajax({
					url:'ajax.php',
					data:{"notiplan":true},
					success:function(data){
						var notiplan = []
						for(x=0;x<data.length;x++){
							notiplan.push(JSON.parse(data[x]))
						}
						that.notiplan = notiplan
						if(notiplan.length==0){
							$('.emptystate').html("<td><h3 style='margin:50px'>No Notification Plan Exists Yet</h3></td>")
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
			/* Check Notification Plan Table Rules*/
			checknoti: function (ele,id,ischeck){
				$.ajax({
					url:'ajax.php',
					data:{"notiplanid":id,"ischeck":ischeck},
					success:function(data){
						vmsetting.getall();
					},
					beforeSend:function(){
						$(ele).attr('class','fa fa-spinner fa-spin fa-2x')
					},
					type:'POST',
					dataType:'json'
				});
			},
			/* Remove Notification Plan rules */
			rmnoti: function(ele,id){
				if(confirm("Do you want to remove this rule?")){
					$.ajax({
						url:'ajax.php',
						data:{"rmnotiid":id},
						success:function(data){
							vmsetting.getall();
						},
						beforeSend:function(){
							$(ele).attr('class','fa fa-spinner fa-spin fa-2x')
						},
						type:'POST',
						dataType:'json'
					});
				}
			}
		}
});