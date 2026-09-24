<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuarios
        User::create([
            'rol' => 'admin',
            'nombre' => 'Administrador',
            'apellido' => 'Europa',
            'email' => 'admin@almaceneuropa.com',
            'movil' => '3001234567',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'rol' => 'vendedor',
            'nombre' => 'Karen',
            'apellido' => 'Plazas',
            'email' => 'karen@almaceneuropa.com',
            'movil' => '3109876543',
            'password' => Hash::make('vendedor123'),
        ]);

        User::create([
            'rol' => 'cliente',
            'nombre' => 'Angie',
            'apellido' => 'Patiño',
            'email' => 'angie111@gmail.com',
            'movil' => '3201111111',
            'password' => Hash::make('cliente123'),
        ]);

        User::create([
            'rol' => 'cliente',
            'nombre' => 'Melanie',
            'apellido' => 'Lemus',
            'email' => 'Melanie12345@gmail.com',
            'movil' => '3214567890',
            'password' => Hash::make('cliente123'),
        ]);

        // 2. Categorías
        $this->call(CategoriaSeeder::class);

        // 3. Productos
        $this->call(ProductoSeeder::class);
    }
}
