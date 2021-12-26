@extends('layouts.master')
@section('title')
    Buku
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buku</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Buku</h6>
            <!-- Button trigger modal -->

        </div>
        <div class="card-header py-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Tambah Buku
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_kategori"></label>
                                <select name="id_kategori" class="form-control" id="">
                                    <option value="">- Pilih Kategori Buku -</option>
                                    @foreach ($fixDataKategori as $dataKategori)
                                        <option value="{{ $dataKategori['id'] }}">
                                            {{ $dataKategori['nama_kategori'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_buku">Nama Buku</label>
                                <input type="text" name="nama_buku" class="form-control" id="nama_buku" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_buku">Harga Buku</label>
                                <input type="number" name="harga_buku" class="form-control" id="harga_buku" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok Buku</label>
                                <input type="number" name="stok" class="form-control" id="stok" required>
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
                            <th>Nama Kategori</th>
                            <th>Nama Buku</th>
                            <th>Harga Buku</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Nama Buku</th>
                            <th>Harga Buku</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d['kategori_buku']['nama_kategori'] }}</td>
                                <td>{{ $d['nama_buku'] }}</td>
                                <td>{{ $d['harga_buku'] }}</td>
                                <td>{{ $d['stok'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-id="{{ $d['id'] }}"
                                        data-toggle="modal" data-target="#exampleModal2{{ $d['id'] }}"
                                        id="updatebutton">
                                        Edit
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('buku.update', ['buku' => $d['id']]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="id_kategori"></label>
                                                                <select name="id_kategori" class="form-control" id="">
                                                                    <option value="">- Pilih Kategori Buku -</option>
                                                                    @foreach ($fixDataKategori as $dataKategori)
                                                                        <option value="{{ $dataKategori['id'] }}"
                                                                            {{ $dataKategori['id'] == $d['id_kategori'] ? 'selected' : '' }}>
                                                                            {{ $dataKategori['nama_kategori'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_buku">Nama Buku</label>
                                                                <input type="text" name="nama_buku"
                                                                    value="{{ $d['nama_buku'] }}" class="form-control"
                                                                    id="nama_buku" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="harga_buku">Harga Buku</label>
                                                                <input type="number" name="harga_buku"
                                                                    class="form-control" id="harga_buku"
                                                                    value="{{ $d['harga_buku'] }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stok">Stok Buku</label>
                                                                <input type="number" name="stok"
                                                                    value="{{ $d['stok'] }}" class="form-control"
                                                                    id="stok" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Buku</button>
                                                        </div>
                                                    </form>
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
            var r = confirm("Apa anda yakin untuk menghapus buku ini?");
            if (r == true) {
                console.log(id);
                $(document).on('click', '.delete', function() {
                    $.ajax({
                        url: 'buku/' + id,
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
