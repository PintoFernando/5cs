@extends ('layouts.admin3')
@section ('contenido')
<!-- div usuario seleccionado-->
<div class="box-body">
 <h3> Seguimiento del Crédito</h3>
 <h3> Id Crédito: {{Session::get('id_credito')}}</h3>
 <div class="col-md-3 col-sm-6 col-xs-12" style="float:right;">
  <div class="info-box bg-green">
    <span class="info-box-icon"><i class="fa fa-user"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">U. Seleccionado</span>
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

@if(session('notification'))
<div class="alert alert-success">
 {{session('notification')}}
</div>
@endif
<!-- /.box-header -->
<div class="box-body">
  <table id="o_seguimiento" class="table table-bordered table-striped">
    <thead>
      <tr>      
       <th>Id</th>
       <th>Fecha inicio</th>
       <th>Fecha fin</th>
       <th>Usuario destino</th> 
       <th>Área destino</th>    
       <th>Observaciones</th>          
       <th>Desembolsado</th>
       <th>Área</th>             
       <th>Usuario</th> 
       <th>Acciones</th>            
     </tr>
   </thead>
   <tbody>
    @foreach ($seguimiento as $se)
    <tr>   
    <td>{{$se->id_seguimiento}}</td>
      <td>{{$se->fecha_inicio}}</td>
      <td>{{$se->fecha_fin}}</td> 
      <td>
      @foreach ($usuarios as $u)
      @if($u->id_users==$se->usuario_destino)       
        {{$u->name}}
       @endif
      @endforeach
      </td> 

      <td>
      @foreach ($areas as $a)
      @if($a->id_area==$se->area_destino)       
        {{$a->area}}
       @endif
      @endforeach
      </td>
      <td>{{$se->observaciones}}</td>
      <td>
       @if($se->desembolsado==1)       
       SI
       @else
       NO
       @endif
     </td> 
     <td>{{$se->area}}</td>    
     <td>{{$se->name}}</td>

      <td> 
      <!--<a href="{{url('/riesgos/seguimiento/'.$se->id_seguimiento.'/edit_fin')}}"> <button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-saved"></span>Marcar fin</button> </a>-->
      <a href="{{url('/riesgos/seguimiento/'.$se->id_seguimiento.'/edit_derivar')}}"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-user"></span>Derivar </button> </a> 
      </td>    

   </tr>
   @endforeach
 </tbody>                
</table>
</div>
<!-- /.box-body -->
@include('sweetalert::alert')
@endsection