@extends('layouts.app')

@section('title')
    Pago de mantenimiento
@endsection

@section('content')
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Registrar pago</h3>
            </div>
            <div class="card-body">
                <form action="{{route('send_payment_data')}}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <select class="form-control select2" data-placeholder="Select a State" style="width: 20%;" name="id_selected">
                        </select>
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit">Registrar</button>
                        </div>
                    </div>
                </form>
                {{-- <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>

                <h4>With icons</h4>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email">
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-ambulance"></i></div>
                    </div>
                </div>

                <h5 class="mt-4 mb-2">With checkbox and radio inputs</h5>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <input type="checkbox">
                                </span>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="radio"></span>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        
        var data = {!! $info !!}
        $(function() {
            $('.select2').select2({
                data: data,
                
            });

        })
    </script>
@endsection

@section('stilos')
    <style type="text/css">
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 18px
        }
    </style>
@endsection
