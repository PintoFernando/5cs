<?php
namespace sis5cs\Repositories;
class ContadorC1Repository{
    public static function contador_c1($p1,$p2,$p3,$p4,$p5,$p6)
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
        if($p4>0)
          {
           $cont++;
          }
         if($p5>0)
            {
              $cont++;
            }
             if($p6>0)
              {
                $cont++;
              }        
        
      return $cont*10;
    }
  
}