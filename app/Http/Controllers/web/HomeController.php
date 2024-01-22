<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Travel::with("category")->with("photos")->with("ratings")->limit(200)->get();
        $totalTravel = Travel::count();
        $totalCategory = Category::count();
        $totalRating = Rating::count();
        $totalUser = User::count();
        $transformData = [];
        $transformData2 = [];
        $clusterLabel = [];
        foreach ($data as $d) {
            $total =  collect($d->ratings)->map(function ($v) {
                return (float) $v->num_of_rating;
            })->sum();
            $transformData[] = [
                $d['price'],
                $d->category->id,
                round($total / count($d->ratings), 2),
            ];
            $transformData2[] = [
                $d['price'],
                $d->category->id,
                round($total / count($d->ratings), 2),
                $d->name
            ];
            $clusterLabel[] = $d['name'];
        }
        file_put_contents(storage_path('data.json'), json_encode(['data' => $transformData2]));
        $kmeans = new KMeans(3);
        $clusterResult =  $kmeans->cluster($transformData);
        return view("pages.dashboard", ['clusterResult' => json_encode($clusterResult), "clusterLabel" => json_encode($clusterLabel), 'count' => [
            "totalCategory" => $totalCategory,
            "totalRating" => $totalRating,
            "totalUser" => $totalUser,
            "totalTravel" => $totalTravel
        ]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
