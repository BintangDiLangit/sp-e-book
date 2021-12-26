<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
	use HasFactory;
	protected $guarded = [];

	public function bukus()
	{
		return $this->hasMany(Buku::class, 'id_kategori', 'id');
	}
}
