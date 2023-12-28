@extends('layouts.contents')
@section('headerlinks')
<link  rel="stylesheet" href="{{asset('css/style2.css')}}"> 
@endsection
@section('section')

@php
  $locations =json_decode($location[0]->data);




   
@endphp



<section class="center-area" id="location-comparison-page">
	<section class="home-inner" id="comparison-select">
		<div>Please select up to five (5) metropolitan areas to include in your comparison.</div>
		<div class="msgs danger dn error-msg">
			<div>Please select up to five (5) metropolitan areas to include in your comparison.</div>
			<a class="msg-cross"><i class="fa fa-close"></i></a>
		</div>
		<div class="comparison-area">
			<div class="left" data-aos="zoom-in-right" data-aos-duration="1500">
				<div class="counting">&nbsp;</div>
				<h5>Available MSAs</h5>
				<div class="list-area">
					<ul id="allmsalist" class="left-ul">
                        @foreach($locations->data as $compare)
                        <?php
                        // dd($compare->state);
                        ?>
                        <li data-state="{{$compare->state}}" value="{{$compare->row}}" title="{{$compare->msa}}({{$compare->location}})">{{$compare->msa}}</li>
                        @endforeach
                        <!-- <li data-state="Georgia" value="43708" title="Atlanta-Sandy Springs-Alpharetta, GA Metropolitan Statistical Area (Atlanta MSA (GA))">Atlanta-Sandy Springs-Alpharetta, GA Metropolitan Statistical Area</li>
                        <li data-state="Texas" value="12873" title="Austin-Round Rock, TX Metropolitan Statistical Area (Austin MSA (TX))">Austin-Round Rock, TX Metropolitan Statistical Area</li>
                        <li data-state="California" value="43456" title="Bakersfield, CA Metropolitan Statistical Area (Bakersfield MSA (CA))">Bakersfield, CA Metropolitan Statistical Area</li>
                        <li data-state="Idaho" value="2164" title="Boise City-Nampa, ID Metropolitan Statistical Area (Boise City MSA (ID))">Boise City-Nampa, ID Metropolitan Statistical Area</li>
                        <li data-state="North Carolina" value="9222" title="Charlotte-Gastonia-Rock Hill, NC-SC Metropolitan Statistical Area (Charlotte MSA (NC))">Charlotte-Gastonia-Rock Hill, NC-SC Metropolitan Statistical Area</li>
                        <li data-state="Texas" value="12872" title="Dallas-Fort Worth-Arlington, TX Metropolitan Statistical Area (Dallas MSA (TX))">Dallas-Fort Worth-Arlington, TX Metropolitan Statistical Area</li>
                        <li data-state="Colorado" value="9290" title="Denver-Aurora-Lakewood, CO Metropolitan Statistical Area (Denver MSA (CO))">Denver-Aurora-Lakewood, CO Metropolitan Statistical Area</li>
                        <li data-state="Texas" value="9307" title="Houston-The Woodlands-Sugar Land, TX Metropolitan Statistical Area (Houston MSA (TX))">Houston-The Woodlands-Sugar Land, TX Metropolitan Statistical Area</li>
                        <li data-state="Idaho" value="43768" title="Idaho Falls, ID Metropolitan Statistical Area (Idaho Falls MSA (ID))">Idaho Falls, ID Metropolitan Statistical Area</li>
                        <li data-state="California" value="2159" title="Los Angeles-Long Beach-Anaheim, CA Metropolitan Statistical Area (Los Angeles MSA (CA))">Los Angeles-Long Beach-Anaheim, CA Metropolitan Statistical Area</li>
                        <li data-state="Tennessee" value="44558" title="Nashville-Davidson--Murfreesboro--Franklin, TN Metropolitan Statistical Area (Nashville MSA (TN))">Nashville-Davidson--Murfreesboro--Franklin, TN Metropolitan Statistical Area</li>
                        <li data-state="Nebraska" value="44158" title="Omaha-Council Bluffs, NE-IA Metropolitan Statistical Area (Omaha MSA (NE))">Omaha-Council Bluffs, NE-IA Metropolitan Statistical Area</li>
                        <li data-state="Florida" value="43660" title="Orlando-Kissimmee-Sanford, FL Metropolitan Statistical Area (Orlando MSA (FL))">Orlando-Kissimmee-Sanford, FL Metropolitan Statistical Area</li>
                        <li data-state="Arizona" value="2161" title="Phoenix-Mesa-Glendale, AZ Metropolitan Statistical Area (Phoenix MSA (AZ))">Phoenix-Mesa-Glendale, AZ Metropolitan Statistical Area</li>
                        <li data-state="Oregon" value="2167" title="Portland-Vancouver-Hillsboro, OR-WA Metropolitan Statistical Area (Portland MSA (OR))">Portland-Vancouver-Hillsboro, OR-WA Metropolitan Statistical Area</li>
                        <li data-state="Utah" value="44670" title="Provo-Orem, UT Metropolitan Statistical Area (Provo MSA (UT))">Provo-Orem, UT Metropolitan Statistical Area</li>
                        <li data-state="California" value="43504" title="Riverside-San Bernardino-Ontario, CA Metropolitan Statistical Area (Riverside MSA (CA))">Riverside-San Bernardino-Ontario, CA Metropolitan Statistical Area</li>
                        <li data-state="California" value="43508" title="Sacramento--Roseville--Arden-Arcade, CA Metropolitan Statistical Area (Sacramento MSA (CA))">Sacramento--Roseville--Arden-Arcade, CA Metropolitan Statistical Area</li>
                        <li data-state="Utah" value="2163" title="Salt Lake City, UT Metropolitan Statistical Area (Salt Lake City MSA (UT))">Salt Lake City, UT Metropolitan Statistical Area</li>
                        <li data-state="California" value="2158" title="San Francisco-Oakland-Hayward, CA Metropolitan Statistical Area (San Francisco MSA (CA))">San Francisco-Oakland-Hayward, CA Metropolitan Statistical Area</li>
                        <li data-state="Washington" value="12865" title="Seattle-Tacoma-Bellevue, WA Metropolitan Statistical Area (Seattle MSA (WA))">Seattle-Tacoma-Bellevue, WA Metropolitan Statistical Area</li>
                        <li data-state="Washington" value="44749" title="Spokane-Spokane Valley, WA Metropolitan Statistical Area (Spokane MSA (WA))">Spokane-Spokane Valley, WA Metropolitan Statistical Area</li>
                        <li data-state="Arizona" value="2160" title="Tucson, AZ Metropolitan Statistical Area (Tucson MSA (AZ))">Tucson, AZ Metropolitan Statistical Area</li> -->
                    </ul>
				</div>
			</div>
			<div class="arrow-left" data-aos="zoom-in-right" data-aos-duration="1500">
				<span class="arrow-set move-right"><i class="fa fa-angle-right"></i></span>
				<span class="arrow-set move-left"><i class="fa fa-angle-left"></i></span>
			</div>
			
			<div class="right"  data-aos="zoom-in-left" data-aos-duration="1500">
				<div class="counting">Count: <span id="cntMSA">[2]</span></div>
				<h5>Selected MSAs</h5>
				<div class="list-area">
					<ul id="selectmsalist" class="right-ul"><li data-state="Nevada" value="492" title="Las Vegas-Paradise, NV Metropolitan Statistical Area (Las Vegas MSA (NV))" class="">Las Vegas-Paradise, NV Metropolitan Statistical Area</li><li data-state="Nevada" value="488" title="Reno-Sparks, NV Metropolitan Statistical Area (Reno MSA (NV))" class="">Reno-Sparks, NV Metropolitan Statistical Area</li></ul>
				</div>
			</div>
                    <div class="arrow-right" data-aos="zoom-in-left" data-aos-duration="1500">
				<span class="arrow-set move-up"><i class="fa fa-angle-up"></i></span>
				<span class="arrow-set move-down"><i class="fa fa-angle-down"></i></span>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="btn-margin" data-aos="fade-up" data-aos-duration="2000">
        @csrf
			<a href="javascript:void(0);"><button class="btn" id="generate_report"  >Generate Report<i class="ms-2 fa fa-file-text"></i></button></a>
		</div>
		<div class="clear"></div>
	</section>
	<section class="home-inner" style="display:none;" id="comparison-report">
		<div><button class="btn" id="edit-msa"><i class="fa fa-angle-left"></i> BACK to location selector</button> Location Comparison Report</div>
		<!-- Table Start -->
		<div class="lcr-table">
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr id="head-profile"></tr>
				</thead>
				<tbody id="tbody-profile"></tbody>
			</table>
			<table cellpadding="0" cellspacing="0" border="0">
				<thead>
					<tr id="head-develop"></tr>
				</thead>
				<tbody id="tbody-develop"></tbody>
			</table>
		</div>
		<!-- Table End -->
		
		<div class="btn-margin">
            @csrf
			<button class="btn dwn-loc" type="pdf">Download report [PDF] <i class="ms-2 fa fa-file-pdf-o" aria-hidden="true"></i></button>
			<button class="btn dwn-loc" type="xls">Download Data [EXCEL] <i class="ms-2 fa fa-file-excel-o" aria-hidden="true"></i></button>
		</div>
		
		<!-- Notes Start -->
		<div class="notes-sec">
			<h4>Notes:</h4>
			<div class="notes-list">
				<ul>
					<li>Population: The Bureau of Economic Analysis (BEA) uses the Census Bureau's midyear (July 1) population estimates.</li>
					<li>Total Nonfarm Employment: The Current Employment Statistics (CES) survey utilizes payroll records and is designed to provide industry information on nonfarm wage and salary employment, average weekly hours and average hourly earnings for the nation, states and metropolitan areas. US Bureau of Labor Statistics.</li>
					<li>Labor Force: The concepts and definitions underlying LAUS data come from the Current Population Survey (CPS), the household survey that is the official measure of the labor force for the nation. US Bureau of Labor Statistics.</li>
					<li>Unemployment Rate: The concepts and definitions underlying LAUS data come from the Current Population Survey (CPS), the household survey that is the official measure of the labor force for the nation. US Bureau of Labor Statistics.</li>
					<li>Average Annual Wages - Private: Based on survey of covered employment. U.S. Bureau of Labor Statistics.</li>
					<li>Average Annual Wages - Manufacturing: Based on survey of covered employment. U.S. Bureau of Labor Statistics.</li>
					<li>Per Capita Personal Income: Per capita personal income is calculated as the personal income of the residents of a given area divided by the resident population of the area. In computing per capita personal income, BEA uses the Census Bureau's annual midyear population estimates. US Bureau of Economic Analysis.</li>
					<li>Workers Compensation Cost (per $100 in Payroll): Compensation costs based on a weighted statewide average index rate for all occupations. Specific rates will depend on the specific occupations employed. Oregon Department of Consumer and Business Services.</li>
					<li>Payroll Tax: Local and other imposed payroll tax, as reported by individual jurisdictions. ADP.</li>
					<li>Unemployment Insurance Tax (Max Rate): Rates apply only to experience rated employers and do not include non UI taxes, surtaxes, penalties, or surcharges. US Department of Labor - Employment &amp; Training Administration.</li>
					<li>Corporate Income Tax (Highest Bracket): An income tax is a government levy imposed on individuals or entities that varies with the income or profits of the taxpayer. Details vary widely by jurisdiction. Federation of Tax Administrators.</li>
					<li>Individual Income Tax Rate (Highest Bracket): An income tax is a government levy imposed on individuals or entities that varies with the income or profits of the taxpayer. Details vary widely by jurisdiction. Federation of Tax Administrators.</li>
					<li> Sales Tax Rate (State Minimum): Sales tax rates vary among districts within local jurisdictions and at the state-level. Tax Foundation.</li>
					<li>Property Tax Rate: Figures are mean effective property tax rates on owner-occupied housing (total real taxes paid / total home value). As a result, the data exclude property taxes paid by business men, renters, and others. Tax Foundation.</li>
					<li>Leasing Cost - Office: Rental rates refer to space available on the market. Rates are per square foot per month, quoted on full service gross for office. CBRE Quarterly Statistical Releases.</li>
					<li>Leasing Cost - Industrial: Rental rates refer to space available on the market. Rates are per square foot per month, quoted on a triple net basis for industrial. CBRE Quarterly Statistical Releases.</li>
					<li>Commercial Electric Rates (Per kWh): Average commercial price of electricity by select utility providers. U.S. Energy Information Administration.</li>
					<li>Industrial Electric Rates (Per kWh): Average industrial price of electricity by select utility providers. U.S. Energy Information Administration.</li>
					<li>Commercial Natural Gas Rates (Per 1000 cu ft.): Based on statewide average industrial prices. U.S. Energy Information Administration.</li>
					<li>Industrial Natural Gas Rates (Per 1000 cu ft.): Based on statewide average commercial prices. U.S. Energy Information Administration.</li>
					<li>Cost of Living Index (US=100): The index reflects cost differentials throughout geographical areas in the United States and is based on prices in different categories of consumer expenditures (e.g., housing, utilities, grocery, transportation, health care). The national average index value is 100. Council for Community &amp; Economic Research.</li>
				</ul>
			</div>
		</div>
		<!-- Notes End -->
		<div class="clear"></div>
	</section>
</section>

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<script>

	
</script>
@endsection

@endsection

