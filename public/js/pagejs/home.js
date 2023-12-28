  
am5.ready(function() {



    var root = am5.Root.new("chartdiv");
    root._logo.dispose();
    
    
    root.setThemes([
      am5themes_Animated.new(root)
    ]);
    
    
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
     
      paddingLeft: 0
    }));
    
    
    
    
    
    
    
    
    
    var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
      maxDeviation: 0.5,
      baseInterval: {
        timeUnit: "day",
        count: 1
      },
      renderer: am5xy.AxisRendererX.new(root, {
        minGridDistance: 80,
        
        pan: "zoom"
      }),
      tooltip: am5.Tooltip.new(root, {})
    }));
    
    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
      maxDeviation: 0,
      renderer: am5xy.AxisRendererY.new(root, {
        pan: "zoom",
        
      })
    }));
    root.interfaceColors.set("grid",);
    
    
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
      fillOpacity: 0.9
    });
    series.set("fill", am5.color("#8bbedf"));
    
    
    
    
    var chartdata = phpData;
    
    console.log(chartdata);
    
    
    
    // Disable x-axis and y-axis labels
    xAxis.set("renderer.labels.template.disabled", true);
    
    xAxis.set("visible", false);
    
    yAxis.set("renderer.labels.template.disabled", true);
    // yAxis.set("renderer.grid.template.strokeWidth" , 0);
    yAxis.set("visible", false);
     series.data.setAll(chartdata);
    
    
    
    
    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    // series.appear(1000);
    chart.appear(1000, 100);
    
    }); // end am5.ready()
    
    
    am5.ready(function() {
    
    var root3 = am5.Root.new("chartdiv3");
    root3._logo.dispose();
    
    
    
    root3.setThemes([
      am5themes_Animated.new(root3)
    ]);
    
    
    var chart3 = root3.container.children.push(am5xy.XYChart.new(root3, {
      paddingLeft: 0
    }));
    
    
    
    
    
    
    
    var xAxis3 = chart3.xAxes.push(am5xy.DateAxis.new(root3, {
      maxDeviation: 0.5,
      baseInterval: {
        timeUnit: "day",
        count: 1
      },
      renderer: am5xy.AxisRendererX.new(root3, {
    
        pan: "zoom"
      }),
      tooltip: am5.Tooltip.new(root3, {})
    }));
    
    var yAxis3 = chart3.yAxes.push(am5xy.ValueAxis.new(root3, {
    
      renderer: am5xy.AxisRendererY.new(root3, {
        pan: "zoom"
      })
    }));
    root3.interfaceColors.set("grid",);
    
    
    
    var series = chart3.series.push(am5xy.SmoothedXLineSeries.new(root3, {
      name: "Series",
      xAxis: xAxis3,
      yAxis: yAxis3,
      valueYField: "value",
      valueXField: "date",
      tooltip: am5.Tooltip.new(root3, {
        labelText: "{valueY}"
      })
    }));
    
    series.fills.template.setAll({
      visible: true,
      fillOpacity: 0.9
     
    });
    series.set("fill", am5.color("#8bbedf"));
    
    
    
    
    
    
    
    var chartdata = economicalchart;
    
    console.log(chartdata);
    
    xAxis3.set("renderer.labels.template.disabled", true);
    
    xAxis3.set("visible", false);
    
    yAxis3.set("renderer.labels.template.disabled", true);
    
    yAxis3.set("visible", false);
    
    
    
      series.data.setAll(chartdata);
      var overlay = chart3.plotContainer.children.push(am5.Rectangle.new(root3, {
        width: root3.innerWidth,
        height: root3.innerHeight,
        fillOpacity: 0 // Make it transparent
      }));
    
      chart3.get("background").set("fillOpacity", 0);
    
    
    series.appear(1000);
    chart3.appear(1000, 100);
    
    }); 
    
    am5.ready(function() {
    
    
    
    var root2 = am5.Root.new("chartdiv2");
    
    root2._logo.dispose();
    
    root2.setThemes([
      am5themes_Animated.new(root2)
    ]);
    
    
    var chart2 = root2.container.children.push(am5xy.XYChart.new(root2, {
      paddingLeft: 0
    }));
    
    
    var xAxis2 = chart2.xAxes.push(am5xy.DateAxis.new(root2, {
      maxDeviation: 0.5,
      baseInterval: {
        timeUnit: "day",
        count: 1
      },
      renderer: am5xy.AxisRendererX.new(root2, {
       
        pan: "zoom"
      }),
      tooltip: am5.Tooltip.new(root2, {})
    }));
    
    var yAxis2 = chart2.yAxes.push(am5xy.ValueAxis.new(root2, {
    
      renderer: am5xy.AxisRendererY.new(root2, {
        pan: "zoom"
      })
    }));
    root2.interfaceColors.set("grid",);
    
    var series = chart2.series.push(am5xy.SmoothedXLineSeries.new(root2, {
      name: "Series",
      xAxis: xAxis2,
      yAxis: yAxis2,
      valueYField: "value",
      valueXField: "date",
      tooltip: am5.Tooltip.new(root2, {
        labelText: "{valueY}"
      })
    }));
    
    series.fills.template.setAll({
      visible: true,
      fillOpacity: 0.9
    });
    
    series.set("fill", am5.color("#8bbedf"));
    
    chart2.set("disposable", true);
    
    
    
    
    
    
    var chartdata = spending ;
    
    console.log(chartdata);
    
    xAxis2.set("renderer.labels.template.disabled", true);
    
    xAxis2.set("visible", false);
    
    yAxis2.set("renderer.labels.template.disabled", true);
    
    
    yAxis2.set("visible", false);
    
    
    
      series.data.setAll(chartdata);
      var overlay = chart2.plotContainer.children.push(am5.Rectangle.new(root2, {
        width: root2.innerWidth,
        height: root2.innerHeight,
        fillOpacity: 1 ,
        strokeWidth :0
      }));
    
    
    xAxis.get("grid").set("disabled", true);
      chart2.get("background").set("strokeWidth", 0);
    
    
    series.appear(1000);
    chart2.appear(1000, 100);
    
    }); 