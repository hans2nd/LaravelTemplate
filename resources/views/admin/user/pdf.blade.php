<h1 align="center">Data User</h1>
<h3 align="center">Tanggal : {{ $date }}</h3>
<hr>

<table width="100%" border="1" style="border-collapse: collapse">
    <thead>
        <tr>
            <th width="20" align="center">No</th>
            <th width="20" align="center">Nama</th>
            <th width="20" align="center">Email</th>
            <th width="20" align="center">Jabatan</th>
            <th width="20" align="center">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td align="center">{{ $item->jabatan }}</td>
                <td align="center">
                    @if ($item->is_tugas == false)
                        Belum Ditugaskan
                    @else
                        Sudah Ditugaskan
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
