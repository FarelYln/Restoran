<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    
    public function store(Request $request)
{
    $request->validate([
        'nama_menu' => 'required|string|max:255|unique:menus,nama_menu',
        'price' => 'required|numeric|min:0',
    ], [
        'nama_menu.unique' => 'Menu sudah ada.',
        'price.min' => 'Harga tidak valid, harus lebih dari 0'
    ]);

    Menu::create($request->all());

    return redirect()->route('menu.index')
                     ->with('success', 'Menu berhasil dibuat.');
}


    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

        public function update(Request $request, $id)
    {
    $request->validate([
        'nama_menu' => 'required|string|max:255|unique:menus,nama_menu,' . $id,
        'price' => 'required|numeric|min:0',
    ], [
        'nama_menu.unique' => 'Menu sudah ada.',
        'price.min' => 'Harga tidak valid, harus lebih dari 0'
    ]);

    $menu = Menu::findOrFail($id);
    $menu->update($request->all());

    return redirect()->route('menu.index')
                     ->with('success', 'Menu di perbarui');
    }

    // public function destroy(Menu $menu)
    // {
    //     $menu->delete();

    //     return redirect()->route('menu.index')
    //                      ->with('success', 'Menu dihapus.');
    // }
    public function destroy(Menu $menu)
{
    // Check if the menu is currently being used in any orders
    $isBeingUsed = $menu->pesanans()->exists();

    if ($isBeingUsed) {
        return redirect()->route('menu.index')
                         ->with('error', 'Menu sedang digunakan.');
    }

    $menu->delete();

    return redirect()->route('menu.index')
                     ->with('success', 'Menu dihapus.');
}

}
