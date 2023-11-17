<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['Css', 'Html', 'Bootstrap', 'Javascript', 'Vite', 'Vue.js', 'MySql', 'Php', 'Laravel'];

        foreach ($technologies as $technology) {

            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Str::slug($new_technology->name);
            $new_technology->save();
        }
    }
}
