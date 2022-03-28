<?php

namespace Database\Seeders;

use App\Models\Publisher;
use App\Models\Writer;
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
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PublisherSeeder::class,
            WriterSeeder::class,
            BookSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
