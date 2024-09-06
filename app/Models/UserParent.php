<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserParent extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_parent';
    protected $fillable = [ 'nim','password','remember_token'];
    protected $hidden = ['password', 'remember_token'];


}
