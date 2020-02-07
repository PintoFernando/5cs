<?php

use Illuminate\Database\Seeder;
use sis5cs\FormaPago;
class FormaPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormaPago::create([
            'forma_pago' => 'Pago por ventanilla',
            'estado' => true
        ]);
        FormaPago::create([
            'forma_pago' => 'Descuento por planilla Por parte de la empresa',
            'estado' => true
        ]);
        FormaPago::create([
            'forma_pago' => 'Transferencia de su caja de ahorro',
            'estado' => true
        ]);
        FormaPago::create([
            'forma_pago' => 'Débito automatico',
            'estado' => true
        ]);
        FormaPago::create([
            'forma_pago' => 'Otro',
            'estado' => true
        ]);

    }
}
