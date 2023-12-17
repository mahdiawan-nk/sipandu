<?php

namespace App\Http\Controllers;

use App\Models\DataIbu;
use Illuminate\Http\Request;

class DataIbuController extends Controller
{
    protected $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function views()
    {
        $this->data = [
            'title' => 'Data Ibu',
        ];
        return view('data-ibu.index', $this->data);
    }
    public function index()
    {
        return response()->json(DataIbu::all());
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
        $insert = DataIbu::create($request->all());

        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataIbu  $dataIbu
     * @return \Illuminate\Http\Response
     */
    public function show(DataIbu $dataIbu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataIbu  $dataIbu
     * @return \Illuminate\Http\Response
     */
    public function edit(DataIbu $dataIbu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataIbu  $dataIbu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataIbu $dataibu)
    {
        $dataibu->fill($request->post())->save();
        return response()->json([
            'message'=>'Updated Successfully!!',
            'category'=>$dataibu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataIbu  $dataIbu
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataIbu $dataibu)
    {
        $dataibu->delete();
        return response()->json([
            'message'=>'Deleted Successfully!!'
        ]);
    }
}
