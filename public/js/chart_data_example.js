// REAL TIME DATA GENERATOR
/*
 * Real-time data generators for the example graphs in the documentation section.
 */
(function() {

    /*
     * Class for generating real-time data for the area, line, and bar plots.
     */
    var RealTimeData = function(layers) {
        this.layers = layers;
        this.timestamp = ((new Date()).getTime() / 1000)|0;
    };

    RealTimeData.prototype.rand = function() {
        return parseInt(Math.random() * 100) + 50;
    };

    RealTimeData.prototype.history = function(entries) {
        if (typeof(entries) != 'number' || !entries) {
            entries = 60;
        }

        var history = [];
        for (var k = 0; k < this.layers; k++) {
            history.push({ values: [] });
        }

        for (var i = 0; i < entries; i++) {
            for (var j = 0; j < this.layers; j++) {
                history[j].values.push({time: this.timestamp, y: this.rand()});
            }
            this.timestamp++;
        }

        return history;
    };

    RealTimeData.prototype.next = function() {
        var entry = [];
        for (var i = 0; i < this.layers; i++) {
            entry.push({ time: this.timestamp, y: this.rand() });
        }
        this.timestamp++;
        return entry;
    }

    window.RealTimeData = RealTimeData;


    /*
     * Gauge Data Generator.
     */
    var GaugeData = function() {};

    GaugeData.prototype.next = function() {
        return Math.random();
    };

    window.GaugeData = GaugeData;



    /*
     * Heatmap Data Generator.
     */

    var HeatmapData = function(layers) {
        this.layers = layers;
        this.timestamp = ((new Date()).getTime() / 1000)|0;
    };
    
    window.normal = function() {
        var U = Math.random(),
            V = Math.random();
        return Math.sqrt(-2*Math.log(U)) * Math.cos(2*Math.PI*V);
    };

    HeatmapData.prototype.rand = function() {
        var histogram = {};

        for (var i = 0; i < 1000; i ++) {
            var r = parseInt(normal() * 12.5 + 50);
            if (!histogram[r]) {
                histogram[r] = 1;
            }
            else {
                histogram[r]++;
            }
        }

        return histogram;
    };

    HeatmapData.prototype.history = function(entries) {
        if (typeof(entries) != 'number' || !entries) {
            entries = 60;
        }

        var history = [];
        for (var k = 0; k < this.layers; k++) {
            history.push({ values: [] });
        }

        for (var i = 0; i < entries; i++) {
            for (var j = 0; j < this.layers; j++) {
                history[j].values.push({time: this.timestamp, histogram: this.rand()});
            }
            this.timestamp++;
        }

        return history;
    };

    HeatmapData.prototype.next = function() {
        var entry = [];
        for (var i = 0; i < this.layers; i++) {
            entry.push({ time: this.timestamp, histogram: this.rand() });
        }
        this.timestamp++;
        return entry;
    }

    window.HeatmapData = HeatmapData;


})();


var chartData = {};

chartData['barchart_demo'] = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "",
            fillColor: "rgba(84, 121, 170, 0.5)",
            strokeColor: "rgba(84, 121, 170, 0.8)",
            highlightFill: "rgba(84, 121, 170, 0.5)",
            highlightStroke: "rgba(84, 121, 170, 0.5)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "",
            fillColor: "rgba(78, 78, 78, 0.5)",
            strokeColor: "rgba(78, 78, 78, 0.8)",
            highlightFill: "rgba(78, 78, 78, 0.5)",
            highlightStroke: "rgba(78, 78, 78, 0.5)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};

chartData['linechart_demo'] = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "",
            fillColor: "rgba(84, 121, 170, 0.5)",
            strokeColor: "rgba(84, 121, 170, 0.8)",
            pointColor: "rgba(84, 121, 170, 1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(84, 121, 170, 0.5)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "",
            fillColor: "rgba(117, 176, 69, 0.5)",
            strokeColor: "rgba(117, 176, 69, 0.8)",
            pointColor: "rgba(117, 176, 69, 1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(117, 176, 69, 0.5)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};

chartData['radarchart_demo'] = {
    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(84, 121, 170, 0.5)",
            strokeColor: "rgba(84, 121, 170, 0.8)",
            pointColor: "rgba(84, 121, 170, 1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(84, 121, 170, 1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(117, 176, 69, 0.5)",
            strokeColor: "rgba(117, 176, 69, 0.8)",
            pointColor: "rgba(117, 176, 69, 1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(117, 176, 69, 1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
    ]
};

chartData['polarareachart_demo'] = [
    {
        value: 300,
        color:"rgba(84, 121, 170, 0.6)",
        highlight: "rgba(84, 121, 170, 0.8)",
        label: "Blue"
    },
    {
        value: 50,
        color: "rgba(117, 176, 69, 0.6)",
        highlight: "rgba(117, 176, 69, 0.8)",
        label: "Green"
    },
    {
        value: 100,
        color: "rgba(189, 81, 81, 0.6)",
        highlight: "rgba(189, 81, 81, 0.8)",
        label: "Red"
    },
    {
        value: 40,
        color: "rgba(78, 78, 78, 0.6)",
        highlight: "rgba(78, 78, 78, 0.8)",
        label: "Grey"
    },
    {
        value: 120,
        color: "rgba(187, 96, 150, 0.6)",
        highlight: "rgba(187, 96, 150, 0.8)",
        label: "Purple"
    }

];

chartData['piechart_demo'] = [
    {
        value: 300,
        color:"rgba(84, 121, 170, 0.6)",
        highlight: "rgba(84, 121, 170, 0.8)",
        label: "Blue"
    },
    {
        value: 50,
        color: "rgba(117, 176, 69, 0.6)",
        highlight: "rgba(117, 176, 69, 0.8)",
        label: "Green"
    },
    {
        value: 100,
        color: "rgba(78, 78, 78, 0.6)",
        highlight: "rgba(78, 78, 78, 0.8)",
        label: "Yellow"
    }
]


/////////////////////
// CHARTS ///////////
/////////////////////
jQuery(document).ready(function() {

    Chart.defaults.global = {
        animation: true,
        animationSteps: 60,
        animationEasing: "easeOutQuart",
        showScale: true,
        scaleOverride: false,
        scaleSteps: null,
        scaleStepWidth: null,
        scaleStartValue: null,
        scaleLineColor: "rgba(0,0,0,0.05)",
        scaleLineWidth: 1,
        scaleShowLabels: true,
        scaleLabel: "<%=value%>",
        scaleIntegersOnly: true,
        scaleBeginAtZero: false,
        scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
        scaleFontSize: 12,
        scaleFontStyle: "normal",
        scaleFontColor: "rgba(0,0,0,0.2)",
        responsive: true,
        maintainAspectRatio: true,
        showTooltips: true,
        customTooltips: false,
        tooltipEvents: ["mousemove", "touchstart", "touchmove"],
        tooltipFillColor: "#1a2a42",
        tooltipFontFamily: "'Open Sans', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
        tooltipFontSize: 12,
        tooltipFontStyle: "normal",
        tooltipFontColor: "#fff",
        tooltipTitleFontFamily: "'Open Sans', 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
        tooltipTitleFontSize: 12,
        tooltipTitleFontStyle: "normal",
        tooltipTitleFontColor: "#fff",
        tooltipYPadding: 6,
        tooltipXPadding: 6,
        tooltipCaretSize: 8,
        tooltipCornerRadius: 2,
        tooltipXOffset: 10,
        tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
        multiTooltipTemplate: "<%= value %>",

        onAnimationProgress: function(){},
        onAnimationComplete: function(){}
    }

    jQuery('.bar-chart').each(function() {
        var options = {
            barShowStroke : false,
            barStrokeWidth : 2,
            barValueSpacing : 6,
            barDatasetSpacing : 2
        }
        var data = jQuery(this).attr('cr-data');
        var ctx = jQuery(this).get(0).getContext("2d");
        var crBarChart = new Chart(ctx).Bar(chartData[data], options);
    });

    jQuery('.line-chart').each(function() {
        var options = {
        }

        var data = jQuery(this).attr('cr-data');
        var ctx = jQuery(this).get(0).getContext("2d");
        var crLineChart = new Chart(ctx).Line(chartData[data], options);
    });

    jQuery('.radar-chart').each(function() {
        var options = {
        }

        var data = jQuery(this).attr('cr-data');
        var ctx = jQuery(this).get(0).getContext("2d");
        var myRadarChart = new Chart(ctx).Radar(chartData[data], options);
    });

    jQuery('.polararea-chart').each(function() {
        var options = {
        }

        var data = jQuery(this).attr('cr-data');
        var ctx = jQuery(this).get(0).getContext("2d");
        var myPolarAreaChart = new Chart(ctx).PolarArea(chartData[data], options);
    });

    jQuery('.pie-chart').each(function() {
        var options = {
        }

        var data = jQuery(this).attr('cr-data');
        var ctx = jQuery(this).get(0).getContext("2d");
        var myPieChart = new Chart(ctx).Pie(chartData[data],options);
    });

    jQuery('.doughnut-chart').each(function() {
        var options = {
        }

        var data = jQuery(this).attr('cr-data');
        var ctx = jQuery(this).get(0).getContext("2d");
        var myDoughnutChart = new Chart(ctx).Doughnut(chartData[data],options);
    });

    if (jQuery('#morris-line-example').length > 0) {
        Morris.Line({
          element: 'morris-line-example',
          data: [
            { y: '2006', a: 100, b: 90 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
          ],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Series A', 'Series B'],
          lineColors: ['rgba(84, 121, 170, 0.6)', 'rgba(117, 176, 69, 0.6)']
        });
    }

    if (jQuery('#morris-bar-example').length > 0) {
        Morris.Bar({
          element: 'morris-bar-example',
          data: [
            { y: '2006', a: 100, b: 90 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
          ],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Series A', 'Series B'],
          barColors: ['rgba(78, 78, 78, 0.6)', 'rgba(84, 121, 170, 0.6)']
        });
    }

    if (jQuery('#morris-donut-example').length > 0) {
        Morris.Donut({
          element: 'morris-donut-example',
          data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
          ],
          colors: ['rgba(84, 121, 170, 0.6)', 'rgba(117, 176, 69, 0.6)', 'rgba(78, 78, 78, 0.6)']
        });
    }


    jQuery('.inlinesparkline').sparkline('html', { type:'line' });
    jQuery('.inlinebarsparkline').sparkline('html', { type:'bar' });
    jQuery('.discretechart').sparkline('html', { type:'discrete' });
    jQuery('.inlinepiesparkline').sparkline('html', { type:'pie' });

    

    
    

    jQuery("span.peity-pie").peity("pie")
    jQuery("span.peity-donut").peity("donut")
    jQuery("span.peity-line").peity("line")
    jQuery("span.peity-bar").peity("bar")
    var updatingChart = jQuery(".peity-updating-chart").peity("line", { width: 64 })

    setInterval(function() {
      var random = Math.round(Math.random() * 10)
      var values = updatingChart.text().split(",")
      values.shift()
      values.push(random)

      updatingChart
        .text(values.join(","))
        .change()
    }, 1000)



    $('#quote-carousel').carousel({
        pause: true,
        interval: 4000,
      });



    // EPOCH examples
    var values = [];

    var data1 = [
        {label: 'Cos', values: []},
        {label: 'Sin', values: []}
    ];

    var data2 = [
        {label: 'Sqrt', values: []},
        {label: 'Cbrt', values: []},
        {label: '4th', values: []}
    ];

    for (var i = 0; i <= 128; i++) {
        var x = 4 * Math.PI * (i / 128);
        data1[0].values.push({x: x, y: Math.cos(x) + 1});
        data1[1].values.push({x: x, y: Math.sin(x) + 1});

        var x2 = 20 * (i / 128);
        data2[0].values.push({x: x2, y: Math.sqrt(x2)});
        data2[1].values.push({x: x2, y: Math.pow(x2, (1/3)) });
        data2[2].values.push({x: x2, y: Math.pow(x2, (1/4)) });
    }

    var data = [data1, data2];

    var area = $('#basic-area-example').epoch({
        type: 'area',
        data: data1,
        axes: ['bottom', 'left', 'right']
    });

    $('.basic-area-data').on('click', function(e) {
        e.preventDefault();

        $('.basic-area-data').removeClass('active');
        $(e.target).addClass('active');
        var index = parseInt($(e.target).attr('data-value'));
        area.setData(data[index]);
        area.draw();
    });

    // bubbles

    var DATA_LENGTH = 24;

    var data2 = [
        { label: 'A', values: [] },
        { label: 'B', values: [] }
    ];

    for (var i = 0; i < DATA_LENGTH; i++) {
        for (var j = 0; j < data2.length; j++) {
            data2[j].values.push({ x: (Math.random() * 1000), y: (Math.random() * 200), r: Math.random()*15 + 1 });
        }
    }

    var chart = $('#basic-bubble-example').epoch({
        type: 'scatter',
        data: data2,
        axes: ['top', 'bottom', 'left', 'right']
    });

    // Real time epoch

    var data3 = new RealTimeData(3);

    var chart = $('#real-time-bar').epoch({
        type: 'time.bar',
        data: data3.history(),
        axes: ['left', 'bottom', 'right']
    });

    setInterval(function() { chart.push(data3.next()); }, 1000);
    chart.push(data3.next());

    // line

    var data4 = new RealTimeData(2);

    var chart2 = $('#real-time-line').epoch({
        type: 'time.line',
        data: data4.history(),
        axes: ['left', 'bottom', 'right']
    });

    setInterval(function() { chart2.push(data4.next()); }, 1000);
    chart2.push(data4.next())
});