@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Menu</h1>
        <a href="{{ route('menu.create') }}" class="btn btn-primary">Tambah Menu</a>
        
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
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $i=1;
            ?>
            <tbody>
                @foreach ($menus as $m)
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>{{ $m->nama_menu }}</td>
                        <td>{{ number_format($m->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('menu.edit', $m->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('menu.destroy', $m->id) }}" method="POST" style="display:inline;">
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
