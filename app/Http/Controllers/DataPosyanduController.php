<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use Illuminate\Http\Request;

class DataPosyanduController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Data Posyandu',
        ];
        return view('data-posyandu.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPosyandu = DataPosyandu::all();
        return response()->json($dataPosyandu);
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
        $insert = DataPosyandu::create($request->all());

        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPosyandu  $dataPosyandu
     * @return \Illuminate\Http\Response
     */
    public function show(DataPosyandu $dataPosyandu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPosyandu  $dataPosyandu
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPosyandu $dataPosyandu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPosyandu  $dataPosyandu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPosyandu $dataposyandu)
    {
        $dataposyandu->fill($request->post())->save();
        return response()->json([
            'message'=>'Updated Successfully!!',
            'category'=>$dataposyandu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPosyandu  $dataPosyandu
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPosyandu $dataposyandu)
    {
        $dataposyandu->delete();
        return response()->json([
            'message'=>'Deleted Successfully!!'
        ]);
    }
}
