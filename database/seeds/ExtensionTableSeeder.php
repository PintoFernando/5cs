<?php

use Illuminate\Database\Seeder;
use sis5cs\Extension;

class ExtensionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extension::create([
            'extension' => 'LP',
        ]);
        Extension::create([
            'extension' => 'CB',
        ]);
        Extension::create([
            'extension' => 'OR',
        ]);
        Extension::create([
            'extension' => 'CB',
        ]);
        Extension::create([
            'extension' => 'PT',
        ]);
        Extension::create([
            'extension' => 'SC',
        ]);
        Extension::create([
            'extension' => 'BN',
        ]);
        Extension::create([
            'extension' => 'PA',
        ]);
        Extension::create([
            'extension' => 'TJ',
        ]);
        Extension::create([
            'extension' => 'CH',
        ]);

    }
}
