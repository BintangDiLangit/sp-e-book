<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{

	public function index()
	{
		$bukus = Buku::with('kategoriBuku')->get();
		return response()->json([
			"success" => true,
			"message" => "List Buku",
			"data" => $bukus
		]);
	}

	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_buku' => 'required',
			'harga_buku' => 'required',
			'stok' => 'required',
			'id_kategori' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$buku = Buku::create($input);
		return response()->json([
			"success" => true,
			"message" => "Data buku telah ditambahkan.",
			"data" => $buku
		]);
	}

	public function update(Request $request, $id)
	{
		// dd($request->all());
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_buku' => 'required',
			'harga_buku' => 'required',
			'stok' => 'required',
			'id_kategori' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$data = Buku::find($id);
		$buku = $data->update($input);
		return response()->json([
			"success" => true,
			"message" => "Data buku telah diupdate.",
			"data" => $buku
		]);
	}

	public function destroy($buku)
	{
		Buku::destroy($buku);
		return response()->json([
			"success" => true,
			"message" => "Data buku telah dihapus",
			"data" => $buku
		]);
	}
}
