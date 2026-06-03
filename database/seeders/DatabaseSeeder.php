<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Produto::factory(50)->create();

        $this->call([
            UsersSeeder::class,
            RegiaoSeeder::class,
            EstadoSeeder::class
            ]);
    }
}
