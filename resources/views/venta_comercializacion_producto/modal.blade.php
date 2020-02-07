<div class="modal fade modal-sllide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ve->id_venta_comercializacion}}">

   <form method="post" action="{{url('/venta_comercializacion_producto/'.$ve->id_venta_comercializacion)}}">
  {{csrf_field()}}
  {{method_field('DELETE')}}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Eliminar Registo</h4>
		</div>
		<div class="modal-body">
			<p>Confirme si desea eliminar el registro</p>
		</div>
		
		  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-success">Confirmar</button>
			</div>
	</div>
</div>	
</form>
</div>


                 
                       
                      
                        
                    