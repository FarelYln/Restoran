@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pelanggan</h1>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama:</label>
            @if ($errors->has('nama'))
            <div class="alert alert-danger">
                {{ $errors->first('nama') }}
            </div>
            @endif
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP:</label>
            @if ($errors->has('no_hp'))
            <div class="alert alert-danger">
                {{ $errors->first('no_hp') }}
            </div>
            @endif
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
            @endif
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection