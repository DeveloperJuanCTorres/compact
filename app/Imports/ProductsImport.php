<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Taxonomy;
use App\Models\Subtaxonomy;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Normaliza datos del Excel
        $productName = trim($row['nombre']);
        $brandName = trim($row['marca']) ? trim($row['marca']) : null;
        $taxonomyName = trim($row['categoria']);
        $subtaxonomyName = trim($row['subcategoria']);
        $price = $row['precio'] ?? 0;
        $stock = $row['stock'] ?? 0;

        // 🔹 1. Verificar o crear categoría
        $taxonomy = Taxonomy::firstOrCreate(
            ['name' => $taxonomyName]
        );

        // 🔹 2. Verificar o crear subcategoría (asociada a taxonomy)
        $subtaxonomy = Subtaxonomy::firstOrCreate(
            ['name' => $subtaxonomyName, 'taxonomy_id' => $taxonomy->id]
        );

        // 🔹 3. Si hay marca, verificar o crearla; si está vacía, dejar null
        $brandId = null;
        if (!empty($brandName)) {
            $brand = Brand::firstOrCreate(['name' => $brandName]);
            $brandId = $brand->id;
        }

        // 🔹 4. Crear producto
        return new Product([
            'name' => $productName,
            'taxonomy_id' => $taxonomy->id,
            'subtaxonomy_id' => $subtaxonomy->id,
            'brand_id' => $brandId,
            'price' => $price,
            'stock' => $stock,
            'slug' => Str::slug($productName),
        ]);
    }
}
