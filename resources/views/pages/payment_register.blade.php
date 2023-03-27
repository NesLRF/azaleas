@extends('layouts.app')

@section('title')
    Registrar pagos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Pago de mantenimiento mensual</h3>
                    </div>
                    <form action="{{ route('send_payment_data') }}" method="POST" id="pay-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>No. de condomino:</label>
                                        <select class="form-control select2" data-placeholder="Select a State"
                                            name="id_selected" style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label>Mes a pagar:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="mm-yyyy" data-mask name="month_selected"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Cantidad de:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" required name="amount_paid"
                                                value="{{$fee}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Descripción:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" required name="pay_registered_by">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-check"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Enviar recibo</h4>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="send_email">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info" type="submit">Registrar</button>
                            <button type="reset" class="btn btn-outline-danger float-right">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Multi pago</h3>
                    </div>
                    <form action="{{ route('send_annual_payment_data') }}" method="POST" id="pay-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="callout callout-warning">
                                    <h5><strong>Al Pagar Anualidad!</strong></h5>
                                    <p>Si se realiza el pago anual apartir de este mes <strong>{{ $current_month }}</strong> se bonificará el 13avo
                                        mes <strong>{{ $last_month }}</strong></p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label>Meses a Pagar:</label>
                                        <select class="form-control month_select" data-placeholder="Select a State"
                                            name="total_month" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label>No. de condomino:</label>
                                        <select class="form-control select2" data-placeholder="Select a State"
                                            name="id_selected" style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label>A partir del mes:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="mm-yyyy" data-mask name="month_selected"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Cantidad de:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" required name="amount_paid"
                                                value="{{ $fee }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Descripción:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" required name="pay_registered_by">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-check"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Enviar recibo</h4>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="send_email">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-warning" type="submit">Registrar</button>
                            <button type="reset" class="btn btn-outline-danger float-right">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Todos los pagos </h3>
                    </div>
                    <div class="card-body">
                        <form>
                            
                            <div class="input-group mb-3 justify-content-end">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="search" class="form-control w-25" placeholder="Buscar..." name="search" value="{{ request('search') }}">
                            </div>
                            
                        </form>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Direccion </th>
                                    <th>Condomino </th>
                                    <th>Fecha pagada </th>
                                    <th>Pago </th>
                                    <th>Descripcion </th>
                                    <th>Acciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allPayments as $item)
                                    <tr>
                                        <td>{{ $item->direccion->first()->domicilio }}</td>
                                        <td>{{ $item->direccion->first()->condomino }}</td>
                                        <td>{{ $item->capture_month.' - '.$item->capture_year }}</td>
                                        <td>{{ $item->paid}}</td>
                                        <td>{{ $item->description}}</td>
                                        <td>
                                            <button class="btn btn-info" >
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        {!! $allPayments->onEachSide(0)->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
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
                "searching": false,
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

            $('.month_select').select2({
                data: [{
                        "id": 2,
                        "text": "2"
                    },
                    {
                        "id": 3,
                        "text": "3"
                    },
                    {
                        "id": 4,
                        "text": "4"
                    },
                    {
                        "id": 5,
                        "text": "5"
                    },
                    {
                        "id": 6,
                        "text": "6"
                    },
                    {
                        "id": 7,
                        "text": "7"
                    },
                    {
                        "id": 8,
                        "text": "8"
                    },
                    {
                        "id": 9,
                        "text": "9"
                    },
                    {
                        "id": 10,
                        "text": "10"
                    },
                    {
                        "id": 11,
                        "text": "11"
                    },
                    {
                        "id": 12,
                        "text": "12"
                    }
                ],
            });

        });

        $('[data-mask]').inputmask()
    </script>
    @if (Session::get('status') == 200)
        <script>
            toastr.options = {
                fadeIn: 1000,
                closeButton: true,
                fadeOut: 1000,
                extendedTimeOut: 1000,
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


        .btn-warning {
            color: #f8f9fa;
            background-color: #605ca8;
            border-color: #605ca8;
            box-shadow: none;
        }
    </style>
@endsection

@section('payment_status')
    active
@endsection