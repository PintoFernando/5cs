<?php
namespace sis5cs\Repositories;
class PuntajeRepository{
 /*	protected $valor;
	public function __construct($valor)
	{
       $this->valor=$valor;
  }	
*/
    //FUNCIONES PARA LA CALIFICACION DE LAS 5CS---------------------------------------------------------------
    public static function tipo_residencia($valor)
    {
      switch ($valor) {
        case 1:
          return 10;
          break;
  
        case 2:
          return 9;
          break;
  
        case 3:
          return 7;
          break;
  
        case 4:
          return 8;
          break;
  
        case 5:
          return 5;
          break;
  
        case 6:
          return 3;
          break;
  
        case 7:
          return 3;
          break;
        default:
          return 0;
          break;
      }
    }
     //tomar en cuenta cuando tipo de vivienda es propia
    public static function tiempo_residencia($valor)
    {
      if ($valor >= 1 && $valor <= 6) {
        return 1;
      } else {
        if ($valor >= 7 && $valor <= 12) {
          return 3;
        } else {
          if ($valor >= 13 && $valor <= 24) {
            return 4;
          } else {
            if ($valor >= 25 && $valor <= 36) {
              return 7;
            } else {
              if ($valor >= 37) {
                return 8;
              }
              else
              {
                return 0;
              }
            }
          }
        }
      }
    }
  
  //Negocio
    public static function tiempoNegocio($valor)
    {
      if ($valor > 0 && $valor <= 12) {
        return 2;
      } else {
        if ($valor >= 13 && $valor <= 24) {
          return 3;
        } else {
          if ($valor >= 25 && $valor <= 35) {
            return 6;
          } else {
            if ($valor >= 36 && $valor <= 59) {
              return 8;
            } else {
              if ($valor >= 60) {
                return 10;
              }
              else{
                return 0;
              }
            }
          }
        }
      }
    }
  
    public static function experiencia_cre_penultimo($valor)
    {
      if ($valor > 0 && $valor <= 5) {
        return 10;
      } else {
        if ($valor >= 6 && $valor <= 30) {
          return 8;
        } else {
          if ($valor >= 31 && $valor <= 60) {
            return 6;
          } else {
            if ($valor >= 61 && $valor <= 90) {
              return 8;
            } else {
              if ($valor >= 91) {
                return 2;
              } else {
                return 0;
              }
            }
          }
        }
      }
    }
    public static function experiencia_cre_ultimo($valor)
    {
      if ($valor > 0 && $valor <= 5) {
        return 10;
      } else {
        if ($valor >= 6 && $valor <= 30) {
          return 8;
        } else {
          if ($valor >= 31 && $valor <= 60) {
            return 6;
          } else {
            if ($valor >= 61 && $valor <= 90) {
              return 8;
            } else {
              if ($valor >= 91) {
                return 2;
              } else {
                 
                  return 0;
                
              }
            }
          }
        }
      }
    }
  
    //CAPITAL
    public static function f_endeudamiento_actual($valor)
    {
      if ($valor > 0 && $valor <= 40) {
        return 10;
      } else {
        if ($valor > 40 && $valor <= 60) {
          return 5;
        } else {
          if ($valor > 60) {
            return 1;
          } else {
            return 0;
          }  
        }
      }
    }
  
    public static function f_endeudamiento_con_credito($valor)
    {
      if ($valor > 0 && $valor <= 50) {
        return 10;
      } else {
        if ($valor > 50 && $valor <= 70) {
          return 5;
        } else {
          if ($valor > 70) {
            return 1;
          } else {
            return 0;
          }  
        }
      }
    }
      //C3-------------------------------------------------------------------------------------------------------
     //CAPACIDAD DE PAGO
    public static function cobertura_cuota($valor)
    {
      if ($valor > 0 && $valor < 150) {
        return 1;
      } else {
        if ($valor >= 150 && $valor < 160) {
          return 5;
        } else {
          if ($valor >= 160 && $valor < 170) {
            return 6;
          } else {
            if ($valor >= 170 && $valor < 180) {
              return 7;
            } else {
              if ($valor >= 180 && $valor < 190) {
                return 8;
              } else {
                if ($valor >= 190 && $valor < 200) {
                  return 9;
                } else {
                  if ($valor > 200) {
                    return 10;
                  } else {
                    return 0;
                  }
                }
              }
            }
          }
        }
      }
    }
  
    public static function gasto_anterior($valor)
    {
      if ($valor > 0 && $valor < 50) {
        return 10;
      } else {
        if ($valor >= 50 && $valor < 55) {
          return 9;
        } else {
          if ($valor >= 55 && $valor < 59) {
            return 8;
          } else {
            if ($valor >= 59 && $valor < 63) {
              return 7;
            } else {
              if ($valor >= 63 && $valor < 67) {
                return 6;
              } else {
                if ($valor >= 67 && $valor < 70) {
                  return 5;
                } else {
                  if ($valor > 70) {
                    return 1;
                  } else {
                    return 0;
                  }
                }
              }
            }
          }
        }
      }
    }
  
  
    public static function gasto_actual($valor)
    {
      if ($valor > 0 && $valor < 60) {
        return 10;
      } else {
        if ($valor >= 60 && $valor < 65) {
          return 9;
        } else {
          if ($valor >= 65 && $valor < 69) {
            return 8;
          } else {
            if ($valor >= 69 && $valor < 73) {
              return 7;
            } else {
              if ($valor >= 73 && $valor < 77) {
                return 6;
              } else {
                if ($valor >= 77 && $valor < 80) {
                  return 5;
                } else {
                  if ($valor > 80) {
                    return 1;
                  } else {
                    return 0;
                  }
                }
              }
            }
          }
        }
      }
    }
  //C3 fin----------------------------------------------------
  
  //C4 BEGIN  
    public static function ingresos_condiciones($valor)
    {
      if ($valor > 0 && $valor <= 1000) {
        return 3;
      } else {
        if ($valor >= 1001 && $valor <= 1500) {
          return 4;
        } else {
          if ($valor >= 1501 && $valor <= 2000) {
            return 6;
          } else {
            if ($valor >= 2001 && $valor <= 2500) {
              return 8;
            } else {
              if ($valor >= 2501 && $valor <= 3000) {
                return 9;
              } else {
                if ($valor >= 3001) {
                  return 10;
                }
                else{
                  return 0;
                }
              }
            }
          }
        }
      }
    }
  //c4 end
  
  //c5 functions begin
    public static function garantias($valor)
    {
      if ($valor == 1) {
        return 5;
      } else {
        if ($valor == 2) {
          return 9;
        } else {
          if ($valor == 3) {
            return 8;
          } else {
            if ($valor == 4) {
              return 10;
            } else {
              if ($valor == 5) {
                return 6;
              } else {
                if ($valor == 6) {
                  return 4;
                }
                else{
                  return 0;
                }
              }
            }
          }
        }
      }
    }
  //c5 funtions end
  
  //-------------------Funtions recomendacion
    public static function recomendacion($valor)
    {
      if ($valor < 75) {
        return 'NEGADO';
      } else {
        if ($valor >= 75 && $valor < 90) {
          return 'APROBADO';
        } else {
          if ($valor >= 90 && $valor <= 100) {
            return 'APROBADO';
          }
        }
      }
    }
  
    public static function tipoRiesgo($valor)
    {
      if ($valor < 75) {
        return 'Riesgo no Aceptable';
      } else {
        if ($valor >= 75 && $valor < 90) {
          return 'Riesgo Moderado';
        } else {
          if ($valor >= 90 && $valor <= 100) {
            return 'Riesgo Normal';
          }
        }
      }
    }
  
}