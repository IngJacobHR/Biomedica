@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @include('workorders._nav')
                <div class="card-body">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container1" class="chart-container"></div>
                        </figure>
                        <div>
                            <figure class="highcharts-figure">
                                <div id="container3" class="chart-container"></div>
                            </figure>
                        </div>
                        <div>
                            <figure class="highcharts-figure">
                                <div id="container4" class="chart-container"></div>
                            </figure>
                        </div>
                        <div>
                            <figure class="highcharts-figure">
                                <div id="container2" class="chart-container"></div>
                            </figure>
                        </div>
                        <div class="table-responsive col-4">
                            <table class="table table-hover table-bordered mt-4  text-white text-center">
                                <tbody class='table text-black text-center'>
                                    @foreach ($finish as $finish)
                                        <tr>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script>
            $(document).ready(function() {
            var work =  <?php echo json_encode($work); ?>;
            Highcharts.setOptions({
                    colors: ['yellow', 'red']
                });
            var options = {
                chart: {
                    renderTo: 'container1',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,


                },
                credits: {
                    enabled: false
                },
                title: {
                    text: '<b>Tipos de ordenes de trabajo mensuales</b>'
                },
                 tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>',
                    percentageDecimals: 1
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        showInLegend: true,
                        cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b></br>'+
                                'Total: ' + Highcharts.numberFormat(this.y, 2);
                            }
                        }
                    }
                },
                series: [{
                    type:'pie',
                    name:'Porcentaje'
                }]
            }
            myarray = [];
            $.each(work, function(index, val) {
                myarray[index] = [val.order, val.count];
            });
            options.series[0].data = myarray;
            chart = new Highcharts.Chart(options);
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>

    <script>
            $(document).ready(function() {
            var solution =  <?php echo json_encode($solution); ?>;
            Highcharts.setOptions({
                    colors: ['green', 'red', 'purple', 'orange']
                });
            var options = {
                chart: {
                    renderTo: 'container2',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: '<b>Asignación de trabajo<b>'
                },
                 tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>',
                    percentageDecimals: 1
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        showInLegend: true,
                        cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b><br/>'+
                                'Total ordenes: ' + Highcharts.numberFormat(this.y, 2);
                            }

                        }
                    }
                },
                series: [{
                    type:'pie',
                    name: 'Porcentaje'
                }],
                responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            }
            myarray = [];
            $.each(solution, function(index, val) {
                myarray[index] = [val.assigned, val.count];
            });
            options.series[0].data = myarray;
            chart = new Highcharts.Chart(options);
        });
    </script>

    <script>
            $(document).ready(function() {
            var sedes =  <?php echo json_encode($sedes); ?>;
                Highcharts.setOptions({
                        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
                    });
            var options = {
                chart: {
                    renderTo: 'container3',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: '<b>Ordenes de trabajo consulta externa<b>'
                },
                 tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>',
                    percentageDecimals: 1
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        showInLegend: true,
                        cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b><br/>'+
                                'Total ordenes: ' + Highcharts.numberFormat(this.y, 2);
                            }

                        }
                    }
                },
                series: [{
                    type:'pie',
                    name: 'Porcentaje'
                }],
                responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            }
            myarray = [];
            $.each(sedes, function(index, val) {
                myarray[index] = [val.name, val.count];
            });
            options.series[0].data = myarray;
            chart = new Highcharts.Chart(options);
        });
    </script>

    <script>
            $(document).ready(function() {
            var odon =  <?php echo json_encode($odon); ?>;
            Highcharts.setOptions({
                    colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
                });
            var options = {
                chart: {
                    renderTo: 'container4',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: '<b>Ordenes de trabajo odontología<b>'
                },
                 tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>',
                    percentageDecimals: 1
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        showInLegend: true,
                        cursor: 'pointer',
                            dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: '#000000',
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b><br/>'+
                                'Total ordenes: ' + Highcharts.numberFormat(this.y, 2);
                            }

                        }
                    }
                },
                series: [{
                    type:'pie',
                    name: 'Porcentaje'
                }],
                responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
            }
            myarray = [];
            $.each(odon, function(index, val) {
                myarray[index] = [val.name, val.count];
            });
            options.series[0].data = myarray;
            chart = new Highcharts.Chart(options);
        });
    </script>
  @endsection
