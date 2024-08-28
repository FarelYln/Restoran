@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Menu</h1>

        <form action="{{ route('menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_menu">Nama Menu:</label>
                @if ($errors->has('nama_menu'))
                <div class="alert alert-danger">
                    {{ $errors->first('nama_menu') }}
                </div>
                @endif
                <input type="text" name="nama_menu" id="nama_menu" class="form-control" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="price">Harga:</label>
                <input type="number" name="price" id="price" class="form-control" value="{{number_format($menu->price, 0, ',', '.') }}" min="0" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    </div>
@endsection
