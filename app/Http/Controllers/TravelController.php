<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Travel;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;

use function PHPSTORM_META\map;

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
        $isPopular = $request->get('isPopular');
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
        foreach ($data as $d) {
            $d['rating'] = floor(collect($d['ratings'])->avg('num_of_rating'));
            $data[] = $d;
        }
        if ($recommend == 1) {
            foreach ($data as $d) {
                $d['distance'] = round(haversine($lat, $long, $d->lat, $d->lon), 2);
                $data[] = $d;
            }
            $data = collect($data)->sortBy("distance");
            $data = $data->values()->take(4);
            $total = count($data);
        }
        if ($isPopular == 1) {
            foreach ($data  as $d) {
                $d['total_review'] = count($d['ratings']);
                $data[] = $d;
            }
            $data = collect($data)->sortByDesc("total_review");
            $data = $data->values()->take(3);
            $total = count($data);
        }
        return response()->json([
            'data' => $data, "message" => "Success Load", 'status' => true, 'total' => $total
        ]);
    }


    public function clusteringData(Request $request)
    {
        $limit = $request->get("limit");
        $page = $request->get('page');
        $data = Travel::with("category")->with("photos")->with("ratings")->paginate($limit, ['*'], 'page', $page);
        $totalData = $data->total();
        $data = $data->items();
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
                round(haversine($lat, $long,  (float)$d->lat,  (float)$d->lon), 2)
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
                        $d['distance'] = round(haversine($lat, $long, (float)$d->lat, (float)$d->lon));
                        $d['rating'] = floor($total / count($d->ratings));
                        $result[] = $d;
                    }
                }
            }
        }
        $result =  collect($result)->sortBy("distance")->sortBy("num_of_cluster")->values()->all();
        return response()->json([
            'data' => $result, "message" => "Success Load", 'status' => true, 'total' => $totalData
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
