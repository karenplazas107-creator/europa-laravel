<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Aseo',          'descripcion' => 'Productos de limpieza e higiene personal y del hogar'],
            ['nombre' => 'Abarrotes',     'descripcion' => 'Alimentos no perecederos, granos y conservas'],
            ['nombre' => 'Ropa',          'descripcion' => 'Prendas de vestir para toda la familia'],
            ['nombre' => 'Herramientas',  'descripcion' => 'Herramientas manuales y eléctricas para el hogar'],
            ['nombre' => 'Perfumes',      'descripcion' => 'Fragancias y colonias para dama y caballero'],
            ['nombre' => 'Gorras',        'descripcion' => 'Gorras, sombreros y accesorios para la cabeza'],
            ['nombre' => 'Blusas',        'descripcion' => 'Blusas y camisas para dama'],
            ['nombre' => 'Ropa interior', 'descripcion' => 'Ropa interior y medias para toda la familia'],
            ['nombre' => 'Reloj',         'descripcion' => 'Relojes de pulsera y accesorios'],
            ['nombre' => 'Zandalias',     'descripcion' => 'Calzado tipo sandalia y chanclas'],
        ];

        foreach ($categorias as $cat) {
            DB::table('categories')->insertOrIgnore([
                'nombre' => $cat['nombre'],
                'descripcion' => $cat['descripcion'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
