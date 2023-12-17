<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\DataIbu;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function checkLogin(Request $request)
    {
        if ($request->nik) {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|max:255',
                'password_pengguna' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $dataPost = $request->post();
            unset($dataPost['_token']);

            $checkNIK = DataIbu::where('nik', $request->post('nik'))->first();

            if ($checkNIK) {
                $checkPassNik = $checkNIK = DataIbu::where('nik', $request->post('password_pengguna'))->first();
                if ($checkPassNik) {
                    $dataSession = ['login' => TRUE, 'uuid' =>  $checkNIK->id, 'username' =>  $checkNIK->nama, 'role' => 'O'];
                    session($dataSession);
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->back()->with('error', 'Data Pass Salah');
                }
            } else {
                return redirect()->back()->with('error', 'Akun Tidak Ada');
            }
        } else {
            $validator = Validator::make($request->all(), [
                'email_pengguna' => 'required|email|max:255',
                'password_pengguna' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $dataPost = $request->post();
            unset($dataPost['_token']);
            $dataPost['password_pengguna'] = md5($dataPost['password_pengguna']);
            $checkAkun = Pengguna::where($dataPost)->first();

            if ($checkAkun) {
                $dataSession = ['login' => TRUE, 'uuid' => $checkAkun->id, 'username' => $checkAkun->nama_pengguna, 'role' => $checkAkun->role, 'posyandu' => $checkAkun->id_posyandu];
                session($dataSession);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('error', 'Data Deleted');
            }
        }
    }

    public function logout(Request $request)
    {
        if (in_array(Session::get('role'), ['A', 'P'])) {
            Session::flush();
            return redirect('/admin');
        }else{
            Session::flush();
            return redirect('/');
        }
    }
}
