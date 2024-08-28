<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'price',
    ];
    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'menu_pesanan', 'menu_id', 'pesanan_id');
    }
}
