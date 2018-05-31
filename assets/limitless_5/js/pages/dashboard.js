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


    // Switchery toggles
    // ------------------------------

    var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    switches.forEach(function(html) {
        var switchery = new Switchery(html, {color: '#4CAF50'});
    });




    // Daterange picker
    // ------------------------------

    $('.daterange-ranges').daterangepicker(
    {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2016',
        dateLimit: { days: 60 },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        applyClass: 'btn-small bg-slate-600 btn-block',
        cancelClass: 'btn-small btn-default btn-block',
        format: 'MM/DD/YYYY'
    },
    function(start, end) {
        $('.daterange-ranges span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
    }
    );

    $('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));




    // Traffic sources stream chart
    // ------------------------------

    trafficSources('#traffic-sources', 330); // initialize chart

    // Chart setup
    function trafficSources(element, height) {


        // Basic setup
        // ------------------------------

        // Define main variables
        var d3Container = d3.select(element),
        margin = {top: 5, right: 50, bottom: 40, left: 50},
        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
        height = height - margin.top - margin.bottom,
        tooltipOffset = 30;

        // Tooltip
        var tooltip = d3Container
        .append("div")
        .attr("class", "d3-tip e")
        .style("display", "none")

        // Format date
        var format = d3.time.format("%m/%d/%y %H:%M");
        var formatDate = d3.time.format("%H:%M");

        // Colors
        var colorrange = ['#03A9F4', '#29B6F6', '#4FC3F7', '#81D4FA', '#B3E5FC', '#E1F5FE'];



        // Construct scales
        // ------------------------------

        // Horizontal
        var x = d3.time.scale().range([0, width]);

        // Vertical
        var y = d3.scale.linear().range([height, 0]);

        // Colors
        var z = d3.scale.ordinal().range(colorrange);



        // Create axes
        // ------------------------------

        // Horizontal
        var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom")
        .ticks(d3.time.hours, 4)
        .innerTickSize(4)
        .tickPadding(8)
            .tickFormat(d3.time.format("%H:%M")); // Display hours and minutes in 24h format

        // Left vertical
        var yAxis = d3.svg.axis()
        .scale(y)
        .ticks(6)
        .innerTickSize(4)
        .outerTickSize(0)
        .tickPadding(8)
        .tickFormat(function (d) { return (d/1000) + "k"; });

        // Right vertical
        var yAxis2 = yAxis;

        // Dash lines
        var gridAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(6)
        .tickPadding(8)
        .tickFormat("")
        .tickSize(-width, 0, 0);



        // Create chart
        // ------------------------------

        // Container
        var container = d3Container.append("svg")

        // SVG element
        var svg = container
        .attr('width', width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



        // Construct chart layout
        // ------------------------------

        // Stack
        var stack = d3.layout.stack()
        .offset("silhouette")
        .values(function(d) { return d.values; })
        .x(function(d) { return d.date; })
        .y(function(d) { return d.value; });

        // Nest
        var nest = d3.nest()
        .key(function(d) { return d.key; });

        // Area
        var area = d3.svg.area()
        .interpolate("cardinal")
        .x(function(d) { return x(d.date); })
        .y0(function(d) { return y(d.y0); })
        .y1(function(d) { return y(d.y0 + d.y); });



        // Load data
        // ------------------------------

        d3.csv("assets/limitless_1/demo_data/dashboard/traffic_sources.csv", function (error, data) {

            // Pull out values
            data.forEach(function (d) {
                d.date = format.parse(d.date);
                d.value = +d.value;
            });

            // Stack and nest layers
            var layers = stack(nest.entries(data));



            // Set input domains
            // ------------------------------

            // Horizontal
            x.domain(d3.extent(data, function(d, i) { return d.date; }));

            // Vertical
            y.domain([0, d3.max(data, function(d) { return d.y0 + d.y; })]);



            // Add grid
            // ------------------------------

            // Horizontal grid. Must be before the group
            svg.append("g")
            .attr("class", "d3-grid-dashed")
            .call(gridAxis);



            //
            // Append chart elements
            //

            // Stream layers
            // ------------------------------

            // Create group
            var group = svg.append('g')
            .attr('class', 'streamgraph-layers-group');

            // And append paths to this group
            var layer = group.selectAll(".streamgraph-layer")
            .data(layers)
            .enter()
            .append("path")
            .attr("class", "streamgraph-layer")
            .attr("d", function(d) { return area(d.values); })                    
            .style('stroke', '#fff')
            .style('stroke-width', 0.5)
            .style("fill", function(d, i) { return z(i); });

            // Add transition
            var layerTransition = layer
            .style('opacity', 0)
            .transition()
            .duration(750)
            .delay(function(d, i) { return i * 50; })
            .style('opacity', 1)



            // Append axes
            // ------------------------------

            //
            // Left vertical
            //

            svg.append("g")
            .attr("class", "d3-axis d3-axis-left d3-axis-solid")
            .call(yAxis.orient("left"));

            // Hide first tick
            d3.select(svg.selectAll('.d3-axis-left .tick text')[0][0])
            .style("visibility", "hidden");


            //
            // Right vertical
            //

            svg.append("g")
            .attr("class", "d3-axis d3-axis-right d3-axis-solid")
            .attr("transform", "translate(" + width + ", 0)")
            .call(yAxis2.orient("right"));

            // Hide first tick
            d3.select(svg.selectAll('.d3-axis-right .tick text')[0][0])
            .style("visibility", "hidden");


            //
            // Horizontal
            //

            var xaxisg = svg.append("g")
            .attr("class", "d3-axis d3-axis-horizontal d3-axis-solid")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

            // Add extra subticks for hidden hours
            xaxisg.selectAll(".d3-axis-subticks")
            .data(x.ticks(d3.time.hours), function(d) { return d; })
            .enter()
            .append("line")
            .attr("class", "d3-axis-subticks")
            .attr("y1", 0)
            .attr("y2", 4)
            .attr("x1", x)
            .attr("x2", x);



            // Add hover line and pointer
            // ------------------------------

            // Append group to the group of paths to prevent appearance outside chart area
            var hoverLineGroup = group.append("g")
            .attr("class", "hover-line");

            // Add line
            var hoverLine = hoverLineGroup
            .append("line")
            .attr("y1", 0)
            .attr("y2", height)
            .style('fill', 'none')
            .style('stroke', '#fff')
            .style('stroke-width', 1)
            .style('pointer-events', 'none')
            .style('shape-rendering', 'crispEdges')
            .style("opacity", 0);

            // Add pointer
            var hoverPointer = hoverLineGroup
            .append("rect")
            .attr("x", 2)
            .attr("y", 2)
            .attr("width", 6)
            .attr("height", 6)
            .style('fill', '#03A9F4')
            .style('stroke', '#fff')
            .style('stroke-width', 1)
            .style('shape-rendering', 'crispEdges')
            .style('pointer-events', 'none')
            .style("opacity", 0);



            // Append events to the layers group
            // ------------------------------

            layerTransition.each("end", function() {
                layer
                .on("mouseover", function (d, i) {
                    svg.selectAll(".streamgraph-layer")
                    .transition()
                    .duration(250)
                    .style("opacity", function (d, j) {
                                return j != i ? 0.75 : 1; // Mute all except hovered
                            });
                })

                .on("mousemove", function (d, i) {
                    mouse = d3.mouse(this);
                    mousex = mouse[0];
                    mousey = mouse[1];
                    datearray = [];
                    var invertedx = x.invert(mousex);
                    invertedx = invertedx.getHours();
                    var selected = (d.values);
                    for (var k = 0; k < selected.length; k++) {
                        datearray[k] = selected[k].date
                        datearray[k] = datearray[k].getHours();
                    }
                    mousedate = datearray.indexOf(invertedx);
                    pro = d.values[mousedate].value;


                        // Display mouse pointer
                        hoverPointer
                        .attr("x", mousex - 3)
                        .attr("y", mousey - 6)
                        .style("opacity", 1);

                        hoverLine
                        .attr("x1", mousex)
                        .attr("x2", mousex)
                        .style("opacity", 1);

                        //
                        // Tooltip
                        //

                        // Tooltip data
                        tooltip.html(
                            "<ul class='list-unstyled mb-5'>" +
                            "<li>" + "<div class='text-size-base mt-5 mb-5'><i class='icon-circle-left2 position-left'></i>" + d.key + "</div>" + "</li>" +
                            "<li>" + "Visits: &nbsp;" + "<span class='text-semibold pull-right'>" + pro + "</span>" + "</li>" +
                            "<li>" + "Time: &nbsp; " + "<span class='text-semibold pull-right'>" + formatDate(d.values[mousedate].date) + "</span>" + "</li>" + 
                            "</ul>"
                            )
                        .style("display", "block");

                        // Tooltip arrow
                        tooltip.append('div').attr('class', 'd3-tip-arrow');
                    })

                .on("mouseout", function (d, i) {

                        // Revert full opacity to all paths
                        svg.selectAll(".streamgraph-layer")
                        .transition()
                        .duration(250)
                        .style("opacity", 1);

                        // Hide cursor pointer
                        hoverPointer.style("opacity", 0);

                        // Hide tooltip
                        tooltip.style("display", "none");

                        hoverLine.style("opacity", 0);
                    });
            });



            // Append events to the chart container
            // ------------------------------

            d3Container
            .on("mousemove", function (d, i) {
                mouse = d3.mouse(this);
                mousex = mouse[0];
                mousey = mouse[1];

                    // Display hover line
                        //.style("opacity", 1);


                    // Move tooltip vertically
                    tooltip.style("top", (mousey - ($('.d3-tip').outerHeight() / 2)) - 2 + "px") // Half tooltip height - half arrow width

                    // Move tooltip horizontally
                    if(mousex >= ($(element).outerWidth() - $('.d3-tip').outerWidth() - margin.right - (tooltipOffset * 2))) {
                        tooltip
                            .style("left", (mousex - $('.d3-tip').outerWidth() - tooltipOffset) + "px") // Change tooltip direction from right to left to keep it inside graph area
                            .attr("class", "d3-tip w");
                        }
                        else {
                            tooltip
                            .style("left", (mousex + tooltipOffset) + "px" )
                            .attr("class", "d3-tip e");
                        }
                    });
        });



        // Resize chart
        // ------------------------------

        // Call function on window resize
        $(window).on('resize', resizeStream);

        // Call function on sidebar width change
        $(document).on('click', '.sidebar-control', resizeStream);

        // Resize function
        // 
        // Since D3 doesn't support SVG resize by default,
        // we need to manually specify parts of the graph that need to 
        // be updated on window resize
        function resizeStream() {

            // Layout
            // -------------------------

            // Define width
            width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;

            // Main svg width
            container.attr("width", width + margin.left + margin.right);

            // Width of appended group
            svg.attr("width", width + margin.left + margin.right);

            // Horizontal range
            x.range([0, width]);


            // Chart elements
            // -------------------------

            // Horizontal axis
            svg.selectAll('.d3-axis-horizontal').call(xAxis);

            // Horizontal axis subticks
            svg.selectAll('.d3-axis-subticks').attr("x1", x).attr("x2", x);

            // Grid lines width
            svg.selectAll(".d3-grid-dashed").call(gridAxis.tickSize(-width, 0, 0))

            // Right vertical axis
            svg.selectAll(".d3-axis-right").attr("transform", "translate(" + width + ", 0)");

            // Area paths
            svg.selectAll('.streamgraph-layer').attr("d", function(d) { return area(d.values); });
        }
    }




    // App sales lines chart
    // ------------------------------

    appSalesLines('#app_sales', 255); // initialize chart

    // Chart setup
    function appSalesLines(element, height) {


        // Basic setup
        // ------------------------------

        // Define main variables
        var d3Container = d3.select(element),
        margin = {top: 5, right: 30, bottom: 30, left: 50},
        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
        height = height - margin.top - margin.bottom;

        // Tooltip
        var tooltip = d3.tip()
        .attr('class', 'd3-tip')
        .html(function (d) {
            return "<ul class='list-unstyled mb-5'>" +
            "<li>" + "<div class='text-size-base mt-5 mb-5'><i class='icon-circle-left2 position-left'></i>" + d.name + " app" + "</div>" + "</li>" +
            "<li>" + "Sales: &nbsp;" + "<span class='text-semibold pull-right'>" + d.value + "</span>" + "</li>" +
            "<li>" + "Revenue: &nbsp; " + "<span class='text-semibold pull-right'>" + "$" + (d.value * 25).toFixed(2) + "</span>" + "</li>" + 
            "</ul>";
        });

        // Format date
        var parseDate = d3.time.format("%Y/%m/%d").parse,
        formatDate = d3.time.format("%b %d, '%y");

        // Line colors
        var scale = ["#4CAF50", "#FF5722", "#5C6BC0"],
        color = d3.scale.ordinal().range(scale);



        // Create chart
        // ------------------------------

        // Container
        var container = d3Container.append('svg');

        // SVG element
        var svg = container
        .attr('width', width + margin.left + margin.right)
        .attr('height', height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
        .call(tooltip);



        // Add date range switcher
        // ------------------------------

        // Menu
        var menu = $("#select_date").multiselect({
            buttonClass: 'btn btn-link text-semibold',
            enableHTML: true,
            dropRight: true,
            onChange: function() { change(), $.uniform.update(); },
            buttonText: function (options, element) {
                var selected = '';
                options.each(function() {
                    selected += $(this).html() + ', ';
                });
                return '<span class="status-mark border-warning position-left"></span>' + selected.substr(0, selected.length -2);
            }
        });

        // Radios
        $(".multiselect-container input").uniform({ radioClass: 'choice' });



        // Load data
        // ------------------------------

        d3.csv("assets/limitless_1/demo_data/dashboard/app_sales.csv", function(error, data) {
            formatted = data;
            redraw();
        });



        // Construct layout
        // ------------------------------

        // Add events
        var altKey;
        d3.select(window)
        .on("keydown", function() { altKey = d3.event.altKey; })
        .on("keyup", function() { altKey = false; });
        
        // Set terms of transition on date change   
        function change() {
          d3.transition()
          .duration(altKey ? 7500 : 500)
          .each(redraw);
      }



        // Main chart drawing function
        // ------------------------------

        function redraw() { 

            // Construct chart layout
            // ------------------------------

            // Create data nests
            var nested = d3.nest()
            .key(function(d) { return d.type; })
            .map(formatted)
            
            // Get value from menu selection
            // the option values correspond
            //to the [type] value we used to nest the data  
            var series = menu.val();
            
            // Only retrieve data from the selected series using nest
            var data = nested[series];
            
            // For object constancy we will need to set "keys", one for each type of data (column name) exclude all others.
            color.domain(d3.keys(data[0]).filter(function(key) { return (key !== "date" && key !== "type"); }));

            // Setting up color map
            var linedata = color.domain().map(function(name) {
                return {
                    name: name,
                    values: data.map(function(d) {
                        return {name: name, date: parseDate(d.date), value: parseFloat(d[name], 10)};
                    })
                };
            });

            // Draw the line
            var line = d3.svg.line()
            .x(function(d) { return x(d.date); })
            .y(function(d) { return y(d.value); })
            .interpolate('cardinal');



            // Construct scales
            // ------------------------------

            // Horizontal
            var x = d3.time.scale()
            .domain([
                d3.min(linedata, function(c) { return d3.min(c.values, function(v) { return v.date; }); }),
                d3.max(linedata, function(c) { return d3.max(c.values, function(v) { return v.date; }); })
                ])
            .range([0, width]);

            // Vertical
            var y = d3.scale.linear()
            .domain([
                d3.min(linedata, function(c) { return d3.min(c.values, function(v) { return v.value; }); }),
                d3.max(linedata, function(c) { return d3.max(c.values, function(v) { return v.value; }); })
                ])
            .range([height, 0]);



            // Create axes
            // ------------------------------

            // Horizontal
            var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom")
            .tickPadding(8)
            .ticks(d3.time.days)
            .innerTickSize(4)
                .tickFormat(d3.time.format("%a")); // Display hours and minutes in 24h format

            // Vertical
            var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(6)
            .tickSize(0 -width)
            .tickPadding(8);
            


            //
            // Append chart elements
            //

            // Append axes
            // ------------------------------

            // Horizontal
            svg.append("g")
            .attr("class", "d3-axis d3-axis-horizontal d3-axis-solid")
            .attr("transform", "translate(0," + height + ")");

            // Vertical
            svg.append("g")
            .attr("class", "d3-axis d3-axis-vertical d3-axis-transparent");



            // Append lines
            // ------------------------------

            // Bind the data
            var lines = svg.selectAll(".lines")
            .data(linedata)
            
            // Append a group tag for each line
            var lineGroup = lines
            .enter()
            .append("g")
            .attr("class", "lines")
            .attr('id', function(d){ return d.name + "-line"; });

            // Append the line to the graph
            lineGroup.append("path")
            .attr("class", "d3-line d3-line-medium")
            .style("stroke", function(d) { return color(d.name); })
            .style('opacity', 0)
            .attr("d", function(d) { return line(d.values[0]); })
            .transition()
            .duration(500)
            .delay(function(d, i) { return i * 200; })
            .style('opacity', 1);
            


            // Append circles
            // ------------------------------

            var circles = lines.selectAll("circle")
            .data(function(d) { return d.values; })
            .enter()
            .append("circle")
            .attr("class", "d3-line-circle d3-line-circle-medium")
            .attr("cx", function(d,i){return x(d.date)})
            .attr("cy",function(d,i){return y(d.value)})
            .attr("r", 3)
            .style('fill', '#fff')
            .style("stroke", function(d) { return color(d.name); });

            // Add transition
            circles
            .style('opacity', 0)
            .transition()
            .duration(500)
            .delay(500)
            .style('opacity', 1);



            // Append tooltip
            // ------------------------------

            // Add tooltip on circle hover
            circles
            .on("mouseover", function (d) {
                tooltip.offset([-15, 0]).show(d);

                    // Animate circle radius
                    d3.select(this).transition().duration(250).attr('r', 4);
                })
            .on("mouseout", function (d) {
                tooltip.hide(d);

                    // Animate circle radius
                    d3.select(this).transition().duration(250).attr('r', 3);
                });

            // Change tooltip direction of first point
            // to always keep it inside chart, useful on mobiles
            lines.each(function (d) { 
                d3.select(d3.select(this).selectAll('circle')[0][0])
                .on("mouseover", function (d) {
                    tooltip.offset([0, 15]).direction('e').show(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 4);
                    })
                .on("mouseout", function (d) {
                    tooltip.direction('n').hide(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 3);
                    });
            })

            // Change tooltip direction of last point
            // to always keep it inside chart, useful on mobiles
            lines.each(function (d) { 
                d3.select(d3.select(this).selectAll('circle')[0][d3.select(this).selectAll('circle').size() - 1])
                .on("mouseover", function (d) {
                    tooltip.offset([0, -15]).direction('w').show(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 4);
                    })
                .on("mouseout", function (d) {
                    tooltip.direction('n').hide(d);

                        // Animate circle radius
                        d3.select(this).transition().duration(250).attr('r', 3);
                    })
            })



            // Update chart on date change
            // ------------------------------

            // Set variable for updating visualization
            var lineUpdate = d3.transition(lines);
            
            // Update lines
            lineUpdate.select("path")
            .attr("d", function(d, i) { return line(d.values); });

            // Update circles
            lineUpdate.selectAll("circle")
            .attr("cy",function(d,i){return y(d.value)})
            .attr("cx", function(d,i){return x(d.date)});

            // Update vertical axes
            d3.transition(svg)
            .select(".d3-axis-vertical")
            .call(yAxis);   

            // Update horizontal axes
            d3.transition(svg)
            .select(".d3-axis-horizontal")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);



            // Resize chart
            // ------------------------------

            // Call function on window resize
            $(window).on('resize', appSalesResize);

            // Call function on sidebar width change
            $(document).on('click', '.sidebar-control', appSalesResize);

            // Resize function
            // 
            // Since D3 doesn't support SVG resize by default,
            // we need to manually specify parts of the graph that need to 
            // be updated on window resize
            function appSalesResize() {

                // Layout
                // -------------------------

                // Define width
                width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;

                // Main svg width
                container.attr("width", width + margin.left + margin.right);

                // Width of appended group
                svg.attr("width", width + margin.left + margin.right);

                // Horizontal range
                x.range([0, width]);

                // Vertical range
                y.range([height, 0]);


                // Chart elements
                // -------------------------

                // Horizontal axis
                svg.select('.d3-axis-horizontal').call(xAxis);

                // Vertical axis
                svg.select('.d3-axis-vertical').call(yAxis.tickSize(0-width));

                // Lines
                svg.selectAll('.d3-line').attr("d", function(d, i) { return line(d.values); });

                // Circles
                svg.selectAll('.d3-line-circle').attr("cx", function(d,i){return x(d.date)})
            }
        }
    }


    // Monthly app sales area chart
    // ------------------------------

    monthlySalesArea("#monthly-sales-stats", 100, '#4DB6AC'); // initialize chart

    // Chart setup
    function monthlySalesArea(element, height, color) {


        // Basic setup
        // ------------------------------

        // Define main variables
        var d3Container = d3.select(element),
        margin = {top: 20, right: 35, bottom: 40, left: 35},
        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
        height = height - margin.top - margin.bottom;

        // Date and time format
        var parseDate = d3.time.format( '%Y-%m-%d' ).parse,
        bisectDate = d3.bisector(function(d) { return d.date; }).left,
        formatDate = d3.time.format("%b %d");



        // Create SVG
        // ------------------------------

        // Container
        var container = d3Container.append('svg');

        // SVG element
        var svg = container
        .attr('width', width + margin.left + margin.right)
        .attr('height', height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")



        // Construct chart layout
        // ------------------------------

        // Area
        var area = d3.svg.area()
        .x(function(d) { return x(d.date); })
        .y0(height)
        .y1(function(d) { return y(d.value); })
        .interpolate('monotone')


        // Construct scales
        // ------------------------------

        // Horizontal
        var x = d3.time.scale().range([0, width ]);

        // Vertical
        var y = d3.scale.linear().range([height, 0]);


        // Create axes
        // ------------------------------

        // Horizontal
        var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom")
        .ticks(d3.time.days, 6)
        .innerTickSize(4)
        .tickPadding(8)
        .tickFormat(d3.time.format("%b %d"));


        // Load data
        // ------------------------------

        d3.json("assets/limitless_1/demo_data/dashboard/monthly_sales.json", function (error, data) {

            // Show what's wrong if error
            if (error) return console.error(error);

            // Pull out values
            data.forEach(function (d) {
                d.date = parseDate(d.date);
                d.value = +d.value;
            });

            // Get the maximum value in the given array
            var maxY = d3.max(data, function(d) { return d.value; });

            // Reset start data for animation
            var startData = data.map(function(datum) {
                return {
                    date: datum.date,
                    value: 0
                };
            });


            // Set input domains
            // ------------------------------

            // Horizontal
            x.domain(d3.extent(data, function(d, i) { return d.date; }));

            // Vertical
            y.domain([0, d3.max( data, function(d) { return d.value; })]);



            //
            // Append chart elements
            //

            // Append axes
            // -------------------------

            // Horizontal
            var horizontalAxis = svg.append("g")
            .attr("class", "d3-axis d3-axis-horizontal d3-axis-solid")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

            // Add extra subticks for hidden hours
            horizontalAxis.selectAll(".d3-axis-subticks")
            .data(x.ticks(d3.time.days), function(d) { return d; })
            .enter()
            .append("line")
            .attr("class", "d3-axis-subticks")
            .attr("y1", 0)
            .attr("y2", 4)
            .attr("x1", x)
            .attr("x2", x);



            // Append area
            // -------------------------

            // Add area path
            svg.append("path")
            .datum(data)
            .attr("class", "d3-area")
            .attr("d", area)
            .style('fill', color)
                .transition() // begin animation
                .duration(1000)
                .attrTween('d', function() {
                    var interpolator = d3.interpolateArray(startData, data);
                    return function (t) {
                        return area(interpolator (t));
                    }
                });



            // Append crosshair and tooltip
            // -------------------------

            //
            // Line
            //

            // Line group
            var focusLine = svg.append("g")
            .attr("class", "d3-crosshair-line")
            .style("display", "none");

            // Line element
            focusLine.append("line")
            .attr("class", "vertical-crosshair")
            .attr("y1", 0)
            .attr("y2", -maxY)
            .style("stroke", "#e5e5e5")
            .style('shape-rendering', 'crispEdges')


            //
            // Pointer
            //

            // Pointer group
            var focusPointer = svg.append("g")
            .attr("class", "d3-crosshair-pointer")
            .style("display", "none");

            // Pointer element
            focusPointer.append("circle")
            .attr("r", 3)
            .style("fill", "#fff")
            .style('stroke', color)
            .style('stroke-width', 1)


            //
            // Text
            //

            // Text group
            var focusText = svg.append("g")
            .attr("class", "d3-crosshair-text")
            .style("display", "none");

            // Text element
            focusText.append("text")
            .attr("dy", -10)
            .style('font-size', 12);


            //
            // Overlay with events
            //

            svg.append("rect")
            .attr("class", "d3-crosshair-overlay")
            .style('fill', 'none')
            .style('pointer-events', 'all')
            .attr("width", width)
            .attr("height", height)
            .on("mouseover", function() {
                focusPointer.style("display", null);        
                focusLine.style("display", null)
                focusText.style("display", null);
            })
            .on("mouseout", function() {
                focusPointer.style("display", "none"); 
                focusLine.style("display", "none");
                focusText.style("display", "none");
            })
            .on("mousemove", mousemove);


            // Display tooltip on mousemove
            function mousemove() {

                // Define main variables
                var mouse = d3.mouse(this),
                mousex = mouse[0],
                mousey = mouse[1],
                x0 = x.invert(mousex),
                i = bisectDate(data, x0),
                d0 = data[i - 1],
                d1 = data[i],
                d = x0 - d0.date > d1.date - x0 ? d1 : d0;

                // Move line
                focusLine.attr("transform", "translate(" + x(d.date) + "," + height + ")");

                // Move pointer
                focusPointer.attr("transform", "translate(" + x(d.date) + "," + y(d.value) + ")");

                // Reverse tooltip at the end point
                if(mousex >= (d3Container.node().getBoundingClientRect().width - focusText.select('text').node().getBoundingClientRect().width - margin.right - margin.left)) {
                    focusText.select("text").attr('text-anchor', 'end').attr("x", function () { return (x(d.date) - 15) + "px" }).text(formatDate(d.date) + " - " + d.value + " sales");
                }
                else {
                    focusText.select("text").attr('text-anchor', 'start').attr("x", function () { return (x(d.date) + 15) + "px" }).text(formatDate(d.date) + " - " + d.value + " sales");
                }
            }



            // Resize chart
            // ------------------------------

            // Call function on window resize
            $(window).on('resize', monthlySalesAreaResize);

            // Call function on sidebar width change
            $(document).on('click', '.sidebar-control', monthlySalesAreaResize);

            // Resize function
            // 
            // Since D3 doesn't support SVG resize by default,
            // we need to manually specify parts of the graph that need to 
            // be updated on window resize
            function monthlySalesAreaResize() {

                // Layout variables
                width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;


                // Layout
                // -------------------------

                // Main svg width
                container.attr("width", width + margin.left + margin.right);

                // Width of appended group
                svg.attr("width", width + margin.left + margin.right);


                // Axes
                // -------------------------

                // Horizontal range
                x.range([0, width]);

                // Horizontal axis
                svg.selectAll('.d3-axis-horizontal').call(xAxis);

                // Horizontal axis subticks
                svg.selectAll('.d3-axis-subticks').attr("x1", x).attr("x2", x);


                // Chart elements
                // -------------------------

                // Area path
                svg.selectAll('.d3-area').datum( data ).attr("d", area);

                // Crosshair
                svg.selectAll('.d3-crosshair-overlay').attr("width", width);
            }
        });
}

     // Sparklines
    // ------------------------------

    // Initialize chart
    sparkline("#new-visitors", "line", 30, 35, "basis", 750, 2000, "#26A69A");
    sparkline("#new-sessions", "line", 30, 35, "basis", 750, 2000, "#FF7043");
    sparkline("#total-online", "line", 30, 35, "basis", 750, 2000, "#5C6BC0");
    // sparkline("#server-load", "area", 30, 50, "basis", 750, 2000, "rgba(255,255,255,0.5)");

    // Chart setup
    function sparkline(element, chartType, qty, height, interpolation, duration, interval, color) {


        // Basic setup
        // ------------------------------

        // Define main variables
        var d3Container = d3.select(element),
        margin = {top: 0, right: 0, bottom: 0, left: 0},
        width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
        height = height - margin.top - margin.bottom;


        // Generate random data (for demo only)
        var data = [];
        for (var i=0; i < qty; i++) {
            data.push(Math.floor(Math.random() * qty) + 5)
        }



        // Construct scales
        // ------------------------------

        // Horizontal
        var x = d3.scale.linear().range([0, width]);

        // Vertical
        var y = d3.scale.linear().range([height - 5, 5]);



        // Set input domains
        // ------------------------------

        // Horizontal
        x.domain([1, qty - 3])

        // Vertical
        y.domain([0, qty])
        


        // Construct chart layout
        // ------------------------------

        // Line
        var line = d3.svg.line()
        .interpolate(interpolation)
        .x(function(d, i) { return x(i); })
        .y(function(d, i) { return y(d); });

        // Area
        var area = d3.svg.area()
        .interpolate(interpolation)
        .x(function(d,i) { 
            return x(i); 
        })
        .y0(height)
        .y1(function(d) { 
            return y(d); 
        });



        // Create SVG
        // ------------------------------

        // Container
        var container = d3Container.append('svg');

        // SVG element
        var svg = container
        .attr('width', width + margin.left + margin.right)
        .attr('height', height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



        // Add mask for animation
        // ------------------------------

        // Add clip path
        var clip = svg.append("defs")
        .append("clipPath")
        .attr('id', function(d, i) { return "load-clip-" + element.substring(1) })

        // Add clip shape
        var clips = clip.append("rect")
        .attr('class', 'load-clip')
        .attr("width", 0)
        .attr("height", height);

        // Animate mask
        clips
        .transition()
        .duration(1000)
        .ease('linear')
        .attr("width", width);



        //
        // Append chart elements
        //

        // Main path
        var path = svg.append("g")
        .attr("clip-path", function(d, i) { return "url(#load-clip-" + element.substring(1) + ")"})
        .append("path")
        .datum(data)
        .attr("transform", "translate(" + x(0) + ",0)");

        // Add path based on chart type
        if(chartType == "area") {
            path.attr("d", area).attr('class', 'd3-area').style("fill", color); // area
        }
        else {
            path.attr("d", line).attr("class", "d3-line d3-line-medium").style('stroke', color); // line
        }

        // Animate path
        path
        .style('opacity', 0)
        .transition()
        .duration(750)
        .style('opacity', 1);



        // Set update interval. For demo only
        // ------------------------------

        setInterval(function() {

            // push a new data point onto the back
            data.push(Math.floor(Math.random() * qty) + 5);

            // pop the old data point off the front
            data.shift();

            update();

        }, interval);



        // Update random data. For demo only
        // ------------------------------

        function update() {

            // Redraw the path and slide it to the left
            path
            .attr("transform", null)
            .transition()
            .duration(duration)
            .ease("linear")
            .attr("transform", "translate(" + x(0) + ",0)");

            // Update path type
            if(chartType == "area") {
                path.attr("d", area).attr('class', 'd3-area').style("fill", color)
            }
            else {
                path.attr("d", line).attr("class", "d3-line d3-line-medium").style('stroke', color);
            }
        }



        // Resize chart
        // ------------------------------

        // Call function on window resize
        $(window).on('resize', resizeSparklines);

        // Call function on sidebar width change
        $(document).on('click', '.sidebar-control', resizeSparklines);

        // Resize function
        // 
        // Since D3 doesn't support SVG resize by default,
        // we need to manually specify parts of the graph that need to 
        // be updated on window resize
        function resizeSparklines() {

            // Layout variables
            width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;


            // Layout
            // -------------------------

            // Main svg width
            container.attr("width", width + margin.left + margin.right);

            // Width of appended group
            svg.attr("width", width + margin.left + margin.right);

            // Horizontal range
            x.range([0, width]);


            // Chart elements
            // -------------------------

            // Clip mask
            clips.attr("width", width);

            // Line
            svg.select(".d3-line").attr("d", line);

            // Area
            svg.select(".d3-area").attr("d", area);
        }
    }





















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
                    text: 'Data Jumlah User Terdaftar',
                    // subtext: 'Open source data',
                    x: 'center'
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
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
                    name: 'User',
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
                legend: {
                    data: ['Internet Explorer','Opera','Safari','Firefox','Chrome']
                },

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
                    data: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    splitArea: {show: true}
                }],

                // Add series
                series: [
                {
                    name: 'Internet Explorer',
                    type: 'bar',
                    stack: 'Total',
                    data: [320, 332, 301, 334, 390, 330, 320]
                },
                {
                    name: 'Opera',
                    type: 'bar',
                    stack: 'Total',
                    data: [120, 132, 101, 134, 90, 230, 210]
                },
                {
                    name: 'Safari',
                    type: 'bar',
                    stack: 'Total',
                    data: [220, 182, 191, 234, 290, 330, 310]
                },
                {
                    name: 'Firefox',
                    type: 'bar',
                    stack: 'Total',
                    data: [150, 232, 201, 154, 190, 330, 410]
                },
                {
                    name: 'Chrome',
                    type: 'bar',
                    stack: 'Total',
                    data: [820, 932, 901, 934, 1290, 1330, 1320]
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
