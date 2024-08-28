<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller {
    public function index() {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create() {
        return view('pelanggan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi yang diizinkan
            ],
            'no_hp' => [
                'required',
                'string',
                'max:15',
                'unique:pelanggans,no_hp',
                'regex:/^[0-9]+$/', // Hanya angka yang diizinkan
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:pelanggans,email',
            ],
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar.',
            'no_hp.max' => 'Nomor HP tidak valid.',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil dibuat.');
    }

    public function edit(Pelanggan $pelanggan) {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan) {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi yang diizinkan
            ],
            'no_hp' => [
                'required',
                'string',
                'max:15',
                'unique:pelanggans,no_hp,' . $pelanggan->id, // Mengecualikan pelanggan saat ini
                'regex:/^[0-9]+$/', // Hanya angka yang diizinkan
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:pelanggans,email,' . $pelanggan->id, // Mengecualikan pelanggan saat ini
            ],
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi.',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar.',
            'no_hp.max' => 'Nomor HP tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);
    
    
        $pelanggan->update($request->all());
    
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan diubah.');
    }
    

    public function destroy(Pelanggan $pelanggan) {
        // Check if the table (pelanggan) is currently being used in any orders
        $isBeingUsed = $pelanggan->pesanan()->exists();
    
        if ($isBeingUsed) {
            return redirect()->route('pelanggan.index')
                             ->with('error', 'pelanggan sedang digunakan');
        }
    
        $pelanggan->delete();
    
        return redirect()->route('pelanggan.index')
                         ->with('success', 'pelanggan dihapus.');
    }
}
