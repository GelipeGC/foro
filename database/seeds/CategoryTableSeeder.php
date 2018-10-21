<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  => 'Laravel',
            'slug'  => 'laravel',
        ]);
        Category::create([
            'name'  => 'PHP',
            'slug'  => 'php',
        ]);
        Category::create([
            'name'  => 'Vue.js',
            'slug'  => 'vue-js',
        ]);
        Category::create([
            'name'  => 'JavaScriptVanilla',
            'slug'  => 'javascriptvanilla',
        ]);
        
        Category::create([
            'name'  => 'Sass',
            'slug'  => 'sass',
        ]);
        Category::create([
            'name'  => 'Git',
            'slug'  => 'git',
        ]);
        Category::create([
            'name'  => 'Otras tecnologías',
            'slug'  => 'otras-tecnologias',
        ]);
    }
}
