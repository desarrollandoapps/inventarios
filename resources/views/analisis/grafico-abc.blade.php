@extends('layouts.admin')

@section('hidden-search')
    hidden
@endsection

@section('main-content')
    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $item)
                    <li> {{$item}} </li>
                @endforeach
            </ul>    
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif
    
    <div class="float-right mr-5">
        <a href="{{route('abc.export.excel')}} " class="exportar-excel" data-toggle="tooltip" data-placement="left" title="Exportar a Excel">
            <i class="fas fa-fw fa-file-excel fa-2x"></i>
        </a>        
    </div>

    <h3 class="mb-3">{{ __('ABC Graph') }}</h3>

    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        //////////////////
        //   Chart code
        /////////////////
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_material);
        am4core.useTheme(am4themes_animated);
        // Themes end

        //preparación de datos
        var productos = @json($productos);
        var vlrTotal = @json($vlrTotal).vlrTotal;
        var valores = [];
        var labels = [];
        var jsonProd = [];
        var acumulado = 0;

        productos.forEach(p => {
            jsonProd.push({ country: p.descripcion, visits: p.valor });
        });
        /////////

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

        // Add data
        chart.data = [];
        for(var i = 0; i < jsonProd.length; i++)
        {
            chart.data.push(jsonProd[i]);
        }

        prepareParetoData();

        function prepareParetoData(){
            var total = 0;

            for(var i = 0; i < chart.data.length; i++){
                var value = chart.data[i].visits;
                total += value;
            }

            var sum = 0;
            for(var i = 0; i < chart.data.length; i++){
                var value = chart.data[i].visits;
                sum += value;   
                chart.data[i].pareto = sum / total * 100;
            }    
        }

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 60;
        categoryAxis.tooltip.disabled = false;
        var label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.truncate = true;
        label.maxWidth = 80;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;
        valueAxis.min = 0;
        valueAxis.cursorTooltipEnabled = false;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        // on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
        return chart.colors.getIndex(target.dataItem.index);
        })


        var paretoValueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        paretoValueAxis.renderer.opposite = true;
        paretoValueAxis.min = 0;
        paretoValueAxis.max = 100;
        paretoValueAxis.strictMinMax = true;
        paretoValueAxis.renderer.grid.template.disabled = true;
        paretoValueAxis.numberFormatter = new am4core.NumberFormatter();
        paretoValueAxis.numberFormatter.numberFormat = "#'%'"
        paretoValueAxis.cursorTooltipEnabled = false;

        var paretoSeries = chart.series.push(new am4charts.LineSeries())
        paretoSeries.dataFields.valueY = "pareto";
        paretoSeries.dataFields.categoryX = "country";
        paretoSeries.yAxis = paretoValueAxis;
        paretoSeries.tooltipText = "pareto: {valueY.formatNumber('#.0')}%[/]";
        paretoSeries.bullets.push(new am4charts.CircleBullet());
        paretoSeries.strokeWidth = 2;
        paretoSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
        paretoSeries.strokeOpacity = 0.5;

        // Cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "panX";

        });
    </script>
    
    <div class="row">
        <div class="col-12">
            {{-- <canvas id="myChart" width="100%" height="50%"></canvas> --}}
            <div id="chartdiv"></div>
        </div>
    </div>

@endsection
