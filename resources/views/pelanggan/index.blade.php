@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pelanggan</h1>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah Pelanggan
        </a>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3">
                {{ $message }}
            </div>
        @endif
        @if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php 
            $i=1; 
            ?>
            <tbody>
                @foreach ($pelanggan as $p)
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->email }}</td>
                        <td>
                            <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin?&#x2639;')" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
