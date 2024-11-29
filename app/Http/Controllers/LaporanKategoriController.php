<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanKategori;
use App\Kategori;
use App\Laporan;
use App\Http\Requests\LaporanKategoriFormRequest; 
use App\Visitor;

class LaporanKategoriController extends Controller
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
        $laporanKategoris = LaporanKategori::orderBy('updated_at', 'desc')->get();
        return view ('laporanKategori.index', ['laporanKategoris' => $laporanKategoris]);
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
        $laporans = Laporan::all();
        return view ('laporanKategori.create', ['kategoris' => $kategoris],['laporans' => $laporans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanKategoriFormRequest $request)
    {
        //
        $laporanKategori = new LaporanKategori();
        $laporanKategori->laporan_id=  $request->get('laporan_id');
        $laporanKategori->kategori_id=  $request->get('kategori_id');
            
        $laporanKategori->save();

        return redirect('laporanKategori');
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
        $laporanKategoris = LaporanKategori::whereId($id)->firstOrFail();
        $laporans = Laporan::All();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('laporanKategori.edit', compact('laporanKategoris','laporans', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanKategoriFormRequest $request, $id)
    {
        //
        $laporanKategori = LaporanKategori::whereId($id)->firstOrFail();
        $laporanKategori->laporan_id=  $request->get('laporan_id');
        $laporanKategori->kategori_id=  $request->get('kategori_id');
        
        $laporanKategori->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LaporanKategoriController@edit', $laporanKategori->id))->with('status', 'Kategori - Laporan dengan id '.$laporanKategori->id.' telah berhasil diubah');
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
        $laporanKategori = LaporanKategori::whereId($id)->firstOrFail();
        $laporanKategori ->delete();
        return redirect('laporanKategori')->with('Penghapusan data berhasil dilakukan');
    }
}
