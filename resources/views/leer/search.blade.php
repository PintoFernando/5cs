<form method="GET" action="{{url('inmueble/crud')}}">
	{{csrf_field()}}
<div class="form-group">
	<div class="input-group">
		<input type="search" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
</form>
