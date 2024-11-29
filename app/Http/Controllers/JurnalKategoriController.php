<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JurnalKategori;
use App\Kategori;
use App\Jurnal;
use App\Http\Requests\JurnalKategoriFormRequest; 

class JurnalKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jurnalKategoris = JurnalKategori::orderBy('updated_at', 'desc')->get();
        return view ('jurnalKategori.index', ['jurnalKategoris' => $jurnalKategoris]);
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
        $jurnals = Jurnal::all();
        return view ('jurnalKategori.create', ['kategoris' => $kategoris],['jurnals' => $jurnals]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurnalKategoriFormRequest $request)
    {
        //
        $jurnalKategori = new JurnalKategori();
        $jurnalKategori->jurnal_id=  $request->get('jurnal_id');
        $jurnalKategori->kategori_id=  $request->get('kategori_id');
            
        $jurnalKategori->save();

        return redirect('jurnalKategori');
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
        $jurnalKategoris = JurnalKategori::whereId($id)->firstOrFail();
        $jurnals = Jurnal::All();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('jurnalKategori.edit', compact('jurnalKategoris','jurnals', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurnalKategoriFormRequest $request, $id)
    {
        //
        $jurnalKategori = JurnalKategori::whereId($id)->firstOrFail();
        $jurnalKategori->jurnal_id=  $request->get('jurnal_id');
        $jurnalKategori->kategori_id=  $request->get('kategori_id');
        
        $jurnalKategori->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('JurnalKategoriController@edit', $jurnalKategori->id))->with('status', 'Kategori - Jurnal dengan id '.$jurnalKategori->id.' telah berhasil diubah');
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
        $jurnalKategori = JurnalKategori::whereId($id)->firstOrFail();
        $jurnalKategori ->delete();
        return redirect('jurnalKategori')->with('Penghapusan data berhasil dilakukan');
    }
}
