<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // implementasi class Authenticatable
class UserModel extends Authenticatable
{

    use HasFactory;
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username',
        'password',
        'nama',
        'level_id',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'password', // jangan di tampilkan saat select
    ];
    protected $casts = [
        'password' => 'hashed', // casting password agar otomatis di hash
    ];
    /**
     * Relasi ke tabel level
     */
    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function getRollname()
    {
        return $this->level->level_nama;
    }

    public function hasRole($role)
    {
        return ($this->level_kode === $role);
    }

    public function getRole()
    {
        return $this->level->level_kode;
    }
}

