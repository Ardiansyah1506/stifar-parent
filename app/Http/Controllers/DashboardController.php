<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Wilayah;
use App\Models\Mahasiswa;
use App\Models\UserParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $mhs = Auth::user(); // Data dari Mahasiswa
        $nim = $mhs->nim;
        $title = "Mahasiswa";
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        $program_studi = Prodi::all();
        $prodi = [];
        foreach ($program_studi as $row) {
            $prodi[$row->id] = $row->nama_prodi;
        }
        $agama = array('1' => 'Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghuchu', 'Lainnya');
        $wilayah = Wilayah::where('id_induk_wilayah', '000000')->get();

        $kota = [];
        if ($mahasiswa->provinsi != 0 && !empty($mahasiswa->provinsi)) {
            $kota = Wilayah::where('id_induk_wilayah', $mahasiswa->provinsi)->get();
        }

        $kecamatan = [];
        if ($mahasiswa->kecamatan != 0 && !empty($mahasiswa->kecamatan)) {
            $kecamatan = Wilayah::where('id_induk_wilayah', $mahasiswa->kotakab)->get();
        }

        $status = array(
            1 => 'aktif',
            2 => 'cuti',
            3 => 'Keluar',
            4 => 'lulus',
            5 => 'meninggal',
            6 => 'DO'
        );
        $user = Mahasiswa::where('id', $mahasiswa->user_id)->first();

        return view('dashboard', compact('user', 'status', 'kecamatan', 'wilayah', 'kota', 'title', 'mahasiswa', 'prodi', 'agama'));
    }

    public function UpdatePassword(Request $request)
    {
        $nim = Auth::user()->nim;

        $checkUser = UserParent::where('nim', $nim)->first();
        if ($checkUser) {
            UserParent::where('nim', $nim)->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json('Password Berhasil Diperbarui');

        } else {
            UserParent::create(
                [
                    'nim' => $nim,
                    'password' => Hash::make($request->password),
                ]
            );
            return response()->json('Password Berhasil Ditambahkan');
        }

    }
}
