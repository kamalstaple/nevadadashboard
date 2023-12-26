<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width&#44; initial-scale=1&#44; maximum-scale=1&#44; user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge&#44;chrome=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <title>Statewide | Nevada Governor's Office of Economic Development</title>
    <link href="css/style.css" rel="stylesheet">   
	<style>
	.map-area{}
	.map-area polygon:hover{ fill: #1f5a7b; cursor: pointer; }
	.map-area polygon.active{ fill: #1f5a7b; cursor: pointer; }
	.map-area polygon.disable:hover{ fill: #CABFB5; cursor: auto; }
	.name-text polygon:hover{ fill: #000000; }
	.name-text path:hover{ fill: #000000; }
	.demo-hover{ fill: #1f5a7b; cursor: pointer; }
	.name-text:hover polygon{ fill: #FFFFFF; }
	.name-text:hover path{ fill: #FFFFFF; }
	.name-text:hover rect{ fill: #FFFFFF; }
	</style>



	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-BM0DCDTZNC"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-BM0DCDTZNC');
	</script>


</head>
<body>
<div class="wrapper-full">
<!-- header start -->
<header>	
	<div class="logo">
		<a href="index">
			<img src="img/logo.png" alt="">
		</a>           
	</div>
	<div class="wrapper">
	
	
		
	
	<!-- Navigation Start -->
	<div class="header-right pull-right">
	<div class="nav-icon">
		<nav>
			<ul>
				<li class="active"><a href="index">Economic Performance Data</a></li>
				<li><a href="economic">Economic development Data</a></li>
				<li><a href="location-comparison">location comparison</a></li>
				<li><a href="overview">detailed overview reports</a></li>
			</ul>
		</nav>
		</div>
	</div>
	<div class="menu-icon"><i class="fa fa-bars"></i></div>
	<!-- Navigation End -->
	<div class="clear"></div>
	</div>
</header>
<!-- header end -->
<section class="center-area">
	<?php 
	$city = "Nevada";
	if(isset($_POST['city']) && $_POST['city'] != '')
	{
		$city = $_POST['city'];
	}
	?>
	<section class="home-inner" id="statewides" data-city="<?php echo $city; ?>">
		<div class="elko-left" >
			<h1 id="wchCity"><?php echo $city == "Nevada" ? $city : $city." County"; ?></h1>
			<p>Below you will find key statistics for the region you selected. Select one or more indicators from the summary table to access trend data. Additionally, detailed state and county-level reports are available and provide extensive information about the economy at all levels.</p>
		</div>
		<div class="elko-right"><a href="index"><img src="img/map-return.jpg"></a></div>
		<div class="clear"></div>
		<!-- Indicator Detail Chart Area Start -->
		<!-- Chart Area Start -->
		<div class="indi-chart-area dn">
			<span class="chart-pop-icon cross-chart"><i class="fa fa-times"></i></span>
			<span class="chart-pop-icon download-btn"><i class="fa fa-download"></i>
				<div class="download-menu">
				   <div class="heading">Export data</div>
				   <ul>
					   <li class="main_download_export" type="xls"><a href="javascript:void(0)">Excel Spreadsheet</a> </li>
					   <li class="main_download_export" type="csv"><a href="javascript:void(0)">.csv File</a> </li>
					   <li class="chart_download" type="png"><a href='javascript:void(0)' download="Chart.png">PNG File</a> </li>
				   </ul>                                      
			   </div>
			</span>
			<div class="clr"></div>
			<div class="chart-inner">
				<div id="thegrid-body" style="display: none;">
					<div id="thegrid">
						
					</div>
					<div style="border: 1px solid #AAAAAA;overflow:auto;height:355px;display:none" id="thegrid_detail_div">
						<table width="100%" id="thegrid_detail" style="display: none;">
						</table>
					</div>
					<div class="clr"></div>
				</div>
				<div class="chart-place" id="chart-area" style="width:100%;height:300px;"></div>
				<div class="chart-bar">
					<div class="chart change-chart active" type="line" ><i class="fa fa-line-chart"></i></div>
					<div class="chart change-chart" type="bar" ><i class="fa fa-bar-chart"></i></div>
					<div class="chart change-chart list" type="list" ><i class="fa fa-list"></i></div>
					<div class="chart-gray-bar">
						<span id="mult-axe" style="display: none;"><input type="checkbox" id="mul-axes"> Multiple Axes</span>
					</div>
					<div class="clr"></div>
				</div>
				<div id="box-areas"></div>
				<!-- Colored boxes start -->
				
				<div class="clr"></div>
				<!-- colored boxes end -->
			</div>					
		</div>
		<!-- Chart Area End -->
		<!-- Indicator Detail Chart Area End -->
		<!-- Table Start -->
		<div class="elko-table">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr>
						<th class="no-color">&nbsp;</th>
						<th class="no-color">&nbsp;</th>
						<th class="no-color">&nbsp;</th>
						<th class="no-color">&nbsp;</th>
						<th class="no-color">&nbsp;</th>
						<th class="no-color">&nbsp;</th>
						<th class="t-center border-bottom" colspan="2">Prior Period</th>
						<th class="t-center border-left border-bottom" colspan="2">One Year Ago</th>
						<th class="border-left border-bottom">&nbsp;</th>
					</tr>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th class="t-left">Indicator</th>
						<th>Location</th>
						<th>Date</th>
						<th>Latest Period</th>
						<th>Value</th>
						<th>Change</th>
						<th>Value</th>
						<th>Change</th>
						<th>Spark</th>
					</tr>
				</thead>
				<tbody id="main-table-list"></tbody>
			</table>			
		</div>
		<!-- Tabke End -->		
		<!-- Table hint start -->
		<div class="table-hint">
			<ul>
				<li><i class="fa fa-leaf yellow"></i> Seasonally Adjusted</li>
				<!--<li><span>BOLD</span> Recently Updated</li>-->
				<div class="clear"></div>
			</ul>
		</div>
		<!-- Table hint End -->
		<div class="btn-margin">
			<?php 	$pdf = isset($_POST['pdfName'])?$_POST['pdfName']:"Nevada";	?>
			<a download="<?php echo $pdf ?>.pdf" href="pdf/<?php echo $pdf ?>.pdf"><button class="btn elko-btn">Download <?php echo $city == "Nevada" ? $city : $city." County"; ?> Overview report [PDF]</button></a>
		</div>
		<div class="clear"></div>
	</section>
</section>
<!-- Center section end -->
</div>
<!-- Footer Start -->
<footer>&copy; Copyright 2021. All rights reserved. Powered by <span class="power-logo"></span> <a target="_blank" href="http://myresearcher.com/">myResearcher.com</a></footer>
<!-- Footer End -->
<script type='text/javascript' src="js/jquery.min.js"></script>
<script type='text/javascript' src="js/amcharts.js"></script>
<script type='text/javascript' src="js/serial.js"></script>
<script type='text/javascript' src="js/chartexport.js"></script>
<script type='text/javascript' src="js/jquery.tmpl.min.js"></script>
<script type='text/javascript' src="js/jquery.colorbox.js"></script>
<script type='text/javascript' src="js/jquery.popover-1.1.2.js"></script>
<script src="js/dataportal.js"></script>
<div class="loader-overlay">
	<div class="loader"><img src="img/main-loader.svg"></div>
</div>
<div id="_graph_holder" style="display:none;"></div>
<!-- Tools Menu start -->
<div style="display:none;" class="tools-menu" id="tools-menu"> 
	<ul>
		<li>
			<a id="quick_chart" href="javascript:void(0);">View Quick Chart <i class="fa fa-angle-double-right"></i></a>
		</li>
		<li><a id="add_to_chart" href="javascript:void(0);">Add to Chart <i class="fa fa-angle-double-right"></i></a></li>
		<li>
			<a href="javascript:void(0);">Create Report <i class="fa fa-angle-double-right"></i></a>
			<ul class="tools-second-menu">
				<li class="tools-menu-heading">Create Report</li>
				<li class="download_report" type="single"><a href="javascript:void(0);">Current Indicator <i class="fa fa-angle-double-right"></i></a></li>
				<li><a href="javascript:void(0);">All Indicators <i class="fa fa-angle-double-right"></i></a>
					<ul class="tools-third-menu">
						<li class="tools-menu-heading">Full Report</li>
						<li class="download_report" type="cur"><a href="javascript:void(0)">Current Data Only <i class="fa fa-angle-double-right"></i></a></li>
						<li class="download_report" type="trl"><a href="javascript:void(0)">Current &amp; Trailing Data <i class="fa fa-angle-double-right"></i></a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:void(0)">Export Data <i class="fa fa-angle-double-right"></i></a>
			<ul class="tools-second-menu">
				<li class="tools-menu-heading">Export Data</li>
				<li>
					<a href="javascript:void(0)">Current Indicator <i class="fa fa-angle-double-right"></i></a>
					<ul class="tools-third-menu">
						<li class="tools-menu-heading">File Format</li>
						<li class="download_export" rel="single" type="xls" ><a href="javascript:void(0)">Excel Spreadsheet</a> </li>
						<li class="download_export" rel="single" type="csv" ><a href="javascript:void(0)">.csv File</a> </li>
						<li class="download_export" rel="single" type="pdf" ><a href="javascript:void(0)">PDF File</a> </li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0)">All Indicators <i class="fa fa-angle-double-right"></i></a>
					<ul class="tools-third-menu">
						<li class="tools-menu-heading">File Format</li>
						<li class="download_export" rel="all" type="xls" ><a href="javascript:void(0)">Excel Spreadsheet</a> </li>
						<li class="download_export" rel="all" type="csv" ><a href="javascript:void(0)">.csv File</a> </li>
					</ul>
				</li>
			</ul>
		</li>														
	</ul>
</div>
<!-- Tools Menu End -->

<!-- Popups End -->
<script type="text/x-jquery-tmpl" id="template-list-view-name">
	<div class="top-head-tb">
		<table cellspacing="0" cellpadding="0" class="list-vie-crt">
			<thead id="list-view-names">
			<tr>
				<th  valign="bottom" class="dt-first">Date</th>
				{{each name}}
				<th  valign="bottom">${name}</th>
				{{/each}}
			</tr>											
			</thead>
		</table>
	</div>
	<div class="cont-body-tb">
		<table cellspacing="0" cellpadding="0" class="list-vie-crt">
			<tbody id="list-view-data">
				{{each(i, item) rows}}
				<tr>
					{{each(i, val) item}}
						<td  valign="bottom">${val}</td>
					{{/each}}
				</tr>
				{{/each}}
			</tbody>
		</table>
	</div>
</script> 
<script type="text/x-jquery-tmpl" id="template-list-view-name">
	<div class="top-head-tb">
		<table cellspacing="0" cellpadding="0" class="list-vie-crt">
			<thead id="list-view-names">
			<tr>
				<th  valign="bottom" class="dt-first">Date</th>
				{{each name}}
				<th  valign="bottom">${name}</th>
				{{/each}}
			</tr>											
			</thead>
		</table>
	</div>
	<div class="cont-body-tb">
		<table cellspacing="0" cellpadding="0" class="list-vie-crt">
			<tbody id="list-view-data">
				{{each(i, item) rows}}
				<tr>
					{{each(i, val) item}}
						<td  valign="bottom">${val}</td>
					{{/each}}
				</tr>
				{{/each}}
			</tbody>
		</table>
	</div>
</script> 
<div id="main-chart-legend-div"></div>

<div id='view-quick-chart' style="display:none;">
	<div class="popup-area quick-chart-pop">
		<div class="blue-bar">
			<div class="pop-title">quick chart</div>
		</div>
		<div class="white-bar">
			<div class="body-title quick-use" id="ind_name">${NameAlias}</div>
			<span class="quick-pop-icon add-to-main"><i class="fa fa-plus"></i></span>
			<span class="quick-pop-icon quick-download">
				<i class="fa fa-download"></i>
				<div class="quick-download-menu">
				   <div class="heading">Export data</div>
				   <ul>
					   <li class="q_download_export" rel="single" type="xls" ><a href="javascript:void(0)">Excel Spreadsheet</a> </li>
					   <li class="q_download_export" rel="single" type="csv" ><a href="javascript:void(0)">.csv File</a> </li>
					   <li class="q_download_export" rel="single" type="pdf" ><a href="javascript:void(0)">PDF File</a> </li>
					
				   </ul>
			   </div>
			</span>
			<div class="clr"></div>
			<div class="quick-edit-left" id="show-quick-chart-left">
				
			</div>
			<div class="quick-edit-right">
				<div class="quick-chart-map">
					<div id="quick_graph" data-graph=""></div>
					<div class="map-show-scroll">
						<div><input type="checkbox" id="show_scroll"></div>
						<div class="input-text">Show scrollbar</div>
						<div class="clr"></div>
					</div>
				</div>
				<!-- Table start -->
				<div class="quick-chart-table">
					<table cellpadding="0" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th colspan="4" class="blue-bg-light">Current</th>
								<th colspan="4" class="orange-bg-light">Trailing 12 months</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="4" class="no-padding">
									<table cellpadding="0" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th class="blue-bg-dark"></th>
												<th class="blue-bg-dark">Value</th>
												<th class="blue-bg-dark">MoM<br>% CHG</th>
												<th class="blue-bg-dark">YoY<br>% CHG</th>
											</tr>
										</thead>
										<tbody id="current-monthly">
												
										</tbody>
									</table>
								</td>
								<td colspan="4" class="no-padding">
									<table cellpadding="0" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th class="orange-bg-dark"></th>
												<th class="orange-bg-dark">Value</th>
												<th class="orange-bg-dark">MoM<br>% CHG</th>
												<th class="orange-bg-dark">YoY<br>% CHG</th>
											</tr>
										</thead>
										<tbody id="aggregate-monthly">
												
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- Table end -->
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>
<!--Quick Chart Tmpl-->
<script id="quick-chart-left" type="text/x-jquery-tmpl">
	<div class="info-sec">
		<span>Geographic Location</span><br>
		${GeographicAlias}
	</div>
	<div class="info-sec">
		<span>Source</span><br>
		${Source}
	</div>
	<div class="info-sec">
		<span>source location</span><br>
		<a href="javascript:void(0);">${SourceURL}</a>
	</div>
	<div class="info-sec">
		<span>description/notes</span><br>
		${variable_description_definition}
	</div>
	<div class="info-sec">
		<span>adjustment</span><br>
		${Adjustment}
	</div>
	<div class="info-sec">
		<span>Periodicity</span><br>
		${periodName}
	</div>
	<div class="info-sec">
		<span>Last Update</span><br>
		${LastUpdated}
	</div>
	<div class="info-sec">
		<span>Categorization</span><br>
		${Categories_list_name}
	</div>
</script>
<script type="text/x-jquery-tmpl" id="template-current-monthly">
	<tr>
		<td>${f_Date}</td>
		<td data-raw-value="${f_value}">${f_value}</td>
		<td data-raw-value="${m}">${m}</td>
		<td data-raw-value="${y}">${y}</td>
	</tr>
</script> 
<script type="text/x-jquery-tmpl" id="template-aggregate-monthly">
	<tr>
		<td>${f_Date}</td>
		<td data-raw-value="${af_value}">${af_value}</td>
		<td data-raw-value="${am}">${am}</td>
		<td data-raw-value="${ay}">${ay}</td>
	</tr>
</script> 
