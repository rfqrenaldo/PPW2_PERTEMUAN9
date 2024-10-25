<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Buku</h1>
    <form method="POST" action="{{ route('buku.update', $buku->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" value="{{ $buku->judul }}" class="form-control" id="judul">
        </div>
        <div class="form-group">
            <label for="penulis">Penulis:</label>
            <input type="text" name="penulis" value="{{ $buku->penulis }}" class="form-control" id="penulis">
        </div>
        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" name="harga" value="{{ $buku->harga }}" class="form-control" id="harga">
        </div>
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit:</label>
            <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}" class="form-control" id="tgl_terbit">
        </div>
        <button type="submit" class="btn btn-success btn-block mt-3">Update</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
