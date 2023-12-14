<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Travel;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categoryID =  $request->get('category_id');
        $page = $request->get('page');
        $recommend = $request->get('recommend');
        $lat = $request->get("my_lat");
        $long = $request->get("my_long");
        $data = Travel::with("category")->with("photos")->with("ratings");
        $total = 0;
        if ($categoryID) {
            $data = $data->where("category", $categoryID ?? "");
        }
        if ($page) {
            $data = $data->paginate(5, ['*'], 'page', $page);
            $total = $data->total();
            $data = $data->items();
        } else {
            $data = $data->get();
            $total = count($data);
        }
        if ($recommend) {
            foreach ($data as $d) {
                $d['distance'] = round(haversine($lat, $long, $d->lat, $d->long), 2);
                $data[] = $d;
            }
            $data = collect($data)->sortBy("distance");
            $data = $data->values()->all();
            $total = count($data);
        }
        return response()->json([
            'data' => $data, "message" => "Success Load", 'status' => true, 'total' => $total
        ]);
    }


    public function clusteringData(Request $request)
    {
        $data = Travel::with("category")->with("photos")->with("ratings")->get();
        $lat = $request->get("my_lat");
        $long = $request->get("my_long");
        $k = $request->get("k");
        $transformData = [];
        foreach ($data as $d) {
            $total =  collect($d->ratings)->map(function ($v) {
                return (float) $v->num_of_rating;
            })->sum();
            $transformData[$d->id] = [
                $d['price'],
                $d->category,
                round($total / count($d->ratings), 2),
                round(haversine($lat, $long, $d->lat, $d->long), 2)
            ];
        }
        $kmeans = new KMeans($k);
        $clusterResult =  $kmeans->cluster($transformData);
        $result = [];
        foreach ($data as $d) {
            foreach ($clusterResult as $cluster => $dd) {
                foreach ($dd as $k => $ddd) {
                    if ($d->id == $k) {
                        $d["num_of_cluster"] = $cluster;
                        $result[] = $d;
                    }
                }
            }
        }
        $result =  collect($result)->sortBy("num_of_cluster")->values()->all();
        return response()->json([
            'data' => $result, "message" => "Success Load", 'status' => true, 'total' => $data->count()
        ]);
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
