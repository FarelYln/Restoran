@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Meja</h1>
        <a href="{{ route('meja.create') }}" class="btn btn-primary mb-3">Tambah Meja</a>
        @if ($message = Session::get('success'))
             <div class="alert alert-success">
                {{ $message }}
             </div>
        @endif
        @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th> 
                    <th>Nomor Meja</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $i = 1;

            ?>
            <tbody>
                @foreach ($meja as $m)
                    <tr>
                        <td><?=$i++?></td>
                        <td>{{ strval($m->nomor_meja) }}</td>
                        <td>
                           
                            <a href="{{ route('meja.edit', $m->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('meja.destroy', $m->id) }}" method="POST" style="display:inline;">
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