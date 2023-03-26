@extends('layouts.app')

@section('title')
    Resultados de {{ $months['current_month'] }}
@endsection

@section('content')
    <div class="container-fluid">
        @hasanyrole('SuperAdmin|Admin')
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$maintenance_payments_percent}}<sup style="font-size: 20px">%</sup></h3>

                            <p>Mantenimientos de {{ $months['current_month'] }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sort-amount-up"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Consultar pagados <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$maintenance_not_payment_percent}}<sup style="font-size: 20px">%</sup></h3>

                            <p>Mantenimientos pendientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sort-amount-down-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Consultar pendientes <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_neighbors }}</h3>

                            <p>Vecinos registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="{{ route('users.create') }}" class="small-box-footer">
                            Ver usuarios <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$visits_count}}</h3>

                            <p>Registros de entrada</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <a href="{{ route('visits.index') }}" class="small-box-footer">
                            Consultar datos <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <br>
            {{-- Ingresos y Egresos --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Resumen de reporte mensual {{ $months['current_month_year'] }}</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>Datos de Enero - {{ $months['current_month'] }}
                                            {{ $months['current_month_year'] }}</strong>
                                    </p>
                                    <p class="text-success text-center">Cuota actual: <strong>${{ $fee }}</strong></p>
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Ingresos anuales si se realizan los pagos con la cuota acutal">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total al año estimado</span>
                                                    <span class="info-box-number text-center text-muted mb-0">${{ $total_annual }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Ingresos mensuales si se realizan los pagos con la cuota acutal">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total al mes estimado</span>
                                                    <span class="info-box-number text-center text-muted mb-0">${{ $total_mensual }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Cantidad de mantenimientos pagados en el mes de {{$months['current_month']}}">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total de pagos realizados en {{ $months['current_month'] }}</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $month_payments_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Cantidad de mantenimientos pagados en el mes de {{$months['current_month']}}">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total de pagos realizados en el año {{ $months['current_month_year'] }}</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $annual_payments_fee_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Si se paga entre el día 1 al 5 se bonifican $100. Si se paga entre el día 6 al 10 se bonifican $50.">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total al año estimado con bonificación</span>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="info-box-number text-center text-muted mb-0">1 al 5: ${{$annual_bonification_fee_1_5_format}}</span>
                                                        </div>
                                                        <div class="col-6">    
                                                            <span class="info-box-number text-center text-muted mb-0">6 al 10: ${{$annual_bonification_fee_6_10_format}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Si se paga entre el día 1 al 5 se bonifican $100. Si se paga entre el día 6 al 10 se bonifican $50.">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total al mes estimado con bonificación</span>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="info-box-number text-center text-muted mb-0">1 al 5: ${{$bonification_fee_1_5_format}}</span>
                                                        </div>
                                                        <div class="col-6">    
                                                            <span class="info-box-number text-center text-muted mb-0">6 al 10: ${{$bonification_fee_6_10_format}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Bonificaciones aplicadas por pagar en las fechas indicadas en el mes de {{ $months['current_month'] }}">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total de bonificaciones de pago en {{ $months['current_month'] }}</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $bonification_payments_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="info-box bg-light" data-toggle="tooltip" data-placement="top" title="Bonificaciones aplicadas por pagar en las fechas indicadas en el mes de {{ $months['current_month'] }}">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total de bonificaciones del año {{ $months['current_month_year'] }}</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $bonification_annual_payments_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                            {{$total_annual_percent_format}}%</span>
                                        <h5 class="description-header">{{$total_current_year_format}}</h5>
                                        <span class="description-text">TOTAL DEL AÑO</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                            {{$annual_bills_percent_format}}%</span>
                                        <h5 class="description-header">${{$annual_bills_format}}</h5>
                                        <span class="description-text">GASTOS DEL AÑO</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                            {{$total_current_month_percent_format}}%</span>
                                        <h5 class="description-header">${{$total_current_month_format}}</h5>
                                        <span class="description-text">TOTAL DEL MES</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                            {{$mensual_bills_percent_format}}%</span>
                                        <h5 class="description-header">${{$mensual_bills_format}}</h5>
                                        <span class="description-text">GASTOS DEL MES</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        @endhasanyrole
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection

@section('panel_status')
    active
@endsection