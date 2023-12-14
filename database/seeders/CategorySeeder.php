<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category as ModelsCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [

                "nama" =>"Budaya"
                
            ],
            [

                "nama" =>"Cagar Alam"  
            ],
            [

                "nama" =>"Pusat Perbelanjaan"  
            ],
            [

                "nama" =>"Tempat Ibadah"  
            ],
        ];

        foreach($data as $d){
            $category = new ModelsCategory();
            $category->nama = $d['nama'];
            $category->save();
        }
        
    }
}
