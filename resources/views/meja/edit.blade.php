@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Meja</h1>

        <form action="{{ route('meja.update', $meja->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nomor_meja">Nomor Meja:</label>
                @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </ul>
            </div>
        @endif
                <input type="number" name="nomor_meja" class="form-control" value="{{ old('nomor_meja', $meja->nomor_meja) }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    </div>
@endsection
