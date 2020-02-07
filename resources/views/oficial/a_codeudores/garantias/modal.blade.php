<div class="modal fade modal-sllide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$in->id_inmueble}}">

   <form method="post" action="{{url('/inmueble/crud/'.$in->id_inmueble)}}">
  {{csrf_field()}}
  {{method_field('DELETE')}}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Eliminar inmueble</h4>
		</div>
		<div class="modal-body">
			<p>Confirme si desea eliminar inmueble</p>
		</div>
		
		    <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
	</div>
</div>	
</form>
</div>


                 
                       
                      
                        
                    