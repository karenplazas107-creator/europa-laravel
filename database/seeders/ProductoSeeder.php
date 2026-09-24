<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener IDs de categorías por nombre
        $cats = DB::table('categories')->pluck('categoria', 'nombre');

        $productos = [
            [
                'nombre' => 'Chanel Coco Mademoiselle',
                'descripcion' => 'Es una fragancia abstracta, definida por aldehídos y un bouquet floral de jazmín, rosa, ylang-ylang con fondo de pachulí.',
                'precio_compra' => 75.00,
                'precio_venta' => 100.00,
                'categoria' => $cats['Perfumes'] ?? 1,
                'stock' => 98,
                'stock_minimo' => 10,
                'codigo_barras' => '35017181',
            ],
            [
                'nombre' => 'Gorra Gucci',
                'descripcion' => 'Combina lujo, estilo urbano y elegancia en una sola pieza. Diseñada con materiales premium y el icónico logo bordado.',
                'precio_compra' => 65.00,
                'precio_venta' => 100.00,
                'categoria' => $cats['Gorras'] ?? 2,
                'stock' => 58,
                'stock_minimo' => 6,
                'codigo_barras' => '1234567',
            ],
            [
                'nombre' => 'Oral-B Cepillo de dientes eléctrico recargable Pro',
                'descripcion' => 'Tecnología de limpieza oscilante y rotatoria que ayuda a remover más placa bacteriana que un cepillo manual convencional.',
                'precio_compra' => 18000.00,
                'precio_venta' => 30000.00,
                'categoria' => $cats['Aseo'] ?? 3,
                'stock' => 187,
                'stock_minimo' => 5,
                'codigo_barras' => '87656790',
            ],
            [
                'nombre' => 'Oud For King',
                'descripcion' => 'Una fragancia intensa y elegante que transmite poder, exclusividad y sofisticación. Su aroma perdura durante horas.',
                'precio_compra' => 120.00,
                'precio_venta' => 200.00,
                'categoria' => $cats['Perfumes'] ?? 1,
                'stock' => 89,
                'stock_minimo' => 10,
                'codigo_barras' => '78765543',
            ],
            [
                'nombre' => 'Detergente Ariel 1kg',
                'descripcion' => 'Detergente en polvo con tecnología de limpieza profunda, elimina manchas difíciles desde el primer lavado.',
                'precio_compra' => 7500.00,
                'precio_venta' => 10000.00,
                'categoria' => $cats['Aseo'] ?? 3,
                'stock' => 240,
                'stock_minimo' => 20,
                'codigo_barras' => '11223344',
            ],
            [
                'nombre' => 'Arroz Diana 5kg',
                'descripcion' => 'Arroz blanco de grano largo, seleccionado y empacado con los más altos estándares de calidad.',
                'precio_compra' => 14000.00,
                'precio_venta' => 18500.00,
                'categoria' => $cats['Abarrotes'] ?? 4,
                'stock' => 320,
                'stock_minimo' => 25,
                'codigo_barras' => '55667788',
            ],
            [
                'nombre' => 'Camiseta Polo Ralph Lauren',
                'descripcion' => 'Camiseta polo de algodón pima 100%, corte slim fit, disponible en varios colores. Estilo clásico y duradero.',
                'precio_compra' => 55.00,
                'precio_venta' => 85.00,
                'categoria' => $cats['Ropa'] ?? 5,
                'stock' => 72,
                'stock_minimo' => 8,
                'codigo_barras' => '99001122',
            ],
            [
                'nombre' => 'Martillo Truper 16oz',
                'descripcion' => 'Martillo de orejas con mango de fibra de vidrio anti-vibración, cabeza de acero forjado de alta resistencia.',
                'precio_compra' => 22000.00,
                'precio_venta' => 32000.00,
                'categoria' => $cats['Herramientas'] ?? 6,
                'stock' => 45,
                'stock_minimo' => 5,
                'codigo_barras' => '33445566',
            ],
            [
                'nombre' => 'Reloj Casio G-Shock',
                'descripcion' => 'Reloj resistente a golpes y al agua hasta 200m. Ideal para actividades al aire libre y deportes extremos.',
                'precio_compra' => 180.00,
                'precio_venta' => 260.00,
                'categoria' => $cats['Reloj'] ?? 7,
                'stock' => 33,
                'stock_minimo' => 5,
                'codigo_barras' => '77889900',
            ],
            [
                'nombre' => 'Sandalias Crocs Classic',
                'descripcion' => 'Sandalias ligeras y cómodas fabricadas en Croslite™, material patentado ultra suave y resistente al agua.',
                'precio_compra' => 45.00,
                'precio_venta' => 70.00,
                'categoria' => $cats['Zandalias'] ?? 8,
                'stock' => 8,  // Stock bajo deliberado
                'stock_minimo' => 10,
                'codigo_barras' => '12344321',
            ],
        ];

        foreach ($productos as $p) {
            DB::table('products')->updateOrInsert(
                ['codigo_barras' => $p['codigo_barras']],
                [
                    'nombre' => $p['nombre'],
                    'descripcion' => $p['descripcion'],
                    'precio_compra' => $p['precio_compra'],
                    'precio_venta' => $p['precio_venta'],
                    'categoria' => $p['categoria'],
                    'imagen' => null,
                    'stock' => $p['stock'],
                    'stock_minimo' => $p['stock_minimo'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
