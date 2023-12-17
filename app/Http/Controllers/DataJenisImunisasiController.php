<?php

namespace App\Http\Controllers;

use App\Models\DataJenisImunisasi;
use Illuminate\Http\Request;

class DataJenisImunisasiController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Data Jenis Imunisasi',
        ];
        return view('jenis-imunisasi.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DataJenisImunisasi::all();
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
        $insert = DataJenisImunisasi::create($request->all());

        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataJenisImunisasi  $dataJenisImunisasi
     * @return \Illuminate\Http\Response
     */
    public function show(DataJenisImunisasi $dataJenisImunisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataJenisImunisasi  $dataJenisImunisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(DataJenisImunisasi $dataJenisImunisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataJenisImunisasi  $dataJenisImunisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataJenisImunisasi $datajenisimunisasi)
    {
        $datajenisimunisasi->fill($request->post())->save();
        return response()->json([
            'message'=>'Updated Successfully!!',
            'category'=>$datajenisimunisasi
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataJenisImunisasi  $dataJenisImunisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataJenisImunisasi $datajenisimunisasi)
    {
        $datajenisimunisasi->delete();
        return response()->json([
            'message'=>'Deleted Successfully!!'
        ]);
    }
}
