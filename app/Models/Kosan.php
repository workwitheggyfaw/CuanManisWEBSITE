<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kosan extends Model
{
    use HasFactory;

    protected $table = 'kos';

    protected $primaryKey = 'id_kos';


    protected $fillable = [
        'id_user',
        'nama_kos',
        'kategori_kos',
        'lokasi',
        'alamat',
        'harga',
        'nama_pemilik_kos',
        'no_telepon',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        //'tanggal_post'
    ];

    public $timestamps = false; // karena tabel tidak menggunakan created_at dan updated_at
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
