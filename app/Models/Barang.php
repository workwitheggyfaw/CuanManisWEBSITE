<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    protected $table = 'barang'; // pakai 'barangs' jika itu nama tabelmu
    public function getUserIdAttribute() {
        return $this->attributes['id_user'];
    }


    protected $fillable = [
        'id_user',
        'nama_barang',
        'kategori_barang',
        'lokasi',
        'harga',
        'no_telepon',
        'kondisi_barang',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        'tanggal_post',
    ];

    // relasi ke user
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
    
    
    public function getWhatsappLinkAttribute()
    {
    $phone = $this->no_telepon;
    if (!$phone) {
        return null;
    }
    // Remove all non-digit characters
    $phone = preg_replace('/\D/', '', $phone);
    // Replace leading '0' with '62' for Indonesia
    if (substr($phone, 0, 1) == '0') {
        $phone = '62' . substr($phone, 1);
    }
    return 'https://wa.me/' . $phone;
    }

}
