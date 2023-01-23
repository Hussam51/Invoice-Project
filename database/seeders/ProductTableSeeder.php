<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {


        $data=[
            'product_name'=>'حمص',
            'description'=>'nothing',
            'section_id'=>'1',

        ];
        Product::create($data);
    }
}
