@extends ('layouts.admin3')
@section ('contenido')
<h1>Observación</h1>
<p>{{$observacion->observacion}}</p>
<small>Enviado por {{$observacion->sender->name}}</small>
@endpush
@endsection
