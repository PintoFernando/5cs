@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
     <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
          <h3>Listado de Croquis <a href="{{url('/croquis/crud/create')}}"><button class="btn btn-success">Nueva ubicación croquis</button></a></h3>
           @include('croquis.crud.search')
     </div>
</div>

<div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
               <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
               <th>Id</th>
               <th>Latitud</th>
               <th>Longitud</th>
               
                    </thead>
               @foreach ($croquis as $cro)
                    <tr>
               <td>{{$cro->id_croquis}} </td>
               <td>{{$cro->latitud}} </td>
               <td>{{$cro->longitud}} </td>
               <td>
                     <a href="{{url('/croquis/crud/'.$cro->id_croquis.'/edit')}}" rel="tooltip" title="Editar Croquis" class="btn btn-success btn-simple btn-xs">
                        <i class="fa fa-edit"></i> 
                        </a>

                    <a href="" data-target="#modal-delete-{{$cro->id_croquis}}" rel="tooltip" title="Eliminar" data-toggle="modal" class="btn btn-danger btn-simple btn-xs">
                         <i class="fa fa-times"></i> 
                    </a>
               </td>
                    </tr>
                    @include('croquis.crud.modal')
                    @endforeach
               </table>
          </div>
         {{$croquis->links()}}
     </div>
</div>

@endsection