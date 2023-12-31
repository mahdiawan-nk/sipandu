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
        $postData = $request->all();
        if ($this->nikexist($request->post('nik'))) {
            return response()->json([
                'status' => false,
                'message' => 'NIK sudah terdaftar'
            ]);
        } else {
            $postData['password_pengguna'] = md5($request->post('nik'));
            $insert = DataIbu::create($postData);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ]);
        }
    }

    protected function nikexist($nik)
    {
        return DataIbu::where('nik', $nik)->exists();
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
        $postData = $request->post();
        $postData['password_pengguna'] = md5($request->post('nik'));
        $dataibu->fill($postData)->save();
        return response()->json([
            'message' => 'Updated Successfully!!',
            'category' => $dataibu
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
            'message' => 'Deleted Successfully!!'
        ]);
    }
}
