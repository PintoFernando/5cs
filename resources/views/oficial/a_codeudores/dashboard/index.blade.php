@extends ('layouts.admin3')
@section ('contenido')

<section class="content-header">
<div class="row">
  <h1>
    Panel de control
  </h1>

   <!-- div usuario seleccionado-->
   <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">U. Seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial','Usuario no seleccionado')}}
        </span>
      </div>
    </div>
  </div>
<!-- div usuario seleccionado-->

</div>
</section>

<div class="box-body">
<div class="row">
@if(session('notification'))
<div class="alert alert-success">
   {{session('notification')}}
</div>
@endif
</div>
</div>

@include('sweetalert::alert')
@endsection
