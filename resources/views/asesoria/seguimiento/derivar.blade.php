@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3></h3>
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

<form method="post" action="{{url('/asesoria/seguimiento/'.$segui->id_seguimiento.'/edit_derivar')}}">
  {{csrf_field()}}
<div class="row"> 

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group" class="form-control">
   <label for="id_users">Usuario destino</label>
   <select name="id_users"  class="form-control selectpicker" data-size="5" id="id_ext" data-live-search="true">
     @foreach($usuarios_sis as $usu)
     <option value="{{$usu->id_users}}"> {{$usu->name}}</option>
     @endforeach
   </select>
 </div>
</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
  <div class="form-group">
    <label>Observaciones</label>
    <input type="text" name="observaciones" class="form-control">     
  </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <button class="btn btn-primary" type="submit">Guardar</button>
   <a href="{{url('/asesoria/seguimiento')}}" class="btn btn-warning"> cancelar</a>
   <button class="btn btn-danger" type="reset">Restablecer</button>
 </div>
</div>
</div>
</form>

<script type="text/javascript">
  function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("text");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}  
</script>

@endsection