@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Pesanan</h1>

        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="pelanggan_id">Pelanggan</label>
                <select name="pelanggan_id" class="form-control">
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="meja_id">Meja</label>
                <select name="meja_id" class="form-control">
                    @forelse($mejas as $meja)
                        <option value="{{ $meja->id }}">{{ $meja->nomor_meja }}</option>
                    @empty
                    <option disabled>Meja Not available</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group">
                <label for="menu_ids">Menu</label>
                <div>
                    @foreach($menus as $menu)
                        <div class="form-check">
                            <input type="checkbox" name="menu_ids[]" value="{{ $menu->id }}" class="form-check-input" id="menu{{ $menu->id }}">
                            <label class="form-check-label" for="menu{{ $menu->id }}">
                                {{ $menu->nama_menu }} - Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
