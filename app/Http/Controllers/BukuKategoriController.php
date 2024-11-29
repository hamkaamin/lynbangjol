<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BukuKategori;
use App\Kategori;
use App\Buku;
use App\Http\Requests\BukuKategoriFormRequest; 
use App\Visitor;

class BukuKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Visitor::hit();
        $bukuKategoris = BukuKategori::all();
        return view ('bukuKategori.index', ['bukuKategoris' => $bukuKategoris]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        $bukus = Buku::all();
        return view ('bukuKategori.create', ['kategoris' => $kategoris],['bukus' => $bukus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuKategoriFormRequest $request)
    {
        //
        $bukuKategori = new BukuKategori();
        $bukuKategori->buku_id=  $request->get('buku_id');
        $bukuKategori->kategori_id=  $request->get('kategori_id');
            
        $bukuKategori->save();

        return redirect('bukuKategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $bukuKategoris = BukuKategori::whereId($id)->firstOrFail();
        $bukus = Buku::All();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('bukuKategori.edit', compact('bukuKategoris','bukus', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BukuKategoriFormRequest $request, $id)
    {
        //
        $bukuKategori = BukuKategori::whereId($id)->firstOrFail();
        $bukuKategori->buku_id=  $request->get('buku_id');
        $bukuKategori->kategori_id=  $request->get('kategori_id');
        
        $bukuKategori->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('BukuKategoriController@edit', $bukuKategori->id))->with('status', 'Kategori - Buku dengan id '.$bukuKategori->id.' telah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bukuKategori = BukuKategori::whereId($id)->firstOrFail();
        $bukuKategori ->delete();
        return redirect('bukuKategori')->with('Penghapusan data berhasil dilakukan');
    }
}
