<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPesanan extends Model {
    use HasFactory;

    protected $fillable = ['pesanan_id', 'menu_id', 'quantity'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class); // Adjust if using a pivot table
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function pesanan()
{
    return $this->belongsToMany(Pesanan::class, 'menu_pesanan');
}
}
