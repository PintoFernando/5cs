@extends ('layouts.admin3')
@section ('contenido')
<div class="box">
	<h1> Notificaciones</h1>
	<div class="row">
		<div class="col-sm-6">
			<h2>No leidas </h2>
			<ul class="list-group">
			@foreach($unreadNotifications  as $unreadNotification)
			<li class="list-group-item">
				<a href="{{$unreadNotification->data['link']}}">{{$unreadNotification->data['text']}}</a>
				<form method="POST" action="{{route('notifications.read',$unreadNotification->id)}}" class="pull-right">
					{{method_field('PATCH')}}
					{{csrf_field()}}
					<button class="btn btn-danger btn-xs">X</button>
				</form>
			</li>
			@endforeach
			</ul>
		</div>
		<div class="col-sm-6">
			<h2>Leidas </h2>
			<ul class="list-group">
			@foreach($readNotifications  as $readNotification)
			<li class="list-group-item"><a href="{{$readNotification->data['link']}}">{{$readNotification->data['text']}}</a>
				<form method="POST" action="{{route('notifications.destroy',$readNotification->id)}}" class="pull-right">
					{{method_field('DELETE')}}
					{{csrf_field()}}
					<button class="btn btn-danger btn-xs">X</button>
				</form>
			</li>
			@endforeach
			</ul>
		</div>
	</div>
</div>


@include('sweetalert::alert')
@push ('scripts')
<script>
	$('#liC1').addClass("treeview active");
	$('#liDireccion').addClass("active");
</script>
@endpush
@endsection