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

<form method="post" action="{{url('/asesoria/seguimiento/')}}">
  {{csrf_field()}}
  <div class="row"> 

 <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   <div class="form-group">
    <label>Marcar Hora inicio</label>
     <input type="checkbox" name="fecha_inicio" id="myCheck" onclick="myFunction()" style="width: 20px;height: 20px;" value="1" required>
     <p id="text" style="display:none">Hora Marcada</p>      
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
