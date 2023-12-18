@extends('layouts.contents')
@section('section')


   <section class="nevada_dashboard_tabs_section pt-3 pb-5">
    <div class="custom_container">
      <div class="row nevada_economic_highlights">
        <div class="col-lg-4">
           <div class="text_block">
              <h3>Nevada Dashboard</h3>
              <p>Welcome to the Nevada Governor’s Office of Economic Development (GOED) data portal. 
                  <br/>
                  <br/>
                  This page provides useful data and links to get information about Nevada’s economy and its consumers. Click on any of the counties on the map to the right to get information on population, employment, spending and other key market metrics.</p>
           </div>
        </div>
        <div class="col-lg-8">
        <div class="right_nevada_economic">
          <h4>Nevada Economic Highlights</h4>
          <div class="row">
           <div class="col-md-4">
             <div class="economic_cards population">
                <img src="{{asset('images/population.png')}}" alt="icon" class="card_icon">
                <span class="economic_type">Population</span>
                <h5 class="economic_number">2.8 M</h5>
                <span class="economic_year">2014</span>
                <div class="bottom_details">
                  <div class="prior_click">
                       <div class="arrow arrow_up">
                          <img src="{{asset('images/arrow.png')}}" alt="">
                          <span>+1.5%</span>
                       </div>
                       <p class="text-center mb-0">vs. prior period</p>
                      </div>
                       <div class="prior_list">
                        <span class="remove_list">x</span>
                         <ul>
                          <li class="label_unit">
                            <span class="year">2006</span>
                            <b class="unit">2.50 M</b>
                          </li>
                          <li class="label_unit">
                            <span class="year">2007</span>
                            <b class="unit">2.50 M</b>
                          </li>
                          <li class="label_unit">
                            <span class="year">2008</span>
                            <b class="unit">2.50 M</b>
                          </li>
                          <li class="label_unit">
                            <span class="year">2009</span>
                            <b class="unit">2.50 M</b>
                          </li>
                         </ul>
                       </div>
                </div>
             </div>
           </div>
           <div class="col-md-4">
              <div class="economic_cards employment">
                 <img src="{{asset('images/employment.png')}}" alt="icon" class="card_icon">
                 <span class="economic_type">Employment</span>
                 <h5 class="economic_number">2.8 M</h5>
                 <span class="economic_year">2014</span>
                 <div class="bottom_details">
                  <div class="prior_click">
                        <div class="arrow  arrow_down">
                           <img src="{{asset('images/arrow.png')}}" alt="">
                           <span>+1.5%</span>
                        </div>
                        <p class="text-center mb-0">vs. prior period</p>
                        </div>
                        
                        <div class="prior_list">
                          <span class="remove_list">x</span>
                           <ul>
                            <li class="label_unit">
                              <span class="year">2006</span>
                              <b class="unit">2.50 M</b>
                            </li>
                            <li class="label_unit">
                              <span class="year">2007</span>
                              <b class="unit">2.50 M</b>
                            </li>
                            <li class="label_unit">
                              <span class="year">2008</span>
                              <b class="unit">2.50 M</b>
                            </li>
                            <li class="label_unit">
                              <span class="year">2009</span>
                              <b class="unit">2.50 M</b>
                            </li>
                           </ul>
                         </div>
                 </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="economic_cards spending">
                 <img src="{{asset('images/spending.png')}}" alt="icon" class="card_icon">
                 <span class="economic_type">Spending</span>
                 <h5 class="economic_number">2.8 M</h5>
                 <span class="economic_year">2014</span>
                 <div class="bottom_details">
                  <div class="prior_click">
                        <div class="arrow arrow_up arrow_down">
                           <span class="dot_circle">.</span>
                           <span>+1.5%</span>
                        </div>
                        <p class="text-center mb-0">vs. prior period</p>
                  </div>
                        <div class="prior_list">
                          <span class="remove_list">x</span>
                           <ul>
                            <li class="label_unit">
                              <span class="year">2006</span>
                              <b class="unit">2.50 M</b>
                            </li>
                            <li class="label_unit">
                              <span class="year">2007</span>
                              <b class="unit">2.50 M</b>
                            </li>
                            <li class="label_unit">
                              <span class="year">2008</span>
                              <b class="unit">2.50 M</b>
                            </li>
                            <li class="label_unit">
                              <span class="year">2009</span>
                              <b class="unit">2.50 M</b>
                            </li>
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

   <section class="nevada_dynamic_data_map">
    <div class="custom_container" >
      <div class="row align-items-center">
      <div class="col-md-6">
     <div class="text_block">
       <h4>Nevada Dynamic Data Map</h4>
       <p>Select on a county on the map above to access key market metrics or click <a href="#" class="link_here">here</a> to obtain data for the entire state.</p>
     </div>
      </div>
      <div class="col-md-6">
         <div class="dynamic_data_map text-end">
      <img src="{{asset('images/map.png')}}" class="img-fluid" alt="map">
         </div>
      </div>
      </div>
    </div>
   </section>

   @endsection
 