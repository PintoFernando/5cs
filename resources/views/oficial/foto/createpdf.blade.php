<html>
<head>
    <table    border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
    <tr>@foreach ($tipocred as $tip)
      <td  width="420px" > <left><small><em><i style="color:#B73451"; >Tipo Credito: {{$tip->tipo_credito}} </i></em></small><br></br>
      @endforeach 
                                     
                  @foreach ($nombre as $nom)
                  <small> <em><i style="color:#B73451"; >Nombre: {{$nom->nombre}}  {{$nom->ap_paterno}} {{$nom->ap_materno}} </i></em></small>
                    
                    @endforeach <br></br>
                    <small> <em><i style="color:#B73451"; > Creacion Reporte: {{$now}} </i></em> </small> </td>
                 <td valign="top" align="right"><left><small><em><p style="color:#B73451"; >Cooperativa de Ahorro y Credito Societaria                                            
       &nbsp;&nbsp;“San Martin” Ltda.
                   </p></em></small></td>
                   
                    <td   width="5" heigth="5" valign="top"> <img src="{{asset('images/logo1.png')}}"  height="50px" width="50px" class="img-thumbnail" >
                   
            </td> 
                    
          </tr> 
        
        </table>    
                  
                  
</head>
    
<body >
                
   
   <table border="0"
   align="center"  cellspacing="3" cellpadding="3" >
   <caption  style="color:#3E3E8B";><pre style="white-space: normal"><ins><font size="3" FACE="times new roman">{{$titulo}}</font> </ins></pre></caption>  
  @switch($hptam)  
  @case (3) 
   @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
           <tr >
            <td align="center" width ="300px"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td align="center" width ="300px" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
            </tr>  
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          
          <tr>
          <td align="center" width="300px"colspan="2" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
           
           </tr> 
           <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
           
           
          @endforeach
          @break
       @case(3)
         @break
      @endswitch
    @endfor
  @break
  @case(4)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
        
           <tr>
           
           <td  width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
           
      </td>
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          <td></td>
          <td></td>
          <td></td>
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
            </tr>  
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          <tr>
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
           
           
           </div>
          @endforeach
          @break
       @case(3)
       @foreach($coll[$i] as $pe)
          <td></td>
          <td></td>
          <td></td>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="300px" width="300px" class="img-thumbnail"></td>   
           
           </tr> 
           <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
           </div>
          @endforeach
         @break
      @endswitch
    @endfor
  @break
  @case(5)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
        
           <tr>
           
           <td  width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
           
      </td>
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          <td></td>
          <td></td>
          <td></td>
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
            </tr>  
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          <tr>
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
          @endforeach
          @break
       @case(3)
       @foreach($coll[$i] as $pe)
          <td></td>
          <td></td>
          <td></td>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
           
           </tr> 
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          <tr >
          <td align="center" colspan="5"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>  
         </tr>
         <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
          @endforeach
         @break
        
      @endswitch
    @endfor
  @break
  @case(6)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
        
           <tr>
           
           <td  align="right" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
           
      </td>
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
            </tr>  
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          <tr>
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
           
           
           </div>
          @endforeach
          @break
       @case(3)
       @foreach($coll[$i] as $pe)
         
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>   
           
           </tr> 
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          <tr >
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="270px" width="300px" class="img-thumbnail"></td>  
         </tr>
         <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
          @endforeach
         @break  
      @endswitch
    @endfor
  @break 
</table>

  @case(7)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
          <table 
            align="right"  cellspacing="3" cellpadding="3"  >
           <tr>
           
           <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
              
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
           
          </tr> 
           </div>
          @endforeach
          @break
          
       @case(3)
       @foreach($coll[$i] as $pe)
         <tr>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
           
           
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
         </tr>
          @endforeach
         @break  
         @case(6)
        @foreach($coll[$i] as $pe)
          <tr>
          <td align="center" colspan="5"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
         </tr>
         <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
         </table>
          @endforeach
         @break 
      @endswitch
    @endfor
  @break
  @case(8)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
          
           <tr>
           
           <td  ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>   
           
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td  ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>   
            </tr>
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>   
           
          
           
          @endforeach
          @break
          
       @case(3)
       @foreach($coll[$i] as $pe)
         
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>   
           
           </tr>
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>  
         </tr>
          @endforeach
         @break  
         @case(6)
        @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>  
         
          @endforeach
         @break 
         @case(7)
        @foreach($coll[$i] as $pe)
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="200px" width="300px" class="img-thumbnail"></td>  
           </tr>
           <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
         
          @endforeach
          
         @break 
      @endswitch
    @endfor
  @break
  @case(9)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
          <table 
            align="right"  cellspacing="3" cellpadding="3"  >
           <tr>
           
           <td  width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
           
      </td>
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
            
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
           
          </tr>
           
          @endforeach
          @break
          
       @case(3)
       @foreach($coll[$i] as $pe)
           <tr>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>   
           
           
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
         </tr>
          @endforeach
         @break  
         @case(6)
        @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break 
         @case(7)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break 
         @case(8)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="240px" width="240px" class="img-thumbnail"></td>  
           </tr>
           <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
</table>
          @endforeach
         @break 
      @endswitch
    @endfor
  @break
  @case(10)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
          <table 
            align="right"  cellspacing="3" cellpadding="3"  >
           <tr>
           
           <td  width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
      </td>
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
            
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
          </tr>
           
          @endforeach
          @break
          
       @case(3)
       @foreach($coll[$i] as $pe)
           <tr>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
           
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         </tr>
          @endforeach
         @break  
         @case(6)
        @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break 
         @case(7)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break 
         @case(8)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           </tr>
          @endforeach
         @break 
         @case(9)
        @foreach($coll[$i] as $pe)
          <tr>
          <td align="center" colspan="5"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           </tr>
           <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
         </table>
          @endforeach
         @break
      @endswitch
    @endfor
  @break
  @case(11)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
          <table 
            align="right"  cellspacing="3" cellpadding="3"  >
           <tr>
           
           <td  width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
      </td>
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
            
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
          </tr>
           
          @endforeach
          @break
          
       @case(3)
       @foreach($coll[$i] as $pe)
           <tr>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
           
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         </tr>
          @endforeach
         @break  
         @case(6)
        @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break 
         @case(7)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break 
         @case(8)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           </tr>
          @endforeach
         @break 
         @case(9)
        @foreach($coll[$i] as $pe)
          <tr>
          <td align="left" colspan="2"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break
         @case(10)
        @foreach($coll[$i] as $pe)
          
          <td align="right" colspan="2"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           </tr>
           <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
          </table>
          @endforeach
         @break
      @endswitch
    @endfor
  @break
  
  @case(12)
  @for($i=0 ;$i<$hptam;$i++ )
      @switch($i)
        @case(0)
          @foreach($coll[$i] as $pe)
          <table
            align="right"  cellspacing="3" cellpadding="3"  >
           <tr>
           
           <td  width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
      
           
          @endforeach
             @break
             
        @case(1)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
            
          @endforeach
            @break
          
        @case(2)
          @foreach($coll[$i] as $pe)
          
          <td width ="50%" ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
          </tr>
           
          @endforeach
          @break
          
       @case(3)
       @foreach($coll[$i] as $pe)
           <tr>
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>   
           
           
        
          @endforeach
         @break
       @case(4)
       @foreach($coll[$i] as $pe)
          
          
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break
        @case(5)
        @foreach($coll[$i] as $pe)
          <td width ="50%"><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         </tr>
          @endforeach
         @break  
         @case(6)
        @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
         
          @endforeach
         @break 
         @case(7)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break 
         @case(8)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           </tr>
          @endforeach
         @break 
         @case(9)
        @foreach($coll[$i] as $pe)
          <tr>
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break
         @case(10)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           
          @endforeach
         @break
         @case(11)
        @foreach($coll[$i] as $pe)
          
          <td ><img src="{{asset('images/fotos/'.$pe->archivo)}}" alt="{{ $pe->archivo}}" height="210px" width="240px" class="img-thumbnail"></td>  
           </tr>
          <tr>
          <td colspan= "3">
                @foreach($users as $us)
                 <a>Reporte Generado por :  {{$us->name}} </a>
               @endforeach
               </td>
          </tr>
          </table>
          @endforeach
         @break
      @endswitch
    @endfor
  @break
  @endswitch
  
 
    </table>
   
    

</body>

 
</html>