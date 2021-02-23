@extends('adminlte::page')

@section('title', 'Inicio')

@section('css')
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Charts -->

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <style>
        #visitors-chart {
            min-width: 310px;
            max-width: 800px;
            height: 400px;
            margin: 0 auto
        }

        .buttons {
            min-width: 310px;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 0;
        }

        .buttons button {
            cursor: pointer;
            border: 1px solid silver;
            border-right-width: 0;
            background-color: #f8f8f8;
            font-size: 1rem;
            padding: 0.5rem;
            outline: none;
            transition-duration: 0.3s;
        }

        .buttons button:first-child {
            border-top-left-radius: 0.3em;
            border-bottom-left-radius: 0.3em;
        }

        .buttons button:last-child {
            border-top-right-radius: 0.3em;
            border-bottom-right-radius: 0.3em;
            border-right-width: 1px;
        }

        .buttons button:hover {
            color: white;
            background-color: rgb(158, 159, 163);
            outline: none;
        }

        .buttons button.active {
            background-color: #0051B4;
            color: white;
        }

        .my-custom-scrollbar {
            position: relative;
            height: 200px;
            overflow: auto;
        }
        .table-wrapper-scroll-y {
            display: block;
        }

    </style>


@stop

@section('content_header')

        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item active">
                            <i class="fas fa-home"></i>
                    </li>

                </ol>
            </div>

            <div class="col-sm-12">
                <h1>Inicio</h1>
            </div>
        </div>

@stop

@section('content')

    <div class="row">

        <!-- ./col -->
        @if(auth()->user()->tipo_id==1)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$total["usuarios"]}} <sup style="font-size: 20px">Usarios</sup></h3>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fw fa-users"></i>
                    </div>
                    <a href="{{url("/")}}/home/users" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <!-- ./col -->


        @if(auth()->user()->tipo_id==1)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$total["gerentes"]}}<sup style="font-size: 20px">Gerentes</sup></h3>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-user-tie"></i>
                </div>
                <a href="{{url("/")}}/home/users-gerentes" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif
        <!-- ./col -->

        @can("crud-promotores")
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$total["promotores"]}}<sup style="font-size: 20px">Promotores</sup></h3>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-headset"></i>
                </div>
                <a href="{{url("/")}}/home/users-promotores" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan
        <!-- ./col -->

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total["solicitantes"]}} @if(auth()->user()->tipo_id==1) <sup style="font-size: 20px">/{{$total["solicitantes_brute"]}}</sup> @endif <sup style="font-size: 20px">Prospectos</sup></h3>
                </div>
                <div class="icon">
                    <i class="fas fas fa-fw fa-comments-dollar"></i>
                </div>
                <a href="{{url("/")}}/home/prospectos-followup" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Timer Modal-->
    <div class="modal fade" id="timerModal" tabindex="-1" role="dialog" aria-labelledby="timerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteResourceLabel">¿Deseas continuar tu sesión? <span class="placehold-del-res"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Te queda
                    <span class="countdown-end">00:00</span><span id="time" class="countdown">{{config('session.lifetime')}}:00</span>
                    minutos para continuar con tu sesión.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fa-" data-dismiss="modal">Cancelar</button>
                    <button onclick="refresh()" id="continuesession" type="button" class="btn btn-danger">CONTINUAR</button>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->tipo_id==1)

        <div class="row">
            <div class="col-lg-12 col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Prospectos por Mes</h3>

                    </div>
                    <div class="card-body">
                        <div class="buttons">

                            <button id="2016" class="active">
                                2020
                            </button>
                        </div>
                        <div id="visitors-chart"></div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Top Mejores Promotores</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-condensed">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nombre</th>
                                <th >
                                    Horas
                                    <i class="fas fa-fw fa-question-circle" rel="tooltip"
                                       title="Promedio de Horas que los prospectos permanecen en un mismo status de seguimiento en proceso">

                                    </i>
                                </th>
                            </tr>
                            @foreach($tables["top_bests"] as $key=> $best)
                            <tr>

                                <td>{{$key+1}}</td>
                                <td>{{$best->name}}</td>
                                <td><span class="badge bg-light-blue">{{round($best->avg_hours)}}</span></td>

                            </tr>
                            @endforeach

                        </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Top Peores Promotores</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">

                        <table class="table table-condensed">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nombre</th>
                                <th >
                                    Horas
                                    <i class="fas fa-fw fa-question-circle" rel="tooltip"
                                       title="Promedio de Horas que los prospectos permanecen en un mismo status de seguimiento en proceso">

                                    </i>
                                </th>
                            </tr>
                            @foreach($tables["top_worsts"] as $key=> $worst)
                                <tr>

                                    <td>{{$key+1}}</td>
                                    <td>{{$worst->name}}</td>
                                    <td><span class="badge bg-light-blue">{{round($worst->avg_hours)}}</span></td>

                                </tr>
                            @endforeach

                        </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    <div class="row">
        <div class="col-lg-12 col-6">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Prospectos y promotores por gerente</h3>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                            <th>Gerente</th>
                            <th>Promotores</th>
                            <th>Prospectos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gerentes_report as $gerente)
                        <tr>
                            <td>
                                {{$gerente["nombre"]}}
                            </td>
                            <td>{{$gerente["promotores"]}}</td>
                            <td>{{$gerente["prospectos"]}}</td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif


@stop

@section('js')
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Hecho por <img src="{{asset("assets/img/mkt-connect.png")}}" height="10">
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{date("Y")}} <a href="#">MKT Connect</a>.</strong> Todos los derechos reservados.
    </footer>
    </div>



    <script>
        var baseUrl = {!! json_encode(url("/"))!!};
        var statusTrans = {!! json_encode(request()->session()->has('status') ? session('status') : null )!!};
        var sessionLifetime = {!! json_encode(config('session.lifetime')) !!};

        // Refresh Browser
        function refresh() {
            location.reload();
        }


        $(function () {

            // Timeout Modal Launcher
            setTimeout(function(){
                $('#timerModal').modal('show');
            }, (sessionLifetime-1)*60*1000); // min*sec*miliesec

            // Timer
            var timer2 = sessionLifetime+":01";
            var interval = setInterval(function() {

                var timer = timer2.split(':');
                //by parsing integer, I avoid all extra string processing
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) clearInterval(interval);
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('.countdown').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
            }, 1000);

            // Timer Over
            $('.countdown-end').hide();
            setTimeout(function(){
                $('.countdown').hide();
                $('.countdown-end').show();
            }, (sessionLifetime)*60*1000); // min*sec*miliesec

            // Status Notification
            if (typeof statusTrans.body !== 'undefined') {
                $(document).Toasts('create', {
                    body: statusTrans.body,
                    title: statusTrans.title,
                    icon: statusTrans.icon,
                    class: statusTrans.class,
                })
            }


            $("[rel=tooltip]").tooltip({ placement: 'right'});


        });
    </script>

    <script>


        function visitorsData (dataPrev, data, countries) {

            var countries = [{
                name: 'Enero',
                flag: 197582,
                color: 'rgb(201, 36, 39)'
            }, {
                name: 'Febrero',
                flag: 197604,
                color: 'rgb(201, 36, 39)'
            }, {
                name: 'Marzo',
                flag: 197507,
                color: 'rgb(0, 82, 180)'
            }, {
                name: 'Abril',
                flag: 197571,
                color: 'rgb(0, 0, 0)'
            }, {
                name: 'Mayo',
                flag: 197408,
                color: 'rgb(240, 240, 240)'
            }, {
                name: 'Junio',
                flag: 197375,
                color: 'rgb(255, 217, 68)'
            }, {
                name: 'Julio',
                flag: 197374,
                color: 'rgb(0, 82, 180)'
            }, {
                name: 'Agosto',
                flag: 197484,
                color: 'rgb(215, 0, 38)'
            }];

            var chart = Highcharts.chart('visitors-chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Visitantes 2020 - Visión por Meses'
                },
                subtitle: {
                    text: 'Visitantes mes a mes'
                },
                plotOptions: {
                    series: {
                        grouping: false,
                        borderWidth: 0
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    shared: true,
                    headerFormat: '<span style="font-size: 15px">{point.point.name}</span><br/>',
                    pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: <b>{point.y} visitantes</b><br/>'
                },
                xAxis: {
                    type: 'category',
                    // max: 4,
                    labels: {
                        useHTML: true,
                        animate: true,
                        formatter: function() {
                            var value = this.value,
                                output;

                            countries.forEach(function(country) {
                                if (country.name === value) {
                                    output = country.name;
                                }
                            });

                            return '<span>' + output + '</span>';
                        }
                    }
                },
                yAxis: [{
                    title: {
                        text: 'Visitantes'
                    },
                    showFirstLabel: false
                }],
                series: [{
                    color: 'rgb(158, 159, 163)',
                    pointPlacement: -0.2,
                    linkedTo: 'main',
                    data: dataPrev[2020].slice(),
                    name: '2019'
                }, {
                    name: '2020',
                    id: 'main',
                    dataSorting: {
                        enabled: false,
                        matchByName: true
                    },
                    dataLabels: [{
                        enabled: true,
                        inside: true,
                        style: {
                            fontSize: '16px'
                        }
                    }],
                    data: getData(data[2020]).slice()
                }],
                exporting: {
                    allowHTML: true
                }
            });

            var years = [2020];
            /*

            years.forEach(function(year) {
                var btn = document.getElementById(year);

                btn.addEventListener('click', function() {

                    document.querySelectorAll('.buttons button.active').forEach(function(active) {
                        active.className = '';
                    });
                    btn.className = 'active';

                    chart.update({
                        title: {
                            text: 'Summer Olympics ' + year + ' - Top 5 countries by Gold medals'
                        },
                        subtitle: {
                            text: 'Comparing to results from Summer Olympics ' + (year - 4) + ' - Source: <ahref="https://en.wikipedia.org/wiki/' + (year) + '_Summer_Olympics_medal_table">Wikipedia</a>'
                        },
                        series: [{
                            name: year - 4,
                            data: dataPrev[year].slice()
                        }, {
                            name: year,
                            data: getData(data[year]).slice()
                        }]
                    }, true, false, {
                        duration: 800
                    });
                });
            });
            */

            /**/
            $('#visitorsChart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Average Visitors'
                },
                xAxis: {
                    categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
                },
                yAxis: {
                    title: {
                        text: 'Number of visitors'
                    }
                },
                series: data,
            });
        }
        $(document).ready(function() {
            $.ajax({
                url: baseUrl+'/data/prospectos?action=month-to-month-count',
                type: 'GET',
                async: true,
                dataType: "json",
                success: function (data) {

                    console.log(data.data.data);
                    console.log(data.data.data_prev);




                    var data_a = data.data.data;
                    var dataPrev = data.data.data_prev;

                    var months = [{
                        name: 'Enero',
                        flag: 197582,
                        color: 'rgb(201, 36, 39)'
                    }, {
                        name: 'Febrero',
                        flag: 197604,
                        color: 'rgb(201, 36, 39)'
                    }, {
                        name: 'Marzo',
                        flag: 197507,
                        color: 'rgb(0, 82, 180)'
                    }, {
                        name: 'Abril',
                        flag: 197571,
                        color: 'rgb(0, 0, 0)'
                    }, {
                        name: 'Mayo',
                        flag: 197408,
                        color: 'rgb(240, 240, 240)'
                    }, {
                        name: 'Junio',
                        flag: 197375,
                        color: 'rgb(255, 217, 68)'
                    }, {
                        name: 'Julio',
                        flag: 197374,
                        color: 'rgb(0, 82, 180)'
                    }, {
                        name: 'Agosto',
                        flag: 197484,
                        color: 'rgb(215, 0, 38)'
                    }];

                    visitorsData(dataPrev, data_a, months);
                }
            });
        });

        var countries = [{
            name: 'Enero',
            flag: 197582,
            color: 'rgb(201, 36, 39)'
        }, {
            name: 'Febrero',
            flag: 197604,
            color: 'rgb(201, 36, 39)'
        }, {
            name: 'Marzo',
            flag: 197507,
            color: 'rgb(0, 82, 180)'
        }, {
            name: 'Abril',
            flag: 197571,
            color: 'rgb(0, 0, 0)'
        }, {
            name: 'Mayo',
            flag: 197408,
            color: 'rgb(240, 240, 240)'
        }, {
            name: 'Junio',
            flag: 197375,
            color: 'rgb(255, 217, 68)'
        }, {
            name: 'Julio',
            flag: 197374,
            color: 'rgb(0, 82, 180)'
        }, {
            name: 'Agosto',
            flag: 197484,
            color: 'rgb(215, 0, 38)'
        }];



        function getData(data) {
            return data.map(function(country, i) {
                return {
                    name: country[0],
                    y: country[1],
                    color: countries[i].color
                };
            });
        }




    </script>

@stop




