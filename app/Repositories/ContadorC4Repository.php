<?php
namespace sis5cs\Repositories;
class ContadorC4Repository{
    public static function contador_c4($p1,$p2,$p3)
    {     
      $cont=0;
      if($p1>0)
      {
       $cont++;
      }
      if($p2>0)
       {
        $cont++;
       }
       if($p3>0)
        {
         $cont++;
        } 
      return $cont*10;
    }
  
}