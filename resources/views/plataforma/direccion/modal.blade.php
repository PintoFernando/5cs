<div class="modal fade modal-sllide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$cre->id_credito}}">

   <form method="post" action="{{url('/credito/crud/'.$cre->id_credito)}}">
  {{csrf_field()}}
  {{method_field('DELETE')}}

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="close">
				<span aria-hidden="true">x</span>
			</button>
			<h4 class="modal-title">Eliminar Solicitud de Credito</h4>
		</div>
		<div class="modal-body">
			<p>Confirme si desea eliminar la Solicitud deCredito</p>
		</div>
		
		  <div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-success">Confirmar</button>
			</div>
	</div>
</div>	
</form>
</div>


                 
                       
                      
                        
                    