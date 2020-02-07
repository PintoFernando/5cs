@extends ('layouts.admin3')
@section ('contenido')

<!-- div usuario seleccionado-->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
    <div class="info-box bg-light-blue">
      <span class="info-box-icon"><i class="fa fa-user text-orange"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Codeudor seleccionado</span>
        <span class="info-box-number"> </span>
        <div class="progress">
          <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
          {{Session::get('id_persona_oficial_codeudor','Codeudor no seleccionado')}}
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
    </div>
  </div>
</div>
<!-- div usuario seleccionado-->


<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Amortizacion Coop. San Martín</h3>
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

<div class="row">
<form method="post" action="{{url('/oficial/a_codeudores/capacidad_pago/'.$capacidad->id_capacidad_pago.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
     <div class="form-group">
       <label>Porcentaje</label>
       <select name="porcentaje" class="form-control selectpicker" data-size="5" id="porcentaje" data-live-search="true">

        @if ($capacidad->porcentaje==0.25)
        <option value="{{$capacidad->porcentaje}}" selected>25%</option>
        <option value="0.4" >40%</option>
        <option value="1" >100%</option>
        @elseif ($capacidad->porcentaje==1)
        <option value="{{$capacidad->porcentaje}}" selected>100%</option>
        <option value="0.4" >40%</option>
        <option value="0.25" >25%</option>
        @else
        <option value="{{$capacidad->porcentaje}}" selected>40%</option>
        <option value="0.25" >25%</option>
        <option value="1" >100%</option>
        @endif
         


       </select> 
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="amortizacion_coop_san_martin">Amortización Coop San Martín</label>
     <input type="number" step="any"name="amortizacion_coop_san_martin" class="form-control" value="{{old('amortizacion_coop_san_martin',$capacidad->amortizacion_coop_san_martin)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/a_codeudores/capacidad_pago')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>
 </div>

</div>
</div>
</form>
@push ('scripts')
<script>
  $('#liCodeudor').addClass("treeview active");
  $('#liCodeudor_sub_capacidad_pago').addClass("active");
</script>
@endpush
@endsection
