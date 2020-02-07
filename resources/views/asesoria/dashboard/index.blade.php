@extends ('layouts.admin3')
@section ('contenido')

<section class="content-header">
  <h1>
    Panel de control
    <small>Panel de control</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Usurio actual seleccionado:</a></li>
    <li class="active">{{Session::get('id_persona_oficial','Usuario no seleccionado')}}</li>
  </ol>     
  <!-- /.content -->
  @include('sweetalert::alert')
  @endsection