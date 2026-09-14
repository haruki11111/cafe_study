<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCafe;
use Illuminate\Http\Request;
use App\Models\Cafe;
use Illuminate\Support\Facades\Auth;

class FavoriteCafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cafes = Auth::user()
        ->favoriteCafes()
        ->get();

        return view('favoritecafe.index',[
            'cafes' => $cafes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FavoriteCafe $favoriteCafe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FavoriteCafe $favoriteCafe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FavoriteCafe $favoriteCafe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FavoriteCafe $favoriteCafe)
    {
        //
    }
}
