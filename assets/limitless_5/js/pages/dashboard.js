/* ------------------------------------------------------------------------------
 *
 *  # Dashboard configuration
 *
 *  Demo dashboard configuration. Contains charts and plugin inits
 *
 *  Version: 1.0
 *  Latest update: Aug 1, 2015
 *
 * ---------------------------------------------------------------------------- */

 $(function() {    

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = yyyy + '-' + mm + '-' + dd;

    var datatrans;

    $.ajax({
      type : 'GET',
      url : 'http://marketplace-kombas.com/Ajax/getweekoftrans/' + today,
      dataType: 'json',
      async: false,
      success: function (data) {
        datatrans = data;
    }
});


    // Switchery toggles
    // ------------------------------

    var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    switches.forEach(function(html) {
        var switchery = new Switchery(html, {color: '#4CAF50'});
    });





    


    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'assets/limitless_1/js/plugins/visualization/echarts'
        }
    });



    // Configuration
    // ------------------------------

    var user,seller,reseller;

    $.ajax({
        type : 'GET',
        url : 'http://marketplace-kombas.com/Ajax/gettotaluser',
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                user = data.user;
                seller = data.seller;
                reseller = data.reseller;
            }
        }
    });

    require(

        // Add necessary charts
        [
        'echarts',
        'echarts/theme/limitless',
        'echarts/chart/line',
        'echarts/chart/bar',
        'echarts/chart/pie',


        'echarts/chart/scatter',
        'echarts/chart/k',
        'echarts/chart/radar',
        'echarts/chart/gauge'
        ],



        // Charts setup
        function (ec, limitless) {


            // Initialize charts
            // ------------------------------

            var connect_pie = ec.init(document.getElementById('connect_pie'), limitless);
            var connect_column = ec.init(document.getElementById('connect_column'), limitless);




            // Charts options
            // ------------------------------


            //
            // Column and pie connection
            //



            // Pie options
            connect_pie_options = {

                // Add title
                title: {
                    text: 'Data User',
                    subtext: 'Data jumlah user yang terdaftar dalam database',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    x: 'left',
                    data: ['User','Seller','Reseller']
                },


                // Add toolbox
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    x: 'right', 
                    y: 35,
                    feature: {
                       saveAsImage: {
                        show: true,
                        title: 'Same as image',
                        lang: ['Save']
                    }
                }
            },

                // Enable drag recalculate
                // calculable: true,

                // Add series
                series: [{
                    name: 'Data',
                    type: 'pie',
                    radius: '75%',
                    center: ['50%', '57.5%'],
                    data: [
                    {value: user, name: 'User'},
                    {value: seller, name: 'Seller'},
                    {value: reseller, name: 'Reseller'},
                    // {value: 135, name: 'Firefox'},
                    // {value: 1548, name: 'Chrome'}
                    ]
                }],
            };

            // Column options
            connect_column_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 47,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },

                // Add legend
                // legend: {
                //     data: ['Chrome']
                // },

                // Add toolbox
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    x: 'right', 
                    y: 35,
                    feature: {
                        // mark: {
                        //     show: true,
                        //     title: {
                        //         mark: 'Markline switch',
                        //         markUndo: 'Undo markline',
                        //         markClear: 'Clear markline'
                        //     }
                        // },
                        magicType: {
                            show: true,
                            title: {
                                line: 'Switch to line chart',
                                bar: 'Switch to bar chart',
                                stack: 'Switch to stack',
                                tiled: 'Switch to tiled'
                            },
                            type: ['line', 'bar', 'stack', 'tiled']
                        },
                        // restore: {
                        //     show: true,
                        //     title: 'Restore'
                        // },
                        saveAsImage: {
                            show: true,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                // Enable drag recalculate
                // calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: [datatrans[0]['day'],datatrans[1]['day'],datatrans[2]['day'],datatrans[3]['day'],datatrans[4]['day'],datatrans[5]['day'],datatrans[6]['day']]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    splitArea: {show: true}
                }],

                // Add series
                series: [
                {
                    name: 'Total Transaksi',
                    type: 'bar',
                    stack: 'Total',
                    data: [datatrans[0]['value'], datatrans[1]['value'], datatrans[2]['value'], datatrans[3]['value'], datatrans[4]['value'], datatrans[5]['value'], datatrans[6]['value']]
                }
                ]
            };

            // // Connect charts
            // connect_pie.connect(connect_column);
            // connect_column.connect(connect_pie);

            // Apply options
            // ------------------------------
            
            connect_pie.setOption(connect_pie_options);
            connect_column.setOption(connect_column_options);


             // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    connect_pie.resize();
                    connect_column.resize();
                }, 200);
            }
        });

});
