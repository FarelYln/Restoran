<?php

namespace App\Http\Controllers;
use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller {
    public function index() {
        $meja = Meja::all();
        return view('meja.index', compact('meja'));
    }

    public function create() {
        return view('meja.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_meja' => 'required|string|unique:mejas,nomor_meja',
        ],[
            'nomor_meja.unique' => 'Meja sudah ada.',
        ]);

        Meja::create($request->all());

        return redirect()->route('meja.index')
                         ->with('success', 'Meja Berhasil ditambah.');
    }

    public function edit(Meja $meja) {  
        return view('meja.edit', compact('meja'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nomor_meja' => 'required|string|max:255|unique:mejas,nomor_meja,' . $id,
    ], [
        'nomor_meja.unique' => 'Meja sudah ada.',
    ]);

    $meja = Meja::findOrFail($id);
    $meja->update($request->all());

    return redirect()->route('meja.index')
                     ->with('success', 'Meja di perbarui');
    }

    public function destroy(Meja $meja) {
        // Check if the table (meja) is currently being used in any orders
        $isBeingUsed = $meja->pesanan()->exists();
    
        if ($isBeingUsed) {
            return redirect()->route('meja.index')
                             ->with('error', 'Meja sedang digunakan');
        }
    
        $meja->delete();
    
        return redirect()->route('meja.index')
                         ->with('success', 'Meja dihapus.');
    }
}
