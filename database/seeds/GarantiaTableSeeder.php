<?php

use Illuminate\Database\Seeder;
use sis5cs\Garantia;
class GarantiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Garantia::create([
            'id_credito'=>1,
            'id_tipo_garantia'=>1                      
       ]);
    }
}
