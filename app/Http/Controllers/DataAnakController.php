<?php

namespace App\Http\Controllers;

use App\Models\DataAnak;
use Illuminate\Http\Request;

class DataAnakController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Data anak',
        ];
        return view('data-anak.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAnak = DataAnak::with(['dataIbu'])
            ->get()
            ->map(function ($data) {
                return $this->transformedData($data);
            });
        return response()->json($dataAnak);
    }

    protected function transformedData($data)
    {
        return [
            'id' => $data->id,
            'id_ibu' => $data->id_ibu,
            'ibu' => $data->dataIbu->nama,
            'nama' => $data->nama,
            'jenis_kelamin' => $data->jenis_kelamin,
            'tanggal_lahir' => $data->tanggal_lahir,
            'tempat_lahir' => $data->tempat_lahir,
            'berat_lahir' => $data->berat_lahir,
            'tinggi_lahir' => $data->tinggi_lahir,
            'riwayat_kesehatan' => $data->riwayat_kesehatan
        ];
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $dataAnak = DataAnak::with(['dataIbu'])
            ->where(function ($query) use ($searchTerm) {
                $query->whereHas('dataIbu', function ($query) use ($searchTerm) {
                    $query->where('nik', 'like', '%' . $searchTerm . '%')
                        ->orWhere('nama', 'like', '%' . $searchTerm . '%');
                })->orWhere('nama', 'like', '%' . $searchTerm . '%');
            })
            ->get()
            ->map(function ($data) {
                return $this->transformedData($data);
            });
        return response()->json($dataAnak);
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
        $insert = DataAnak::create($request->all());

        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataAnak  $dataAnak
     * @return \Illuminate\Http\Response
     */
    public function show(DataAnak $dataAnak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataAnak  $dataAnak
     * @return \Illuminate\Http\Response
     */
    public function edit(DataAnak $dataAnak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataAnak  $dataAnak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataAnak $dataanak)
    {
        $dataanak->fill($request->post())->save();
        return response()->json([
            'message' => 'Updated Successfully!!',
            'category' => $dataanak
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataAnak  $dataAnak
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataAnak $dataanak)
    {
        $dataanak->delete();
        return response()->json([
            'message' => 'Deleted Successfully!!'
        ]);
    }
}
