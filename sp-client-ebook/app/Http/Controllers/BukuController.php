<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BukuController extends Controller
{
	function index()
	{

		$client = new Client();
		$data = $client->request(
			'GET',
			'http://127.0.0.1:8001/api/buku',
		)->getBody()->getContents();

		$dataKategori = $client->request(
			'GET',
			'http://127.0.0.1:8001/api/kategori',
		)->getBody()->getContents();

		$fixData = json_decode($data, true);
		$fixDataKategori = json_decode($dataKategori, true);
		// dd($fixData['data'][0]);
		return view('admin.buku.index', ['data' => $fixData['data'], 'fixDataKategori' => $fixDataKategori['data']]);
	}

	function store(Request $request)
	{

		$client = new Client();
		$res = $client->request('POST', 'http://127.0.0.1:8001/api/buku', [
			'json' => [
				'nama_buku' => $request->nama_buku,
				'harga_buku' => $request->harga_buku,
				'stok' => $request->stok,
				'id_kategori' => $request->id_kategori,
			]
		]);
		return redirect(route('buku.index'));
	}

	public function update(Request $request, $id)
	{
		// dd($request);
		$client = new Client();
		$data = $client->request('PUT', 'http://127.0.0.1:8001/api/buku/' . $id, [
			'json' => [
				'nama_buku' => $request->nama_buku,
				'harga_buku' => $request->harga_buku,
				'stok' => $request->stok,
				'id_kategori' => $request->id_kategori,
			]
		]);
		return redirect(route('buku.index'));
	}

	public function destroy($id)
	{
		$client = new Client();
		$data = $client->request('DELETE', 'http://127.0.0.1:8001/api/buku/' . $id);
		return redirect(route('buku.index'));
	}
}
