<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Publisher;
use App\Models\Writer;
use Database\Factories\BookFactory;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $writers = Writer::all();

        BookFactory::new()->count(20)->create()
        ->each(function ($book) use ($writers) {
            $book->writers()->attach($writers->random(rand(1,3))->pluck('id'));
        });
    }
}
