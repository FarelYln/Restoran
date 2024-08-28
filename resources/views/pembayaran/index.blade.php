@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pembayaran</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor Meja</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
                <th>Kembalian</th>
                <th>Aksi</th> <!-- New column for actions -->
            </tr>
        </thead>
        <?php $i=1; ?>
        <tbody>
            @foreach ($pembayarans as $pembayaran)
                <tr>
                    <td><?= $i++ ?></td>
                    <td>{{ $pembayaran->pesanan->meja->nomor_meja ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                    <td>
                        @if($pembayaran->total_bayar >= $pembayaran->total_harga)
                            Rp {{ number_format($pembayaran->total_bayar - $pembayaran->total_harga, 0, ',', '.') }}
                        @else
                            Rp 0
                        @endif
                    </td>
                    <td>
                        <!-- Detail link -->
                        <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
