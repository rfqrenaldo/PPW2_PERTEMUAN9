<?php

namespace App\Http\Controllers;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'index'
        ]);
    }

    public function index(){

        Paginator::useBootstrapFive();
        $jumlah_buku= Buku::count();
        $data_buku= Buku::all();
         // Menghitung jumlah buku
         $jumlah_buku = $data_buku->count();

         // Menghitung total harga semua buku
         $total_harga = $data_buku->sum('harga');

         return view('buku.index', compact('data_buku', 'jumlah_buku','total_harga'));
        }


    public function create (){
        return view('buku.create');
    }
    public function store(Request $request){

        $this->validate($request,[
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'photo'=> "required|string"
        ],[
            'judul.required' =>"MOHON ISI JUDUL BUKU!",
            "penulis.max" => "MOHON ISI NAMA PENULIS BUKU!",
            'harga.numeric'=>"MOHON ISI HARGA BUKU",
            "tgl_terbit.required" => "MOHON ISI TANGGAL TERBIT BUKU!",
        ]);
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->photo= $request->photo;
        $buku->save();
        return redirect('/buku')->with('pesan','Data buku berhasil disimpan');
    }
    public function destroy($id){
        $buku =Buku::find($id);
        $buku ->delete();

        return redirect('/buku')->with('pesan_hapus','Data buku berhasil dihapus');
    }
    public function edit($id)
    {
    $buku = Buku::find($id);
    return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
    $buku = Buku::find($id);
    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->harga = $request->harga;
    $buku->tgl_terbit = $request->tgl_terbit;
    $buku->save();
    return redirect('/buku')->with('pesan_updated', 'Buku berhasil diupdate');
    }



}
