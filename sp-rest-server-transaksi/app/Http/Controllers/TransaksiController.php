<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
	public function index()
	{
		$transaksis = Transaksi::get();
		return response()->json([
			"success" => true,
			"message" => "List transaksi pembelian",
			"data" => $transaksis
		]);
	}

	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_pembeli' => 'required',
			'alamat' => 'required',
			'no_telp' => 'required',
			'nama_buku' => 'required',
			'total_harga' => 'required',
			'jumlah' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$transaksi = Transaksi::create($input);
		return response()->json([
			"success" => true,
			"message" => "Transaksi pembelian telah ditambahkan.",
			"data" => $transaksi
		]);
	}

	public function destroy($transaksi)
	{
		Transaksi::destroy($transaksi);
		return response()->json([
			"success" => true,
			"message" => "Transaksi pembelian telah dihapus",
			"data" => $transaksi
		]);
	}
}
