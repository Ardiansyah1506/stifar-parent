@extends('layouts.master')
@section('title', 'Dashboard')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
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
                                                <td>Alexander</td>
                                                <td>Orton</td>
                                                
                                                </tr>
                                                <tr>
                                                <td>John Deo</td>
                                                <td>Deo</td>
                                                
                                                </tr>
                                                <tr>
                                                <td>Randy Orton</td>
                                                <td>the Bird</td>
                                                
                                                </tr>
                                                <tr>
                                                <td>Randy Mark</td>
                                                <td>Ottandy</td>
                                               
                                                </tr>
                                                <tr>
                                                <td>Ram Jacob</td>
                                                <td>Thornton</td>
                                               
                                                </tr>
                                                </tbody>
                                                </table>
                                                </div>
                                            {{-- <h5 class="mb-1">{{ $mahasiswa->nama }}</h5>
                                            <p>{{ $prodi[$mahasiswa->id_program_studi] }}</p>
                                            <p>{{ $prodi[$mahasiswa->id_program_studi] }}</p> --}}
                                        </div>
                                        <div class="photo-profile col-sm-2">
                                            <img class="img-fluid" alt=""
                                                src="{{ !empty($mahasiswa->foto_mhs) ? asset('assets/images/mahasiswa/' . $mahasiswa->foto_mhs) : asset('assets/images/dashboard/images/user/7.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <a href="#" class="btn btn-primary btn-block" data-bs-toggle="modal"
                                            data-original-title="test" data-bs-target="#ubahPasswordModal"><i
                                                class="fa fa-key"></i> Ubah Password</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
  
@endsection
