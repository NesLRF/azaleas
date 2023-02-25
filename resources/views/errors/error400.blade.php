@extends('layouts.app')

@section('title')
    ACCESO NO AUTORIZADO
@endsection

@section('content')
<section class="content">
  <div class="error-page">
    <h2 class="headline text-warning"> 404</h2>

    <div class="error-content">
      <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Página no encontrada.</h3>

      <p>
        No pudimos encontrar la página que estabas buscando.
        Mientras tanto, puede volver al <a href="{{route('home')}}">inicio</a> del sistema.
      </p>
    </div>
    <!-- /.error-content -->
  </div>
  <!-- /.error-page -->
</section>
@endsection