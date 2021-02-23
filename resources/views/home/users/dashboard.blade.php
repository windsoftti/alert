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

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
@stop

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1> <span class="badge badge-secondary">{{count($users)}}</span> Promotores
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url("/")}}">Inicio</a></li>
                <li class="breadcrumb-item active">Promotores</li>
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
                        <a href="{{url("/")}}/home/users/create" type="button"
                           class="btn btn-block btn-success text-white"><i class="fas fa-plus-circle"></i> Agregar</a>

                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Gerente</label>
                                <select id="table-filter" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach ($gerentes as $gerente)
                                        <option>{{$gerente->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <table id="resources" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Tipo</th>
                            <th>Asignado a</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->celular}}</td>
                            <td>{{$user->tipo->nombre}}</td>
                            <td>{{$user->asignado->name}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{url("home/users/$user->id/edit")}}" class="btn btn-info">
                                        <i class="fas fa-eye text-white"></i>
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteResourceModal"
                                            data-resource-id="{{$user->id}}"
                                            data-resource-name="{{$user->name}}">
                                        <i class="fas fa-trash text-white"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Tipo</th>
                            <th>Asignado a</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                    </table>
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
                        <h5 class="modal-title" id="deleteResourceLabel">Confirmar borrar usuario <span class="placehold-del-res"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de borrar al usuario <span class="placehold-del-res-name"></span>?

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
            // Datatable
            var table = $("#resources").DataTable({
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
                },
                "responsive": true,
                "autoWidth": false,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
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
                $('#delResForm').get(0).setAttribute('action', baseUrl+'/home/users/'+resourceId); //this works
            });

            $('#table-filter').on('change', function(){
                table.search(this.value).draw();
            });

            // Status Notification
            if (typeof statusTrans.body !== 'undefined') {
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




