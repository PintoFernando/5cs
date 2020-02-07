@extends ('layouts.admin3')
@section ('contenido')
<div class="form-group">
	<label>Mensaje:</label>
	<textarea class="form-control" rows="3"  disabled> {{$message->observaciones}}</textarea>
</div>
<small>Enviado por {{$message->sender->name}}</small>
<br>
<small>Fecha de envío: {{$message->created_at}}</small>
	<?php  
	$credito=DB::table('persona')
	->join('credito', 'persona.id_persona', '=', 'credito.id_persona')				
	->select('persona.*', 'credito.monto_solicitado')
	->where('credito.id_credito',$message->id_credito)
	->first();
	?>
</small>
<br>
<small>Credito de: {{$credito->nombre.' '.$credito->ap_materno.' '.$credito->ap_paterno}}</small>
<br>
<small>Monto solicitado: {{$credito->monto_solicitado}}</small>
@endsection
