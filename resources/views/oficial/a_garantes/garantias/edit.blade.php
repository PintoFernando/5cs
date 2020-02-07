@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Garantia:{{$garantia->id_garantia}}</h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form method="post" action="{{url('/oficial/garantias/'.$garantia->id_garantia.'/edit')}}">
    {{csrf_field()}}
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
     <div class="form-group">
      <label> Tipo de Garantia</label>
       <select name="id_tipo_garantia" class="form-control selectpicker" data-size="5" id="id_tipo_garantia" data-live-search="true">
         @foreach ($tipo_garantia as $ti)
         @if($ti->id_tipo_garantia==$garantia->id_tipo_garantia)
         <option value="{{$ti->id_tipo_garantia}}" selected>{{$ti->tipo_garantia}}</option>
         @else
         <option value="{{$ti->id_tipo_garantia}}">{{$ti->tipo_garantia}}</option>
         @endif
         @endforeach
       </select> 
     </div>
   </div>

   <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('oficial/garantias/')}}" class="btn btn-warning"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>

 </form>
</div>
</div>
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liGarantia').addClass("active");
</script>
@endpush
@endsection
