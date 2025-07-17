<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel (default 'users')
     * Uncomment dan sesuaikan jika berbeda dari default
     *
     * @var string
     */
    // protected $table = 'users';

    /**
     * Primary key tabel users
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * Apakah primary key auto-incrementing?
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Tipe data primary key
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Atribut yang dapat diisi secara massal.
     * Pastikan sesuai kolom di database, gunakan 'name' atau 'nama_lengkap'
     * tergantung struktur tabel.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'foto_profil',
        'kartu_mahasiswa',
    ];

    /**
     * Atribut yang disembunyikan untuk array atau JSON.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus di-cast ke tipe tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator dan accessor untuk memetakan atribut 'name' ke kolom 'nama_lengkap'
     */
    public function getNameAttribute(): ?string
    {
        return $this->attributes['nama'] ?? null;
    }

    public function setNameAttribute(string $value): void
    {
        $this->attributes['nama'] = $value;
    }

    /**
     * Relations: users memiliki banyak barang
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_user', 'id_user');
    }

    /**
     * Relations: users memiliki banyak kos
     */
    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_user', 'id_user');
    }
}
