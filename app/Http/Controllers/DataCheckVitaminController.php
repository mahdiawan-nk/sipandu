<?php

namespace App\Http\Controllers;

use App\Models\CheckUpVitamin;
use Illuminate\Http\Request;

class DataCheckVitaminController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Check Up Vitamin Anak',
        ];
        return view('data-vitamin.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataVitamin = CheckUpVitamin::with(['dataJenisVitamin','dataCheckUp.dataAnak.dataIbu'])->get();
        return response()->json($dataVitamin);
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
     * @param  \App\Models\CheckUpVitamin  $checkUpVitamin
     * @return \Illuminate\Http\Response
     */
    public function show(CheckUpVitamin $checkUpVitamin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckUpVitamin  $checkUpVitamin
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckUpVitamin $checkUpVitamin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckUpVitamin  $checkUpVitamin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckUpVitamin $checkUpVitamin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckUpVitamin  $checkUpVitamin
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckUpVitamin $checkUpVitamin)
    {
        //
    }
}
