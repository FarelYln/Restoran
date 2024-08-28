@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pembayaran</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="text" name="total_harga" id="total_harga" class="form-control" value="Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}" readonly>
            </div>

            <div class="form-group mt-3">
                <label for="total_bayar">Total Bayar:</label>
                <input type="number" name="total_bayar" id="total_bayar" class="form-control" value="{{ $pembayaran->total_bayar }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    </div>
@endsection
