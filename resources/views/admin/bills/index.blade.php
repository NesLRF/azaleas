@extends('layouts.app')

@section('title')
    Registro de gastos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Gastos Fijos y Otros Gastos</h3>
                    </div>
                    <form action="{{ route('bills.store') }}" method="POST" id="pay-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Tipo de gasto:</label>
                                        <select class="form-control select2" data-placeholder="Select a State"
                                            name="bills_type_id" style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label>Cantidad de:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" required name="amount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <label>Descripcion:</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" placeholder="Comentario..." required name="description" value="{{ old('description') }}"></textarea>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label>Del mes:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            data-inputmask-inputformat="mm-yyyy" data-mask name="month_selected" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info" type="submit">Registrar</button>
                            <button type="reset" class="btn btn-outline-danger float-right">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="far fa-chart-bar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de Gastos Fijos</span>
                        <span class="info-box-number">{{$total_fixed}}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{$total_fixed}}%"></div>
                        </div>
                        <span class="progress-description">
                            Disminución de Gastos Fijos en 70%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de Otros Gastos</span>
                        <span class="info-box-number">{{$total_others}}</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{$total_others}}%"></div>
                        </div>
                        <span class="progress-description">
                            Disminución de Otros Gastos en 60%
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Todos los gastos</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tipo de gasto: </th>
                                    <th>Cantidad: </th>
                                    <th>Comentario: </th>
                                    <th>Fecha: </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $item)
                                    <tr>
                                        <td>{{ $item->type->name }}</td>
                                        <td>${{ $item->amount }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->capture_month }}-{{ $item->capture_year}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {!! $bills->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                // "buttons": [{
                //         extend: 'copy',
                //         text: 'Copiar',
                //         "titleAttr": "Copiar",
                //         "className": "btn btn-secondary"
                //     },
                //     {
                //         extend: 'csv',
                //         text: 'csv',
                //         "titleAttr": "Esportar a CSV",
                //         "className": "btn btn-info"
                //     },
                //     {
                //         extend: 'excel',
                //         "titleAttr": "Esportar a Excel",
                //         "className": "btn btn-success"
                //     },
                //     {
                //         extend: 'print',
                //         "titleAttr": "Imprimir archivo",
                //         text: 'PDF',
                //         "className": "btn btn-danger"
                //     }
                // ],
                "oLanguage": {
                    "sSearch": "Buscar:",
                    "sEmptyTable": "No hay informacion que mostrar",
                    "sInfo": "Mostrando  del _START_ al _END_ de un total de _TOTAL_ registros",
                },
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $('[data-mask]').inputmask();
        var data = {!! $types !!}
        $(function() {
            $('.select2').select2({
                data: data,

            });


        })
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
    </style>
@endsection

@section('fonts')
@endsection
