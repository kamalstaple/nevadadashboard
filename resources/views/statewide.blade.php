@extends('layouts.contents')
@section('headerlinks')
<link  rel="stylesheet" href="{{asset('css/style2.css')}}"> 
@endsection
@php
$statewise = json_decode($statewide[0]);


$tabledatas = json_decode($statewide[0]['data'])->data;

@endphp
@section('section')

<section class="center-area">
		<section class="home-inner" id="statewides" data-city="{{$statewise->tab}}">
            @csrf
		<div class="elko-left">
			<h1 id="wchCity">{{$statewise->tab}}</h1>
			<p>Below you will find key statistics for the region you selected. Select one or more indicators from the summary table to access trend data. Additionally, detailed state and county-level reports are available and provide extensive information about the economy at all levels.</p>
		</div>
		<div class="elko-right">
			<a href="index"><img src="img/map_return.png"></a>
		</div>
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
					   <li class="chart_download" type="png"><a href="javascript:void(0)" download="Chart.png">PNG File</a> </li>
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
					<div class="chart change-chart active" type="line"><i class="fa fa-line-chart"></i></div>
					<div class="chart change-chart" type="bar"><i class="fa fa-bar-chart"></i></div>
					<div class="chart change-chart list" type="list"><i class="fa fa-list"></i></div>
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
				<tbody id="main-table-list">
                    @foreach($tabledatas as $tabledata)
                <tr id="row-{{$tabledata->IndicatorID}}" data-id="{{$tabledata->IndicatorID}}" data-adjs="{{$tabledata->is_adjustment}}">
                    <td><div class="arrow-block"><i class="fa fa-angle-right arr-ic"></i></div></td>
                    <td>{{$tabledata->is_adjustment ?? ''}}</td>
                    <td class="t-left name" title="{{$tabledata->Name}}">{{$tabledata->Name}}</td>
                    <td class="location" title="{{$tabledata->GeographicAlias}}">{{$tabledata->GeographicAlias}}</td>
                    <td>{{$tabledata->Date}}</td>
                    <td>{{$tabledata->ValueFormatted}}</td>
                    <td>{{$tabledata->previousValue}}</td>
                    <td>{{$tabledata->priorValue}} <i class="fa {{$tabledata->priorPeriod}}"></i></td>
                    <td>{{$tabledata->lastYearValue}}</td>
                    <td>{{$tabledata->priorYValue}} <i class="fa {{$tabledata->priorYear}}"></i></td>
                    <td id="trend-{{$tabledata->IndicatorID}}" class="trend-line" data-graph="{{ json_encode($tabledata->trend) }}" style="width: 100px; height: 25px;">Spark</td>
                    
            </tr>
            @endforeach
                </tbody>
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
						<a download href="{{asset('pdf/'.$statewise->tab.'.pdf')}}"><button class="btn elko-btn">Download {{$statewise->tab}} Overview report [PDF]</button></a>
		</div>
		<div class="clear"></div>
	</section>
</section>

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

@endsection


@section('script')


<script id="box-area" type="text/x-jquery-tmpl">

<div class="box-area box-${divNum}" id="box-${IndicatorID}" data-id="${IndicatorID}" >
	<a href="javascript:void(0)" class="cross-icon fa fa-times cross"></a>
	<div class="head ${classname}">${Name}</div>
	<div class="box-body ${classname}">
		<div>${Location}</div>
		<div>
			<select class="box-select">
				<optgroup label="CURRENT PERIOD">
					<option value="v">Value</option>
					<option value="m">MoM% Change</option>
					<option value="y">YoY% Change</option>
					<option value="c">CAGR</option>
				</optgroup>     
				<optgroup label="TRAILING 12 MONTHS">
					<option value="a">Value</option>
					<option value="am">MoM% Change</option>
					<option value="ay">YoY% Change</option>
					<option value="ac">CAGR</option>
				</optgroup>
			</select>
		</div>
		<div class="input-area">
			<input type="checkbox" checked class="dis-grph">
			<div class="text">Display Data</div>
			<div class="clr"></div>
		</div>		
		<div class="clear"></div>
	</div>
</div>
</script>
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

@endsection
 










