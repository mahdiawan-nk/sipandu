<?php

namespace App\Http\Controllers;

use App\Models\DataIbu;
use App\Models\DataAnak;
use App\Models\DataPosyandu;
use App\Models\Pengguna;
use App\Models\DataCheckUp;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        $this->data = [
            'title' => 'Dashboard',
        ];
        return view('home', $this->data);
    }

    public function statistikcard()
    {
        $dataIbu = DataIbu::count();
        $dataAnak = DataAnak::count();
        if (in_array($this->role, ['A'])) {
            $dataPosyandu = DataPosyandu::count();
            $dataCheckUp = DataCheckUp::count();
        } else if (in_array($this->role, ['P'])) {
            $dataPosyandu = DataPosyandu::where('id', $this->idposyandu)->count();
            $dataCheckUp = DataCheckUp::where('id_posyandu', $this->idposyandu)->count();
        }
        $dataPengguna = Pengguna::where('role', 'P')->count();


        return response()->json([
            'data_ibu' => $dataIbu,
            'data_anak' => $dataAnak,
            'data_posyandu' => $dataPosyandu,
            'data_checkup' => $dataCheckUp,
            'data_petugas' => $dataPengguna
        ]);
    }
}
