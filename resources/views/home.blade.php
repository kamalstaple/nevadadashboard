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
                  This page provides useful data and links to get information about Nevada’s economy and its consumers. Click on any of the counties on the map to the right to get information on population, employment, spending and other key market metrics.</p>
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
                <h5 class="economic_number">{{$population->valueformated}}</h5>
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
                        <span class="remove_list">x</span>
                         <ul>
                          @foreach($population->trendList as $trend)
                          <li class="label_unit">
                            <span class="year">{{$trend->F_Date}}</span>
                            <b class="unit">{{$trend->f_value}}</b>
                          </li>
                          @endforeach
                          <!-- <li class="label_unit">
                            <span class="year">2007</span>
                            <b class="unit">2.50 M</b>
                          </li> -->
                          <!-- <li class="label_unit">
                            <span class="year">2008</span>
                            <b class="unit">2.50 M</b>
                          </li> -->
                          <!-- <li class="label_unit">
                            <span class="year">2009</span>
                            <b class="unit">2.50 M</b>
                          </li> -->
                         </ul>
                       </div>
                </div>
             </div>
           </div>
           <div class="col-md-4">
              <div class="economic_cards employment" id="chartdiv2">
                 <img src="{{asset('images/employment.png')}}" alt="icon" class="card_icon">
                 <span class="economic_type">{{$economical->Name}}</span>
                <h5 class="economic_number">{{$economical->valueformated}}</h5>
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
                          <span class="remove_list">x</span>
                           <ul>
                           @foreach($economical->trendList as $trend)
                          <li class="label_unit">
                            <span class="year">{{$trend->F_Date}}</span>
                            <b class="unit">{{$trend->f_value}}</b>
                          </li>
                          @endforeach
                            <!-- <li class="label_unit">
                              <span class="year">2007</span>
                              <b class="unit">2.50 M</b>
                            </li> -->
                            <!-- <li class="label_unit">
                              <span class="year">2008</span>
                              <b class="unit">2.50 M</b>
                            </li> -->
                            <!-- <li class="label_unit">
                              <span class="year">2009</span>
                              <b class="unit">2.50 M</b>
                            </li> -->
                           </ul>
                         </div>
                 </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="economic_cards spending" id="chartdiv3">
                 <img src="{{asset('images/spending.png')}}" alt="icon" class="card_icon">
                 <span class="economic_type">{{$spending->Name}}</span>
                <h5 class="economic_number">{{$spending->valueformated}}</h5>
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
                          <span class="remove_list">x</span>
                           <ul>
                           @foreach($spending->trendList as $trend)
                          <li class="label_unit">
                            <span class="year">{{$trend->F_Date}}</span>
                            <b class="unit">{{$trend->f_value}}</b>
                          </li>
                          @endforeach
                            <!-- <li class="label_unit">
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
                            </li> -->
                            <!-- <li class="label_unit">
                              <span class="year">2009</span>
                              <b class="unit">2.50 M</b>
                            </li> -->
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
       <p>Select on a county on the map above to access key market metrics or click <a href="{{route('/statewide',['city'=>'Nevada' ,'Name'=>'Nevada'])}}" class="link_here">here</a> to obtain data for the entire state.</p>
     </div>
      </div>
      <div class="col-md-6 map-area" data-aos="zoom-in-left" data-aos-duration="3000">
         <div class="dynamic_data_map text-end" id="cityMap">
         <meta name="csrf-token" content="{{ csrf_token() }}">
      <img src="{{asset('images/map-img.jpg')}}" class="img-fluid" alt="map">
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

<!-- Chart code -->
<script>

am5.ready(function() {


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");
// root.htmlElement.classList.add("your-class-name");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
 
  paddingLeft: 0
}));

// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "none"
}));
// cursor.lineY.set("visible", false);


// Generate random data
var date = new Date();
date.setHours(0, 0, 0, 0);
var value = 100;

function generateData() {
  value = Math.round((Math.random() * 10 - 5) + value);
  am5.time.add(date, "day", 1);
  return {
    date: date.getTime(),
    value: value
  };
}

function generateDatas(count) {
  var data = [];
  for (var i = 0; i < count; ++i) {
    data.push(generateData());
  }
  console.log(data);
  return data;
}


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0.5,
  baseInterval: {
    timeUnit: "day",
    count: 1
  },
  renderer: am5xy.AxisRendererX.new(root, {
    minGridDistance: 80,
    // minorGridEnabled: true,
    pan: "zoom"
  }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 1,
  renderer: am5xy.AxisRendererY.new(root, {
    pan: "zoom"
  })
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
  name: "Series",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  valueXField: "date",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  })
}));

series.fills.template.setAll({
  visible: true,
  fillOpacity: 0.7
});

// series.bullets.push(function () {
//   return am5.Bullet.new(root, {
//     locationY: 0,
//     sprite: am5.Circle.new(root, {
//       radius: 4,
//       stroke: root.interfaceColors.get("background"),
//       strokeWidth: 2,
//       fill: series.get("fill")
//     })
//   });
// });


// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
// chart.set("scrollbarX", am5.Scrollbar.new(root, {
//   orientation: "horizontal"
// }));

var chartdata = JSON.parse('<?php echo json_encode($populationchart); ?>');

console.log(chartdata);
// var data = generateDatas(50);


// Disable x-axis and y-axis labels
xAxis.set("renderer.labels.template.disabled", true);
xAxis.set("renderer.grid.template.disabled", true);
xAxis.set("visible", false);

yAxis.set("renderer.labels.template.disabled", true);
yAxis.set("renderer.grid.template.disabled", true);
yAxis.set("visible", false);


  series.data.setAll(chartdata);




// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
// series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>
   

<script>

am5.ready(function() {


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv3");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {

  paddingLeft: 0
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "none"
}));
cursor.lineY.set("visible", false);


// Generate random data
var date = new Date();
date.setHours(0, 0, 0, 0);
var value = 100;

function generateData() {
  value = Math.round((Math.random() * 10 - 5) + value);
  am5.time.add(date, "day", 1);
  return {
    date: date.getTime(),
    value: value
  };
}

function generateDatas(count) {
  var data = [];
  for (var i = 0; i < count; ++i) {
    data.push(generateData());
  }
  return data;
}


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0.5,
  baseInterval: {
    timeUnit: "day",
    count: 1
  },
  renderer: am5xy.AxisRendererX.new(root, {
    // minGridDistance: 80,
    // minorGridEnabled: true,
    pan: "zoom"
  }),
  tooltip: am5.Tooltip.new(root, {})
}));
// xAxis.get("renderer.grid.template").set("disabled", true);
var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  // maxDeviation: 1,
  renderer: am5xy.AxisRendererY.new(root, {
    pan: "zoom"
  })
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
  name: "Series",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  valueXField: "date",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  })
}));

series.fills.template.setAll({
  visible: true,
  fillOpacity: 0.7
});

// series.bullets.push(function () {
//   return am5.Bullet.new(root, {
//     locationY: 0,
//     sprite: am5.Circle.new(root, {
//       radius: 4,
//       stroke: root.interfaceColors.get("background"),
//       strokeWidth: 2,
//       fill: series.get("fill")
//     })
//   });
// });


// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
// chart.set("scrollbarX", am5.Scrollbar.new(root, {
//   orientation: "horizontal"
// }));



var chartdata = JSON.parse('<?php echo json_encode($economicalchart); ?>');

console.log(chartdata);
// var data = generateDatas(50);
xAxis.set("renderer.labels.template.disabled", true);
xAxis.set("renderer.grid.template.strokeWidth ", 0);
xAxis.set("visible", false);

yAxis.set("renderer.labels.template.disabled", true);
yAxis.set("renderer.grid.template.strokeWidth ", 0);
yAxis.set("visible", false);

  series.data.setAll(chartdata);



// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>
<script>

am5.ready(function() {


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv2");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {

  paddingLeft: 0
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "none"
}));
cursor.lineY.set("visible", false);


// Generate random data
var date = new Date();
date.setHours(0, 0, 0, 0);
var value = 100;

function generateData() {
  value = Math.round((Math.random() * 10 - 5) + value);
  am5.time.add(date, "day", 1);
  return {
    date: date.getTime(),
    value: value
  };
}

function generateDatas(count) {
  var data = [];
  for (var i = 0; i < count; ++i) {
    data.push(generateData());
  }
  return data;
}


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0.5,
  baseInterval: {
    timeUnit: "day",
    count: 1
  },
  renderer: am5xy.AxisRendererX.new(root, {
    minGridDistance: 80,
    // minorGridEnabled: true,
    pan: "zoom"
  }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 1,
  renderer: am5xy.AxisRendererY.new(root, {
    pan: "zoom"
  })
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
  name: "Series",
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  valueXField: "date",
  tooltip: am5.Tooltip.new(root, {
    labelText: "{valueY}"
  })
}));

series.fills.template.setAll({
  visible: true,
  fillOpacity: 0.7
});

// series.bullets.push(function () {
//   return am5.Bullet.new(root, {
//     locationY: 0,
//     sprite: am5.Circle.new(root, {
//       radius: 4,
//       stroke: root.interfaceColors.get("background"),
//       strokeWidth: 2,
//       fill: series.get("fill")
//     })
//   });
// });


// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
// chart.set("scrollbarX", am5.Scrollbar.new(root, {
//   orientation: "horizontal"
// }));


var chartdata = JSON.parse('<?php echo json_encode($spendingchart); ?>');

console.log(chartdata);
// var data = generateDatas(50);
xAxis.set("renderer.labels.template.disabled", true);
xAxis.set("renderer.grid.template.disabled", true);
xAxis.set("visible", false);

yAxis.set("renderer.labels.template.disabled", true);
yAxis.set("renderer.grid.template.disabled", true);
yAxis.set("visible", false);


  series.data.setAll(chartdata);



// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>

   
   @endsection
 