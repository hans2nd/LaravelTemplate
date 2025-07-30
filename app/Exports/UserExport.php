<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{
    public function view(): view
    {
        $data = [
            'user' => User::orderBy('jabatan', 'asc')->get(),
            'date' => date('Y-m-d'),
        ];
        return view('admin/user/excel', $data);
    }
    
}

