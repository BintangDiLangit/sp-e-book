@extends('layouts.master')
@section('title')
    Transaksi
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
            <!-- Button trigger modal -->

        </div>
        <div class="card-header py-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Tambah Transaksi
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_pembeli">Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" class="form-control" id="nama_pembeli" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_buku">Nama Buku</label>
                                <select id="namabuku" name="nama_buku" class="form-control">
                                    <option value="">- Pilih E-Book -</option>
                                    @foreach ($dataBuku as $item)
                                        <option value="{{ $item['nama_buku'] }}" id="{{ $item['harga_buku'] }}">
                                            {{ $item['nama_buku'] }} - @php
                                                echo 'Rp.' . number_format($item['harga_buku']) . ',00';
                                            @endphp</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total_harga">Total Harga</label>
                                <input type="text" name="total_harga" value="0" class="form-control" id="total_harga"
                                    placeholder="Total harga" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pembeli</th>
                            <th>Nama Buku</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pembeli</th>
                            <th>Nama Buku</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d['nama_pembeli'] }}</td>
                                <td>{{ $d['nama_buku'] }}</td>
                                <td>{{ $d['total_harga'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-id="{{ $d['id'] }}"
                                        data-toggle="modal" data-target="#exampleModal2{{ $d['id'] }}"
                                        id="updatebutton">
                                        Detail
                                    </button>
                                    <button type="button" class="btn btn-danger hap delete" value="{{ $d['id'] }}"
                                        id="{!! $d['id'] !!}"
                                        onclick="hapusData({{ $d['id'] }})">Hapus</button>
                                    @if ($data != null)
                                        <div class="modal fade" id="exampleModal2{{ $d['id'] }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail
                                                            transaksi
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h1>{{ $d['nama_pembeli'] }}</h1>
                                                        <ul>
                                                            <li>
                                                                Nama Buku :
                                                                {{ $d['nama_buku'] }}
                                                            </li>
                                                            <li>
                                                                Jumlah : {{ $d['jumlah'] }}
                                                            </li>
                                                            <li>
                                                                Total Harga : {{ $d['total_harga'] }}
                                                            </li>
                                                            <li>
                                                                Nomor Telp. : {{ $d['no_telp'] }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function hapusData(id) {
            var r = confirm("Apa anda yakin untuk menghapus transaksi ini?");
            if (r == true) {
                console.log(id);
                $(document).on('click', '.delete', function() {
                    $.ajax({
                        url: 'transaksi/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    });

                    location.reload()
                })
            } else {}
        }
    </script>
@endsection
