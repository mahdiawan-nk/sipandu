<?php

namespace App\Http\Controllers;

use App\Models\DataJenisVitamin;
use Illuminate\Http\Request;

class DataJenisVitaminController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Data Jenis Vitamin',
        ];
        return view('jenis-vitamin.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DataJenisVitamin::all();
        return response()->json($data);
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
        $insert = DataJenisVitamin::create($request->all());

        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataJenisVitamin  $dataJenisVitamin
     * @return \Illuminate\Http\Response
     */
    public function show(DataJenisVitamin $dataJenisVitamin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataJenisVitamin  $dataJenisVitamin
     * @return \Illuminate\Http\Response
     */
    public function edit(DataJenisVitamin $dataJenisVitamin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataJenisVitamin  $dataJenisVitamin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataJenisVitamin $datajenisvitamin)
    {
        $datajenisvitamin->fill($request->post())->save();
        return response()->json([
            'message'=>'Updated Successfully!!',
            'category'=>$datajenisvitamin
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataJenisVitamin  $dataJenisVitamin
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataJenisVitamin $datajenisvitamin)
    {
        $datajenisvitamin->delete();
        return response()->json([
            'message'=>'Deleted Successfully!!'
        ]);
    }
}
