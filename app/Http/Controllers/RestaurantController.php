<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::all();
        return response()->json($restaurant);
    }

    /**
     * Store a newly created restaurant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'note' => 'numeric',
            'status' => 'required'
        ]);

        $restaurant = Restaurant::create($validatedData);
        return response()->json($restaurant, Response::HTTP_CREATED);
    }

    /**
     * Display the specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return response()->json($restaurant);
    }

    /**
     * Update the specified restaurant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'address' => 'required|max:255',
            'note' => 'numeric',
            'status' => 'required'
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validatedData);
        return response()->json($restaurant);
    }

    /**
     * Remove the specified restaurant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
