<table>
    <thead>
        <tr>
            <th colspan="5" align="center">Data User</th>
        </tr>
        <tr>
            <th colspan="5" align="left">Print : {{ $date }}</th>
        </tr>
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
                <td>{{ $item->jabatan }}</td>
                <td>
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
