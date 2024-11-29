<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MajalahKategori;
use App\Kategori;
use App\Majalah;
use App\Http\Requests\MajalahKategoriFormRequest; 
use App\Visitor;

class MajalahKategoriController extends Controller
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
        $majalahKategoris = MajalahKategori::orderBy('updated_at', 'desc')->get();
        return view ('majalahKategori.index', ['majalahKategoris' => $majalahKategoris]);
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
        $majalahs = Majalah::all();
        return view ('majalahKategori.create', ['kategoris' => $kategoris],['majalahs' => $majalahs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajalahKategoriFormRequest $request)
    {
        //
        $majalahKategori = new MajalahKategori();
        $majalahKategori->majalah_id=  $request->get('majalah_id');
        $majalahKategori->kategori_id=  $request->get('kategori_id');
            
        $majalahKategori->save();

        return redirect('majalahKategori');
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
        $majalahKategoris = MajalahKategori::whereId($id)->firstOrFail();
        $majalahs = Majalah::All();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('majalahKategori.edit', compact('majalahKategoris','majalahs', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajalahKategoriFormRequest $request, $id)
    {
        //
        $majalahKategori = MajalahKategori::whereId($id)->firstOrFail();
        $majalahKategori->majalah_id=  $request->get('majalah_id');
        $majalahKategori->kategori_id=  $request->get('kategori_id');
        
        $majalahKategori->save();

        //return redirect('majalah')->with('data majalah berhasil di update!'); 
	return redirect(action('MajalahKategoriController@edit', $majalahKategori->id))->with('status', 'Kategori - Majalah dengan id '.$majalahKategori->id.' telah berhasil diubah');
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
        $majalahKategori = MajalahKategori::whereId($id)->firstOrFail();
        $majalahKategori ->delete();
        return redirect('majalahKategori')->with('Penghapusan data berhasil dilakukan');
    }
}
