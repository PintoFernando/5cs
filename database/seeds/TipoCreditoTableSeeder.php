<?php

use Illuminate\Database\Seeder;
use sis5cs\TipoCredito;
class TipoCreditoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      TipoCredito::create([
        'tipo_credito'=>'CONSUMO CON OTRAS GARANTIAS',
        'estado'=>true                      
      ]);

      TipoCredito::create([
        'tipo_credito'=>'CONSUMO A SOLA FIRMA',
        'estado'=>true                              

      ]);

      TipoCredito::create([
        'tipo_credito'=>'CONSUMO CON 2 GARANTES PERSONALES',
        'estado'=>true                        
      ]);
      TipoCredito::create([
        'tipo_credito'=>'CONSUMO CON 1 GARANTE PERSONAL',
        'estado'=>true                        
      ]);
      TipoCredito::create([
        'tipo_credito'=>'CONSUMO DEBIDAMENTE GARANTIZADO',
        'estado'=>true                        
      ]);
      //MICROCREDITO
      TipoCredito::create([
        'tipo_credito'=>'MICROCREDITO DEBIDAMENTE GARANTIZADO',
        'estado'=>true                        
      ]);
      TipoCredito::create([
        'tipo_credito'=>'MICROCREDITO CON OTRAS GARANTIAS',
        'estado'=>true                        
      ]);
      TipoCredito::create([
        'tipo_credito'=>'MICROCREDITO A SOLA FIRMA',
        'estado'=>true                        
      ]);

      TipoCredito::create([
        'tipo_credito'=>'MICROCREDITO CON 1 GARANTE PERSONAL',
        'estado'=>true                        
      ]);

      TipoCredito::create([
        'tipo_credito'=>'MICROCREDITO CON 2 GARANTES PERSONALES',
        'estado'=>true                        
      ]);

      TipoCredito::create([
        'tipo_credito'=>'HIPOTECARIO DE VIVIENDA',
        'estado'=>true                        
      ]);

      TipoCredito::create([
        'tipo_credito'=>'VIVIENDA SIN GARANTIA A SOLA FIRMA',
        'estado'=>true                        
      ]);

      TipoCredito::create([
        'tipo_credito'=>'VIVIENDA SIN GARANTIA HIPOTECARIA',
        'estado'=>true                        
      ]);
      TipoCredito::create([
        'tipo_credito'=>'VIVIENDA CON DOCUMENTOS EN CUSTODIA',
        'estado'=>true                        
      ]);
    }
  }
