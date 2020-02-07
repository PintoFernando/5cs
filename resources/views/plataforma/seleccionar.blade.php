@extends ('layouts.admin3')
@section ('contenido')
<div class="row" >
  <div id="print">

  <form method="GET" action="{{url('cliente/vcliente/registrar/seleccionar')}}">
    {{csrf_field()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <label>Seleccionar el tipo de credito</label>
        <select name="id_tcredito" class="form-control selectpicker" data-size="5" id="id_tcredito"  data-live-search="true">
         @foreach ($tipocredito as $tipo)
         <option value="{{$tipo->id_tcredito}}">{{$tipo->tipo_credito}}</option>
         @endforeach
       </select> 
    </div>
  </div>
  <hr>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
       <span class="input-group-btn">       
        <button type="submit"  class="btn btn-primary">Requisitos</button> 
         <button class="btn btn-info" onclick="imprimir()" type="button"><i class=" fa fa-print"></i>imprimir</button>
       </span>      
    </div>

</form>



<!--  contenedor del resultado-->
<?php
$tipo
?>

<table id="table" class="table table-bordered table-hover table-responsive">
  <thead >
    <tr>
      <th style="text-align: center">N°</th>
      <th>Requisito</th>
    </tr>
    {{ csrf_field() }}
  </thead>
  <tbody>
    <?php
    $cont=1;
    ?>
    @foreach ($requisitos as $re)
    <tr class="users{{$re->id_requisitos}}">
      <td style="text-align: center">{{ $cont}}</td>
      <td>{{ $re->descripcion}}</td>                       
    </tr>
    <?php $cont++; ?>
    @endforeach
  </tbody>
</table>
</div>
</div>

@push ('scripts')
<script src="{{asset('admin2/dist/js/jquery.PrintArea.js')}}"></script>
<script>
//Código para imprimir el svg
function imprimir()
{
    $("#print").printArea();
}
</script>
@endpush
@endsection
