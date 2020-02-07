@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>INFORMACIÓN DEL CRÉDITO</h3>
 </div>
</div>

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Progreso del llenado de tablas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">Id</th>
                  <th>Nombre</th>
                  <th>Fecha inicio de tramite</th>
                  <th>Progreso Llenado de datos</th>
                  <th style="width: 40px">%</th>
                </tr>
                <tr>
                  <td>{{$persona->id_persona}} </td>
                  <td>{{$persona->nombre.' '.$persona->ap_paterno.' '.$persona->ap_materno}} </td>
                  <td>{{$persona->created_at->format('d/m/Y')}}</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width:{{$porcentaje}}%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">{{$porcentaje}}%</span></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>SEGUIMIENTO DE ATENCIÓN POR ÁREAS:</h3>
 </div>
</div>

<!-- /.box-header -->
<div class="box-body">
  <table id="a_seguimiento" class="table table-bordered table-striped">
    <thead>
      <tr>
       <th>Id seguimiento</th>
       <th>Fecha inicio</th>
       <th>Fecha Fin</th>
       <th>Usuario destino</th>
       <th>Área destino</th>
       <th>Observaciones</th>
       <th>Desembolsado</th>
       <th>Completado</th>
       <th>Área</th>
     </tr>
   </thead>
   <tbody>
    @foreach ($seguimiento as $segui)
    <tr>
      <td>{{$segui->id_seguimiento}}</td>
      <td>{{$segui->fecha_inicio}}</td>
      <td>{{$segui->fecha_fin}}</td>
      <td>
      @foreach($usuarios as $u)
        @if($u->id_users==$segui->usuario_destino)
          {{$u->name}}
        @endif
      @endforeach
      </td>
      <td>
      @foreach($areas as $a)
        @if($a->id_area==$segui->area_destino)
          {{$a->area}}
        @endif
      @endforeach
      </td>
      <td>{{$segui->observaciones}}</td>
      <td>
      @if($segui->desembolsado)
       Si
       @else
       No
       @endif
      </td>
      <td>
      @if($segui->completado)
       Si
       @else
       No
       @endif
      </td>
      <td>{{$segui->area}}</td>
  </tr>
  @endforeach
</tbody>
</table>
<!--  Suma del total-->
</div>
<!-- /.box-body -->
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <h3>Tiempo total de atención por áreas</h3>   
   {{$tiempo_seguimiento[0]->sum}}
 </div>
</div>

@include('sweetalert::alert')

@push ('scripts')
<script>
  $('#aLi_seguimiento').addClass("treeview active");
  $('#aLi_seguimiento_sub').addClass("active");
</script>
@endpush
@endsection
