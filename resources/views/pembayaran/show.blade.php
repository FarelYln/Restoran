@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <h2>Detail Pembayaran</h2>
            Pembayaran ID: {{ $pembayaran->id }}
        </div>
        <div class="card-body">
            
            <hr>
            
            <h3>Pelanggan</h3>
            <p><strong>Nama Pelanggan:</strong> {{ $pembayaran->pesanan->pelanggan->nama ?? 'N/A' }}</p>
            <p><strong>No HP:</strong> {{ $pembayaran->pesanan->pelanggan->no_hp ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $pembayaran->pesanan->pelanggan->email ?? 'N/A' }}</p>
            <hr>

            <h3>Menu</h3>
            <ul>
                @foreach ($pembayaran->pesanan->menus as $menu)
                    <li>{{ $menu->nama_menu }} - Rp {{ number_format($menu->price, 0, ',', '.') }}</li>
                @endforeach
            </ul>

            <hr>
            <h3>Pembayaran</h3>
            <p><strong>Nomor Meja:</strong> {{ $pembayaran->pesanan->meja->nomor_meja ?? 'N/A' }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</p>
            <p><strong>Kembalian:</strong>
                @if($pembayaran->total_bayar >= $pembayaran->total_harga)
                    Rp {{ number_format($pembayaran->total_bayar - $pembayaran->total_harga, 0, ',', '.') }}
                @else
                    Rp 0
                @endif
            </p>
            <hr>
            <p>Tanggal Transaksi: {{ $tanggalSelesai->format('d M Y') }}</p>
            
        </div>
        <div class="card-footer">
            <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
