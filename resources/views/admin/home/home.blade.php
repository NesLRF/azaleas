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
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

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
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_neighbors }}</h3>

                            <p>Vecinos registrados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Ver usuarios <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>47<sup style="font-size: 20px">%</sup></h3>

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
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <strong>Datos de Enero - {{ $months['current_month'] }}
                                            {{ $months['current_month_year'] }}</strong>
                                    </p>
                                    <p class="text-success text-center">Cuota actual: <strong>${{ $fee }}</strong></p>
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total al año estimado</span>
                                                    <span class="info-box-number text-center text-muted mb-0">${{ $total_annual }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total al mes estimado</span>
                                                    <span class="info-box-number text-center text-muted mb-0">${{ $total_mensual }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total de pagos realizados en {{ $months['current_month'] }}</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $month_payments_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Total de pagos realizados en {{ $months['current_month'] }}</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $month_payments_count }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Metas alcanzadas de {{ $months['current_month'] }}-{{ $months['current_month_year'] }} </strong>
                                    </p>

                                    <div class="progress-group">
                                        Total de condominos pagados
                                        <span class="float-right"><b>160</b>/169</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->

                                    <div class="progress-group">
                                        Total de morosos
                                        <span class="float-right"><b>310</b>/400</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Meta de egresos alcanzado</span>
                                        <span class="float-right"><b>480</b>/800</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" style="width: 60%"></div>
                                        </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        Gastos realizados
                                        <span class="float-right"><b>250</b>/500</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <!-- /.progress-group -->
                                </div>
                                <!-- /.col -->
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
                                            0%</span>
                                        <h5 class="description-header">$10,390.90</h5>
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
                                            18%</span>
                                        <h5 class="description-header">1200</h5>
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
