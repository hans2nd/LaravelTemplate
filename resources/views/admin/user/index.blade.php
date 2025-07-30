@extends('layouts/app')
<!-- Page Heading -->
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-user-alt mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('userCreate') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah User
                </a>
            </div>
            <div>
                <a href="{{ route('userExcel') }}" class="btn btn-success">
                    <i class="fas fa-file-excel mr-2"></i>
                    Excel
                </a>
                <a href="{{ route('userPdf') }}" class="btn btn-danger" target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i>
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>
                                    <i class="fas fa-cog"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        <span class="badge badge-primary badge-pill">
                                            {{ $item->email }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->jabatan == 'Admin')
                                            <span class="badge badge-dark badge-pill">{{ $item->jabatan }}</span>
                                        @else
                                            <span class="badge badge-info badge-pill">{{ $item->jabatan }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->is_tugas == false)
                                            <span class="badge badge-danger badge-pill">Belum Ditugaskan</span>
                                        @else
                                            <span class="badge badge-success badge-pill">Sudah Ditugaskan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('userEdit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#exampleModal{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @include('admin.user.modal')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
