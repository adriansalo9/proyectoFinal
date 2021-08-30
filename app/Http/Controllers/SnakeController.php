<?php

namespace App\Http\Controllers;

use App\Models\Snake;
use Illuminate\Http\Request;

class SnakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('snake.index');
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
        //$snake->user_id = \Auth::id();
        $user = \Auth::id();
        //return " El id es: $user, y su puntuación es: $request->score";
        $snake = new Snake();
        $snake->user_id = \Auth::id();
        $snake->score = $request->score;
        //return $snake;
        $snake->save();
        return $snake;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Snake  $snake
     * @return \Illuminate\Http\Response
     */
    public function show(Snake $snake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Snake  $snake
     * @return \Illuminate\Http\Response
     */
    public function edit(Snake $snake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Snake  $snake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Snake $snake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Snake  $snake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Snake $snake)
    {

    }
}
