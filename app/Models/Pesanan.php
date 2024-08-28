<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'pelanggan_id',
        'meja_id',
        'total',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_pesanan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}


