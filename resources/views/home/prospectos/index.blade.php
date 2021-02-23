@extends('adminlte::page')

@section('title', 'Solicitantes')

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
            padding: .01rem !important;
        }
    </style>
@stop

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><span class="badge badge-secondary">{{count($prospectos)}}</span> Solicitantes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url("/")}}">Inicio</a></li>
                <li class="breadcrumb-item active">Solicitantes</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{url("/")}}/home/prospectos/create" type="button" class="btn btn-block btn-success text-white">
                            <i class="fas fa-plus-circle"></i> Agregar
                        </a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Facebook</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Fecha de Asignación</th>
                                <th>Status Seguimiento</th>
                                <th>Fecha de Seguimiento</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($prospectos as $prospecto)
                                <tr>
                                    <td>{{$prospecto->id}}</td>
                                    <td>{{$prospecto->number}}</td>
                                    <td>{{$prospecto->nombre}}</td>
                                    <td>{{$prospecto->celular}}</td>
                                    <td>{{$prospecto->updated_at}}</td>
                                    <td>{{$prospecto->seguimiento->nombre??"Sin Seguimiento"}}</td>
                                    <td>{{$prospecto->fecha_cambio}}</td>


                                    <td>
                                        <div class="btn-group">
                                            <a href="{{url("home/prospectos/$prospecto->id/edit")}}"
                                               class="btn btn-info"><i class="fas fa-eye text-white"></i></a>
                                            {{--<a class="btn btn-danger" data-toggle="modal"
                                               data-target="#deleteResourceModal"
                                               data-resource-id="{{$prospecto->id}}"
                                               data-resource-name="{{$prospecto->name}}"><i class="fas fa-trash text-white"></i></a>--}}
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Facebook</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Fecha de Asignación</th>
                                <th>Status Seguimiento</th>
                                <th>Fecha de Seguimiento</th>
                                <th>Acciones</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>

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
                        <button type="button" class="btn btn-secondary fa-" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="BORRAR">

                    </div>
                </div>
            </form>
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

        $(function () {
            $("#table").DataTable({
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                },
                "autoWidth": true
            });

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
            })

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




