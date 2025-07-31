<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tugas;
use App\Exports\TugasExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TugasController extends Controller
{
   public function index()
    {
        $user = Auth::user();

        if ($user->jabatan == 'Admin') {
            $data = [
                'title' => 'Data Tugas',
                'menuAdminTugas' => 'active',
                'tugas' => Tugas::with('user')->get(),   
            ];
            return view('admin/tugas/index', $data);
        } else {
            
            $data = [
                'title' => 'Data Tugas',
                'menuKaryawanTugas' => 'active',
                'tugas' => Tugas::with('user')->where('user_id', $user->id)->first(),
            ];
            return view('karyawan/tugas/index', $data);
        }

    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Tugas',
            'menuAdminTugas' => 'active',
            'users' => User::where('jabatan',  'Karyawan')->where('is_tugas', false)->orderBy('nama', 'asc')->get(),
        ];
        return view('admin/tugas/create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tugas' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ],[
            'user_id.required' => 'Nama harus diisi',
            'tugas.required' => 'Tugas harus diisi',
            'tanggal_mulai.required' => 'Tanggal Mulai harus diisi',
            'tanggal_selesai.required' => 'Tanggal Selesai harus diisi',
        ]);

        $user = User::findOrFail($request->user_id);
        $tugas = new Tugas;
        $tugas->user_id = $request->user_id;
        $tugas->tugas = $request->tugas;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->save();
        $user->is_tugas = true;
        $user->save();

        return redirect()->route('tugas')->with('success', 'Data Tugas Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Tugas',
            'menuAdminTugas' => 'active',
            'tugas' => Tugas::with('user')->findOrFail($id)
        ];
        return view('admin/tugas/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tugas' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ],[
            'tugas.required' => 'Tugas harus diisi',
            'tanggal_mulai.required' => 'Tanggal Mulai harus diisi',
            'tanggal_selesai.required' => 'Tanggal Selesai harus diisi',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->tugas = $request->tugas;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->save(); 

        return redirect()->route('tugas')->with('success', 'Data Tugas Berhasil Diubah');
    }

    public function delete($id)
    {
        $tugas = Tugas::findOrFail($id);
        $user = User::findOrFail($tugas->user_id);
        $user->is_tugas = false;
        $user->save();
        $tugas->delete();
        return redirect()->route('tugas')->with('success', 'Data Tugas Berhasil Dihapus');
    }

    public function excel()
    {
        $filename = now()->format('d-m-Y H.i.s');
        return Excel::download(new TugasExport, 'DataTugas_'.$filename.'.xlsx');
    }

    public function pdf()
    {
        $user = Auth::user();
        $filename = now()->format('d-m-Y_H.i.s');
        
        if ($user->jabatan == 'Admin') {
            $data = [
                'tugas' => Tugas::with('user')->get(),
                'date' => date('Y-m-d'),
            ];
            
            $pdf = Pdf::loadView('admin/tugas/pdf', $data);
            return $pdf->setPaper('a4', 'landscape')->stream('DataTugas_'.$filename.'.pdf');
        } else {
            $data = [
                'tugas' => Tugas::with('user')->where('user_id', $user->id)->first(),
                'date' => date('Y-m-d'),
            ];
            
            $pdf = Pdf::loadView('karyawan/tugas/pdf', $data);
            return $pdf->setPaper('a4', 'portrait')->stream('DataTugas_'.$filename.'.pdf');
        }


    }

}
