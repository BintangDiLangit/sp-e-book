<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriBukuController extends Controller
{
	public function index()
	{
		$kategoriBuku = KategoriBuku::get();
		return response()->json([
			"success" => true,
			"message" => "Daftar Kategori Buku",
			"data" => $kategoriBuku
		]);
	}

	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_kategori' => 'required',
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$kategori = KategoriBuku::create($input);
		return response()->json([
			"success" => true,
			"message" => "Kategori buku telah ditambahkan.",
			"data" => $kategori
		]);
	}

	public function update(Request $request, $id)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_kategori' => 'required',
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$data = KategoriBuku::find($id);
		$jenis = $data->update($input);
		return response()->json([
			"success" => true,
			"message" => "Kategori buku telah diupdate.",
			"data" => $jenis
		]);
	}

	public function destroy($kategori_buku)
	{
		KategoriBuku::destroy($kategori_buku);
		return response()->json([
			"success" => true,
			"message" => "Kategori buku telah dihapus",
			"data" => $kategori_buku
		]);
	}
}
