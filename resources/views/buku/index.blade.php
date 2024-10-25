@extends('auth.layouts')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Buku</h1>

        @if(Session::has('pesan'))
            <div class = "alert alert-success">{{ Session::get('pesan')}}</div>
        @endif

        @if(Session::has('pesan_hapus'))
            <div class = "alert alert-success">{{ Session::get('pesan_hapus')}}</div>
        @endif

        @if(Session::has('pesan_updated'))
            <div class = "alert alert-success">{{ Session::get('pesan_updated')}}</div>
        @endif

        @auth
        <div class="container d-flex flex-row justify-content-between align-items-end mb-3">

            <a href="{{ route('buku.create') }}" class="btn btn-primary" >Tambah Buku</a>
        </div>
        @endauth

        <table class="datatable table table-bordered table-hover" >
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    @auth
                    <th>Hapus</th>
                    <th>Update</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $index => $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp.".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                    @auth
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-info mt-4">
            <p><strong>JUMLAH BUKU:</strong> {{ $jumlah_buku }}</p>
            <p><strong>Total Harga Semua Buku:</strong> {{ "Rp.".number_format($total_harga, 2, ',', '.') }}</p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        new DataTable('.datatable');
    </script>

@endsection
