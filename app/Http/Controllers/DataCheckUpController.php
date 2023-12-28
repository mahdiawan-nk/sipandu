<?php

namespace App\Http\Controllers;

use App\Models\DataCheckUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\CheckUpImunisasi;
use App\Models\CheckUpVitamin;
use App\Models\DataAnak;
use App\Models\DataIbu;
use App\Models\DataJenisImunisasi;
use App\Models\DataJenisVitamin;

class DataCheckUpController extends Controller
{
    protected $role, $idposyandu, $idUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role = Session::get('role');
            $this->idposyandu = Session::get('posyandu');
            $this->idUser = Session::get('uuid');
            return $next($request);
        });
    }

    function views()
    {
        $this->data = [
            'title' => 'Check Up Kesehatan Anak',
        ];
        return view('data-checkup.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->role == 'A') {
            $dataCheckUp = DataCheckUp::with([
                'dataAnak',
                'dataImunisasi.DataJenisImunisasi:id,jenis_imunisasi',
                'dataVitamin.DataJenisVitamin:id,nama_vitamin'
            ])
                ->get()
                ->map(function ($data) {
                    return $this->transformedData($data);
                });
        } else if ($this->role == 'P') {
            $dataCheckUp = DataCheckUp::with([
                'dataAnak',
                'dataImunisasi.DataJenisImunisasi:id,jenis_imunisasi',
                'dataVitamin.DataJenisVitamin:id,nama_vitamin'
            ])
                ->where('id_posyandu', $this->idposyandu)
                ->get()
                ->map(function ($data) {
                    return $this->transformedData($data);
                });
        } else {
            $Anak = DataAnak::where('id_ibu', $this->idUser)->get();
            $anakId = $Anak->pluck('id');
            $dataCheckUp = DataCheckUp::with([
                'dataAnak',
                'dataImunisasi.DataJenisImunisasi:id,jenis_imunisasi',
                'dataVitamin.DataJenisVitamin:id,nama_vitamin'
            ])
                ->whereIn('id_anak', $anakId)
                ->get()
                ->map(function ($data) {
                    return $this->transformedData($data);
                });
        }

        return response()->json($dataCheckUp);
    }

    protected function transformedData($data)
    {
        return [
            'id' => $data->id,
            'id_anak' => $data->dataAnak->id,
            'nama' => $data->dataAnak->nama,
            'berat_lahir' => $data->dataAnak->berat_lahir,
            'tinggi_lahir' => $data->dataAnak->tinggi_lahir,
            'usia_saat_periksa' => $data->usia_saat_periksa,
            'tanggal_pemeriksaan' => $data->tanggal_pemeriksaan,
            'berat_badan_pemeriksaan' => $data->berat_badan_pemeriksaan,
            'tinggi_badan_pemeriksaan' => $data->tinggi_badan_pemeriksaan,
            'status_gizi' => $data->status_gizi,
            'status_imunisasi' => $data->status_imunisasi,
            'checkup_imunisasi' => $data->dataImunisasi,
            'status_vitamin' => $data->status_vitamin,
            'checkup_vitamin' => $data->dataVitamin,
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
        $dataPost = [
            'id_posyandu' => $request->id_posyandu,
            'id_anak' => $request->id_anak,
            'usia_saat_periksa' => $request->usia_saat_periksa,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'berat_badan_pemeriksaan' => $request->berat_badan_pemeriksaan,
            'tinggi_badan_pemeriksaan' => $request->tinggi_badan_pemeriksaan,
            'status_gizi' => $request->status_gizi,
            'status_imunisasi' => $request->status_imunisasi,
            'status_vitamin' => $request->status_vitamin
        ];
        $dataCheckUp = DataCheckUp::create($dataPost);
        $idCheckUp = $dataCheckUp->getKey();
        // $idCheckUp =1;
        $dataImunisasi = [];
        $dataVitamin = [];
        if ($request->status_imunisasi == 'Y') {
            foreach ($request->checklis_imunisasi as $item) {
                CheckUpImunisasi::create([
                    'id_imunisasi' => $item,
                    'id_checkup' => $idCheckUp,
                    'dosis' => $request->dosis_imunisasi[$item],
                    'tanggal_beri' => $request->tgl_beri_imunisasi[$item]
                ]);
                $dataImunisasi[] = [
                    'id_imunisasi' => $item,
                    'id_checkup' => $idCheckUp,
                    'dosis' => $request->dosis_imunisasi[$item],
                    'tanggal_beri' => $request->tgl_beri_imunisasi[$item]
                ];
            }
        }
        if ($request->status_vitamin == 'Y') {
            foreach ($request->checklis_vitamin as $item) {
                CheckUpVitamin::create([
                    'id_vitamin' => $item,
                    'id_checkup' => $idCheckUp,
                    'dosis' => $request->dosis_vitamin[$item],
                    'tanggal_beri' => $request->tgl_beri_vitamin[$item]
                ]);
                $dataVitamin[] = [
                    'id_vitamin' => $item,
                    'id_checkup' => $idCheckUp,
                    'dosis' => $request->dosis_vitamin[$item],
                    'tanggal_beri' => $request->tgl_beri_vitamin[$item]
                ];
            }
        }
        // 

        return response()->json(['data_checkup' => $dataPost, 'data_imunisasi' => $dataImunisasi, 'data_vitamin' => $dataVitamin]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataCheckUp  $dataCheckUp
     * @return \Illuminate\Http\Response
     */
    public function show($datacheckup)
    {
        $dataCheckUp = DataCheckUp::with([
            'dataPosyandu',
            'dataAnak.DataIbu',
            'dataImunisasi.DataJenisImunisasi:id,jenis_imunisasi',
            'dataVitamin.DataJenisVitamin:id,nama_vitamin'
        ])
            ->where('id', $datacheckup)
            ->get()
            ->first();
        return response()->json($dataCheckUp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataCheckUp  $dataCheckUp
     * @return \Illuminate\Http\Response
     */
    public function edit(DataCheckUp $dataCheckUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataCheckUp  $dataCheckUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataCheckUp $dataCheckUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataCheckUp  $dataCheckUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataCheckUp $dataCheckUp)
    {
        //
    }
}
