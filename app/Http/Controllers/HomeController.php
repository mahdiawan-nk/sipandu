<?php

namespace App\Http\Controllers;

use App\Models\DataIbu;
use App\Models\DataAnak;
use App\Models\DataPosyandu;
use App\Models\Pengguna;
use App\Models\DataCheckUp;
use Carbon\Carbon;
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

    public function linetinggibadan(Request $request)
    {
        $tahun = request()->get('tahun');
        $tahun = $tahun ? $tahun : date('Y');
        $Anak = DataAnak::where('id_ibu', $this->idUser)->get();
        $anakId = $Anak->pluck('id');

        // Mendapatkan data pemeriksaan berdasarkan id_anak, bulan, dan tahun
        $dataTinggiBadan = DataCheckUp::select('tanggal_pemeriksaan', 'tinggi_badan_pemeriksaan')
            ->whereIn('id_anak', $anakId)
            ->whereYear('tanggal_pemeriksaan', $tahun)
            ->get();

        $tinggiBadanPerBulan = [];

        // Inisialisasi array bulan untuk memastikan semua bulan ada dalam output JSON
        $bulanList = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        foreach ($bulanList as $bulan) {
            $tinggiBadanPerBulan[$bulan] = [];
        }

        foreach ($dataTinggiBadan as $pemeriksaan) {
            $tanggalPemeriksaan = Carbon::parse($pemeriksaan->tanggal_pemeriksaan);
            $bulanPeriksa = $tanggalPemeriksaan->format('M');
            $tinggiPemeriksaan = $pemeriksaan->tinggi_badan_pemeriksaan;

            $tinggiBadanPerBulan[$bulanPeriksa][] = $tinggiPemeriksaan;
        }

        $tinggiBadanPerBulanJson = [];

        foreach ($tinggiBadanPerBulan as $bulan => $tinggiBulanan) {
            $tinggiRataRata = count($tinggiBulanan) > 0 ? array_sum($tinggiBulanan) / count($tinggiBulanan) : null;
            $tinggiBadanPerBulanJson[] = [
                'bulan_periksa' => $bulan,
                'tinggi_pemeriksaan' => $tinggiRataRata
            ];
        }

        return response()->json($tinggiBadanPerBulanJson);
    }
}
