<?php

namespace Database\Seeders;

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

        foreach($dataArray as $d){
            $travel = new Travel();
            $travel->name = $d['Place_Name'];
            $travel->description = $d['Description'];
            $travel->city = $d['City'];
            $travel->lat = $d['Lat'];
            $travel->lon = $d['Long'];
            $travel->price = $d['Price'];
            $travel->category = 41;
            $travel->save();
        }
    }
}
