<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Mahasiswa;
use App\Models\UserParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->only('nim', 'password');

        // Cek kredensial dan login
        if ($this->attemptLoginMahasiswa($credentials)) {
            return redirect()->route('dashboard');
        } else {
            // Jika login gagal
            Session::flash('error', 'NIM atau Password Salah');
            return redirect()->back();
        }
    }

    protected function attemptLoginMahasiswa($credentials)
    {
        // Jika tidak ditemukan, cek model Mahasiswa
        $mahasiswa = Mahasiswa::where('nim', $credentials['nim'])->first();

        if ($mahasiswa && $mahasiswa->verifyLogin($credentials['password'])) {
            Auth::login($mahasiswa); // Login sebagai Mahasiswa
            return true;
        }

        return false;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
