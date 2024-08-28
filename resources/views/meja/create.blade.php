@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Meja</h1>
        <form action="{{ route('meja.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomor_meja">Nomor Meja:</label>
                @if ($errors->has('nomor_meja'))
                <div class="alert alert-danger">
                    {{ $errors->first('nomor_meja') }}
                </div>
                @endif
                <input type="number" name="nomor_meja" value="{{ old('nomor_meja') }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection
