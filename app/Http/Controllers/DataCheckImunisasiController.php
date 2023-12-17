<?php

namespace App\Http\Controllers;

use App\Models\CheckUpImunisasi;
use Illuminate\Http\Request;

class DataCheckImunisasiController extends Controller
{

    function views()
    {
        $this->data = [
            'title' => 'Check Up Imunisasi Anak',
        ];
        return view('data-imunisasi.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataImun = CheckUpImunisasi::with(['dataJenisImunisasi','dataCheckUp.dataAnak.dataIbu'])->get();
        return response()->json($dataImun);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckUpImunisasi  $checkUpImunisasi
     * @return \Illuminate\Http\Response
     */
    public function show(CheckUpImunisasi $checkUpImunisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckUpImunisasi  $checkUpImunisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckUpImunisasi $checkUpImunisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckUpImunisasi  $checkUpImunisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckUpImunisasi $checkUpImunisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckUpImunisasi  $checkUpImunisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckUpImunisasi $checkUpImunisasi)
    {
        //
    }
}
