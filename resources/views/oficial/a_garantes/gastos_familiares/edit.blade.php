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
   <h3>Editar Gasto Familiar:{{$gastos->id_gasto_familiar}}</h3>
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

  <form method="post" action="{{url('/oficial/a_garantes/gastos_familiares/'.$gastos->id_gastos_familiares.'/edit')}}">
    {{csrf_field()}}
<div class="row">
   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="alimentacion">Alimentacion</label>
       <input type="number" step="any" min="0" name="alimentacion" class="form-control" value="{{old('alimentacion',$gastos->alimentacion)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="energia_electrica">Energía Eléctrica</label>
       <input type="number" step="any" min="0" name="energia_electrica" class="form-control" value="{{old('energia_electrica',$gastos->energia_electrica)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="agua">Agua</label>
       <input type="number" step="any" min="0" name="agua" class="form-control" value="{{old('agua',$gastos->agua)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="telefono">Teléfono</label>
       <input type="number" step="any" min="0" name="telefono" class="form-control" value="{{old('telefono',$gastos->telefono)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="gas">Gas</label>
       <input type="number" step="any" min="0" name="gas" class="form-control" value="{{old('gas',$gastos->gas)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="impuestos">Impuestos</label>
       <input type="number" step="any" min="0" name="impuestos" class="form-control" value="{{old('impuestos',$gastos->impuestos)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="alquileres">Alquileres</label>
       <input type="number" step="any" min="0" name="alquileres" class="form-control" value="{{old('alquileres',$gastos->alquileres)}}">
     </div>
   </div>

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="educacion">Educación</label>
       <input type="number" step="any" min="0" name="educacion" class="form-control" value="{{old('educacion',$gastos->educacion)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="transporte">Transporte</label>
       <input type="number" step="any" min="0" name="transporte" class="form-control" value="{{old('transporte',$gastos->transporte)}}">
     </div>
   </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="salud">Salud</label>
       <input type="number" step="any" min="0" name="salud" class="form-control" value="{{old('salud',$gastos->salud)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="empleada">Empleada</label>
       <input type="number" step="any" min="0" name="empleada" class="form-control" value="{{old('empleada',$gastos->empleada)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="diversion">Diversion</label>
       <input type="number" step="any" min="0" name="diversion" class="form-control" value="{{old('diversion',$gastos->diversion)}}">
     </div>
   </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="vestimenta">Vestimenta</label>
       <input type="number" step="any" min="0" name="vestimenta" class="form-control" value="{{old('vestimenta',$gastos->vestimenta)}}">
     </div>
   </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
       <label for="otros">Otros</label>
       <input type="number" step="any" min="0" name="otros" class="form-control" value="{{old('otros',$gastos->otros)}}">
     </div>
   </div>

    
    
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
     <div class="form-group">
       <button class="btn btn-primary" type="submit">Guardar</button>
       <a href="{{url('/oficial/a_garantes/gastos_familiares')}}" class="btn btn-default">cancelar</a>
       <button class="btn btn-danger" type="reset">Restablecer</button>
     </div>
   </div>
</div>
   </form>
@push ('scripts')
<script>
  $('#liGarante').addClass("treeview active");
  $('#liGarante_sub_gastos_familiares').addClass("active");
</script>
@endpush
@endsection
