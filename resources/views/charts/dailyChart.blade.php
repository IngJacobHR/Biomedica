<?php
    $name=$dataType[0]['name'];
        $multi = 1;
    if (count($rawdata)>0):
        $type=$dataType[0]['type'];
        $valuemin= $dataType[0]['min'];
        $valuemax= $dataType[0]['max'];
        if ($type=="Temperatura"){
            $type="Temperatura (°C)";
        }elseif ($type=="Humedad") {
            $type="Humedad (%)";
            $multi = 10;
        }elseif ($type=="CO2") {
            $type="Concentración de CO2 (ppm)";
            }
        for($i=0;$i<count($rawdata);$i++){
            $time = $rawdata[$i]["date"];
            $data = new DateTime($time);
            $data->modify('-5 hours');
            $rawdata[$i]["date"]=$data->getTimestamp()*1000;
        }

    else :
        $type="";
        $valuemin= 0;
        $valuemax= 0;
    endif

?>


@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white" >
                    <h2>
                        {{$name}}
                        <input type ='button' class="btn btn-success text-white float-right"  value = 'Regresar' onclick="location.href = '{{route('sensors.index')}}'"/>
                        <input type ='button' class="btn btn-secondary text-white float-right mr-3"  value = 'Historico' onclick="location.href = '{{route('historic', $id)}}'"/>
                        <input type ='button' class="btn btn-danger text-white float-right mr-3"  value = 'Evento' onclick="location.href = '{{route('event', $id)}}'"/>
                    </h2>
                </div>
                <div class="card-body">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="container" class="chart-container"></div>
                            </figure>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
    <script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

    <script type='text/javascript'>

    $(function () {
    $(document).ready(function() {
    Highcharts.setOptions({
        global: {
            useUTC: true
        }
    });

    var chart;
    $('#container').highcharts({
        chart: {
            type: 'spline',
            animation: Highcharts.svg, // don't animate in old IE
            marginRight: 10,
            events: {
                load: function() {

                }
            }
        },
        credits: {
        enabled: false
        },
        title: {
            text: "<?php echo $name; ?>"
        },
        xAxis: {
            title: {
                    text: 'Fecha'
                },
            type: 'datetime',
            tickPixelInterval: 50
        },
        yAxis: {
            title: {
                text: "<?php echo $type; ?>"
            },
            plotLines: [{
                value: "<?php echo $valuemin; ?>",
                color: 'red',
                dashStyle: 'shortdash',
                width: 2,
                label: {
                    text: 'Valor minimo'
                }
            }, {
                value: "<?php echo $valuemax; ?>",
                color: 'red',
                dashStyle: 'shortdash',
                width: 2,
                label: {
                    text: 'Valor maximo'
                }
            }]
        },
        tooltip: {
            formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                    'Fecha: ' + Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                    'Valor: ' + Highcharts.numberFormat(this.y, 2);
            }
        },
        legend: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        series: [{
            name: "<?php echo $type; ?>",
                data: (function() {
                    var data = [];
                <?php
                    for($i = 0 ;$i<count($rawdata);$i++){
                ?>
                data.push([<?php echo $rawdata[$i]["date"];?>,<?php echo $rawdata[$i]["val"];?>]);
                <?php } ?>
            return data;
                })(),
                zones: [{
                    value: "<?php echo $valuemin; ?>",
                    color: 'red'
                },{
                    value: "<?php echo $valuemin+(0.5*$multi); ?>",
                    color: 'yellow'
                }, {
                    value: "<?php echo $valuemax-(0.5*$multi); ?>",
                    color: 'blue'
                },{
                    value: "<?php echo $valuemax; ?>",
                    color: 'yellow'
                }, {
                    color: 'red'
                }, ]
                    }]
                    });
                    });

    });

    </script>
@endsection
