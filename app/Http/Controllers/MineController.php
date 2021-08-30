<?php

namespace App\Http\Controllers;

use App\Models\Mine;
use Illuminate\Http\Request;

class MineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('minesweeper.index');
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
        $mine = new Mine();
        $mine->user_id= \Auth::id();
        $mine->minutos = $request->minutos;
        $mine->segundos = $request->segundos;
        $mine->centesimas = $request->centesimas;
        $mine->save();
        return $mine;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function show(Mine $mine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function edit(Mine $mine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mine $mine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mine  $mine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mine $mine)
    {
        //
    }
}
