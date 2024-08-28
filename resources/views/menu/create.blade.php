@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Menu</h1>

        <form action="{{ route('menu.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_menu">Nama Menu:</label>
                @if ($errors->has('nama_menu'))
                <div class="alert alert-danger">
                    {{ $errors->first('nama_menu') }}
                </div>
                @endif
                <input type="text" name="nama_menu" id="nama_menu" value="{{old('nama_menu')}}" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="price">Harga:</label>
                @if ($errors->has('price'))
                <div class="alert alert-danger">
                    {{ $errors->first('price') }}
                </div>
                @endif
                <input type="number" name="price" id="price" value="{{old('price')}}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection
