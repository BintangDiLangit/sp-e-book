<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
	use HasFactory;
	protected $guarded = [];

	protected $table = 'bukus';
	public function kategoriBuku()
	{
		return $this->belongsTo(KategoriBuku::class, 'id_kategori', 'id');
	}
}
