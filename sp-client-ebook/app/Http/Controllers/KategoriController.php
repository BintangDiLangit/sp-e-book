<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
	function index()
	{
		$client = new Client();
		$data = $client->request(
			'GET',
			'http://127.0.0.1:8001/api/kategori',
		)->getBody()->getContents();

		$fixData = json_decode($data, true);
		return view('admin.kategori.index', ['data' => $fixData['data']]);
	}

	function store(Request $request)
	{
		$client = new Client();
		$res = $client->request('POST', 'http://127.0.0.1:8001/api/kategori', [
			'json' => [
				'nama_kategori' => $request->nama_kategori,
			]
		]);
		return redirect(route('kategori.index'));
	}

	public function update(Request $request, $id)
	{
		$client = new Client();
		$data = $client->request('PUT', 'http://127.0.0.1:8001/api/kategori/' . $id, [
			'json' => [
				'nama_kategori' => $request->nama_kategori,
			]
		]);
		return redirect(route('kategori.index'));
	}

	public function destroy($id)
	{
		$client = new Client();
		$data = $client->request('DELETE', 'http://127.0.0.1:8001/api/kategori/' . $id);
		return redirect(route('kategori.index'));
	}
}
