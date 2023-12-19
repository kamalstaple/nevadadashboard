@extends('layouts.contents')
@section('headerlinks')
<link  rel="stylesheet" href="{{asset('css/style2.css')}}"> 
@endsection

@section('section')

<section class="center-area">
	<section class="home-inner" id="economic-development">
		<div class="eco-dev-left">
			<div class="navigation">
				<ul>
					<li class="active" data-tab="economy-table" data-has="0" data-action="economy_develop">
						<a href="javascript:void(0);">
							<span class="icon economy"></span>
							<span class="name">Economy</span>
						</a>
					</li>
					<li data-tab="labor-table" data-has="0" data-action="economy_labor">
						<a href="javascript:void(0);">
							<span class="icon labor"></span>
							<span class="name">Labor</span>
						</a>
					</li>
					<li data-tab="real-estate-table" data-has="0" data-action="economy_real">
						<a href="javascript:void(0);">
							<span class="icon real-estate"></span>
							<span class="name">Real Estate</span>
						</a>
					</li>
					<li data-tab="utilities-table" data-has="0" data-action="economy_utility">
						<a href="javascript:void(0);">
							<span class="icon utilities"></span>
							<span class="name">Utilities</span>
						</a>
					</li>
					<li data-tab="taxes-table" data-has="0" data-action="economy_taxes">
						<a href="javascript:void(0);">
							<span class="icon taxes"></span>
							<span class="name">Taxes</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="eco-dev-right">
			<h2 id="economic-head">Economic comparison by state</h2>
			<span class="icons eco-dev-print" title="Download PDF"><i class="fa fa-print"></i></span>
			<span class="icons mr1 download-btn eco-dev-excel" title="Download Excel"><i class="fa fa-download"></i></span>
			<div class="clear"></div>
			<!-- Table Start -->
			<div class="economy-table tables">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Population</th>
							<th>Median<br>Household<br>Income</th>
							<th>% Bachelor’s<br>Degree<br>or Higher</th>
							<th>GDP<br>(In Billions)</th>
							<th>GDP<br>(Per Capita)</th>
							<th>Cost of Living</th>
							<th>Index</th>
						</tr>
					</thead>
					<tbody id="economy-table-tbody"></tbody>
				</table>			
			</div>
			<!-- Tabke End -->	
			<div class="labor-table tables" style="display:none;">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th class="no-color">&nbsp;</th>
							<th colspan="3" class="t-center border-bottom">Total Nonfarm<br>Employment</th>
							<th colspan="3" class="t-center border-left border-bottom">Avg. Weekly Wages -<br>Private</th>
							<th colspan="3" class="t-center border-left border-bottom">Private Businesses</th>
							<th colspan="3" class="t-center border-left border-bottom">Initial Unemployment<br>Insurance Claims</th>
						</tr>
						<tr><th>&nbsp;</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th></tr>
					</thead>
					<tbody id="labor-table-tbody"></tbody>
				</table>			
			</div>
			<!-- Table Start -->
			<div class="real-estate-table tables" style="display:none;">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th colspan="2" class="no-color">&nbsp;</th>
							<th colspan="3" class="t-center border-left border-bottom">Office Market Avg.<br>Asking Rents PSF</th>
							<th colspan="3" class="t-center border-left border-bottom">Industrial Market Avg.<br>Asking Rents PSF</th>
							<th colspan="3" class="t-center border-left border-bottom">Existing Single-Family Home<br>Median Sales Price</th>
						</tr>
						<tr><th>&nbsp;</th><th class="t-left">Location</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th></tr>
					</thead>
					<tbody id="real-estate-table-tbody"></tbody>
				</table>			
			</div>
			<!-- Tabke End -->
			<!-- Table Start -->
			<div class="utilities-table tables" style="display:none;">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th class="no-color">&nbsp;</th>
							<th colspan="3" class="t-center border-bottom">Industrial Electric Rates<br>(per Kwh)</th>
							<th colspan="3" class="t-center border-left border-bottom">Commercial Electric Rates<br>(per Kwh)</th>
							<th colspan="3" class="t-center border-left border-bottom">Industrial Natural Gas<br>Rates (per 1000 Cu.Ft.)</th>
							<th colspan="3" class="t-center border-left border-bottom">Commercial Natural Gas<br>Rates (per 1000 Cu.Ft.)</th>
						</tr>
						<tr><th>&nbsp;</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th></tr>
					</thead>
					<tbody id="utilities-table-tbody"></tbody>
				</table>			
			</div>
			<!-- Tabke End -->
			<!-- Table Start -->
			<div class="taxes-table tables" style="display:none;">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th class="no-color">&nbsp;</th>
							<th colspan="3" class="t-center border-left border-bottom">Sales Tax rate<br>(state minimum)</th>
							<th colspan="3" class="t-center border-left border-bottom">Individual Income Tax Rate<br>(Highest bracket)</th>
							<th colspan="3" class="t-center border-left border-bottom">Corporate Income Tax Rate<br>(Highest bracket)</th>
						</tr>
						<tr><th>&nbsp;</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th><th>Current</th><th>Date</th><th>Change</th></tr>
					</thead>
					<tbody id="taxes-table-tbody"></tbody>
				</table>			
			</div>
			<!-- Tabke End -->		
		</div>
		<div class="clear"></div>			
	</section>
</section>
@endsection