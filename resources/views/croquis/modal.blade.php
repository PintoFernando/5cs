<div class="modal fade modal-sllide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$cro->id_croquis}}">

   <form method="post" action="{{url('/croquis/'.$cro->id_croquis)}}">
  {{csrf_field()}}
  {{method_field('DELETE')}}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Eliminar Croquis</h4>
		</div>
		<div class="modal-body">
			<p>Confirme si desea eliminar Croquis</p>
		</div>
		
		  <div class="modal-footer">
		  <button type="submit" class="btn btn-success">Confirmar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				
			</div>
	</div>
</div>	
</form>
</div>


                 
                       
                      
                        
                    