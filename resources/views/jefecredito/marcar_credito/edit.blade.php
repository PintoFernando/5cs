@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Marcar Crédito como Desembolsado</h3>
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

<form method="post" action="{{url('/jefecredito/marcar_credito/'.$credito->id_credito.'/edit')}}" enctype="multipart/form-data">
  {{csrf_field()}}
  <div class="row">

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
   <div class="form-group">
    <label>Marcar</label>
     <input type="checkbox" name="marcar" id="myCheck" onclick="myFunction()" style="width: 40px;height: 40px;" value="1" required>
     <p id="text" style="display:none ">Marcado como desembolsado</p>      
   </div>
 </div>

   <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a href="{{url('jefecredito/marcar_credito')}}" class="btn btn-default">cancelar</a>
      <button class="btn btn-danger" type="reset">Restablecer</button>
    </div>
  </div>

</div>
</form>

@push ('scripts')
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
@endpush
@push ('scripts')
<script>
  $('#liJefe_marcar').addClass("active");
</script>
@endpush
@endsection
