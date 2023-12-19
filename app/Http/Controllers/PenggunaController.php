<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    function views()
    {
        $this->data = [
            'title' => 'Data Pengguna',
        ];
        return view('data-pengguna.index', $this->data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAnak = Pengguna::with(['dataPosyandu'])
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
            'id_posyandu' => $data->id_posyandu,
            'nama_pengguna' => $data->nama_pengguna,
            'email_pengguna' => $data->email_pengguna,
            'password_pengguna' => '',
            'role' => $data->role,
            'status_akun' => $data->status_akun,
            'posyandu' => $data->dataPosyandu ? $data->dataPosyandu->nama_posyandu : null
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
        $dataPengguna = $request->post();
        if ($this->emailexist($request->post('email_pengguna'))) {
            return response()->json([
                'status' => false,
                'message' => 'Email sudah terdaftar'
            ]);
        } else {
            $dataPengguna['password_pengguna'] = md5($request->post('password_pengguna'));
            Pengguna::create($dataPengguna);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $dataPengguna,
            ]);
        }
    }

    protected function emailexist($email)
    {
        $emailUser = Pengguna::where('email_pengguna', $email)->first();

        return $emailUser ? true : false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pengguna)
    {
        $dataPengguna = $request->post();
        unset($dataPengguna['_token']);
        unset($dataPengguna['_method']);
        if ($request->post('password_pengguna') != null) {
            $dataPengguna['password_pengguna'] = md5($request->post('password_pengguna'));
        } else {
            unset($dataPengguna['password_pengguna']);
        }

        Pengguna::where('id', $pengguna)->update($dataPengguna);
        return response()->json($dataPengguna);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return response()->json([
            'message' => 'Deleted Successfully!!'
        ]);
    }
}
