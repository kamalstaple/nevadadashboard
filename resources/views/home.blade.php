@extends('layouts.contents')
@section('section')

@php
$population =json_decode($data[0]['data'])->data[0];
$economical =json_decode($data[0]['data'])->data[1];
$spending =json_decode($data[0]['data'])->data[2];




$populationchart = [];

foreach ($population->trendList as $chartdata) {
  $value = (float)preg_replace('/[^0-9.]/', '', $chartdata->f_value);
    $timestamp = new DateTime($chartdata->date);
    $timestamp = $timestamp->getTimestamp() * 1000;
    $populationchart[] = ['date' => $timestamp, 'value' => $value ];
}
$economicalchart = [];

foreach ($economical->trendList as $chartdata) {
  $value = (float)preg_replace('/[^0-9.]/', '', $chartdata->f_value);
    $timestamp = new DateTime($chartdata->date);
    $timestamp = $timestamp->getTimestamp() * 1000;
    $economicalchart[] = ['date' => $timestamp, 'value' => $value ];
}
$spendingchart = [];

foreach ($spending->trendList as $chartdata) {
  $value = (float)preg_replace('/[^0-9.]/', '', $chartdata->f_value);
    $timestamp = new DateTime($chartdata->date);
    $timestamp = $timestamp->getTimestamp() * 1000;
    $spendingchart[] = ['date' => $timestamp, 'value' => $value ];
}







@endphp

   <section class="nevada_dashboard_tabs_section pt-3 pb-5">
    <div class="custom_container">
      <div class="row nevada_economic_highlights">
        <div class="col-lg-4" data-aos="fade-right" data-aos-duration="2000">
           <div class="text_block">
              <h3>Nevada Dashboard</h3>
              <p>Welcome to the Nevada Governor’s Office of Economic Development (GOED) data portal. 
                  <br/>
                  <br/>
                  This page provides useful data and links to<br> get information about Nevada’s economy<br> and its consumers. Click on any of the <br>counties on the map to the right to get<br> information on population, employment, <br>spending and other key market metrics.</p>
           </div>
        </div>
        <div class="col-lg-8" data-aos="fade-left" data-aos-duration="3000">
        <div class="right_nevada_economic">
          <h4>Nevada Economic Highlights</h4>
          <div class="row">
           <div class="col-md-4">
             <div class="economic_cards population" id="chartdiv">
                <img src="{{asset('images/population.png')}}" alt="icon" class="card_icon">
                <span class="economic_type">{{$population->Name}}</span>
                <?php 
                 $cleaned_value = preg_replace("/[0-9]+/", "", $population->valueformated);
                 $cleaned_value = str_replace("$", "", $cleaned_value);
                 $cleaned_value = str_replace(".", " ", $cleaned_value);
                 ?>
                <h5 class="economic_number">{{ number_format(preg_replace("/[A-Za-z]+/", "",$population->valueformated), 1)}}<span>{{$cleaned_value}}</span></h5>
                
                
                <span class="economic_year">{{$population->Date}}</span>
                <div class="bottom_details">
                  <div class="prior_click">
                       <div class="arrow arrow_up">
                          <img src="{{asset('images/arrow.png')}}" alt="">
                          <span>+{{$population->prior}}</span>
                       </div>
                       <p class="text-center mb-0">vs. prior period</p>
                      </div>
                       <div class="prior_list">
                        <span class="remove_list"><i class="fa fa-times" aria-hidden="true"></i></span>
                         <ul>
                          @foreach($population->trendList as $trend)
                          <li class="label_unit">
                            <span class="year">{{$trend->F_Date}}</span>
                            <b class="unit">{{$trend->f_value}}</b>
                          </li>
                          @endforeach
                         
                         </ul>
                       </div>
                </div>
             </div>
           </div>
           <div class="col-md-4">
              <div class="economic_cards employment" id="chartdiv2">
                 <img src="{{asset('images/employment.png')}}" alt="icon" class="card_icon">
                 <span class="economic_type">{{$economical->Name}}</span>
                 <?php 
                 $cleaned_value = preg_replace("/[0-9]+/", "", $economical->valueformated);
                 $cleaned_value = str_replace("$", "", $cleaned_value);
                 $cleaned_value = str_replace(".", " ", $cleaned_value);
                 ?>
                <h5 class="economic_number">{{number_format(preg_replace("/[A-Za-z]+/", "", $economical->valueformated),1)}}<span>{{$cleaned_value}}</span></h5>
                
                <span class="economic_year">{{$economical->Date}}</span>
                 <div class="bottom_details">
                  <div class="prior_click">
                        <div class="arrow  arrow_down">
                           <img src="{{asset('images/arrow.png')}}" alt="">
                           <span>+{{$economical->prior}}</span>
                        </div>
                        <p class="text-center mb-0">vs. prior period</p>
                        </div>
                        
                        <div class="prior_list">
                          <span class="remove_list"><i class="fa fa-times" aria-hidden="true"></i></span>
                           <ul>
                           @foreach($economical->trendList as $trend)
                          <li class="label_unit">
                            <span class="year">{{$trend->F_Date}}</span>
                            <b class="unit">{{$trend->f_value}}</b>
                          </li>
                          @endforeach
                         
                           </ul>
                         </div>
                 </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="economic_cards spending" id="chartdiv3">
                 <img src="{{asset('images/spending.png')}}" alt="icon" class="card_icon">
                 <span class="economic_type">{{$spending->Name}}</span>
                 <?php 
                 $cleaned_value = preg_replace("/[0-9]+/", "", $spending->valueformated);
                 $cleaned_value = str_replace("$", "", $cleaned_value);
                 $cleaned_value = str_replace(".", " ", $cleaned_value);
                 ?>
                <h5 class="economic_number">{{preg_replace("/[A-Za-z]+/", "", $spending->valueformated)}}<span>{{$cleaned_value}}</span></h5>
                <span class="economic_year">{{$spending->Date}}</span>
                 <div class="bottom_details">
                  <div class="prior_click">
                        <div class="arrow arrow_up arrow_down">
                           <span class="dot_circle">.</span>
                           <span>{{$spending->prior}}</span>

                        </div>
                        <p class="text-center mb-0">vs. prior period</p>
                  </div>
                        <div class="prior_list">
                          <span class="remove_list"><i class="fa fa-times" aria-hidden="true"></i></span>
                           <ul>
                           @foreach($spending->trendList as $trend)
                          <li class="label_unit">
                            <span class="year">{{$trend->F_Date}}</span>
                            <b class="unit">{{$trend->f_value}}</b>
                          </li>
                          @endforeach
                            
                           </ul>
                         </div>
                 </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>  
    </div>
   </section>

   <section class="nevada_dynamic_data_map" id ="portal-home">
    <div class="custom_container" >
      <div class="row align-items-center">
      <div class="col-md-6" data-aos="zoom-in-down" data-aos-duration="2000">
     <div class="text_block">
       <h4>Nevada Dynamic Data Map</h4>
       <p>Select on a county on the map above to access key market metrics <br> or click <a href="{{route('/statewide',['city'=>'Nevada' ,'Name'=>'Nevada'])}}" class="link_here">here</a> to obtain data for the entire state.</p>
     </div>
      </div>
      <div class="col-md-6 map-area" data-aos="zoom-in-left" data-aos-duration="3000">
         <div class="dynamic_data_map text-end" id="cityMap">
         <meta name="csrf-token" content="{{ csrf_token() }}">
      <img src="{{asset('images/map.png')}}" class="img-fluid" alt="map">
         </div>
      </div>
      </div>
    </div>
   </section>

   @endsection
   @section('script')
   <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
    
    var phpData = JSON.parse('<?php echo json_encode($populationchart); ?>'); 
    var economicalchart  =JSON.parse('<?php echo json_encode($economicalchart); ?>');
     var spending = JSON.parse('<?php echo json_encode($spendingchart); ?>');

    
</script>

<script src="{{asset('/js/pagejs/home.js')}}"></script>

   
   @endsection
 