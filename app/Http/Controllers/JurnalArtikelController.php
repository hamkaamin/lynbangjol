<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurnal;
use App\JurnalArtikel;
use App\JurnalAuthor;
use App\JurnalKategori;
use App\Author;
use App\Kategori;
use App\Http\Requests\JurnalArtikelFormRequest;
use App\Visitor;

class JurnalArtikelController extends Controller
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
        $jurnalArtikels = JurnalArtikel::orderBy('updated_at', 'desc')->get();
        return view ('jurnalArtikel.index', ['jurnalArtikels' => $jurnalArtikels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $jurnals = Jurnal::all();
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        return view('jurnalArtikel.create', compact('jurnals', 'authors', 'kategoris'));
    }
    
    public function createArtikel($jurnalId)
    {
        //
        $jurnals = Jurnal::all();
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        $jurnalSelected = Jurnal::where('id', $jurnalId)->firstOrFail();
        return view('jurnalArtikel.create', compact('jurnals', 'authors', 'kategoris', 'jurnalSelected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurnalArtikelFormRequest $request)
    {
        //
        $jurnalArtikel = new JurnalArtikel();
        $jurnalArtikel->judul=  $request->get('judul');
        $jurnalArtikel->abstrak=  $request->get('abstrak');
        $jurnalArtikel->keyword=  $request->get('keyword');
        $jurnalArtikel->halaman=  $request->get('halaman');
        $jurnalArtikel->jurnal_id=  $request->get('jurnal_id');
            
        $jurnalArtikel->save();
        
        $id = $jurnalArtikel->id;
        if ($request->get('author_id')) $this->insertConnectorTableData($id, 'authors', 'author_id', $request->get('author_id'), 'edit');
        
        return redirect(action('JurnalArtikelController@createArtikel', $jurnalArtikel->jurnal_id))->with('status', 'Artikel dengan Judul "'.$majalahArtikel->judul.'" Berhasil Ditambahkan');
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
        $jurnalArtikels = JurnalArtikel::whereId($id)->firstOrFail();
        $jurnals = Jurnal::all();
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        
        $authorSelected = JurnalAuthor::where('artikel_id', $id)->get();
        return view('jurnalArtikel.edit', compact('jurnalArtikels','jurnals', 'authors', 'kategoris', 'authorSelected', 'kategoriSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurnalArtikelFormRequest $request, $id)
    {
        //
        $jurnalArtikel = JurnalArtikel::whereId($id)->firstOrFail();
        $jurnalArtikel->judul=  $request->get('judul');
        $jurnalArtikel->abstrak=  $request->get('abstrak');
        $jurnalArtikel->keyword=  $request->get('keyword');
        $jurnalArtikel->halaman=  $request->get('halaman');
        $jurnalArtikel->jurnal_id=  $request->get('jurnal_id');
        
        $jurnalArtikel->save();
        
        if ($request->get('author_id')) $this->insertConnectorTableData($id, 'authors', 'author_id', $request->get('author_id'), 'edit');
        
	return redirect(action('JurnalArtikelController@edit', $jurnalArtikel->id))->with('status', 'Artikel dengan id '.$jurnalArtikel->id.' telah berhasil diubah');
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
        $jurnalArtikel = JurnalArtikel::whereId($id)->firstOrFail();
        $jurnalArtikel ->delete();
        return redirect('jurnalArtikel')->with('Penghapusan data berhasil dilakukan');
    }
    
    public function insertConnectorTableData($artikelId, $table, $attribute, $dataId, $tipeInput)
    {
        if($tipeInput == 'edit')
        {
            if($table == 'authors') 
            {
                JurnalAuthor::where('artikel_id', $artikelId)->delete();
                JurnalAuthor::onlyTrashed()->forceDelete();
            }
        }
        foreach ((array)$dataId as $data)
        {
            if($table == 'authors') $tableInsert = new JurnalAuthor();
            
            $tableInsert->artikel_id=  $artikelId;
            $tableInsert->$attribute=  $data;

            $tableInsert->save();
        }
    }
}
