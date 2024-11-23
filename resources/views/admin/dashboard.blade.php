@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Lembur yang Menunggu Persetujuan</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal Lembur</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lemburs as $lembur)
                    <tr>
                        <td>{{ $lembur->id }}</td>
                        <td>{{ $lembur->user->name }}</td>
                        <td>{{ $lembur->tanggal }}</td>
                        <td>
                            @if($lembur->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($lembur->status == 'approved')
                                <span class="badge badge-success">Disetujui</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if($lembur->status == 'pending')
                                <form action="{{ route('admin.lembur.approve', $lembur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-success">Setujui</button>
                                </form>
                                <form action="{{ route('admin.lembur.reject', $lembur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>Sudah Diproses</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
