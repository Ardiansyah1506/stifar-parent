<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = [ 'nim', 'tgl_lahir_ortu','tgl_lahir_ibu'];
    // protected $hidden = ['tgl_lahi', 'remember_token'];

    public function verifyLogin($password)
    {
        return $password === $this->tgl_lahir_ortu || $password === $this->tgl_lahir_ibu;
    }
}
