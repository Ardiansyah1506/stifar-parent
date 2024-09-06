<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';
	protected $primaryKey = 'id_wil';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_level_wil' => 'int'
	];

	protected $fillable = [
		'nm_wil',
		'asal_wil',
		'kode_bps',
		'kode_dagri',
		'kode_keu',
		'id_induk_wilayah',
		'id_level_wil',
		'id_negara'
	];
}
