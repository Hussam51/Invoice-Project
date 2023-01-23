<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'section_name'=>'حبوب',
            'description'=>'قسم الحبوب والغذائيات',
            'created_by'=>'Hussam',

        ];
        Section::create($data);
    }
}
