<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the applications's database.
     */
    public function run(): void
    {
        $this->call([
            ContactTypeSeeder::class,
        ]);
        if (User::count() < 30) {
            User::factory(50)->create();
        }


    }
}
