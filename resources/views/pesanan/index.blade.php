@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pesanan</h1>
        <a href="{{ route('pesanan.create') }}" class="btn btn-primary">Tambah Pesanan</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3">
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
                    <th>Pelanggan</th>
                    <th>Meja</th>
                    <th>Menu</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $i=1; ?>
            <tbody>
                @foreach ($pesanans as $pesan)
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>{{ $pesan->pelanggan->nama }}</td>
                        <td>{{ $pesan->meja->nomor_meja }}</td>
                        <td>
                            @foreach ($pesan->menus as $menu)
                                {{ $menu->nama_menu }}<br>
                            @endforeach
                        </td>
                        <td>Rp {{ number_format($pesan->total, 0, ',', '.') }}</td>
                        <td>
                            @if ($pesan->status == 'unpaid')
                                <span class="badge bg-warning">Belum Dibayar</span>
                            @else
                                <span class="badge bg-success">Sudah Dibayar</span>
                            @endif
                        </td>
                        <td>
                            @if ($pesan->status == 'unpaid')
                            <a class="btn btn-success" href="{{ route('pembayaran.bayar', $pesan->id) }}">Bayar</a>
                            <a href="{{ route('pesanan.edit', $pesan->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pesanan.destroy', $pesan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin?&#x2639;')" class="btn btn-danger">Hapus</button>
                                </form>
                            @else
                                <span class="badge bg-secondary">Tidak Ada Aksi</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
