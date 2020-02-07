@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Listado de Clientes <a href="{{url('/cliente/crud/create')}}"><button class="btn btn-success">Nuevo cliente</button></a></h3>
           @include('cliente.crud.search')
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
               <th>profesion</th>
                    </thead>
               @foreach ($clientes as $cli)
                    <tr>
               <td>{{$cli->id_persona}} </td>
               <td>{{$cli->ci}} </td>
               <td>{{$cli->nombre}} </td>
               <td>{{$cli->ap_paterno}} </td>
               <td>{{$cli->ap_materno}} </td>
               <td>{{$cli->ap_casada}} </td>
               <td>{{$cli->fec_nac}} </td>
               <td>{{$cli->genero}} </td>
               <td>{{$cli->celular}} </td>
               <td>{{$cli->dependientes}} </td>
               <td>{{$cli->estado_civil}} </td>
               <td>{{$cli->id_profesion}} </td>
               <td>
                     <a href="{{url('/cliente/crud/'.$cli->id_persona.'/edit')}}" rel="tooltip" title="Editar cliente" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-edit"></i> 
                        </a>

                    <a href="" data-target="#modal-delete-{{$cli->id_persona}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
                         <i class="fa fa-times"></i> 
                    </a>
               </td>
                    </tr>
                    @include('cliente.crud.modal')
                    @endforeach
               </table>
          </div>
         {{$clientes->links()}}
     </div>
</div>

@endsection