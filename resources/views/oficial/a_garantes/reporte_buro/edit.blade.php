@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Reporte Buro:{{$reporte->id_reporte_buro}}</h3>
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

<form method="post" action="{{url('/oficial/reporte_buro/'.$reporte->id_reporte_buro.'/edit')}}">
  {{csrf_field()}}
  <div class="row">

   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
     <label for="tiempo_maximo_mora">Tiempo Máximo Mora</label>
     <input type="number" min="0" name="tiempo_maximo_mora" class="form-control" value="{{old('tiempo_maximo_mora',$reporte->tiempo_maximo_mora)}}">
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <label>Buro consultado</label>
     <select name="id_buro" class="form-control selectpicker" data-size="5" id="id_buro" data-live-search="true">
       @foreach ($buros as $bu)
       @if($bu->id_buro==$reporte->id_buro)
       <option value="{{$bu->id_buro}}" selected>{{$bu->nombre_buro}}</option>
       @else
       <option value="{{$bu->id_buro}}">{{$bu->nombre_buro}}</option>
       @endif
       @endforeach
     </select> 
   </div>
 </div>

 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/oficial/reporte_buro')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>
 </div>
</div>
</form>
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liReporteBuro').addClass("active");
</script>
@endpush
@endsection
