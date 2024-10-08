<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Prodi;
use App\Models\Pegawai;
use App\Models\Wilayah;
use App\Models\Mahasiswa;
use App\Models\UserParent;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()){
        $mhs = Auth::user(); // Data dari Mahasiswa
        $nim = $mhs->nim;
        $idmhs= $mhs->id;
        $tahun_ajaran = TahunAjaran::where('status','Aktif')->first();
        $ta = $tahun_ajaran->id;
        $title = "Mahasiswa";
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
      
        $dosenwali = Pegawai::where('id', $mahasiswa->id_dsn_wali)->select('nama')->first();
        $totalsks = Krs::where('id_mhs', 1663)
        ->join('master_jadwal AS jadwal', 'jadwal.id', '=', 'krs.id_jadwal')
        ->join('master_mata_kuliah AS matkul', 'matkul.kode_mata_kuliah', '=', 'jadwal.kode_mata_kuliah')
        ->select(DB::raw('SUM(matkul.jumlah_sks) as total_sks'))
        ->value('total_sks');

        $jadwalDosenWali  = Pegawai::where('pegawai.id', $mahasiswa->id_dsn_wali)
        ->leftJoin('master_jadwal AS jadwal','jadwal.id_dosen','pegawai.id')
        ->leftJoin('master_mata_kuliah AS mata_kuliah','jadwal.kode_mata_kuliah','mata_kuliah.kode_mata_kuliah')
        ->select('mata_kuliah.nama_mata_kuliah AS matkul','mata_kuliah.kelompok_mata_kuliah AS kelompok','mata_kuliah.tp AS tp','jadwal.hari AS hari','jadwal.sesi AS jam','jadwal.ruang AS ruang')
        // ->where('mata_kuliah.is_aktif',1)
        ->get();

        // dd($jadwalDosenWali);
        
          $krsList = Krs::select('krs.*', 'jadwal.hari', 'jadwal.kel', 'matkul.nama_matkul', 'matkul.sks_teori', 'matkul.sks_praktek','matkul.kode_matkul', 'waktu.nama_sesi', 'ruang.nama_ruang')
                    ->leftJoin('jadwals as jadwal', 'krs.id_jadwal', '=', 'jadwal.id')
                    ->leftJoin('mata_kuliahs as matkul', 'jadwal.id_mk', '=', 'matkul.id')
                    ->leftJoin('waktus as waktu', 'jadwal.id_sesi', '=', 'waktu.id')
                    ->leftJoin('master_ruang as ruang', 'jadwal.id_ruang', '=', 'ruang.id')
                    ->where('krs.id_tahun', $ta)
                    ->where('id_mhs',$idmhs)
                    ->get();
        // $krsList = Krs::where('krs.id_mhs', 1663)
        // ->leftJoin('master_jadwal AS jadwal', 'jadwal.id_jadwal', '=', 'krs.id_jadwal')
        // ->leftJoin('master_mata_kuliah AS matkul', 'matkul.kode_mata_kuliah', '=', 'jadwal.kode_mata_kuliah')
        // ->select(
        //     'jadwal.hari AS hari',
        //     'jadwal.status AS status',
        //     'jadwal.kode_mata_kuliah AS kode_mata_kuliah',
        //     'krs.id_jadwal AS kode_jadwal',
        //     'matkul.kelompok_mata_kuliah AS kelompok',
        //     'jadwal.sesi AS sesi',
        //     'jadwal.ruang AS ruang',
        //     'matkul.nama_mata_kuliah AS matkul',
        //     'matkul.jumlah_sks AS sks',
        //     'krs.is_publish',
        //     'matkul.is_aktif',
        //     'matkul.tp'
        // )
        // ->where('jadwal.status', 1)
        // ->get();
    
        // dd($krs);

        $jk = $mahasiswa->jk == 1 ? 'Laki-Laki' : ($mahasiswa->jk == 2 ? 'Perempuan' : '-');
        $status = match($mahasiswa->status) {
            1 => 'aktif',
            2 => 'cuti',
            3 => 'Keluar',
            4 => 'lulus',
            5 => 'meninggal',
            6 => 'DO',
            default => '-',
        };
        
        return view('dashboard', compact( 'status','title', 'mahasiswa','jk','dosenwali','totalsks','krsList','jadwalDosenWali'));
        }
        return redirect()->back();
    }

   
}
