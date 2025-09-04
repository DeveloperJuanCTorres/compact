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
        return DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('taxonomies', 'products.taxonomy_id', '=', 'taxonomies.id')
            ->select(
                'products.id',
                'products.name',
                'brands.name as brand_name',
                'taxonomies.name as taxonomy_name',
                'products.price',
                'products.stock',
                'products.created_at',
                'products.updated_at'
            )->get();
    }

    public function headings(): array
    {
        // Trae dinámicamente los nombres de las columnas
        return [
            'ID',
            'Producto',
            'Marca',
            'Categoria',
            'Precio',
            'Stock',
            'Creado',
            'Actualizado',
        ];
    }
}
