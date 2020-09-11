var vmassoc =  new Vue({
	el:'#panel-assoc',
		data: {
			foodassocName:[],
			foodassocData:[],
			foodliftData:[],
			foodconvData:[],
			foodlevData:[],
			mainnode: '',
			
		},
		mounted(){
			 this.$nextTick(()=>{
				this.searchHeader();
			})
		},
		methods:{
			searchHeader: function(){ //only header food can generate associaiton chart, this function search user's food in header table
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
			changeMeasure: function(){
				var val = $('#measure').val().split(',')
				var label = val[0]
				var attr = "food"+val[1]+"Data"
				mychart.data.datasets[1].label = label;
				mychart.data.datasets[1].data = this[attr];
				mychart.update()
			},
			assoc: function(){
				var that=this;
				$.ajax({
					url:'ajax.php',
					data:{"assocnode":that.mainnode},
					success:function(data){
							that.foodassocName = data.assoc
							that.foodassocData = data.conf
							that.foodsupData = data.sup
							that.foodliftData = data.lift
							that.foodconvData = data.conv
							that.foodlevData = data.lev
						if(typeof mychart!='undefined'){
							mychart.data.datasets[0].label = "Confidence"
							mychart.data.datasets[0].data = data.conf
							that.changeMeasure()
							//mychart.data.datasets[1].label = "Conviction"
							//mychart.data.datasets[1].data = data.conv
							mychart.data.labels = data.assoc
							mychart.options.title.text = 'If '+that.mainnode+', then...'
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
							backgroundColor: "#FFCE56",
							borderColor: "#FFCE56",
						},
						{
							backgroundColor: "#39719c",
							borderColor: "#39719c",
						}]
					},
					options: {
						responsive: true,
						title: {
							display: true,
							text: 'If '+vmassoc.mainnode+' Then ...'
						},
						scales: {
							xAxes: [{
								stacked: false, 
								position: "top",
								ticks: {
									beginAtZero:true
								}
							}],
							yAxes: [{
								stacked: false,
								position: "left",
							}]
						}
					}
				});
				return myassocChart;
			}
$(document).ready(function(){mychart=createChart()})
							