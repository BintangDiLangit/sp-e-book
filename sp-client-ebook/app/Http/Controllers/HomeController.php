<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
	public function dashboard()
	{
		$kategori = Http::get('http://127.0.0.1:8001/api/kategori')->json();
		$buku = Http::get('http://127.0.0.1:8001/api/buku')->json();
		$transaksi = Http::get('http://127.0.0.1:8002/api/transaksi')->json();

		$totalkategori = count($kategori['data']);
		$totalbuku = count($buku['data']);
		$totaltransaksi = count($transaksi['data']);


		$sumpendapatan = 0;
		for ($i = 0; $i < $totaltransaksi; $i++) {
			$sumpendapatan += $transaksi['data'][$i]['total_harga'];
		}


		return view('admin.dashboard', compact('totalkategori', 'totalbuku', 'totaltransaksi', 'sumpendapatan'));
	}
}
