@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Editar Inmueble:{{$cro->id_croquis}}</h3>
   @if (count($errors)>0)
   <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif


  <h1>Selecciona la localización para editarla</h1>
  <p>Click en la localización del mapa para seleccionarlo. Mueve el cursor para cambiar la localización.</p>
  
  <!--map div-->
  <div id="map"></div>



  <form method="post" action="{{url('/croquis/crud/'.$cro->id_croquis.'/edit')}}">
    {{csrf_field()}}
    


    <input type="text" id="lat" name="latitud" readonly="yes">
    <input type="text" id="lng" name="longitud" readonly="yes">             
    
    

    
    <div class="form-group">
     <button class="btn btn-primary" type="submit">Guardar</button>
     <a href="{{url('/direccion/crud')}}" class="btn btn-default"> cancelar</a>
     <button class="btn btn-danger" type="reset">Restablecer</button>
   </div>
   
 </form>
</div>
</div>
@endsection
