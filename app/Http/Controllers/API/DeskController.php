<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Desk;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Desk::orderBy('expiration')
            ->where('user_id', $request->user_id)
            ->get();
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
        $created_desk = new Desk();
        $created_desk->name = $request->input('name');
        $created_desk->expiration = $request->input('expiration');
        $created_desk->description = $request->input('description');
        $created_desk->comment = $request->input('comment');
        $created_desk->user_id = $request->input('user_id');

        $created_desk->save();

        return response()->json('The desk_list successfully added');
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
        $desk = Desk::find($id);
        //$desk->update($request->all());
        $desk->name = $request->input('name');
        $desk->expiration = $request->input('expiration');
        $desk->description = $request->input('description');
        $desk->comment = $request->input('comment');

        $desk->save();

        return response()->json($desk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desk_list = Desk::find($id);
        $desk_list->delete();

        return response()->json('The desk_list successfully deleted');
    }
}
