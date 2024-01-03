<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PhotoTravel;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Travel::with("category")->with("photos")->with("ratings")->get();
        return view("pages.travel.travel", ["travel" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $province = getApiData("http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
        return view("pages.travel.travel-add", ["province" => $province, "categories" => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $travel = new Travel();
        $travel->name = $request->name;
        $travel->price = $request->price;
        $travel->city = $request->city;
        $travel->category_id = $request->category;
        $latLong = explode(",", $request->location);
        $travel->lat =  $latLong[0];
        $travel->lon = $latLong[1];
        $travel->description = $request->description;
        $travel->save();
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $photoTravel = new PhotoTravel();
                $photoTravel->photo = $path;
                $photoTravel->travel = $travel->id;
                $photoTravel->save();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel = Travel::with('category')->find($id);
        $category = Category::all();
        $province = getApiData("http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");
        return view("pages.travel.travel-edit", ["province" => $province, "categories" => $category, "travel" => $travel, "id" => $id]);
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
        $request->validate([
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $travel = Travel::find($id);
        $travel->name = $request->name ?? $travel->name;
        $travel->price = $request->price ?? $travel->price;
        $travel->city = $request->city ?? $travel->city;
        $travel->category_id = $request->category ?? $travel->category_id;
        $latLong = explode(",", $request->location);
        $travel->lat =  $latLong[0];
        $travel->lon = $latLong[1];
        $travel->description = $request->description ?? $travel->description;
        $travel->save();
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');
                $photoTravel = new PhotoTravel();
                $photoTravel->photo = $path;
                $photoTravel->travel = $travel->id;
                $photoTravel->save();
            }
        }
        toast("Berhasil Update Travel", 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travel = Travel::find($id);
        $travel->delete();
        return redirect()->back();
    }
}
