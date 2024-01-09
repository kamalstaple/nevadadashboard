var myScript = new ( function($) {
	var self = this;
	var MainCharBox = ['blue', 'green', 'orange', 'royal-blue', 'teal'];
	var GraphColors = ['#1c81c7', '#8ebf49', '#d34000', '#4a2ef5', '#009aa5'];
	
	this.sendAjax = function(param, afterloadback)
	{
		//  var =param.action
				
		$.ajax({
			data: param,
			url: "/mr_portal",
			cache: false,
			type: 'post',
			dataType: 'json',
			beforeSend: function(){
				$(".loader-overlay").removeClass('d-none');
				$(".loader-overlay").show();
			},
			success: function(reData, status, xhr) {
				$(".loader-overlay").addClass('d-none');
				$(".loader-overlay").hide();
				
				afterloadback(reData);
				return reData;
			}
		});
	}
	this.DrawQuickGraph = function(graphData, divID) {
		
		var Chart = new AmCharts.AmSerialChart();
		Chart.zoomOutButton = {
			backgroundColor: '#000000',
			backgroundAlpha: 0.15
		};
		Chart.pathToImages = "img/";
		Chart.categoryField = "date";
		Chart.dataProvider = graphData;
		Chart.dataDateFormat = "YYYY-MM-DD";
		Chart.autoMargins = false;	
		var balloon = Chart.balloon;
		balloon.color = "#333";
		balloon.fillColor = "#F2BF3F";		       
		var categoryAxis = Chart.categoryAxis;
		categoryAxis.parseDates = true; 
		categoryAxis.minPeriod = "DD"; 
		categoryAxis.dashLength = 2;
		categoryAxis.gridAlpha = 0.15;
		categoryAxis.labelsEnabled = false;
		categoryAxis.axisColor = "#DADADA";
		categoryAxis.axisColor = "transparent";
		categoryAxis.gridColor = "transparent";
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.axisColor = "#1c81c7";
		valueAxis.axisThickness = 0;
		valueAxis.gridAlpha = 0;
		valueAxis.position = "left";
		valueAxis.labelsEnabled = false;
		valueAxis.axisColor = "transparent";
		Chart.addValueAxis(valueAxis);
      	var graph = new AmCharts.AmGraph();
		graph.valueField = 'value';
		graph.bullet = "round";
		graph.hideBulletsCount = 1;
		graph.lineColor = "#1c81c7";
		valueAxis.axisThickness = 0;
		graph.lineAlpha = 0;
		graph.fillAlphas = 0.25;
		graph.balloonText = '[[f_value]]';
		graph.balloonColor = "#F2BF3F";
		Chart.addGraph(graph);                
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorPosition = "mouse";
		chartCursor.zoomable = false;
		chartCursor.cursorColor = "#F2BF3F";
		chartCursor.color = "#333";
		chartCursor.categoryBalloonColor = "#F2BF3F";
		Chart.addChartCursor(chartCursor);
		var chartScrollbar = new AmCharts.ChartScrollbar();
		chartScrollbar.dragIcon  = "dragIcon";
		chartScrollbar.scrollbarHeight  = 15;
		chartScrollbar.color = "#FFFFFF";
		chartScrollbar.gridColor = "#a9a9a9";
		chartScrollbar.graphFillColor = "#a9a9a9";
		chartScrollbar.graphLineColor = "#a9a9a9";
		chartScrollbar.backgroundColor = "#a9a9a9";
		chartScrollbar.selectedBackgroundColor = "#262626";
		chartScrollbar.selectedGraphFillColor = "#262626";
		chartScrollbar.selectedGraphLineColor = "#262626";
		chartScrollbar.autoGridCount = true;
		chartScrollbar.graph = graph;
		if($('#colorbox #show_scroll').is(':checked'))
		{
			Chart.addChartScrollbar(chartScrollbar);
		}
		$("#" + divID).empty();            
		Chart.write(divID);
	}
	this.DrawHomeGraph = function(graphData, divID){
		var Chart = new AmCharts.AmSerialChart();
		Chart.numberFormatter = {precision:0, decimalSeparator:'.', thousandsSeparator:','};
		Chart.usePrefixes = true;
		Chart.prefixesOfBigNumbers = [{number:1e+3,prefix:"K"},{number:1e+6,prefix:"M"},{number:1e+9,prefix:"B"},{number:1e+12,prefix:"T"},{number:1e+15,prefix:"P"},{number:1e+18,prefix:"E"},{number:1e+21,prefix:"Z"},{number:1e+24,prefix:"Y"}]
		Chart.zoomOutButton = {
			backgroundColor: '#000000',
			backgroundAlpha: 0.15
		};
		Chart.pathToImages = "img/";
		Chart.categoryField = "date";
		Chart.dataProvider = graphData;
		var balloon = Chart.balloon;
		balloon.textAlign = "left";		
		Chart.autoMargins = true;
		Chart.dataDateFormat = "YYYY-MM-DD";		
		
		var categoryAxis = Chart.categoryAxis;
		categoryAxis.parseDates = true; 
		categoryAxis.minPeriod = "DD";  
		categoryAxis.dashLength = 2;
		categoryAxis.gridAlpha = 0;
		categoryAxis.axisColor = "#DADADA";
		categoryAxis.gridPosition = "start";
		categoryAxis.autoGridCount = false;
		categoryAxis.gridCount = 5;
		categoryAxis.equalSpacing = true;
		//categoryAxis.labelRotation = 45;
		
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.axisThickness = 0;
		valueAxis.gridAlpha = 0.5;
		valueAxis.gridThickness = 0.5;
		if( divID == "spending-chart")
		{
			valueAxis.unit = "$";
			valueAxis.unitPosition = "left";
		}
		if( divID == "employment-chart")
		{
			//valueAxis.precision = 2;
			valueAxis.labelFunction = function(value) {
				return self.formatValue(value);
			}
		}
		
		Chart.addValueAxis(valueAxis);  
		var graph = new AmCharts.AmGraph();
		graph.valueAxis = valueAxis;
		graph.type = 'line';
		graph.lineAlpha = 1;
		graph.fillAlphas = 0;
		graph.lineThickness = 2;
		graph.bullet = "round";
		graph.hideBulletsCount = 0;
		graph.valueField = "value";
		graph.lineColor = "#A05734";
		graph.balloonText = '[[f_value]]';
		Chart.addGraph(graph);		
		Chart.write(divID); 	
	}
	
	this.DrawMainGraph = function(graphData, divID, count){
		var Chart = new AmCharts.AmSerialChart();
		Chart.numberFormatter = {precision:0, decimalSeparator:'.', thousandsSeparator:','};
		Chart.usePrefixes = true;
		Chart.prefixesOfBigNumbers = [
			{number:1e+3,prefix:"K"},
			{number:1e+6,prefix:"M"},
			{number:1e+9,prefix:"B"},
			{number:1e+12,prefix:"T"},
			{number:1e+15,prefix:"P"},
			{number:1e+18,prefix:"E"},
			{number:1e+21,prefix:"Z"},
			{number:1e+24,prefix:"Y"}]
		Chart.zoomOutButton = {
			backgroundColor: '#000000',
			backgroundAlpha: 0.15
		};
		Chart.pathToImages = "img/";
		Chart.categoryField = "date";
		Chart.dataProvider = graphData.graph;
		var balloon = Chart.balloon;
		balloon.textAlign = "left";
		Chart.autoMargins = true;
		Chart.dataDateFormat = "YYYY-MM-DD";	
		
		Chart.removeValueAxis = 'y';
		var categoryAxis = Chart.categoryAxis;
		//categoryAxis.parseDates = true;
		categoryAxis.minPeriod = "DD"; 
		categoryAxis.dashLength = 2;
		categoryAxis.gridAlpha = 0.15;
		categoryAxis.axisColor = "#DADADA";
		categoryAxis.equalSpacing = true;
		categoryAxis.autoGridCount = true;
		categoryAxis.labelFunction = function(valueText, serialDataItem, categoryAxis){
			return AmCharts.formatDate(new Date(valueText), "YYYY");
		}
		for (var i = 0; i < count; i++) {
			var axis = "value_" + i;
			var description = "description" + i;
			var uniT = "unit_"+i+"";
			if( i == 0 || $('#mul-axes').is(":checked"))
			{
				var valueAxis = new AmCharts.ValueAxis();
				valueAxis.axisColor = GraphColors[i];
				if (i > 0) {
					valueAxis.offset = (i < 1) ? 0 : 65 * (i);               
				}
				valueAxis.axisThickness = 2;
				valueAxis.gridAlpha = 0;
				valueAxis.position = i == 0 ? "left" : "right";
				
				if($('#mul-axes').is(":checked"))
				{
					if(graphData.detail[uniT] == "$")
					{
						valueAxis.unit = graphData.detail[uniT];
						valueAxis.unitPosition = "left";
					} else if(graphData.detail[uniT] == "%") {
						valueAxis.unit = graphData.detail[uniT];
						valueAxis.unitPosition = "right";
					}
				} else if(count == 1)
				{
					if(graphData.detail[uniT] == "$")
					{
						valueAxis.unit = graphData.detail[uniT];
						valueAxis.unitPosition = "left";
					} else if(graphData.detail[uniT] == "%") {
						valueAxis.unit = graphData.detail[uniT];
						valueAxis.unitPosition = "right";
					}
				}
			}
			Chart.addValueAxis(valueAxis);	
			var graph = new AmCharts.AmGraph();
			graph.valueAxis = valueAxis;
			graph.id = "graph-"+i+"";   
			if($(".change-chart.active").attr("type") == "bar")
			{
				graph.type = 'column';
				graph.lineThickness = 5;
				graph.fillAlphas = 1;
				graph.pointPosition = 'start';
			} else {
				graph.type = 'line';
				graph.lineAlpha = 1;
				graph.fillAlphas = 0;
				graph.lineThickness = 2;
				graph.bullet = "round";
				graph.hideBulletsCount = 0;
			}
			graph.valueField = axis;
			graph.lineColor = GraphColors[i];
			graph.balloonText = '[[f_value_'+i+']]';
			//graph.descriptionField = description;
			Chart.addGraph(graph);   
		}                 
		var chartScrollbar = new AmCharts.ChartScrollbar();
		chartScrollbar.dragIcon  = "dragIcon";
		chartScrollbar.scrollbarHeight  = 25;
		chartScrollbar.color = "#FFFFFF";
		chartScrollbar.gridColor = "#a9a9a9";
		chartScrollbar.graphFillColor = "#a9a9a9";
		chartScrollbar.graphLineColor = "#a9a9a9";
		chartScrollbar.backgroundColor = "#a9a9a9";
		chartScrollbar.selectedBackgroundColor = "#262626";
		chartScrollbar.selectedGraphFillColor = "#262626";
		chartScrollbar.selectedGraphLineColor = "#262626";
		chartScrollbar.autoGridCount = true;
		Chart.addChartScrollbar(chartScrollbar);
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorPosition = "mouse";
		chartCursor.zoomable = false;		
		Chart.addChartCursor(chartCursor);
		Chart.amExport = {
			top:21,
			right:20,
			exportPNG:true,
			userCFG:{ menuItems: [{
						icon: 'img/',
						format: 'png',
						onclick: function(a) {
							var output = a.output({
								format: 'png',
								output: 'datastring'
							}, function(data) {	
								$('.chart_download a').attr("href", data);
							});
						},
					}]
				}
		}
        var legend = new AmCharts.AmLegend();
		legendDatas = [];
		$('._hidden_graph_holder').each(function(i,val){
			legendDatas.push({
				title: $(this).attr("data-name"), 
				color: GraphColors[i]
			});
		});
		legend.data = legendDatas;
		legend.marginTop = 280;
		legend.fontSize = 12;
		legend.verticalGap = 15;
		legend.spacing = 50;
		legend.width = 1000;
		Chart.addLegend(legend,'main-chart-legend-div');
		Chart.addLegend(legend);
		Chart.addListener("zoomed", function(event){
			if($('.amExportButton').length != 0){	
				$('#expMapImage').trigger('click');
			}
		});
		Chart.write(divID); 
		$(".chart-inner .box-area input.dis-grph").each(function(i){
			if(!$(this).is(":checked"))
			{
				Chart.hideGraph(Chart.graphs[i]);
			}
		});
		if($('.amExportButton').length != 0){	
			$('#expMapImage').trigger('click');
		}
	}
	
	this.createList = function(){
		indicators = '';
		var cnt = 0;
		$('._hidden_graph_holder').each(function(i,val){
			indicators += $(this).attr("data-value")+",";
			cnt++;
		});
		if(cnt == 0)
		{
			$(".cross-chart").trigger("click");
			return false;
		}
		$("span#mult-axe").hide();
		const csrfToken = document.querySelector('input[name="_token"]').value;

		param = { 'action':'main_grid_data', 'ids': indicators, 'is_arr' : 1 , '_token':csrfToken},
		console.log(param);

		// myScript.sendAjax(param, function(data){
		// 	$('#thegrid').html('');
		// 	// console.log(data.data.rows);
		// 	const names = data.data.names;
		// 	const rows = data.data.rows;
		// 	$('#template-list-view-name').tmpl(data.data).appendTo('#thegrid');
		// 	$(".chart-inner #box-areas").hide();
		// 	$(".chart-inner .chart-place").hide('slow', function(){
		// 		$(".chart-inner #thegrid-body").show();
		// 	});
		// });
		myScript.sendAjax(param, function(data) {
			$('#thegrid').html('');
			console.log(data);
		
		
				const names = data.data.name.map(item => item.name);
				const rows = data.data.rows;
		
				let namesHeaderHTML = '<tr><th class="text-start">Date</th>';
				names.forEach(name => {
					namesHeaderHTML += `<th>${name}</th>`;
				});
				namesHeaderHTML += '</tr>';
		
				let rowsHTML = '';
				rows.forEach(row => {
					rowsHTML += '<tr>';
					rowsHTML += `<td>${row.Date}</td>`;
		
					// Iterate through each property of the row object
					for (const prop in row) {
						if (prop !== 'Date') { // Exclude 'Date' property
							rowsHTML += `<td>${row[prop]}</td>`;
						}
					}
		
					rowsHTML += '</tr>';
				});
		
				const htmlString = `
					<div class="top-head-tb">
						<table cellspacing="0" cellpadding="0" class="list-vie-crt">
							<thead id="list-view-names">
								${namesHeaderHTML}
							</thead>
						</table>
					</div>
					<div class="cont-body-tb">
						<table cellspacing="0" cellpadding="0" class="list-vie-crt">
							<tbody id="list-view-data">
								${rowsHTML}
							</tbody>
						</table>
					</div>
				`;
		
				$('#thegrid').append(htmlString);
		
				$(".chart-inner #box-areas").hide();
				$(".chart-inner .chart-place").hide('slow', function() {
					$(".chart-inner #thegrid-body").show();
				});
			
		});
		
		
	}
	
	this.createChart = function(){
		indicators = '';
		$("#box-areas").html('');
		var cnt = 0;
		$('._hidden_graph_holder').each(function(i,val){
			if($(this).attr('data-name').length > 69){
				names = $(this).attr('data-name').substring(0,66)+"...";
			}else{
				names = $(this).attr('data-name');
			}
			$("#box-area").tmpl({
				IndicatorID: $(this).attr("data-value"),
				Name: names,
				Location: $(this).attr("data-geography"),
				adj:$(this).attr("data-adj"),
				divNum:i,
				classname:MainCharBox[i]
			}).appendTo('#box-areas');
			$("#box-"+$(this).attr("data-value")+" .box-select").val($(this).attr("data-axiskey"));
			indicators += $(this).attr("data-value")+"_"+$(this).attr("data-axiskey")+",";
			cnt++;
		});
		if(cnt == 0)
		{
			$(".cross-chart").trigger("click");
			return false;
		} else if(cnt > 1) {
			$("span#mult-axe").show();
		} else {
			$("span#mult-axe").hide();
		}
		const csrfToken = document.querySelector('input[name="_token"]').value;

		param = { 'action':'chartdata', 'ids'  : indicators, 'is_arr': 1 , '_token':csrfToken},
		myScript.sendAjax(param, function(data){
			$("#chart-area").attr("data-graph",JSON.stringify(data.data));
			$("#chart-area").attr("data-indicator", cnt);
			myScript.DrawMainGraph(data.data, "chart-area", cnt);
		});	
	}
	
	this.downloadReport = function(param){
		//$.colorbox.close();
		myScript.sendAjax(param, function(data){
			if(parseInt(data.result) == 1 && data.name != ''){
				window.location.href = "download?name="+data.name;
				//self.processing();
			}
		});
	}
	
	this.moveUpDown = function(dir){
		
		var $op = jQuery("ul.right-ul li.active");
		
		if(dir == "up")
		{
			if($op.length){
				$op.first().prev().before($op); 
			}
		} 
		else 
		{
			if($op.length){
				$op.last().next().after($op);
			}
		}
	}
	
	this.move_list_items = function(dir, wClick, obj){
		var leftDIV = "ul.left-ul";
		var rightDIV = "ul.right-ul";
		
		if( dir == "left"){
			if(wClick == "dbclick")
			{
				objct = obj;
			} else {
				objct = rightDIV+' li.active';
			}
			$(objct).appendTo(leftDIV);    
		} else {
			if(wClick == "dbclick")
			{
				objct = obj;
			} else {
				objct = leftDIV+' li.active';
			}
			
			$(leftDIV+' li.active').appendTo(rightDIV);  
		}
		$(".comparison-area ul li").removeClass("active");
		$('#cntMSA').html('['+ $("ul#selectmsalist li").length +']');
	}
	this.DrawTrend = function(graphData, divID){
		var Chart = new AmCharts.AmSerialChart();
		Chart.zoomOutButton = {
			backgroundColor: '#000000',
			backgroundAlpha: 0.15
		};
		Chart.categoryField = "date";
		Chart.dataProvider = graphData;
		Chart.fontSize = 13;
		Chart.autoMargins = false;
		Chart.marginLeft = 0;
		Chart.marginRight = 0;
		Chart.marginBottom = 0;
		Chart.marginTop = 0;	
		Chart.dataDateFormat = "YYYY-MM-DD";
		var categoryAxis = Chart.categoryAxis;
		categoryAxis.autoGridCount = true; 
		categoryAxis.parseDates = true; 
		categoryAxis.minPeriod = "DD"; 
		categoryAxis.dashLength = 2;
		categoryAxis.gridAlpha = 0;
		categoryAxis.labelsEnabled = false;
		categoryAxis.gridCount = 0;
		categoryAxis.axisColor = "transparent";
		categoryAxis.gridColor = "transparent";
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.axisColor = "transparent";
		valueAxis.axisThickness = 0;
		valueAxis.gridAlpha = 0;
		valueAxis.position = "left";
		valueAxis.labelsEnabled = false;
		valueAxis.fillColor = "#ffffff";
		valueAxis.fillAlpha = 0;
		Chart.addValueAxis(valueAxis);
		var graph = new AmCharts.AmGraph();
		graph.valueField = 'value';
		graph.bullet = "round";
		graph.hideBulletsCount = 1;
		graph.lineColor = "#1F5A7B";
		graph.lineAlpha = 1;
		graph.fillAlphas = 0.5;
		graph.showBalloon = false;
		//graph.balloonText = '[[f_value]]';
		Chart.addGraph(graph);                
		var chartCursor = new AmCharts.ChartCursor();
		chartCursor.cursorPosition = "mouse";
		chartCursor.zoomable = false;		
		Chart.addChartCursor(chartCursor);
		Chart.write(divID); 
	}
	this.formatValue = function(value)
	{		
		number = parseFloat(value);
		var decimals = 0;
		if (Math.abs(number) >= 1000000){
			number = Number(number);
			number = (number/1000000).toFixed(2)+'M'; 
		}else if (Math.abs(number) >= 1000){
			number = number.toFixed(decimals).toString().split(".");				
			number = number[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (number[1] ? "." + number[1] : "");
		}else if(Math.abs(number)<10){
			number = Number(number);
			number = number.toFixed(decimals); 
		}else if(Math.abs(number)<100){
			number = Number(number);
			number = number.toFixed(decimals); 
		}else if(Math.abs(number)<1000){
			number = Number(number);
			number = number.toFixed(decimals);
		}
		return number;
	}
})(jQuery)
 
jQuery(document).ready(function($){
	
	if($("#portal-home").length > 0)
	{
		// param = { 'action':'home' },
		// myScript.sendAjax(param, function(result){
		// 	var rowHtml = '<li class="${cls_name}-open" data-has="${cls_name}" data-graph="${trend}"><div class="yellow-box"><span class="eco-icon  ${cls_name}"></span></div><h2>${Name}</h2><h1>${valueformated}</h1><h4>${Date}</h4><div class="show-result ${sign}"><span>${prior}</span></div><h5>vs. prior period</h5><div class="tile-pop ${cls_name}-opened dn"><div class="tile-cross"><i class="fa fa-times"></i></div><h1>Nevada ${Name}</h1><div class="graph-listing"><ul>{{each(i, key) trendList}}<li><div class="year">${F_Date}</div><div class="value">${f_value}</div><div class="clear"></div></li>{{/each}}</ul></div><div class="graph-chart" id="${cls_name}-chart"><img src="img/${cls_name}-chart.png"></div><div class="source">Source: ${source}</div><div class="clear"></div></div></li>';
			
		// 	$.template("html-list", rowHtml);
		// 	$("ul#home-list").html('');
			
		// 	$.tmpl("html-list", result.data).appendTo("ul#home-list");
			
		// 	$("ul#home-list li[data-has]").each(function(){
		// 		var grh = $(this);
		// 		var graph = grh.attr("data-graph");
		// 		var ids = grh.attr("data-has")+"-chart";
		// 		myScript.DrawHomeGraph($.parseJSON(graph), ids);
		// 	});
		// });
		
		$(document).on('click', 'ul#home-list li', function(){
			$("ul#home-list li .tile-pop:visible").hide('slow');
			opnCl = $(this).attr('class');
			$("ul#home-list li ."+opnCl+"ed").show('slow');
		});
		
		$(document).on("click", ".tile-pop", function(e) {
			e.stopPropagation();
		});
		$(document).on("click", ".tile-cross", function(e) {
			$("ul#home-list li .tile-pop").hide('slow');
		});
		
		var cityArr = {'humboldt':'Humboldt', 'carson-city':'Carson City', 'churchill' : 'Churchill', 'clark':'Clark', 'douglas':'Douglas', 'elko':'Elko', 'esmeralda':'Esmeralda', 'eureka':'Eureka', 'lander':'Lander', 'lincoln':'Lincoln', 'lyon':'Lyon', 'mineral':'Mineral', 'nye':'NYe', 'pershing':'Pershing', 'storey':'Storey', 'washoe':'Washoe', 'white-pine':'White PINe' };
		
		var pdfArr = {'humboldt':'Humboldt', 'carson-city':'Carson', 'churchill' : 'Churchill', 'clark':'Clark', 'douglas':'Douglas', 'elko':'Elko', 'esmeralda':'Esmeralda', 'eureka':'Eureka', 'lander':'Lander', 'lincoln':'Lincoln', 'lyon':'Lyon', 'mineral':'Mineral', 'nye':'Nye', 'pershing':'Pershing', 'storey':'Storey', 'washoe':'Washoe', 'white-pine':'White Pine' };
		
		$(document).on('click', "#cityMap svg polygon, #cityMap svg path", function(){
			var name = $.trim($(this).attr("id"));
			if(typeof cityArr[name] == "undefined")
			{
				return false;
			}
			// alert(pdfArr[name]);
			// return false;
			$("#cityMap svg polygon[fill=#1f5a7b]").attr('fill',"#CABFB5");

			$(this).attr('fill',"#1f5a7b");
			$.redirect("statewide",
			{
				city: cityArr[name],
				pdfName: pdfArr[name],

			}, "GET", "");
		});
	}
	
	if($("#statewides").length > 0)
	{
		var city = $("#statewides").attr("data-city");
		const csrfToken = document.querySelector('input[name="_token"]').value;

		param = { 'action':'statewide_data', 'tab'  : city, 'is_arr' : 1, '_token':csrfToken},
		// myScript.sendAjax(param, function(result){
		// 	res = result.data;
			
		// 	// console.log(result);
		// 	// if(result.data.length > 0 && result.result > 0)
		// 	// {
		// 	// 	var rowHtml = '<tr id="row-${IndicatorID}" data-id="${IndicatorID}" data-adjs="${is_adjustment}"><td><div class="arrow-block"><i class="fa fa-angle-right arr-ic"></i></div></td><td>{{if is_adjustment == 1 }}<i class="fa fa-leaf"></i>{{else}}&nbsp;{{/if}}</td><td class="t-left name" title="${Name}">${Name}</td><td class="location" title="${GeographicAlias}">${GeographicAlias}</td><td>${Date}</td><td>${ValueFormatted}</td><td>${previousValue}</td><td>${priorValue} <i class="fa ${priorPeriod}"></i></td><td>${lastYearValue}</td><td>${priorYValue} <i class="fa ${priorYear}"></i></td><td id="trend-${IndicatorID}" class="trend-line" data-graph="${JSON.stringify(trend)}" style="width: 100px; height: 25px;">Spark</td></tr>';
				
		// 	// } else {
		// 	// 	var rowHtml = '<tr><td colspan="10"></td></tr>';
		// 	// }
		// 	// $.template("html-list", rowHtml);
		// 	// $("tbody#main-table-list").html('');
		// 	// $.tmpl("html-list", result.data).appendTo("tbody#main-table-list");
			$(".trend-line").each(function(){
				data = $(this).attr('data-graph');
				divID = $(this).attr('id');
				
				
				myScript.DrawTrend($.parseJSON(data), divID);
			});
		// });
		
		$(document).on('click', "tbody#main-table-list .arrow-block", function(event){	
			event.preventDefault();
			event.stopPropagation();
			row_obj = $(this).parents('tr');
			var id = $(row_obj).data('id');	
			$('#main-table-list .arr-ic').removeClass('fa-angle-down');
			$('#main-table-list .arr-ic').addClass('fa-angle-right');
			if($(".popover[rel='"+id+"']").is(':visible')){
				$('.popover').remove();
			} else {
				if($(row_obj).hasClass("active"))
				{
					$("div#tools-menu a#add_to_chart").html('Remove from Chart <i class="fa fa-angle-double-right">');
				} else {
					$("div#tools-menu a#add_to_chart").html('Add to Chart <i class="fa fa-angle-double-right">');
				}
				$('.popover').remove();
				$(this).children(".arr-ic").addClass('fa-angle-down');
				$(this).children(".arr-ic").removeClass('fa-angle-right');			
				$popover = $(this).popover({	
					content:$(".tools-menu").html(),
					stopChildrenPropagation:false,
					onClose: function() { }
				});					
				$(this).popover('show');
				$(".popover").attr('rel',id);
				$('.popover .content').attr('class','tools-menu');
			}	
		});
		
		$(document).on("click", "tbody#main-table-list tr", function(){
			var ID   = $(this).attr("data-id"); 
			var name = $(this).find("td.name").text();
			var loc = $(this).find("td.location").text();
			var adj = $(this).attr("data-adjs");
		
			if($(this).hasClass('active'))
			{
				$("#_indicator_graph_"+ID).remove();
			} 
			else 
			{
				if($('._hidden_graph_holder').length >= 5)
				{
					alert("you can select upto 5 at once");
					return;
				}
				$('#_graph_holder').append('<input class="_hidden_graph_holder" data-geography="' + loc + '" data-name="' + name + '" id="_indicator_graph_' + ID + '" data-adj = "'+adj+'" data-value="' + ID + '" data-charttype="line" data-axiskey = "v" />');
			}
			$(this).toggleClass("active");
			$(".indi-chart-area").slideDown();
			if($(".chart-bar .change-chart.list").hasClass("active")){
				myScript.createList();
			} else {
				myScript.createChart();
			}
		});
		
		$(document).on("change", ".box-select", function(){
			// alert('ok');
			var ID = $(this).parents('.box-area').attr('data-id');
			$('#_indicator_graph_'+ID).attr('data-axiskey',$(this).val());

			indicators = '';
			var cnt = 0;
			$('._hidden_graph_holder').each(function(i,val){
				indicators += $(this).attr("data-value")+"_"+$(this).attr("data-axiskey")+",";
				cnt++;
			});
		const csrfToken = document.querySelector('input[name="_token"]').value;

			param = { 'action':'chartdata', 'ids'  : indicators, 'is_arr':1 ,'_token':csrfToken },
			myScript.sendAjax(param, function(data){
				$("#chart-area").attr("data-graph",JSON.stringify(data.chart));
				$("#chart-area").attr("data-indicator", cnt);
				myScript.DrawMainGraph(data.data, "chart-area", cnt);
			});
		});
		$(document).on('click', ".chart-inner .box-area input.dis-grph", function(){
			var chart = $("#chart-area").attr("data-graph");
			var length = $("#chart-area").attr("data-indicator");
			myScript.DrawMainGraph($.parseJSON(chart), "chart-area", length);
		});
		$(".change-chart").click(function(){
			$(".change-chart").removeClass("active");
			$(this).addClass("active");
			if($(this).attr("type") != "list")
			{
				if($(".chart-inner #thegrid-body").is(":visible"))
				{
					$(".chart-inner #thegrid-body").hide();
					$(".chart-inner #box-areas").show();
					$(".chart-inner .chart-place").show();
					myScript.createChart();
				} else {
					var chart = $("#chart-area").attr("data-graph");
					var length = $("#chart-area").attr("data-indicator");
					myScript.DrawMainGraph($.parseJSON(chart), "chart-area", length);
				}
			}
			if($(this).attr("type") == "list") { myScript.createList();	}
		});
		$("#mul-axes").click(function(){
			var chart = $("#chart-area").attr("data-graph");
			var length = $("#chart-area").attr("data-indicator");
			myScript.DrawMainGraph($.parseJSON(chart), "chart-area", length);
		});
		$(document).on("click", ".box-area .cross", function(){
			var ids = $(this).parents(".box-area").attr("data-id");
			var row_obj = $("tbody#main-table-list #row-"+ids);
			row_obj.trigger("click");
		});
		$(".cross-chart").click(function(){
			$(".indi-chart-area").slideUp();
			$("tbody#main-table-list tr").removeClass('active');
			
			$('#_graph_holder').html('');
			$("#box-areas").html('').show();
			$("#thegrid").html('').show();
			$(".chart-inner .chart-place").html('').show();
		});
		$(document).on('click', "#add_to_chart", function(event){
			var ids = $(this).parents(".popover").attr("rel");
			var row_obj = $("tbody#main-table-list #row-"+ids);
			row_obj.trigger("click");
		});
		$(document).on('click', "#quick_chart", function(event){
			var ids = $(this).parents(".popover").attr("rel");
			// alert(ids);

			if(ids == '')
			{
				return false;
			}
			const csrfToken = document.querySelector('input[name="_token"]').value;

			param = { 'action':'quick_chart', 'is_arr':1, 'ids'  : ids , '_token':csrfToken },
			myScript.sendAjax(param, function(data){
				$.colorbox({ html:$("#view-quick-chart").html() });
				charts = data.data;
				$("div#colorbox #ind_name").html(charts.indicator.NameAlias);
				$("#quick-chart-left").tmpl(charts.indicator).appendTo('div#colorbox #show-quick-chart-left');
				var graph_html = '<div class="draw-space" id="popup-graph" style="width:500px;height:200px;"></div>';
				$('#colorbox  div#quick_graph').html(graph_html);
				$("#template-current-monthly").tmpl(charts.chart).appendTo('div#colorbox #current-monthly');
				$("#template-aggregate-monthly").tmpl(charts.chart).appendTo('div#colorbox #aggregate-monthly');
				$.colorbox.resize();
				$('#colorbox  div#quick_graph').attr("data-graph", JSON.stringify(charts.quickGrp) );
				myScript.DrawQuickGraph(charts.quickGrp, "popup-graph");
				$("div#colorbox .quick-chart-pop").attr('data-id', ids);
			});
		});
		$(document).on('change', 'div#colorbox #show_scroll', function(e){
			graphD = $('#colorbox  div#quick_graph').attr("data-graph");	
			myScript.DrawQuickGraph($.parseJSON(graphD), "popup-graph")
		});
		$(document).on('click', "div#colorbox .add-to-main", function(event){
			var ids = $("div#colorbox .quick-chart-pop").attr('data-id');
			$("tbody#main-table-list #row-"+ids).trigger("click");
			$.colorbox.close();
		});
		
		$(document).on('click', ".download_report", function(){
			var rType = $(this).attr('type');
			var id = $(this).parents(".popover").attr("rel");
			if(id == ''){ return false;	}
			if(rType == "cur" || rType == "trl")
			{
				var city = $("#statewides").attr("data-city");
				name = city;
				if(name == '') { name = 'Nevada'; }
				var ids = name+"_"+rType;
				report = "indicator_report.pdf";
			} else {
				var ids = id+"_single";
				report = "indicator_report.pdf";
			}
			const csrfToken = document.querySelector('input[name="_token"]').value;

			params = { 'action':'report', 'downlaod':1, 'file'  : ids, '_token':csrfToken },
			myScript.downloadReport(params);
		});
		$(document).on('click', ".download_export", function(){
			var rType = $(this).attr('type');
			var rel   = $(this).attr('rel');
			var id = $(this).parents(".popover").attr("rel");
			if(id == ''){ return false; }
			const csrfToken = document.querySelector('input[name="_token"]').value;

			if(rel == "all")
			{

				var city = $("#statewides").attr("data-city");
				name = city;
				var params = {"action":"export", "downlaod":1, "id":name, "format":rType, "type":"all", "dType":"v", '_token':csrfToken};
			} else {
				var params = {"action":"export", "downlaod":1, "id":id, "format":rType, "type":"single", "dType":"v",  '_token':csrfToken};
			}	
			myScript.downloadReport(params, "export");
		});
		$(document).on('click', "div#colorbox .q_download_export", function(){
			var rType = $(this).attr('type');
			var id = $("div#colorbox .quick-chart-pop").attr('data-id');
			if(id == '') {	return false; }
			const csrfToken = document.querySelector('input[name="_token"]').value;

			var params = {"action":"export", "downlaod":1, "id":id, "format":rType, "type":"single", "dType":"v" , '_token':csrfToken};
			myScript.downloadReport(params);
		});
		$(document).on('click', ".main_download_export", function(){
			var rType = $(this).attr('type');
			indicators = '';
			$('._hidden_graph_holder').each(function(i,val){
				indicators += $(this).attr("data-value")+"_"+$(this).attr("data-axiskey")+",";
			});
			if(indicators == ''){ return false;	}
			const csrfToken = document.querySelector('input[name="_token"]').value;

			var params = {"action":"mainchartexport", "downlaod":1, "ids":indicators, "format":rType , '_token':csrfToken};
			myScript.downloadReport(params);
		});
		$(document).on('click', 'body', function(e){
			$('#main-table-list .arr-ic').removeClass('fa-angle-down');
			$('#main-table-list .arr-ic').addClass('fa-angle-right');
		});
	}

	if($("#economic-development").length > 0)
	{
		$(document).on("click", ".navigation li", function(){
			$(".navigation li").removeClass("active");
			var selLI = $(this);
			selLI.addClass("active");
			var tab = selLI.attr("data-tab");
			var actions = selLI.attr("data-action");
			$(".tables:visible").hide('slow');
			$("."+tab).show('slow');
			
			var tiTle = selLI.find("span.name").text();
			$("h2#economic-head").html(tiTle+" Comparison by State");
			if(selLI.attr("data-has") == 1)
			{
				return;
			}
			// param = { 'action' : actions },
			// myScript.sendAjax(param, function(result){
			// 	if(tab == "labor-table")
			// 	{
			// 		var rowHtml = '<tr><td>${total_nonfarm.Name}</td><td>${total_nonfarm.Value}</td><td>${total_nonfarm.Date}</td><td>${total_nonfarm.LastYear} <i class="fa ${total_nonfarm.sign}"></i></td>{{if weekly}}<td>${weekly.Value}</td><td>${weekly.Date}</td><td>${weekly.LastYear}<i class="fa  ${weekly.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}<td>${pri_business.Value}</td><td>${pri_business.Date}</td><td>${pri_business.LastYear}<i class="fa ${pri_business.sign}"></i></td><td>${unemployment.Value}</td><td>${unemployment.Date}</td><td>${unemployment.LastYear}<i class="fa ${unemployment.sign}"></i></td></tr>';
			// 	}
				
			// 	if(tab == "economy-table")
			// 	{
			// 		var rowHtml = '<tr><td>${Name}</td><td>${population}</td><td>${income}</td><td>${degree}</td><td>${gross}</td><td>${gross_capita}</td>{{if living_cost}}{{each(i, key) living_cost[0]}}<td>${i}</td><td>${key}</td></tr>{{/each}}{{else}}<td>n.a.</td><td>n.a.</td></tr>{{/if}}{{if living_cost }}{{each(i,key) living_cost[1]}}<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>${i}</td><td>${key}</td></tr>{{/each}}{{/if}}';
			// 	}
				
			// 	if(tab == "real-estate-table")
			// 	{
			// 		var rowHtml = '<tr>{{if Loc}}<td>${Loc}</td>{{else}}<td></td>{{/if}}{{if Geo}}<td>${Geo}</td>{{else}}<td></td>{{/if}}{{if office}}<td>${office.Value}</td><td>${office.Date}</td><td>${office.LastYear} <i class="fa ${office.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if industrial}}<td>${industrial.Value}</td><td>${industrial.Date}</td><td>${industrial.LastYear} <i class="fa ${industrial.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if existing}}<td>${existing.Value}</td><td>${existing.Date}</td><td>${existing.LastYear} <i class="fa ${existing.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}</tr>';
			// 	}
				
			// 	if(tab == "utilities-table")
			// 	{
			// 		var rowHtml = '<tr><td>${Loc}</td>{{if ind_elec}}<td>${ind_elec.Value}</td><td>${ind_elec.Date}</td><td>${ind_elec.LastYear} <i class="fa ${ind_elec.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if com_elec}}<td>${com_elec.Value}</td><td>${com_elec.Date}</td><td>${com_elec.LastYear} <i class="fa ${com_elec.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if ind_nat}}<td>${ind_nat.Value}</td><td>${ind_nat.Date}</td><td>${ind_nat.LastYear} <i class="fa ${ind_nat.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if com_nat}}<td>${com_nat.Value}</td><td>${com_nat.Date}</td><td>${com_nat.LastYear} <i class="fa ${com_nat.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}</tr>';
			// 	}
			// 	if(tab == "taxes-table")
			// 	{
			// 		var rowHtml = '<tr><td>${Loc}</td>{{if sales}}<td>${sales.Value}</td><td>${sales.Date}</td><td>${sales.LastYear} <i class="fa ${sales.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if individual}}<td>${individual.Value}</td><td>${individual.Date}</td><td>${individual.LastYear} <i class="fa ${individual.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}{{if corporate}}<td>${corporate.Value}</td><td>${corporate.Date}</td><td>${corporate.LastYear} <i class="fa ${corporate.sign}"></i></td>{{else}}<td>n.a.</td><td>n.a.</td><td>n.a.</td>{{/if}}</tr>';
			// 	}
			// 	$.template("html", rowHtml);
			// 	$("tbody#"+tab+"-tbody").html('');
				
			// 	$.tmpl("html", result.data).appendTo("tbody#"+tab+"-tbody");
			// 	selLI.attr("data-has", 1);
			// });
		});
		fileNames = {'economy-table':'economy','labor-table':'labor','real-estate-table':'realEstate','utilities-table':'utilities', 'taxes-table':'taxes'};
		$(document).on('click', ".eco-dev-print", function(){
			var tab = $(".navigation li.active").attr('data-tab');
			var file = fileNames[tab];
			const csrfToken = document.querySelector('input[name="_token"]').value;

			var params = {"action":file+"Pdf", "downlaod":1 , "_token":csrfToken};
			myScript.downloadReport(params);
		});
		$(document).on('click', ".eco-dev-excel", function(){
			var tab = $(".navigation li.active").attr('data-tab');
			var file = fileNames[tab];
			const csrfToken = document.querySelector('input[name="_token"]').value;

			var params = {"action":file+"Xls", "downlaod":1 , "_token":csrfToken };
			myScript.downloadReport(params);
		});
	}
	if($("#location-comparison-page").length > 0)
	{
		// 	const csrfToken = document.querySelector('input[name="_token"]').value;
		// 	param = { 'action' : 'location_msa', '_token':csrfToken },
		// myScript.sendAjax(param, function(result){
		// 	data = result.data;
		// 	var msaMarkup = '<li data-state="${state}" value="${row}" title="${msa} (${location})">${msa}</li>';
		// 	$.template("msaData", msaMarkup);
		// 	$.tmpl("msaData", data).appendTo("ul#allmsalist");
			
		// 	$("li[value='488']").addClass('active');
		// 	$("li[value='492']").addClass('active');
		// 	myScript.move_list_items('right','','');
		// });
		$(document).on('click', 'ul#allmsalist li, ul#selectmsalist li', function(){
			if($(this).val() == '488' || $(this).val() == '492')
			{
				return;
			}
			$(this).toggleClass('active');
		});
		
		$(document).on( 'click', '.move-right', function() {
			myScript.move_list_items('right','','');
		});
		
		$(document).on( 'click', '.move-left', function() {
			myScript.move_list_items('left','','');
		});
		
		$(document).on( 'dblclick', 'ul#allmsalist li', function() {
			myScript.move_list_items('right', 'dbclick', $(this));
		});
		
		$(document).on( 'dblclick', 'ul#selectmsalist li', function() {
			if($(this).val() == '488' || $(this).val() == '492')
			{
				return;
			}
			myScript.move_list_items('left', 'dbclick', $(this));
		});

		$(document).on( 'click', '.move-up', function() {
			myScript.moveUpDown("up");
		});
		
		$(document).on( 'click', '.move-down', function() {
			myScript.moveUpDown("down");
		});
		
		$(document).on( 'click', '#generate_report', function(){
			$(".error-msg").hide('slow');
			ulselected = "ul#selectmsalist li";
			if($(ulselected).length <= 0) {
				$(".error-msg").show('slow');
				return false;
			}
			if($(ulselected).length > 5)
			{
				$(".error-msg").show('slow');
				return false;
			}
			var ids = '';
			$(ulselected).each(function(){	ids += $(this).attr('value')+',';	});
			const csrfToken = document.querySelector('input[name="_token"]').value;

			param = { 'action':'generate_compare', 'idss'  : ids, 'is_arr' : 1, '_token':csrfToken },
			myScript.sendAjax(param, function(result){
				res = result.data;
				$("#comparison-report").show();
				
				var profileHead = '<th class="t-left">Economic profile</th><th>&nbsp;</th>{{each(key, item) msa_title}}<th>${name}</th>{{/each}}';
				$.template("head-profile", profileHead);
				$("tr#head-profile").html('');
				$.tmpl("head-profile", res).appendTo("tr#head-profile");
				var profile = '{{each(key, item) economy_profile}}<tr><td>${Name}</td><td class="num"></td>{{each(i, val) msa_title}}<td>${item[val.name]}</td>{{/each}}</tr>{{/each}}';
				$.template("tbody-profile", profile);
				$("tbody#tbody-profile").html('');
				$.tmpl("tbody-profile", res).appendTo("tbody#tbody-profile");
				
				
				var profileHead = '<th class="t-left">Economic Development</th><th>&nbsp;</th>{{each(key, item) msa_title}}<th>&nbsp;</th>{{/each}}';
				$.template("head-develop", profileHead);
				$("tr#head-develop").html('');
				$.tmpl("head-develop", res).appendTo("tr#head-develop");	
				var develop = '{{each(key, item) economy_develop}}<tr><td>${Name}</td><td class="num"></td>{{each(i, val) msa_title}}<td>${item[val.name]}</td>{{/each}}</tr>{{/each}}';
				$.template("tbody-develop", develop);
				$("tbody#tbody-develop").html('');
				$.tmpl("tbody-develop", res).appendTo("tbody#tbody-develop");			
				$('#comparison-select').slideUp();
				
				var num = 1
				$("#comparison-report tbody td").each(function(i, val){
					if($(val).text() == '')	{	$(val).html('n/a'); }
					if($(val).hasClass('num'))
					{
						$(val).html('['+num+']');
						num++;
					}
				});
			});	
		});
		$(document).on('click', '#edit-msa', function(){	$('#comparison-report').slideUp(); $('#comparison-select').show('slow'); });
		$(document).on('click', '#comparison-select .msg-cross', function(){ $(".error-msg").hide('slow'); });
		$(document).on( 'click', '.dwn-loc', function(){
			var type = $(this).attr("type");
			var ids = '';
			
			if(type == "xls")
			{
				$("ul#selectmsalist li").each(function(){	ids += $(this).attr('value')+',';	});
				const csrfToken = document.querySelector('input[name="_token"]').value;
				var params = {"action":"comparisonReportExcel", 'idss'  : ids, "downlaod":1 ,'_token':csrfToken };
			} else {
				$("ul#selectmsalist li").each(function(){	ids += $(this).attr('value')+'-';	});
			const csrfToken = document.querySelector('input[name="_token"]').value;

				var params = {"action":"comparisonReportPDF", 'idss'  : ids, "downlaod":1, 'link': 'http://nevadadashboard.com/comparison-report.php?ids='+ids , '_token':csrfToken };
			}
			myScript.downloadReport(params);
		});
	}
	
	if($("#cityMap").length > 0)
	{
		
		$(".overlay").show();
		$('#cityMap').load('images/city.svg', function(){
			$(".overlay").hide();
		});
	}
	
	if($("#detail-overview").length > 0)
	{
		
		var cityArr = {'humboldt':'Humboldt', 'carson-city':'Carson', 'churchill' : 'Churchill', 'clark':'Clark', 'douglas':'Douglas', 'elko':'Elko', 'esmeralda':'Esmeralda', 'eureka':'Eureka', 'lander':'Lander', 'lincoln':'Lincoln', 'lyon':'Lyon', 'mineral':'Mineral', 'nye':'Nye', 'pershing':'Pershing', 'storey':'Storey', 'washoe':'Washoe', 'white-pine':'White Pine' };
		
		$(document).on('click', "#cityMap svg polygon, #cityMap svg path", function(){
			
			if($(this).parent('g').hasClass('name-text'))
			{
				name = $(this).parent('g').attr("data-name");
				$("#cityMap svg polygon[id="+name+"]").trigger('click');
				return;
			}
			var name = $.trim($(this).attr("id"));
			
			if(typeof cityArr[name] == "undefined")
			{
				return false;
			}
			
			$("#cityMap svg polygon[fill=#1f5a7b]").attr('fill',"#2288c9");
			$(this).attr('fill',"#1f5a7b");
			$("a#overviewPdf").attr('href', 'pdf/'+cityArr[name]+'.pdf');
			$("div#objPdfSpan").html('<embed id="objPdf" width="100%" height="481" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" alt="pdf" src="pdf/'+cityArr[name]+'.pdf#view=FitH">');
			$("span#cityPd").html(cityArr[name]);
			$("#pdfOver").html(cityArr[name]+" Overview");
		});
		
		$(document).on('click', ".reloads", function(){
			location.reload();
		});
	}
	
	$(document).on('click', ".menu-icon", function(){
		$(".header-right").toggle();
	});
});







































