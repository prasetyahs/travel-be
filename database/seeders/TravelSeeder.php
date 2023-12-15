<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Travel;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonFilePath = storage_path('app\tourism_with_id.json');
        $jsonString = file_get_contents($jsonFilePath);
        $dataArray = json_decode($jsonString, true);

        foreach ($dataArray as $d) {
            $travel = new Travel();
            $category = Category::where("nama", $d['Category'])->first();
            $travel->name = $d['Place_Name'];
            $travel->description = $d['Description'];
            $travel->city = $d['City'];
            $travel->lat = $d['Lat'];
            $travel->lon = $d['Long'];
            $travel->price = $d['Price'];
            $travel->category =  $category->id;
            $travel->save();
        }
    }
}
