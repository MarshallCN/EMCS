var vmassoc =  new Vue({
	el:'#panel-assoc',
		data: {
			foodassocName:[],
			foodassocData:[],
			mychart:{},
			mainnode: '',
			
		},
		mounted(){
			 this.$nextTick(()=>{
				this.searchHeader();
			})
		},
		methods:{
			searchHeader: function(){
				searchFood = $('#assocfood').val()
				if(searchFood.length>0){
					var that=this;
					$.ajax({
						url:'ajax.php',
						data:{"searchfoodfeader":searchFood},
						success:function(data){
							$('#assocmore').html('')
							if(data.res=='empty'){
							//cannot find a food node	
								$('#emptystate').html("Cannot find relevant Foods");
								$('#assocmore').attr('disabled',true);
								$('#assocfoodChart').hide();
							}else{
								$('#assocfoodChart').show();
								$('#emptystate').html('')
								if(data.multiple){
								//found various foods
									for(var i=0;i<data.details.length;i++){
										$('#assocmore').html($('#assocmore').html()+"<option value="+data.details[i].node+">"+data.details[i].node+"</option>")
									}
									$('#assocmore').attr('disabled',false);
									that.select2()
								}else{
								//only found one foods	
									$('#assocmore').html("<option value="+data.details[0].id+">"+data.details[0].node+"</option>");
									$('#assocmore').attr('disabled',true);
								//call function to find assoc data	
									that.mainnode = data.details[0].node
									that.assoc()
								}
							}
						},
						type:'POST',
						dataType:'json'
					});
				}
			},
			assoc: function(){
				var that=this;
				$.ajax({
					url:'ajax.php',
					data:{"assocnode":that.mainnode},
					success:function(data){
						if(typeof mychart=='undefined'){
							that.foodassocName = data.assoc
							that.foodassocData = data.conf
						}else{
							mychart.data.datasets[0].data = data.conf
							mychart.data.labels = data.assoc
							mychart.options.title.text = that.mainnode+' Collocation'
							mychart.update()
						}
					},
					type:'POST',
					dataType:'json'
				});
				
			},
			select2: function(){
				var that=this;
				that.mainnode = $('#assocmore').val()
				that.assoc()
			}
		}
});
	//Chart js
	function createChart(){
				var assoc = $('#assocfoodChart');
				var myassocChart = new Chart(assoc,{
					type: 'horizontalBar',
					data: {
						labels: vmassoc.foodassocName,
						datasets: [{
							label: "Confidence",
							data: vmassoc.foodassocData,
							backgroundColor: "#FFCE56",
							borderColor: "#FFCE56",
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: vmassoc.mainnode+' Collocation'
						},
						scales: {
							xAxes: [{
								stacked: true, 
								position: "top",
								ticks: {
									beginAtZero:true
								}
							}],
							yAxes: [{
								stacked: true,
								position: "left",
							}]
						}
					}
				});
				return myassocChart;
			}
$(document).ready(function(){mychart=createChart()})
							