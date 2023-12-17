<?php

namespace App\Http\Controllers;

use App\Models\DataJadwalPosyandu;
use Illuminate\Http\Request;

class DataJadwalPosyanduController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Data Jadwal Posyandu',
        ];
        return view('data-jadwal.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataJadwal = DataJadwalPosyandu::with(['dataPosyandu'])
            ->get()
            ->map(function ($data) {
                return $this->transformedData($data);
            });
        return response()->json($dataJadwal);
    }

    protected function transformedData($data)
    {
        return [
            'id' => $data->id,
            'title' => $data->dataPosyandu->nama_posyandu,
            'start' => $data->start,
            'end' => $data->end,
        ];
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
        $insert = DataJadwalPosyandu::create($request->all());

        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataJadwalPosyandu  $dataJadwalPosyandu
     * @return \Illuminate\Http\Response
     */
    public function show(DataJadwalPosyandu $datajadwalposyandu)
    {
        $dataJadwal = DataJadwalPosyandu::with(['dataPosyandu'])
            ->find($datajadwalposyandu)
            ->first();
        $dataJadwal = [
            'id' => $dataJadwal->id,
            'id_posyandu' => $dataJadwal->dataPosyandu->id,
            'title' => $dataJadwal->dataPosyandu->nama_posyandu,
            'start' => $dataJadwal->start,
            'end' => $dataJadwal->end,
        ];
        return response()->json($dataJadwal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataJadwalPosyandu  $dataJadwalPosyandu
     * @return \Illuminate\Http\Response
     */
    public function edit(DataJadwalPosyandu $datajadwalposyandu)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataJadwalPosyandu  $dataJadwalPosyandu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataJadwalPosyandu $datajadwalposyandu)
    {
        $datajadwalposyandu->fill($request->post())->save();
        return response()->json([
            'message' => 'Updated Successfully!!',
            'category' => $request->post()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataJadwalPosyandu  $dataJadwalPosyandu
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataJadwalPosyandu $datajadwalposyandu)
    {
        $datajadwalposyandu->delete();
        return response()->json([
            'message'=>'Deleted Successfully!!'
        ]);
    }
}
