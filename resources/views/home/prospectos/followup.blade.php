@extends('adminlte::page')

@section('title', 'Prospectos')

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
        .table td{
            padding-top: .01rem;
            padding-bottom: .01rem;
        }

        .facebook-column{
            min-width: max-content;
            display: block;
        }

        .direct-chat-messages {
            height: 350px;}
    </style>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        var module = { }; /*   <-----THIS LINE */
    </script>

    <script type="text/javascript" src="{{asset('lib/echo.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/pusher.js')}}"></script>

@stop

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{url("/")}}/home">
                        <i class="fas fa-home"></i></a>
                </li>
                <li class="breadcrumb-item active">Prospectos</li>
            </ol>
        </div>
        <div class="col-sm-12">
            <h1><span class="badge badge-secondary">{{count($prospectos)}}</span> Prospectos</h1>
        </div>
    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{url("/")}}/home/prospectos/create" type="button" class="btn btn-block btn-success text-white">
                            <i class="fas fa-plus-circle"></i> Agregar Prospecto
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">

                        @if(auth()->user()->tipo_id<3)
                        <div class="row">
                            <div class="col-md-4 gerente-dropdown">
                                <div class="form-group">
                                    <label>Gerente</label>
                                    <select id="gerente-filter" class="form-control">
                                        <option value="0">Todos</option>
                                        @foreach ($gerentes as $gerente)
                                            <option value="{{$gerente->id}}" >{{$gerente->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Promotor</label>
                                    <select id="promotor-filter" class="form-control">
                                        <option value="">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif

                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>Facebook</th> --}}
                                <th>Nombre</th>
                                <th>Celular</th>
                                {{--<th>Email</th>--}}
                                {{--<th>Fec_asignado</th>--}}
                                <th>Estatus</th>
                                {{--<th>Fec_segto</th>--}}
                                @if(auth()->user()->tipo_id<3 and false)
                                <th>Promotor</th>
                                @endif
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($prospectos as $prospecto)
                                <tr>
                                    <td class="facebook-column">{{$prospecto->id}}</td>
                                    {{-- <td>{{$prospecto->number??"-"}}</td> --}}
                                    <td>{{$prospecto->nombre??"-"}}</td>
                                    <td>{{$prospecto->celular??"-"}}</td>
                                    {{-- <td>{{$prospecto->email??"-"}}</td> --}}
                                    {{-- <td>{{$prospecto->fecha_hora??"-"}}</td> --}}
                                    <td>{{$prospecto->seguimiento->nombre??"Sin Seguimiento"}} <span class="d-none">{{$prospecto->asignado->name??"No Asignado"}}</span></td>
                                    {{-- <td>{{$prospecto->fecha_cambio??"-"}}</td> --}}
                                    @if(auth()->user()->tipo_id<3 and false)

                                    <td>{{$prospecto->asignado->name??"No Asignado"}}</td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url("home/prospectos/$prospecto->id/edit")}}"
                                               class="btn btn-info btn-xs">
                                                <i class="fas fa-eye text-white"></i>
                                            </a>
                                            @if($prospecto->email)
                                            <a href="mailto:{{$prospecto->email}}"
                                               class="btn btn-success btn-xs" target="_blank">
                                                <i class="fas fa-envelope text-white"></i>
                                            </a>
                                            @endif
                                            @if($prospecto->celular)
                                            <a href="https://wa.me/521{{$prospecto->celular}}"
                                               class="btn btn-success btn-xs" target="_blank">
                                                <i class="fab fa-whatsapp text-white"></i>
                                            </a>
                                            @endif



                                            @if($prospecto->chat)

                                                @if($prospecto->chat->type_id==5)
                                                    <button type="button" class="btn btn-success btn-xs messengerBtn" data-lead="{{$prospecto->id}}">
                                                        <i class="fab fa-facebook-messenger text-white"></i>
                                                    </button>
                                                @else
                                                     <button type="button" class="btn btn-danger btn-xs messengerBtn" data-lead="{{$prospecto->id}}">
                                                         <i class="fab fa-facebook-messenger text-white"></i>
                                                     </button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-default btn-xs messengerBtn" data-lead="{{$prospecto->id}}">
                                                    <i class="fab fa-facebook-messenger text-dark"></i>
                                                </button>
                                            @endif
                                            {{--
                                            <a class="btn btn-danger btn-xs" data-toggle="modal"
                                               data-target="#deleteResourceModal"
                                               data-resource-id="{{$prospecto->id}}"
                                               data-resource-name="{{$prospecto->name}}"><i class="fas fa-trash text-white"></i></a>
                                            --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                {{-- <th>Facebook</th> --}}
                                <th>Nombre</th>
                                <th>Celular</th>
                                {{-- <th>Email</th> --}}
                                {{-- <th>Fec_asignado</th> --}}
                                <th>Estatus</th>
                                {{-- <th>Fec_segto</th> --}}
                                @if(auth()->user()->tipo_id<3 and false)
                                    <th>Promotor</th>
                                @endif
                                <th>Acciones</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <div id="chatWidget" class="col-md-3">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="card card-prirary cardutline direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 id="chatTitle" class="card-title"> Chat</h3>

                    <div class="card-tools">
                        <!--

                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-primary">3</span>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        -->

                        <!--
                        <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i></button>

                        -->
                        <!--
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                        -->
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div id="conversation" class="direct-chat-messages">

                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="https://images.assetsdelivery.com/compings_v2/mialima/mialima1603/mialima160300025.jpg">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Ramón Vera
                                            <small class="contacts-list-date float-right">28/02/2020</small>
                                        </span>
                                        <span class="contacts-list-msg">Hola? me interesa el...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                                <a href="#">
                                    <img class="contacts-list-img" src="https://images.assetsdelivery.com/compings_v2/mialima/mialima1603/mialima160300025.jpg">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Ramón Vera
                                            <small class="contacts-list-date float-right">28/02/2020</small>
                                        </span>
                                        <span class="contacts-list-msg">Hola? me interesa el...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>

                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div id="chatInput" class="card-footer">
                    <form action="{{url("/")}}/home/chats" method="post" id="chatform">
                        {{ csrf_field() }}
                        <input type="hidden" id="user_id" name="user_id" vlaue="{{auth()->user()->id}}">
                        <input type="hidden" id="type_id" name="type_id" value="5">
                        <input type="hidden" id="prospecto_id"  name="prospecto_id" value="">

                        <div class="input-group send-message">
                            <input id="message" type="text" name="message" placeholder="Escribir..." class="form-control">

                            <span class="input-group-append">
                                <input id="send" type="submit" value="Enviar" class="btn btn-primary">
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
    </div>

    <!-- Delete Resource -->
    <div class="modal fade" id="deleteResourceModal" tabindex="-1" role="dialog" aria-labelledby="deleteResourceLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <form id="delResForm" method="POST" action="">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteResourceLabel">Confirmar borrar prospecto <span class="placehold-del-res"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de borrar al prospecto <span class="placehold-del-res-name"></span>?

                        <input type="hidden" id="placehold-del-res-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger " value="BORRAR">

                    </div>
                </div>
            </form>
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
        var gerente = {!! json_encode(auth()->user()->tipo_id==2?auth()->user()->id:0) !!};
        var sessionLifetime = {!! json_encode(config('session.lifetime')??10) !!};
        var tipoUsuario = {!! json_encode(auth()->user()->tipo_id??3) !!};
        var loguedUserName = {!! json_encode(auth()->user()->name) !!};
        var loguedUserId = {!! json_encode(auth()->user()->id) !!};
        var chatLeadUrl = {!! json_encode(url("/").'/home/chats-lead') !!};
        var table = null;

        // Chat Resources
        const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre"
            ];
        $('#conversation').scrollTop($('#conversation')[0].scrollHeight);

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

            var table = $("#table").DataTable({
                "pageLength": 50,
                "order": [[ 0, "desc" ]],
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                },
                "autoWidth": true
            });

            if(tipoUsuario<3){
                table.search("Seleccione-filtros").draw();
            }

            // Delete resource modal
            $('#deleteResourceModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var resourceName = button.data('resource-name'); // Extract info from data-* attributes
                var resourceId = button.data('resource-id');
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.placehold-del-res-name').text(resourceName)
                modal.find('.placehold-del-res-id').val(resourceId)
                $('#delResForm').get(0).setAttribute('action', baseUrl+'/home/prospectos/'+resourceId); //this works
            });

            // Datatable filter
            $('#promotor-filter').on('change', function(){
                table.search(this.value).draw();
            });

            $('#gerente-filter').on('change', function(){
                table.search("").draw();
                table.search("Seleccione-filtros").draw();
            });

            // Select filler

            if(gerente>0){
                $(".gerente-dropdown").hide();

                $('#promotor-filter').empty();
                var id = gerente;
                $('#promotor-filter').html('<option selected="selected" value="Seleccione-filtros">Cargando...</option>');
                var url = baseUrl + '/home/users-promotores-del-gerente/'+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        var arr = [];
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                arr.push(data[key]);
                            }
                        }

                        $('#promotor-filter').html('<option selected="selected" value="Seleccione-filtros">- Selecciona -</option>');
                        $.each(arr.sort(), function(key, value) {
                            $('#promotor-filter').append('<option value="'+value+'">'+value+'</option>');
                        });

                    }
                });

            }

            $('#gerente-filter').on('change', function() {
                $('#promotor-filter').empty();
                var id = $('#gerente-filter').val();
                $('#promotor-filter').html('<option selected="selected" value="">Cargando...</option>');
                var url = baseUrl + '/home/users-promotores-del-gerente/'+id;
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        var arr = [];
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                arr.push(data[key]);
                            }
                        }

                        $('#promotor-filter').html('<option selected="selected" value="Seleccione-filtros">- Selecciona -</option>');
                        $.each(arr.sort(), function(key, value) {
                            $('#promotor-filter').append('<option value="'+value+'">'+value+'</option>');
                        });

                    }
                });
            });

            // Status Notification
            if (statusTrans != null) {
                $(document).Toasts('create', {
                    body: statusTrans.body,
                    title: statusTrans.title,
                    icon: statusTrans.icon,
                    class: statusTrans.class,
                })
            }

            // Show Chat
            $(document).on('click','.messengerBtn',function(e) {
                e.stopPropagation();
                e.stopImmediatePropagation();
                leadId = $(this).data("lead");
                getChat(leadId,chatLeadUrl);
            });

            // Send Chat Message
            $("#chatform").submit(function(event){
                event.preventDefault(); //prevent default action

                var message = $("#message").val().trim();

                if(message==""){
                    return;
                }

                var post_url = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data = $(this).serialize(); //Encode form elements for submission

                $.ajax({
                    url : post_url,
                    type: request_method,
                    data : form_data
                }).done(function(response){ //

                    if(response.message=="Success"){

                        var d = new Date();
                        var day = d.getDate();
                        var month = d.getMonth();
                        var hour = d.getHours();
                        var minutes = d.getMinutes();

                        var message = $("#message").val();

                        var uiMessage = "";
                        uiMessage+='<div class="direct-chat-msg right">';
                        uiMessage+='<div class="direct-chat-infos clearfix">';
                        uiMessage+='<span class="direct-chat-name float-right">'+loguedUserName+'</span>';
                        uiMessage+='<span class="direct-chat-timestamp float-left">'+day+' '+monthNames[month]+' '+hour+':'+minutes+' </span>';
                        uiMessage+='</div>';
                        uiMessage+='<img class="direct-chat-img" src="https://images.assetsdelivery.com/compings_v2/yupiramos/yupiramos1607/yupiramos160700971.jpg" alt="Message User Image">';
                        uiMessage+='<div class="direct-chat-text">';
                        uiMessage+=message;
                        uiMessage+='</div>';
                        uiMessage+='</div>';

                        $(".direct-chat-messages").append(uiMessage);

                        $('#conversation').scrollTop($('#conversation')[0].scrollHeight);

                        $("#message").val("");

                        var prospectoId = $("#prospecto_id").val();

                        $('*[data-lead="'+prospectoId+'"]').removeClass('btn-danger');
                        $('*[data-lead="'+prospectoId+'"]').addClass('btn-success');
                    }
                });
            });

            /**
             * Get Chat Via Ajax
             * @param leadId
             * @param chatLeadUrl
             */
            function getChat(leadId,chatLeadUrl){

                $.ajax({
                    url : chatLeadUrl+"/"+leadId,
                    type: "get",
                    data : null
                }).done(function(response){ //

                    $(".direct-chat-messages").empty().append("");

                    $.each(response, function( index, value ) {

                        var uiMessage = "";

                        if(value.type_id==5){
                            uiMessage+='<div class="direct-chat-msg right">';
                        }else{
                            uiMessage+='<div class="direct-chat-msg left">';
                        }

                        uiMessage+='<div class="direct-chat-infos clearfix">';

                        if(value.type_id==5){

                            if (value.user_id>0) {
                                var name = value.user.name;
                            }else{
                                var name = "Promotor";
                            }
                            uiMessage+='<span class="direct-chat-name float-right">'+name+'</span>';
                            uiMessage+='<span class="direct-chat-timestamp float-left">'+value.created_at+' </span>';
                        }else{
                            if (value.hasOwnProperty('lead')) {
                                var name = value.lead.nombre==null?"Prospecto":value.lead.nombre;
                            }else{
                                var name = "Prospecto";
                            }
                            uiMessage+='<span class="direct-chat-name float-left">'+name+'</span>';
                            uiMessage+='<span class="direct-chat-timestamp float-right">'+value.created_at+' </span>';
                        }

                        uiMessage+='</div>';

                        if(value.type_id==5) {
                            uiMessage += '<img class="direct-chat-img" src="https://images.assetsdelivery.com/compings_v2/yupiramos/yupiramos1607/yupiramos160700971.jpg" alt="Message User Image">';
                        }else{
                            uiMessage += '<img class="direct-chat-img" src="https://images.assetsdelivery.com/compings_v2/mialima/mialima1603/mialima160300025.jpg" alt="Message User Image">';
                        }
                        uiMessage+='<div class="direct-chat-text">';
                        uiMessage+=value.message;
                        uiMessage+='</div>';
                        uiMessage+='</div>';

                        $("#chatWidget").removeClass("d-none");

                        $(".direct-chat-messages").append(uiMessage);

                        $('#conversation').scrollTop($('#conversation')[0].scrollHeight);
                    });

                    // Show Chat if there are messages
                    if($.isEmptyObject( response[0] )){
                    // if(false){
                        // $("#chatWidget").addClass("d-none");
                        $("#chatTitle").empty().append("Chat con Prospecto #"+leadId);
                    }else{
                        if(response[0].lead.nombre==null){
                            $("#chatTitle").empty().append("Chat con Prospecto #"+leadId);
                        }else{
                            $("#chatTitle").empty().append("Chat con "+response[0].lead.nombre);
                        }
                    }

                    // Set Lead ID
                    $("#prospecto_id").val(leadId);

                    // Show Chat input only chat is between time window

                    if ($('*[data-lead="'+leadId+'"]').hasClass("btn-default")) {
                        $("#chatInput").addClass("d-none");
                    }else{
                        $("#chatInput").removeClass("d-none");
                    }

                });
            }

            var pusher = new Pusher('');

            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: '{{env("PUSHER_APP_KEY")}}',
                cluster: '{{env("PUSHER_APP_CLUSTER")}}',
                forceTLS: true
            });

            var channel = Echo.channel('my-channel');
            channel.listen('.chat-sent', function(data) {
                if(loguedUserId==data.prospecto.asignado_id){
                    table.search(data.prospecto.id).draw();
                    $('*[data-lead="'+data.prospecto.id+'"]').removeClass('btn-info');
                    $('*[data-lead="'+data.prospecto.id+'"]').addClass('btn-danger');
                    getChat(data.prospecto.id,chatLeadUrl);
                }
            });
        });

        /*
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{env("PUSHER_APP_KEY")}}',
            cluster:'{{env("PUSHER_APP_CLUSTER")}}',
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
            encrypted:false
        });
        */


    /*
        window.Echo.private('App.User.{{auth()->user()->id}}')
            .notification((notification) => {
                doSomeAmazingStuff();
                conslole.log("ctchet");
            });
*/
    /*
        Echo.private('chat')
            .listenForWhisper('typing', (e) => {
                console.log(e.name);
            });
*/
/*
        Echo.channel('chats')
            .listen('chatSent', (e) => {

                console.log(e.chat.id);
            });

*/
    </script>



@stop




