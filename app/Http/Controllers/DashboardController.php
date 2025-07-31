<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menuDashboard' => 'active',
            'jumlahUser' => User::count(),
            'jumlahAdmin' => User::where('jabatan', 'Admin')->count(),
            'jumlahKaryawan' => User::where('jabatan', 'Karyawan')->count(),
            'jumlahDiTugaskan' => User::where('jabatan', 'Karyawan')->where('is_tugas', true)->count(),
        ];
        return view('dashboard', $data);
    }
}
