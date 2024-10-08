@extends('layouts.master')
@section('title', 'Dashboard')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection


@section('content')
    <div class="container-fluid mt-5">
        <div class="edit-profile">
            <div class="container-fluid">
                <div class="col-xl-12">
                    <div class="card  mt-5">
                        <div class="card-header mt-5">
                            <h4 class="card-title mb-0">My Profile</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
                                        <div class="media-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama</td>
                                                            <td>:</td>
                                                            <td>{{ $mahasiswa->nama }}</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Nim</td>
                                                            <td>:</td>
                                                            <td>{{ $mahasiswa->nim }}</td>

                                                        </tr>

                                                        <tr>
                                                            <td>Jenis Kelamin</td>
                                                            <td>:</td>
                                                            <td>{{ $jk }}</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td>{{ $mahasiswa->alamat }}</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Tempat/Tanggal Lahir</td>
                                                            <td>:</td>
                                                            <td>{{ $mahasiswa->tempat_lahir . '/' . $mahasiswa->tgl_lahir }}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Nama Orang Tua/Wali</td>
                                                            <td>:</td>
                                                            <td>{{ $mahasiswa ? $mahasiswa->nama_ayah : '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Akademik</td>
                                                            <td>:</td>
                                                            <td>{{ $status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dosen Wali</td>
                                                            <td>:</td>
                                                            <td>{{ $dosenwali ? $dosenwali->nama : '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total SKS</td>
                                                            <td>:</td>
                                                            <td>{{ $totalsks ? $totalsks : '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>IPK</td>
                                                            <td>:</td>
                                                            <td>Thornton</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- <h5 class="mb-1">{{ $mahasiswa->nama }}</h5>
                                            <p>{{ $prodi[$mahasiswa->id_program_studi] }}</p>
                                            <p>{{ $prodi[$mahasiswa->id_program_studi] }}</p> --}}
                                        </div>
                                        <div class="photo-profile col-sm-3">
                                            <img class="img-thumbnail" alt=""
                                                src="{{ !empty($mahasiswa->foto_mhs) ? asset('assets/images/mahasiswa/' . $mahasiswa->foto_mhs) : asset('assets/images/dashboard/images/user/7.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row default-according style-1 faq-accordion" id="accordionoc">
                <div class="col-xl-10 xl-100 col-lg-8 col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon" aria-expanded="false" aria-controls="collapseicon"><i
                                        data-feather="help-circle"></i> Kartu Rencana Studi</button>
                            </h5>
                        </div>
                        <div class="collapse" id="collapseicon" aria-labelledby="collapseicon"
                            data-bs-parent="#accordionoc">
                            <div class="card-body">
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                                    <div class="table-responsive">
                                        <table class="table" id="tablekrs">
                                            <thead>
                                                <td>No.</td>
                                                <td>Kode</td>
                                                <td>Nama Matakuliah</td>
                                                <td>Kelas</td>
                                                <!-- <td>SKS</td> -->
                                                <td>Hari, Waktu</td>
                                                <td>Ruang</td>
                                                <td>SKS</td>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total_krs = 0;
                                                @endphp
                                                @foreach($krsList as $krs)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $krs['kode_matkul'] }}</td>
                                                        <td>{{ $krs['nama_matkul'] }}</td>
                                                        <td>{{ $krs['kel'] }}</td>
                                                        <!-- <td>{{ $krs['sks_teori'] }}T/ {{ $krs['sks_praktek'] }}P</td> -->
                                                        <td>{{ $krs['hari'] }}, {{ $krs['nama_sesi'] }}</td>
                                                        <td>{{ $krs['nama_ruang'] }}</td>
                                                        <td>{{ ($krs->sks_teori+$krs->sks_praktek) }}</td>
                                                      
                                                    </tr>
                                                    @php
                                                    $total_krs += ($krs->sks_teori+$krs->sks_praktek);
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan=6 class="text-center">Total SKS</th>
                                                    <th>{{$total_krs}}</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon2" aria-expanded="false" aria-controls="collapseicon2"><i
                                        class="text-danger" data-feather="alert-circle"></i> Presensi Semester Ini </button>
                            </h5>
                        </div>
                        {{-- <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                            
                        </div> --}}
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon5" aria-expanded="false"
                                    aria-controls="collapseicon2"><i
                                    class="text-danger" data-feather="alert-circle"></i>  TRANSKRIP
                                    NILAI</button>
                            </h5>
                        </div>
                        {{-- <div class="collapse" id="collapseicon5" data-bs-parent="#accordionoc">
                          
                        </div> --}}
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon6" aria-expanded="false"
                                    aria-controls="collapseicon2"><i class="text-danger" data-feather="alert-circle"></i> PRESENSI SEMESTER INI
                                    WALI</button>
                            </h5>
                        </div>
                        {{-- <div class="collapse" id="collapseicon6" data-bs-parent="#accordionoc">
                           
                        </div> --}}
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon7" aria-expanded="false"
                                    aria-controls="collapseicon2"><i class="text-danger" data-feather="alert-circle"></i> PEMBAYARAN</button>
                            </h5>
                        </div>
                        {{-- <div class="collapse" id="collapseicon7" data-bs-parent="#accordionoc">
                       
                        </div> --}}
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon8" aria-expanded="false"
                                    aria-controls="collapseicon2"><i data-feather="help-circle"></i> JADWAL MENGAJAR DOSEN
                                    WALI</button>
                            </h5>
                        </div>
                        <div class="collapse" id="collapseicon8" data-bs-parent="#accordionoc">
                            <div class="card-body">
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                                    <div class="table-responsive">
                                   
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2" class="align-top">#</th>
                                                    <th rowspan="2" class="align-top">Mata Kuliah </th>
                                                    <th rowspan="2" class="align-top">Kelompok</th>
                                                    <th rowspan="2" class="align-top">SKS</th>
                                                    <th rowspan="2" class="align-top">Status</th>
                                                    <th colspan="4">Jadwal</th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th>Hari/Jam</th>
                                                    <th>Ruang</th>
                                                    <th>Hari/Jam</th>
                                                    <th>Ruang</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @if (count($jadwalDosenWali) > 0)
                                                @foreach ($jadwalDosenWali as  $jadwal)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $jadwal->matkul ?? '-' }}</td>
                                                        <td>{{ $jadwal->kelompok ?? '-' }}</td>
                                                        <td>{{ $jadwal->sks ?? '-' }}</td>
                                                        <td>{{ $jadwal->status ?? '-' }}</td>
                                                            @if($jadwal->tp === 't')
                                                            <td>
                                                                {{ !empty($jadwal->hari) && !empty($jadwal->jam) ? $jadwal->hari . ', ' . $jadwal->jam : '-' }}
                                                            </td>
                                                            
                                                            <td>{{$jadwal->ruang ??  '-' }}</td>
                                                                <td>-</td>
                                                                <td>- </td>
                                                            @else
                                                                <td>-</td>
                                                                <td>- </td>
                                                                <td>
                                                                    {{ !empty($jadwal->hari) && !empty($jadwal->jam) ? $jadwal->hari . ', ' . $jadwal->jam : '-' }}
                                                                </td>
                                                                <td>{{$jadwal->ruang ? $jadwal->ruang : '=' }}</td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                      
                                                @else
                                                    <tr class="text-center">
                                                        <td colspan="9">
                                                            Data Kosong
                                                        </td>
                                                    </tr>
                                                
                                                @endif


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon10" aria-expanded="false"
                                    aria-controls="collapseicon2"><i class="text-danger" data-feather="alert-circle"></i> JADWAL UJIAN</button>
                            </h5>
                        </div>
                        {{-- <div class="collapse" id="collapseicon10" data-bs-parent="#accordionoc">
                      
                        </div> --}}
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                                    data-bs-target="#collapseicon11" aria-expanded="false"
                                    aria-controls="collapseicon2"><i class="text-danger" data-feather="alert-circle"></i> TUGAS AKHIR</button>
                            </h5>
                        </div>
                        <div class="collapse" id="collapseicon11" data-bs-parent="#accordionoc">
           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

@endsection
