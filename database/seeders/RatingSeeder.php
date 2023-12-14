<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Travel;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travel = Travel::all();
        $min = 1;
        $max = 5;
        foreach ($travel as $t) {
            $randomDouble = $min + mt_rand() / mt_getrandmax() * ($max - $min);
            $rating = new Rating();
            $rating->user_id = 1;
            $rating->travel = $t->id;
            $rating->comments ="Bagus banget wisatanya rekomend deh pokoknya";
            $rating->num_of_rating = round($randomDouble, 1);;
            $rating->save();
        }
    }
}
