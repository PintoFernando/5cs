@extends ('layouts.admin3')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Estadísticas</h3>
	</div>
</div>

<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$total_socios}}</h3>
              <p>Socios registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              <?php
$a_cre = DB::table('credito')
    ->select('desembolsado')
    ->where('desembolsado', '=', true)
    ->count();
echo "$a_cre";
?>
</h3>
          <p>Solicitudes desembolsados</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
</div>


 <div class="row">
 <!-- DONUT CHART -->
 <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size:17px;">Gráfica de créditos excedidos </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="myChart" style="height:250px"></canvas>
            </div><!-- /.box-body -->            
 </div>
</div>

@push ('scripts')
<script src="{{asset('/admin2/dist/js/Chart.js')}}"></script>
<script>
new Chart(document.getElementById("myChart"), {
    type: 'pie',
    data: {
      labels: ["Solicitudes con tiempo exedido", "Solicitudes vigentes"],
      datasets: [{
        label: "Créditos",
        backgroundColor: ["#ff6600", "#009900"],
        data: [{{$cont1}},{{$cont2}}]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Créditos'
      }
    }
});
</script>
@endpush
@endsection