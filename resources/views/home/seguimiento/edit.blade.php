@extends('adminlte::page')

@section('title', ($action=="create"?"Alta de Estatus":'Información de Estatus '.$seguimiento->nombre))

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

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

<style>
    .error{
        color:red;
    }
</style>

@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">
                <a href="{{url("/")}}/home">
                    <i class="fas fa-home"></i>
                </a>
            </li>

            <li class="breadcrumb-item">

                <a href="{{url("/")}}/home/seguimientos">Seguimientos</a>

            </li>

            <li class="breadcrumb-item active">{!!($action=="create"?"Nuevo Estatus ":'Información de Estatus <em>'.$seguimiento->nombre.'</em>')!!}</li>
        </ol>
    </div>
    <div class="col-sm-12">
        <h1>{!!($action=="create"?"Alta de Estatus":'Información de Estatus <em>'.$seguimiento->nombre.'</em>')!!}</h1>
    </div>

</div>
@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{!!($action=="create"?"Alta de Estatus":'Información de Estatus <em>'.$seguimiento->nombre.'</em>')!!}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url("/")}}/home/seguimientos{{$action=="edit"?"/".$seguimiento->id:""}}" method="POST" role="form">
                {{ csrf_field() }}
                @if($action=="edit")
                    {{ method_field('PUT') }}
                @endif
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="order">Orden</label>
                                <input type="number" class="form-control" id="order" name="order"
                                       value="{{old('order', $seguimiento->order??$last+1)}}"
                                       {{($action=="create"?' autocomplete="nope" ':'')}} required >
                                @error('order')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       value="{{old('nombre', $seguimiento->nombre??"")}}" {{($action=="create"?' autocomplete="nope" ':'')}} required >
                                @error('nombre')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select name="type_id" id="type_id" class="form-control" required >
                                    <option value="">- Seleccionar -</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}"
                                                @if ($action=="edit")
                                                @if($seguimiento->tipo->id==$tipo->id)
                                                selected
                                                @endif
                                                @endif
                                        >
                                            {{$tipo->nombre}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('type_id')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if ($action=="edit")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Creación</label>
                                <input type="text" class="form-control" value="{{$seguimiento->created_at}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Actualización</label>
                                <input type="text" class="form-control" value="{{$seguimiento->updated_at}}" disabled>
                            </div>
                        </div>

                    </div>
                    @endif

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" onclick="goBack()" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
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
                <button onclick="refresh()" id="continuesession"  type="button" class="btn btn-danger">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>
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

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script>

    var baseUrl = {!! json_encode(url("/"))!!};
    var statusTrans = {!! json_encode(request()->session()->has('status') ? session('status') : null )!!};
    var sessionLifetime = {!! json_encode(config('session.lifetime')) !!};



    // Refresh Browser
    function refresh() {
        location.reload();
    }

    function goBack() {
        window.history.back();
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
        if (statusTrans != null) {
            $(document).Toasts('create', {
                body: statusTrans.body,
                title: statusTrans.title,
                icon: statusTrans.icon,
                class: statusTrans.class,
            })
        }

    });
</script>

@stop







