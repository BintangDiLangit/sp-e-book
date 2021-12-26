<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
	function index()
	{
		$data = Http::get('http://127.0.0.1:8002/api/transaksi')->json();
		$dataBuku = Http::get('http://127.0.0.1:8001/api/buku')->json();

		return view('admin.transaksi.index', ['data' => $data['data'], 'dataBuku' => $dataBuku['data']]);
	}

	public function store(Request $request)
	{
		$client = new Client();
		$res = $client->request('POST', 'http://127.0.0.1:8002/api/transaksi', [
			'json' => [
				'nama_pembeli' => $request->nama_pembeli,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'nama_buku' => $request->nama_buku,
				'total_harga' => $request->total_harga,
				'jumlah' => $request->jumlah
			]
		]);
		return redirect(route('transaksi.index'));
	}
	public function destroy($id)
	{
		$client = new Client();
		$data = $client->request('DELETE', 'http://127.0.0.1:8002/api/transaksi/' . $id);
		return redirect(route('transaksi.index'));
	}
}
