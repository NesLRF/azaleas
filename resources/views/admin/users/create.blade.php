@extends('layouts.app')

@section('title')
    Registrar nuevo usuario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Usuario</h3>
                    </div>
                    <form action="{{ route('users.store') }}" method="POST" id="pay-form">
                        @csrf
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
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre(s)" required name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>Apellidos:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Apellidos" required name="last_name" value="{{old('last_name')}}">
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{old('email')}}">
                            </div>
                            <label>Contraseña:</label>
                            <div class="input-group mb-3">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password">
                            </div>
                            <label>Confirmar contraseña:</label>
                            <div class="input-group mb-3">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Confirmar contraseña" name="password_confirmation">
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
                                                    <input class="form-check-input" required type="radio" name="status" value="owner" >
                                                    <i>Dueño</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="form-check">
                                                <label>
                                                    <input class="form-check-input" required type="radio" name="status" value="tenant" >
                                                    <i>Inquilino</i>
                                                </label>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info" type="submit">Registrar</button>
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
        .card-warning:not(.card-outline)>.card-header, .card-warning:not(.card-outline)>.card-header a {
            color: #ffffff;
        }
        .card-warning:not(.card-outline)>.card-header {
            background-color: #605ca8;
        }
    </style>
@endsection
