@extends('layouts.app')

@section('title')
    Registrar nuevo usuario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card-footer">
            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-user-neighbor">
                Agregar usuario
            </button>
            <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modal-user-guardia">
                Agregar guardia
            </button>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Todos los usuarios </h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombres: </th>
                                    <th>Apellidos: </th>
                                    <th>Domicilio: </th>
                                    <th>Correo: </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>
                                            <p>
                                                @if (count($item->properties) > 0)
                                                    {{ $item->properties->first()->domicilio . ' (Dueño)' }}<br>
                                                @endif
                                                @if (count($item->rents) > 0)
                                                    {{ $item->rents->first()->domicilio . ' (Inquilino)' }}
                                                @endif
                                            </p>

                                        </td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {!! $users->onEachSide(0)->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL USERS --}}
    <div class="modal fade" id="modal-user-neighbor">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST" id="pay-form">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Crear nuevo usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Nombres:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {{-- <span class="input-group-text">
                                                <i class="fas fa-dollar-sign"></i>
                                            </span> --}}
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nombre(s)" required name="name"
                                                value="{{ old('type') != 'guardia' ? old('name') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Apellidos:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                placeholder="Apellidos" required name="last_name"
                                                value="{{ old('type') != 'guardia' ? old('last_name') : '' }}">
                                            {{-- <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-check"></i></span>
                                        </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label>Correo:</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email"
                                    class="form-control @error('email') @if (old('type') != 'guardia') is-invalid @endif @enderror"
                                    placeholder="Email" name="email"
                                    value="{{ old('type') != 'guardia' ? old('email') : '' }}">
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="password"
                                        class="form-control @error('password') @if (old('type') != 'guardia') is-invalid @endif @enderror"
                                        placeholder="Contraseña" name="password">
                                </div>
                                <label>Confirmar contraseña:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="password"
                                        class="form-control @error('password') @if (old('type') != 'guardia') is-invalid @endif @enderror"
                                        placeholder="Confirmar contraseña" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>No. de condomino:</label>
                                        <select class="form-control select2" data-placeholder="Select a State"
                                            name="condomino_id" style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label>Situacion</label>
                                        <div class="input-group">
                                            <div class="form-check">
                                                <label>
                                                    <input class="form-check-input" required type="radio" name="status"
                                                        value="owner">
                                                    <i>Dueño</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="form-check">
                                                <label>
                                                    <input class="form-check-input" required type="radio" name="status"
                                                        value="tenant">
                                                    <i>Inquilino</i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-info" type="submit">Registrar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- END MODAL USERS --}}

    {{-- MODAL GUARDIA --}}
    <div class="modal fade" id="modal-user-guardia">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.store') }}" method="POST" id="pay-form">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Crear nuevo Guardia</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Nombres:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                {{-- <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span> --}}
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nombre(s)" required name="name"
                                                value="{{ old('type') == 'guardia' ? old('name') : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Apellidos:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                placeholder="Apellidos" required name="last_name"
                                                value="{{ old('type') == 'guardia' ? old('last_name') : '' }}">
                                            {{-- <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-check"></i></span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label>Correo:</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email"
                                    class="form-control @error('email') @if (old('type') == 'guardia') is-invalid @endif @enderror"
                                    placeholder="Email" name="email"
                                    value="{{ old('type') == 'guardia' ? old('email') : '' }}">
                            </div>
                            <label>Contraseña:</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="password"
                                    class="form-control @error('password') @if (old('type') == 'guardia') is-invalid @endif @enderror"
                                    placeholder="Contraseña" name="password">
                            </div>
                            <label>Confirmar contraseña:</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="password"
                                    class="form-control @error('password') @if (old('type') == 'guardia') is-invalid @endif @enderror"
                                    placeholder="Confirmar contraseña" name="password_confirmation">
                            </div>
                            <input type="hidden" name="type" value="guardia">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-info" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- END MODAL GUARDIA --}}
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/adminlte/plugins/moment/moment.min.js"></script>
    <script src="/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="/adminlte/plugins/toastr/toastr.min.js"></script>
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    {{-- <script src={{asset('adminlte/plugins/datatables/jquery.dataTables.js')}}> </script> --}}
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": false,
                "info": false,
                "ordering": false,
                "oLanguage": {
                    "sSearch": "Buscar:",
                    "sEmptyTable": "No hay informacion que mostrar",
                    "sInfo": "Mostrando  del _START_ al _END_ de un total de _TOTAL_ registros",
                },
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        var data = {!! $info !!}
        $(function() {
            $('.select2').select2({
                data: data,

            });

        })
        $('[data-mask]').inputmask()
    </script>
    @if (Session::get('status') == 200)
        <script>
            toastr.options = {
                fadeIn: 1000,
                closeButton: true,
                fadeOut: 1000,
                extendedTimeOut: 1000,
                iconClass: 'toast-info',
                positionClass: 'toast-top-right',
                timeOut: 10000,
                progressBar: true,
            };
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif
    @if (Session::get('status') == 400)
        <script>
            toastr.options = {
                fadeIn: 1000,
                closeButton: true,
                fadeOut: 1000,
                extendedTimeOut: 1000,
                iconClass: 'toast-info',
                positionClass: 'toast-top-right',
                progressBar: true,
                timeOut: 15000,
            };
            toastr.info("{{ Session::get('message') }}, verifique la información");
        </script>
    @endif
    @if (Session::get('status') == 500)
        <script>
            toastr.options = {
                fadeIn: 1000,
                closeButton: true,
                fadeOut: 1000,
                extendedTimeOut: 1000,
                positionClass: 'toast-top-right',
                progressBar: true,
                timeOut: 15000,
            };
            toastr.error("{{ Session::get('message') }}");
        </script>
    @endif
@endsection

@section('stilos')
    <style type="text/css">
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 18px
        }

        .card-warning:not(.card-outline)>.card-header,
        .card-warning:not(.card-outline)>.card-header a {
            color: #ffffff;
        }

        .card-warning:not(.card-outline)>.card-header {
            background-color: #605ca8;
        }

        .card-footer {
            padding: 0.75rem 1.25rem;
            background-color: rgb(0 0 0 / 9%);
            border-top: 0 solid rgba(0, 0, 0, .125);
        }
    </style>
@endsection
