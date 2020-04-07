<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $set = Category::create([
        'name' => 'set'
      ]);
      $normal = Category::create([
        'name' => 'normal'
      ]);
    }
}
