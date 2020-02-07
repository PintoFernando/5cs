<?php

use Illuminate\Database\Seeder;
use sis5cs\CuentasDocumentosCobrar;
class CuentasDocumentosCobrarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CuentasDocumentosCobrar::create([
         'nit'=>'2423423',
         'nombre_razon_social'=>'Juan carlos',
         'concepto'=>'deuda',
         'saldo'=>23423,
         'id_persona'=>1
        ]);
        
    }
}
