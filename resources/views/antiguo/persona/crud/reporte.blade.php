@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Listado de personas</h3>
           @include('persona.crud.search')
     </div>
</div>

<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                         <th>Id</th>
               <th>ci</th>
               <th>Nombre</th>
               <th>Ap. paterno</th>
               <th>Ap. materno</th>
               <th>Ap. casada</th>
               <th>Fecha nac</th>
               <th>Genero</th>
               <th>Celular</th>
               <th>Dependientes</th>
               <th>Estado civil</th>
               <th>Profesión</th>
                    </thead>
               @foreach ($personas as $pe)
                    <tr>
                         <td>{{$pe->id_persona}} </td>
               <td>{{$pe->ci}} </td>
               <td>{{$pe->nombre}} </td>
               <td>{{$pe->ap_paterno}} </td>
               <td>{{$pe->ap_materno}} </td>
               <td>{{$pe->ap_casada}} </td>
               <td>{{$pe->fec_nac}} </td>
               <td>{{$pe->genero}} </td>
               <td>{{$pe->celular}} </td>
               <td>{{$pe->dependientes}} </td>
               <td>{{$pe->estado_civil}} </td>
               <td>{{$pe->id_profesion}} </td>
               <td>
                     <a href="{{url('/word/'.$pe->id_persona)}}" rel="tooltip" title="Generar reporte acta de sub comite de credito" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-edit"></i> 
                        </a>
               </td>
                    </tr>
                   
                    @endforeach
               </table>
          </div>
         {{$personas->links()}}
     </div>
</div>

@endsection