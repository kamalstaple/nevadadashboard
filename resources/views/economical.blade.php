@extends('layouts.contents')
@section('headerlinks')
<link  rel="stylesheet" href="{{asset('css/style2.css')}}"> 
@endsection

@php
$economy_develop =json_decode($economic[0]['data']);
$labour =json_decode($economic[1]['data']);
$real_state =json_decode($economic[2]['data']);
$utilities =json_decode($economic[3]['data']);
$taxes =json_decode($economic[4]['data']);







@endphp
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
			@csrf
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
                    <tbody id="economy-table-tbody">
    @foreach($economy_develop->data as $val)
        @if(isset($val->living_cost) && is_array($val->living_cost))
            @php $firstRow = true; @endphp
            @foreach($val->living_cost as $living)
                <tr>
                    <td>{{$firstRow ? $val->Name : ''}}</td>
                    <td>{{$firstRow ? $val->population : ''}}</td>
                    <td>{{$firstRow ? $val->income : ''}}</td>
                    <td>{{$firstRow ? $val->degree : ''}}</td>
                    <td>{{$firstRow ? $val->gross : ''}}</td>
                    <td>{{$firstRow ? $val->gross_capita : ''}}</td>
                    <td>{{key($living)}}</td>
                    <td>{{current($living)}}</td>
                </tr>
                @php $firstRow = false; @endphp
            @endforeach
        @else
            <tr>
                <td>{{$val->Name ?? ''}}</td>
                <td>{{$val->population ?? ''}}</td>
                <td>{{$val->income ?? ''}}</td>
                <td>{{$val->degree ?? ''}}</td>
                <td>{{$val->gross ?? ''}}</td>
                <td>{{$val->gross_capita ?? ''}}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        @endif
    @endforeach
</tbody>

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
					<tbody id="labor-table-tbody">
                        @foreach($labour->data as $labor)
                    <tr>
                    <td>{{$labor->total_nonfarm->Name ?? 'n.a'}}</td>
                    <td>{{$labor->total_nonfarm->Value ?? 'n.a'}}</td>
                    <td>{{$labor->total_nonfarm->Date ?? 'n.a'}}</td>
                    <td>{{$labor->total_nonfarm->LastYear ?? 'n.a'}}<i class="fa {{$labor->total_nonfarm->sign ?? 'n.a'}}"></i></td>
                    <td>{{$labor->weekly->Value ?? 'n.a'}}</td>
                    <td>{{$labor->weekly->Date ?? 'n.a'}}</td>
                    <td>{{$labor->weekly->LastYear ?? 'n.a'}}<i class="fa {{$labor->weekly->sign ?? 'n.a'}}"></i></td>
                    <td>{{$labor->pri_business->Value ?? 'n.a'}}</td>
                    <td>{{$labor->pri_business->Date ?? 'n.a'}}</td>
                    <td>{{$labor->pri_business->LastYear ?? 'n.a'}}<i class="fa {{$labor->pri_business->sign ?? 'n.a'}}"></i></td>
                    <td>{{$labor->unemployment->Value ?? 'n.a'}}</td>
                    <td>{{$labor->unemployment->Date ?? 'n.a'}}</td>
                    <td>{{$labor->unemployment->LastYear ?? 'n.a'}}<i class="fa {{$labor->unemployment->sign ?? 'n.a'}}"></i></td>
                </tr>
                @endforeach
        </tbody>
                    
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
					<tbody id="real-estate-table-tbody">
                        @foreach($real_state->data as $real_state)
                    <tr>
                    <td>{{$real_state->Loc ?? ''}}</td>
                    <td>{{$real_state->Geo ?? 'n.a'}}</td>
                    <td>{{$real_state->office->Value ?? 'n.a'}}</td>
                    <td>{{$real_state->office->Date ?? 'n.a'}}</td>
                    <td>{{$real_state->office->LastYear ?? 'n.a'}} <i class="fa {{$real_state->office->sign ?? 'n.a'}}"></i></td>
                    <td>{{$real_state->industrial->Value ?? 'n.a'}}</td>
                    <td>{{$real_state->industrial->Date ?? 'n.a'}}</td>
                    <td>{{$real_state->industrial->LastYear ?? 'n.a'}} <i class="fa {{$real_state->industrial->sign ?? 'n.a'}}"></i></td>
                    <td>{{$real_state->existing->Value ?? 'n.a'}}</td>
                    <td>{{$real_state->existing->Date ?? 'n.a'}}</td>
                    <td>{{$real_state->existing->LastYear ?? 'n.a'}} <i class="fa {{$real_state->existing->sign ?? 'n.a'}}"></i></td>
                    <tr>
                    <td></td>
                    <!-- <td>Northern Nevada</td>
                    <td>$1.96</td>
                    <td>Q4 2022</td>
                    <td>0.0% <i class="fa fa-circle yellow"></i></td>
                    <td>$0.91</td>
                    <td>Q4 2022</td>
                    <td>54.2% <i class="fa fa-caret-up green"></i></td>
                    <td>$608.00K</td>
                    <td>Q3 2023</td>
                    <td>2.9% <i class="fa fa-caret-up green"></i></td> -->
                </tr>
                @endforeach
                </tr>
</tbody>
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
					<tbody id="utilities-table-tbody">
                        @foreach($utilities->data as $utilitie)
                    <tr>
                    <td>{{$utilitie->Loc ??''}}</td>
                    <td>{{$utilitie->ind_elec->Value ??''}}</td>
                    <td>{{$utilitie->ind_elec->Date ??''}}</td>
                    <td>{{$utilitie->ind_elec->LastYear ??''}}<i class="fa {{$utilitie->ind_elec->sign ??''}}"></i></td>
                    <td>{{$utilitie->com_elec->Value ??''}}</td>
                    <td>{{$utilitie->com_elec->Date ??''}}</td>
                    <td>{{$utilitie->com_elec->LastYear ??''}}<i class="fa {{$utilitie->com_elec->sign ??''}}"></i></td>
                    <td>{{$utilitie->ind_nat->Value ??''}}</td>
                    <td>{{$utilitie->ind_nat->Date ??''}}</td>
                    <td>{{$utilitie->ind_nat->LastYear ??''}}<i class="fa {{$utilitie->ind_nat->sign ??''}}"></i></td>
                    <td>{{$utilitie->com_nat->Value ??''}}</td>
                    <td>{{$utilitie->com_nat->Date ??''}}</td>
                    <td>{{$utilitie->com_nat->LastYear ??''}}<i class="fa {{$utilitie->com_nat->sign ??''}}"></i></td>
                </tr>
                @endforeach
</tbody>
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
					<tbody id="taxes-table-tbody">
                        @foreach($taxes->data as $tax)
                    <tr>
                    <td>{{$tax->Loc ?? ''}}</td>
                    <td>{{$tax->sales->Value ?? ''}}</td>
                    <td>{{$tax->sales->Date ?? ''}}</td>
                    <td>{{$tax->sales->LastYear ?? ''}} <i class="fa {{$tax->sales->sign ?? ''}}"></i></td>
                    <td>{{$tax->individual->Value ?? ''}}</td>
                    <td>{{$tax->individual->Date ?? ''}}</td>
                    <td>{{$tax->individual->LastYear ?? ''}} <i class="fa {{$tax->individual->sign ?? ''}}"></i></td>
                    <td>{{$tax->corporate->Value ?? ''}}</td>
                    <td>{{$tax->corporate->Date ?? ''}}</td>
                    <td>{{$tax->corporate->LastYear ?? ''}} <i class="fa {{$tax->corporate->sign ?? ''}}"></i></td>
                </tr>
                @endforeach
</tbody>
				</table>			
			</div>
			<!-- Tabke End -->		
		</div>
		<div class="clear"></div>			
	</section>
</section>
@endsection