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
                                            <input type="number" class="form-control" required name="amount_paid">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Pagado por:</label>
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
                            <button type="reset" class="btn btn-outline-danger float-right">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Pago de mantenimiento anual</h3>
                    </div>
                    <form action="{{ route('send_annual_payment_data') }}" method="POST" id="pay-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="callout callout-warning">
                                    <h5>Al Pagar anualidad!</h5>
                                    <p>Si se realiza el pago de este mes {{$current_month}} se bonificará el 13avo mes del siguiente año {{$last_month}}</p>
                                </div>
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
                                            <input type="number" class="form-control" required name="amount_paid">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Pagado por:</label>
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
                            <button type="reset" class="btn btn-outline-danger float-right">Cancel</button>
                        </div>
                    </form>
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        var data = {!! $info !!}
        $(function() {
            $('.select2').select2({
                data: data,

            });

        })
        $('[data-mask]').inputmask()
        //validations
        // $(function() {
        //     $('#pay-form').validate({
        //         rules: {
        //             id_selected: {
        //                 required: true,
        //             },
        //             month_selected: {
        //                 required: true,
        //             },
        //         },
        //         messages: {
        //             id_selected: {
        //                 required: "Seleccione un condomino",
        //             },
        //             month_selected: {
        //                 required: "Seleccione el mes a pagar",
        //             },
        //         },
        //         errorElement: 'span',
        //         errorPlacement: function(error, element) {
        //             error.addClass('invalid-feedback');
        //             element.closest('.form-group').append(error);
        //         },
        //         highlight: function(element, errorClass, validClass) {
        //             $(element).addClass('is-invalid');
        //         },
        //         unhighlight: function(element, errorClass, validClass) {
        //             $(element).removeClass('is-invalid');
        //         }
        //     });
        // });
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
