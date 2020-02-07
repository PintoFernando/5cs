<?php
namespace sis5cs\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use sis5cs\User;

class InventarioExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return User::all();
    }
}
