
@extends('layouts.admin3')
@section('contenido')
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="form-group">
    <label>Seleccionar el tipo de credito</label>
    <select name="id_tcredito" class="form-control selectpicker" data-size="5" id="tipocredito"  data-live-search="true" >
     @foreach ($tipocredito as $tipo)
     <option value="{{$tipo->id_tcredito}}">{{$tipo->tipo_credito}}</option>
     @endforeach
   </select> 
 </div>
</div>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i>Informacion general de crédito:</h4>
      </div>
    </div>
</div>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
  <div class="table-responsive">
    <table class="table">
      <tr >
        <td class="info">MONTO MÁXIMO DEL PRESTAMO</td>
        <td><p id="montomax"> </p></td>
      </tr>
      <tr>
        <td class="info">MONEDA</td>
        <td><p id="moneda"> </p></td>
      </tr>
      <tr>
        <td class="info">TIEMPO MÁXIMO</td>
        <td><p id="ttiempo"> </p></td>
      </tr>
      <tr>
        <td class="info">TASA DE INTERES</td>
        <td><p id="tasa"> </p></td>
      </tr>
      <tr>
        <td class="info">GARANTIA</td>
        <td><p id="garantia"> </p></td>
      </tr>
      <tr>
        <td class="info">OBJETIVO DEL CREDITO</td>
        <td><p id="objetivo"> </p></td>
      </tr>
      <tr>
        <td class="info">DESTINO DEL CRÉDITO</td>
        <td><p id="destino"> </p></td>
      </tr>
      <tr>
        <td class="info">APORTE PROPIO (SI CORRESPONDE)</td>
        <td><p id="aporte"> </p></td>
      </tr>      
    </table>
  </div>
</div>


<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i>Simulador de credito:</h4>
      </div>
    </div>
</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="nombre">Monto</label>
   <input type="number" name="monto" class="form-control" id="monto" required value="{{old('monto')}}" placeholder="Monto...">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="interes">Interes</label>
   <input type="number" name="interes" class="form-control" id="interes" required placeholder="">
 </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
 <div class="form-group">
   <label for="interes">Tiempo (En años)</label>
   <input type="number" name="tiempo" class="form-control" id="tiempo" required placeholder="">
 </div>
</div>



<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
 <div class="form-group">
   <button id="boton">Calcular</button>
 </div>
</div>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
 <div id="contenido"></div>
</div>


<!-- simulador -->

<!-- simulador -->
<script>

  //evento cambio de opcion selec
  var select = document.getElementById('tipocredito');
  select.addEventListener('change',segunseleccion);
  // evento calcular boton
  var calc = document.getElementById('boton');
  calc.addEventListener('click',calcular);
  function calcular()
  {
      var tabla='<table class="table table-bordered">'+
       '<tr class="success">'
            +'<td> N°</td>'
            +'<td> Interes</td>'
            +'<td> Capital</td>'
            +'<td> Cuota </td>'
            +'<td> Saldo</td>'+
       '</tr>';
       //document.getElementById('contenido').innerHTML=tabla;
       //variables
       var monto=document.getElementById('monto').value;
       var int=document.getElementById('interes').value;
       var tiempo=document.getElementById('tiempo').value;
       var tmeses=tiempo*12;
       var cont=1;
       var tmeses;       
       var i=(int/100)/12;
       var cuota=monto*((i*Math.pow(1+i,tmeses))/(Math.pow(1+i,tmeses)-1));
       var saldo=monto;
       var concatenar;
       while(cont<=tmeses)
       {
          var interes=i*saldo;
          var capital=cuota-interes;
          var saldo=saldo-capital;
          var calculostring='<tr class="warning">'+
          '<td>'+(Math.round(cont*100)/100)+'</td>'+
          '<td>'+(Math.round(interes*100)/100)+'</td>'+
          '<td>'+(Math.round(capital*100)/100)+'</td>'+
          '<td>'+(Math.round(cuota*100)/100)+'</td>'+
          '<td>'+(Math.round(saldo*100)/100)+'</td>'+        
          '</tr>';
         var concatenar=concatenar+calculostring;        
         cont++;
       }
      var cadena=tabla+concatenar;
      document.getElementById('contenido').innerHTML=cadena;
  };
  function segunseleccion(){
    var selectedOption = this.options[select.selectedIndex];
    if(selectedOption.value==1)
    { 
      var montomax="10000 bolivianos o su equivalente en dólares estado unidenses o monto resultante de límite establecido según avaluó técnico.";  
      var moneda="Los créditos son otorgados en moneda nacional y en dólares estadounidenses.";  
      var tmaximo="18 meses";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="Personal custodia de documentos, debito caja de ahorro por internet y convenio institucional."; 
      var objetivo="Disponibilidad abierta";
      var destino="Libre disponibilidad, compra de bienes muebles, tarjetas de crédito, particulares, salud refacciones de inmueble.";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino; 
      console.log(selectedOption.value + ': ' + selectedOption.text);
    }
    if(selectedOption.value==2)
    {
      var montomax="70.00,0 bolivianos o su equivalente en dólares estadounidenses.";  
      var moneda="Los créditos otorgados en moneda nacional y en dólares estadounidenses.";  
      var tmaximo="60 meses";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="De uno a dos garantes personales de acuerdo a escala"; 
      var objetivo="Financiar créditos con disponibilidad abierta, como para consumo";
      var destino="Particulares-salud-refacciones de inmueble.";

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino; 
    }
    if(selectedOption.value==3)
    {
      var montomax="5% Patrimonio Neto";  
      var moneda="Los Créditos son otorgados en Moneda Nacional y en Dólares Estadounidenses";  
      var tmaximo="60 meses";  
      var tasa="Tasas aprobadas por el Cons¿cejo  de administración";  
      var garantia="Hipotecaria"; 
      var objetivo="Financiar créditos con disponibilidad abierta, como para consumo";
      var destino="Particulares-salud-refacciones de inmueble.";

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino; 
    }
    if(selectedOption.value==4)
    {
      var montomax="68.600,00 en bolivianos o su equivalente en Dólares estadounidenses";  
      var moneda="Los créditos son otorgados en Moneda Nacional y en Dólares Estadounidenses";  
      var tmaximo="60 meses";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="Documentos en custodia"; 
      var objetivo="Financiar créditos con disponibilidad abierta, como para consumo";
      var destino="Particulares-salud-refacciones de inmueble.";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino;
    }
    if(selectedOption.value==5)
    {
      var montomax="10.000,00 en bolivianos o su equivalente en Dólares estadounidenses";  
      var moneda="Los créditos son otorgados en Moneda Nacional y en Dólares Estadounidenses";  
      var tmaximo="12 meses para capital de operaciones, 18 meses para capital de inversion";  
      var tasa="Tasas aprobadas por el consejo de administración";  
      var garantia="Personal documentos en custodia"; 
      var objetivo="Para capital de operaciones, para capital de inversion.";
      var destino="Compra de insumos, mercaderias mantenimiento de vehiculos, compra de activos fijos";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino;
    }
    if(selectedOption.value==6)
    {
      var montomax="70.00,0 bolivianos o su equivalente en dólares estadounidenses.";  
      var moneda="Los créditos otorgados en moneda nacional y en dólares estadounidenses.";  
      var tmaximo="72 meses de capital de inversion y 12 meses capital de operacion";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="De uno a dos garantes personales de acuerdo a escala"; 
      var objetivo="financiar el capital de inversiones y capital de operaciones";
      var aporte="20%";

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('aporte').innerHTML=aporte; 
    }
    if(selectedOption.value==7)
    {
      var montomax="68.600,00 en bolivianos o su equivalente en Dólares estadounidenses";  
      var moneda="Los créditos son otorgados en Moneda Nacional y en Dólares Estadounidenses";  
      var tmaximo="72 meses si no es hipotecaria para capital de inversion y 12 meses para capital de operación";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="Documentos saneados en custodia: terreno, inmueble y Vehículos"; 
      var objetivo="Financiar financiar el capital de inversiones y capital de operaciones";
      var aporte="20%";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('aporte').innerHTML=aporte;
    }
    if(selectedOption.value==8)
    {
      var montomax="Hasta el 5% Patrimonio Neto";  
      var moneda="Los créditos son otorgados en moneda Nacional y en Dólares Estadounidenses";  
      var tmaximo="15 años meses con garantia Hipotecaria y 8 años con garantia de Vehículo ";  
      var tasa="De acuerdo a tasas aprobadas por el consejo de administración";  
      var garantia="Hipotecaria de vivienda o de Vehículo"; 
      var objetivo="financiar capital de inversiones";
      var destino="Disponibilidad para capital de actividad, cini oara compra de vehículo";
      var aporte="20%";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino;      
      document.getElementById('aporte').innerHTML=aporte;
    }
    if(selectedOption.value==9)
    {
      var montomax="10000 bolivianos o su equivalente en dólares estado unidenses o monto resultante de límite establecido según avaluó técnico.";  
      var moneda="Los créditos son otorgados en moneda nacional y en dólares estadounidenses.";  
      var tmaximo="18 meses";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="Personal custodia de documentos, debito caja de ahorro por internet y convenio institucional."; 
      var objetivo="crédito de vivienda";
      var destino="Construcción, refacción, remodelación, mejoramiento de vivienda, anticretico de vivienda";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('destino').innerHTML=destino;
    }
    if(selectedOption.value==10)
    {
      var montomax="68.600 Bs o su equivalente en dólares o monto resultante de limite de crédito de vivienda sin garantía hipotecaria";  
      var moneda="Los créditos son otorgados en moneda nacional y en dólares estadounidenses.";  
      var tmaximo="48 meses";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="documentos en custodia terreno o inmueble"; 
      var objetivo="Financiamiento en la adquisición de inmueble o terreno, ampliación  y refacción de vivienda";
      var aporte="20%";     

      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('aporte').innerHTML=aporte;
    }
    if(selectedOption.value==11)
    {
      var montomax="68.600 Bs o su equivalente en dólares o monto resultante de limite de crédito de vivienda sin garantía hipotecaria";  
      var moneda="Los créditos son otorgados en moneda nacional y en dólares estadounidenses.";  
      var tmaximo="48 meses";  
      var tasa="Tasas aprodas por el concejo de administración";  
      var garantia="documentos en custodia terreno o inmueble"; 
      var objetivo="Financiamiento en la adquisición de inmueble o terreno, ampliación  y refacción de vivienda";
      var aporte="20%"; 
      document.getElementById('montomax').innerHTML=montomax;      
      document.getElementById('moneda').innerHTML=moneda;      
      document.getElementById('ttiempo').innerHTML=tmaximo;      
      document.getElementById('tasa').innerHTML=tasa;      
      document.getElementById('garantia').innerHTML=garantia;      
      document.getElementById('objetivo').innerHTML=objetivo;      
      document.getElementById('aporte').innerHTML=aporte;
    }
    
  };
</script>
@endsection
