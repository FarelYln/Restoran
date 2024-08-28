<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Meja;
use App\Models\Pembayaran;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::all(); // Fetch all records from the 'pesanan' table
        return view('pesanan.index', compact('pesanans'));
    }

    public function getTotal($id)
{
    $pesanan = Pesanan::find($id);
    if ($pesanan) {
        return response()->json(['total' => $pesanan->total]);
    } else {
        return response()->json(['total' => 0], 404);
    }
}

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $mejas = Meja::where('status', 'available')->get();
        $menus = Menu::all();

        return view('pesanan.create', compact('pelanggans', 'mejas', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'exists:menus,id',
            'meja_id' => 'required|exists:mejas,id',
        ]);

        // Create a new Pesanan record
        
        // Calculate total price
        $totalHarga = Menu::whereIn('id', $request->menu_ids)->sum('price');

        // dd($totalHarga);
        
        $pesanan = Pesanan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'meja_id' => $request->meja_id,
            'total' => $totalHarga
        ]);

        $meja = Meja::find($request->meja_id);

        $meja->update([
            'status' => 'unavailable'
        ]);

        // Attach the selected menus to the pesanan
        $pesanan->menus()->attach($request->menu_ids);

        return redirect()->route('pesanan.index')
                         ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit(Pesanan $pesanan)
    { 
        $pelanggans = Pelanggan::all();
        $mejas = Meja::where('status', 'available')->get();
        $menus = Menu::all();
        

        return view('pesanan.edit', compact('pesanan', 'pelanggans', 'menus', 'mejas'));
    }


    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'exists:menus,id',
            'meja_id' => 'required|exists:mejas,id',
        ]);

        // Update Pesanan record
        $pesanan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'meja_id' => $request->meja_id,
        ]);

        // Calculate total price
        $totalHarga = Menu::whereIn('id', $request->menu_ids)->sum('price');

        // Save the total price to the Pesanan record
        $pesanan->total = $totalHarga;
        $pesanan->save();

        // Sync the selected menus with the pesanan
        $pesanan->menus()->sync($request->menu_ids);

        return redirect()->route('pesanan.index')
                         ->with('success', 'Pesanan diubah.');
    }
    public function destroy(Pesanan $pesanan)
    { 
       $mejaId = $pesanan->meja_id;

       $meja = Meja::find($mejaId);
       
        $meja->update([
            'status' => 'available'
        ]);

        $pesanan->delete();

        return redirect()->route('pesanan.index')
                         ->with('success', 'pesanan berhasil dihapus.');
    }
}