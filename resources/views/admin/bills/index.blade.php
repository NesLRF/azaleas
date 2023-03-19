@extends('layouts.app')

@section('title')
    Registro de gastos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Registrar gasto</h3>
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
                            <label>Descripcion:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Comentario..." name="description" value="{{old('description')}}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info" type="submit">Registrar</button>
                            <button type="reset" class="btn btn-outline-danger float-right">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Registrar gasto</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>Tipo de gasto</th>
                              <th>Cantidad</th>
                              <th>Comentario</th>
                              <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $item)
                                    <tr>
                                        <td>{{$item->type->name}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                @endforeach
                            
                            
                          </table>
                    </div>
                    {{-- <div class="card-footer">
                        <button class="btn btn-info" type="submit">Registrar</button>
                        <button type="reset" class="btn btn-outline-danger float-right">Cancel</button>
                    </div> --}}
                    
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
    <script src={{asset('adminlte/plugins/datatables/jquery.dataTables.js')}}> </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        $(document).ready(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        var data = {!! $types !!}
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
