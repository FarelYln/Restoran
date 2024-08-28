<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model {
    use HasFactory;
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
    
    protected $table = 'pelanggans';

    protected $fillable = ['nama', 'no_hp', 'email'];

    public function pesanan()
{
    return $this->hasMany(Pesanan::class);
}

}
 