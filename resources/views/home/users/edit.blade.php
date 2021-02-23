@extends('adminlte::page')

@section('title', ($action=="create"?"Alta de ".$reqTipo:'Información de '.$user->name))

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


    .custom-file-label::after {
        content: "Buscar";
    }
</style>

@stop

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{url("/")}}/home">
                    <i class="fas fa-home"></i></a>
            </li>

            <li class="breadcrumb-item">
                @if(auth()->user()->tipo_id==1)
                <a href="{{url("/")}}/home/users">{{$reqTipo??"Personal"}}</a>
                @else
                <a href="{{url("/")}}/home/users-promotores">Promotores</a>
                @endif
            </li>

            <li class="breadcrumb-item active">{{($action=="create"?"Nuevo ".$reqTipo:'Información de '.$user->name)}}</li>
        </ol>
    </div>
    <div class="col-sm-12">
        <h1>{{($action=="create"?"Alta de ".$reqTipo:'Información de '.$user->name)}}</h1>
    </div>

</div>
@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{($action=="create"?"Alta de Usuario":'Información de '.$user->name)}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url("/")}}/home/users{{$action=="edit"?"/".$user->id:""}}" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if($action=="edit")
                    {{ method_field('PUT') }}
                @endif
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputFile">Foto</label>
                        <br>
                        <img src="@if($action=="create") {{url("/")}}/storage/users/default.png @else {{url("/")}}/storage/{{$user->avatar}} @endif"
                             class="user-image" width="200"
                             alt="@if($action=="create") Usuario @else {{$user->name??"Usuario"}}@endif">


                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                       accept="image/png, .jpeg, .jpg, image/gif">
                                <label class="custom-file-label" for="exampleInputFile">Seleccionar imágen</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{old('name', $user->name??"")}}" {{($action=="create"?' autocomplete="nope" ':'')}} required >
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{old('email', $user->email??"")}}" @if($action=="create") autocomplete="nope" @endif required >
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Celular a 10 dígitos (Opcional)</label>
                        <input type="celular" class="form-control" id="celular" name="celular" value="{{$user->celular??""}}" @if($action=="create") autocomplete="nope" @endif >
                        @error('celular')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    @if($action=="create" or ($action=="edit" and auth()->user()->id==$user->id))
                    <div class="form-group">
                        <label for="password">Contraseña de al menos 8 caracteres
                            @if ($action=="edit") <span> (Llenar sólo si se quiere cambiar) </span> @endif</label>
                        
                        <div class="input-group" id="show_hide_password">
                            <input type="password" class="form-control" id="password" name="password"
                                   @if($action=="create") autocomplete="nope" required @endif >
                            <span class="input-group-append">
                                <a href="" class="btn btn-info" ><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </span>
                        </div>

                        @error('password')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    @if($action=="create")

                        @if(auth()->user()->tipo_id==1)

                            @if($reqTipo=="gerentes")
                                <input type="hidden" id="tipo_id" name="tipo_id" value="2">
                            @else

                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select name="tipo_id" id="tipo_id" class="form-control" required >
                                        <option value="">- Seleccionar -</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo->id}}"
                                                    @if ($action=="edit")
                                                    @if($user->tipo->id==$tipo->id)
                                                    selected
                                                    @endif
                                                    @endif
                                            >
                                                {{$tipo->nombre}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('tipo_id')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                            @endif
                        @elseif(auth()->user()->tipo_id==2)

                            <div class="form-group">
                                <label>Tipo</label>
                                <select name="tipo_id" id="tipo_id" class="form-control" required >
                                    <option value="">- Seleccionar -</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}"
                                                @if ($action=="edit")
                                                @if($user->tipo->id==$tipo->id)
                                                selected
                                                @endif
                                                @endif
                                        >
                                            {{$tipo->nombre}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('tipo_id')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                        @endif

                    @elseif($action=="edit")

                        @if(auth()->user()->id==$user->id)
                            <input type="hidden" id="tipo_id" name="tipo_id" value="{{$user->tipo_id}}">
                        @else
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select name="tipo_id" id="tipo_id" class="form-control" required >
                                            <option value="">- Seleccionar -</option>
                                            @foreach($tipos as $tipo)
                                                <option value="{{$tipo->id}}"
                                                        @if ($action=="edit")
                                                        @if($user->tipo->id==$tipo->id)
                                                        selected
                                                        @endif
                                                        @endif
                                                >
                                                    {{$tipo->nombre}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('tipo_id')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                        @endif

                    @endif


                    @if($action=="create")


                        @if(auth()->user()->tipo_id == 1 && $reqTipo == "promotores")



                        <div class="form-group">
                            <label>Asignado</label>
                            <select id="asignado_id" name="asignado_id" class="form-control" @if($action=="create")  @endif required >
                                <option value="">- Seleccionar -</option>
                                @foreach($usuarios as $asignado)
                                    <option value="{{$asignado->id}}"
                                            @if ($action=="edit")
                                            @if(isset($user->asignado->id))
                                            @if($user->asignado->id==$asignado->id)
                                            selected
                                            @endif
                                            @endif
                                            @elseif($action=="create")
                                            @if(auth()->user()->id==$asignado->id)
                                            selected
                                            @endif
                                            @endif
                                    >
                                        {{$asignado->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('asignado_id')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        @else
                            <input type="hidden" id="asignado_id" name="asignado_id" value="{{auth()->user()->id}}">
                        @endif
                    @else
                        @if(auth()->user()->tipo_id == 1 && auth()->user()->id != $user->id) {{-- Admin edit users, but no himself --}}

                        <div class="form-group">
                            <label>Asignado</label>
                            <select id="asignado_id" name="asignado_id" class="form-control" @if($action=="create")  @endif required >
                                <option value="">- Seleccionar -</option>
                                @foreach($usuarios as $asignado)
                                    <option value="{{$asignado->id}}"
                                            @if ($action=="edit")
                                            @if(isset($user->asignado->id))
                                            @if($user->asignado->id==$asignado->id)
                                            selected
                                            @endif
                                            @endif
                                            @elseif($action=="create")
                                            @if(auth()->user()->id==$asignado->id)
                                            selected
                                            @endif
                                            @endif
                                    >
                                        {{$asignado->name}} ({{$asignado->tipo->nombre}})
                                    </option>
                                @endforeach
                            </select>
                            @error('asignado_id')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @else
                            <input type="hidden" id="asignado_id" name="asignado_id" value="{{$user->asignado_id}}"> {{-- Users edits himself --}}
                        @endif
                    @endif




                    @if(true)
                        <input type="hidden" id="status_id" name="status_id" value="{{$user->status_id??auth()->user()->status_id}}">
                    @else
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status_id" id="status_id" class="form-control" required >
                                <option value="">- Seleccionar -</option>
                                @foreach($status as $status_s)
                                    <option value="{{$status_s->id}}"
                                        @if ($action=="edit")
                                            @if($user->status->id==$status_s->id)
                                                selected
                                            @endif
                                        @endif
                                    >
                                        {{$status_s->nombre}}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>


                    @endif

                    <div class="form-group">
                        <label for="exampleInputEmail1">Picky Assist Token</label>
                        <input type="text" class="form-control" id="pickyassist_token" name="pickyassist_token"
                               value="{{old('pickyassist_token', $user->pickyassist_token??"")}}" @if($action=="create") autocomplete="nope" @endif  >
                        @error('pickyassist_token')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($action=="edit")

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" class="form-control" value="{{$user->id}}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Creación</label>
                            <input type="text" class="form-control" value="{{$user->created_at}}" disabled>
                        </div>

                        <div class="form-group">
                            <label>Actualización</label>
                            <input type="text" class="form-control" value="{{$user->updated_at}}" disabled>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js"></script>


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

        if($("#password").length){
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        }

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

        $(document).ready(function () {
            bsCustomFileInput.init();
        });

    });
</script>

@stop







