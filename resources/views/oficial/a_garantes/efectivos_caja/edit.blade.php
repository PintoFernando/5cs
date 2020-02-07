@extends ('layouts.admin3')
@section ('contenido')

<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-user text-black"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Garante seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_garante','Usuario no seleccionado')}}
        </span>
      </div>
    </div>
  </div>


<div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">S. Seleccionado</span>
        <span class="info-box-number"> </span>

        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial','Usuario no seleccionado')}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3> Editar Efectivo Caja</h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
</div>

<form method="post" action="{{url('/oficial/a_garantes/efectivos_caja/'.$efe->id_efectivos_caja.'/edit')}}">
    {{csrf_field()}}

  <div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="caja">Caja</label>
     <input type="number" step="any" name="caja" class="form-control" value="{{old('caja',$efe->caja)}}">
   </div>
 </div>


 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <button class="btn btn-info" type="reset">Restablecer</button>
   <a href="{{url('/oficial/a_garantes/efectivos_caja')}}" class="btn btn-danger">Cancelar</a>
 </div>
</div>
</div>
</form>
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_efectivo_caja').addClass("active");
</script>
@endpush
@endsection
