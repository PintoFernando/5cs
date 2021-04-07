@extends ('layouts.prueba')


<html >
<div id="imp1">
    <head>
        <table  border="0"  width="100%" eight="70%">
   <tr> <td><em><i style="color:#B73451"; >Reporte Generado en Fecha: {{$now}}</i></em></td><td   valign="top" align="right">    <img src="{{asset('images/logo1.png')}}"  height="50px" width="50px" class="img-thumbnail" >
                    <small><em><i style="color:#B73451"; ><br>Potosi-Bolivia </br></i></em></small> 
            </td> </tr>
            
      <tr><td align="center">   <i  style="color:#3E3E8B";><pre style="white-space: normal"><ins><font size="5" FACE="times new roman">{{$titulo}}</font> </ins></pre></i></td></tr>
</table>
    </head>
    <body>
        <table  align="center"  width="70%" eight="70%" >
            <tr><td align="left">
        @foreach ($nombre as $no)   
        <i  style="color:#3E3E8B";><pre style="white-space: normal"><font size="3" FACE="times new roman"><strong>NOMBRE:</strong> {{$no->nombre}}  {{$no->ap_paterno}}  {{$no->ap_materno}}</font> </pre></i>    
        @endforeach</td></tr>
        <tr><td>
       
        <i  style="color:#3E3E8B";><pre style="white-space: normal"><font size="3" FACE="times new roman"><strong>DIRECCION:</strong> {{$direccion}} </font></pre></i>
        
</tr></td>
       </table>
        <form >
        <table  width="100%" eight="40%" cellspacing="3" cellpadding="3" >
          
        @switch($hptam)  
         @case (2)
         @for($i=0 ;$i<$hptam;$i++)
           @switch($i)
           @case(0)
            <tr >
            @foreach ($croquis as $co)
            
               <td rowspan="2" id="map-container" > 
             
                @push ('scripts')
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVomCQZTYVQSRGPsG6cQPLsoZqYWdZq0w"></script>

                  <script type="text/javascript">
	                function init_map() {
                    var var_location = new google.maps.LatLng({{$co->latitud}},{{$co->longitud}});
                    var var_mapoptions = {
                    center: var_location,
         
                    zoom: 18
                  };
 
                   var var_marker = new google.maps.Marker({
                   position: var_location,
                   map: var_map,
                   title:"Cooperativa de Ahorro y Crédito Societaria San Martín"});
 
                   var var_map = new google.maps.Map(document.getElementById("map-container"),
                   var_mapoptions);
 
                   var_marker.setMap(var_map); 
 
                   }
 
                   google.maps.event.addDomListener(window, 'load', init_map);
                </script>
                </td> 
              
            @endforeach

            @endpush




                @foreach($coll[$i] as $pe)  
                 <td align="right" width="50"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
                 </tr>
                 @endforeach
             @break   
                
            </tr>
            <tr>
            @case(1)
               @foreach($coll[$i] as $pe)  
                <td align="right" width="50"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
               @endforeach
            @break   
                
           </tr>
          
           @endswitch
           @endfor
           @break
        @endswitch   
        
        </table>
        @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
        @endforeach
        
        <br></br><br></br><br></br>
        <button type="button" onclick="javascript:imprim1(imp1);">Imprimir</button>
        
        
</form>

    </body>
  
  </div>  
</html>
@include('sweetalert::alert')
@push ('scripts')
<script>
  $('#liC1').addClass("treeview active");
  $('#liCroquis').addClass("active");

</script>
<script>
function imprim1(imp1){
var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
		w.print();
		w.close();
        return true;}
</script>

@endpush



