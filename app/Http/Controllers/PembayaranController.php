<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pesanan')->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        // Fetch all pesanan records
        $pesanans = Pesanan::with('pelanggan','meja','menus')->get();
        return view('pembayaran.create', compact('pesanans'));
    }
    // In PesananController.php
public function getTotal($id)
{
    $pesanan = Pesanan::with('menu')->find($id); // Assuming there's a relationship between Pesanan and Menu

    if ($pesanan) {
        // Calculate the total price by summing the prices of all menu items associated with this pesanan
        $total = $pesanan->menu->sum('price');
        return response()->json(['total' => $total]);
    } else {
        return response()->json(['total' => 0], 404);
    }
}

    public function bayar(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        return view('pembayaran.create', compact('pesanan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:pesanans,id',
            'total_harga' => 'required|numeric',
            'total_bayar' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value < $request->total_harga) {
                        $fail('Nominal tidak mencukupi.');
                    }
                },
            ],
        ]);
        

        Pembayaran::create([
            'pesanan_id' => $request->pesanan_id,
            'total_harga' => $request->total_harga,
            'total_bayar' => $request->total_bayar,
        ]);

        $pesanan = Pesanan::find($request->pesanan_id);

        $mejaId = $pesanan->meja->id;

        $meja = Meja::find($mejaId);

        $meja->update([
            'status' => 'available'
        ]);

        $pesanan->update([
            'status' => 'paid',
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }
    public function edit(Pembayaran $pembayaran)
    {
        return view('pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $pesanan = Pesanan::find($request->pesanan_id);

        $mejaId = $pesanan->meja->id;

        $meja = Meja::find($mejaId);

        $meja->update([
            'status' => 'available'
        ]);
        $request->validate([
            'total_bayar' => 'required|numeric',
        ]);

        $pembayaran->update([
            'total_bayar' => $request->total_bayar,
        ]);

        return redirect()->route('pembayaran.index')
                         ->with('success', 'Pembayaran berhasil diupdate.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
                         ->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function show($id)
{
    $pembayaran = Pembayaran::with('pesanan.meja')->findOrFail($id);
    $pembayaran = Pembayaran::findOrFail($id);
    
    // Misalkan Anda ingin menentukan tanggal selesai sebagai tanggal saat ini
    $tanggalSelesai = now();

    return view('pembayaran.show', compact('pembayaran', 'tanggalSelesai'));;
}
}
