<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Devuelve todos los registros de la tabla products
        return DB::table('products')->get();
    }

    public function headings(): array
    {
        // Trae dinámicamente los nombres de las columnas
        return DB::getSchemaBuilder()->getColumnListing('products');
    }
}
