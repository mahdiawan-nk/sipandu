<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\DataIbu;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function checkLogin(Request $request)
    {
        $validator = null;
        $loginType = $request->nik ? 'nik' : 'email_pengguna';

        if ($loginType === 'nik') {
            $validator = Validator::make($request->all(), [
                'nik' => 'required|max:255',
                'password_pengguna' => 'required|string|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email_pengguna' => 'required|email|max:255',
                'password_pengguna' => 'required|string|min:6',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = $request->only($loginType, 'password_pengguna');
        $userData['password_pengguna'] =  md5($userData['password_pengguna']);

        $loginCheck = $loginType === 'nik' ? DataIbu::where('nik', $userData[$loginType])->first() : Pengguna::where($userData)->first();

        if ($loginCheck) {
            if ($loginType === 'nik' || ($loginCheck->status_akun == 'Y')) {
                $dataSession = [
                    'login' => true,
                    'uuid' => $loginCheck->id,
                    'username' => $loginType === 'nik' ? $loginCheck->nama : $loginCheck->nama_pengguna,
                    'role' => $loginType === 'nik' ? 'O' : $loginCheck->role,
                    'posyandu' => $loginType !== 'nik' ? $loginCheck->id_posyandu : null,
                ];

                session($dataSession);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('error', 'Akun Di Suspend');
            }
        } else {
            return redirect()->back()->with('error', 'Akun Tidak Ada');
        }
    }


    public function logout(Request $request)
    {
        if (in_array(Session::get('role'), ['A', 'P'])) {
            Session::flush();
            return redirect('/admin');
        } else {
            Session::flush();
            return redirect('/');
        }
    }
}
