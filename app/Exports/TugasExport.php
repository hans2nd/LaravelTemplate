<?php

namespace App\Exports;

use App\Models\Tugas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TugasExport implements FromView
{
    public function view(): view
    {
        $data = [
            'tugas' => Tugas::with('user')->get(),
            'date' => date('Y-m-d'),
        ];
        return view('admin/tugas/excel', $data);
    }
    
}
