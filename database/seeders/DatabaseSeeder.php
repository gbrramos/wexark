<?php

namespace Database\Seeders;
use App\Models\Pastel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Pastel::create([
            'nome'=>'Pastel de Queijo',
            'preco'=>'8.00',
            'media'=>'uploads/img/pastel-queijo.jpg'
        ]);

        Pastel::create([
            'nome'=>'Pastel de Pizza',
            'preco'=>'10.00',
            'media'=>'uploads/img/pastel-pizza.jpg'
        ]);

        Pastel::create([
            'nome'=>'Pastel de Palmito',
            'preco'=>'12.00',
            'media'=>'uploads/img/pastel-palmito.jpg'
        ]);
    }
}
