<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Majalah;
use App\MajalahArtikel;
use App\MajalahAuthor;
use App\MajalahKategori;
use App\Author;
use App\Kategori;
use App\Visitor;
use App\Http\Requests\MajalahArtikelFormRequest;

class MajalahArtikelController extends Controller
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
        $majalahArtikels = MajalahArtikel::orderBy('updated_at', 'desc')->get();
        return view ('majalahArtikel.index', ['majalahArtikels' => $majalahArtikels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $majalahs = Majalah::all();
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        return view('majalahArtikel.create', compact('majalahs', 'authors', 'kategoris'));
    }
    
    public function createArtikel($majalahId)
    {
        //
        $majalahs = Majalah::all();
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        $majalahSelected = Majalah::where('id', $majalahId)->firstOrFail();
        return view('majalahArtikel.create', compact('majalahs', 'authors', 'kategoris', 'majalahSelected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajalahArtikelFormRequest $request)
    {
        //
        $majalahArtikel = new MajalahArtikel();
        $majalahArtikel->judul=  $request->get('judul');
        $majalahArtikel->halaman=  $request->get('halaman');
        $majalahArtikel->majalah_id=  $request->get('majalah_id');
            
        $majalahArtikel->save();

        $id = $majalahArtikel->id;
        if ($request->get('author_id')) $this->insertConnectorTableData($id, 'authors', 'author_id', $request->get('author_id'), 'edit');
        
        return redirect(action('MajalahArtikelController@createArtikel', $majalahArtikel->majalah_id))->with('status', 'Artikel dengan Judul "'.$majalahArtikel->judul.'" Berhasil Ditambahkan');
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
        $majalahArtikels = MajalahArtikel::whereId($id)->firstOrFail();
        $majalahs = Majalah::all();
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        
        $authorSelected = MajalahAuthor::where('artikel_id', $id)->get();
        return view('majalahArtikel.edit', compact('majalahArtikels','majalahs', 'authors', 'kategoris', 'authorSelected', 'kategoriSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajalahArtikelFormRequest $request, $id)
    {
        //
        $majalahArtikel = MajalahArtikel::whereId($id)->firstOrFail();
        $majalahArtikel->judul=  $request->get('judul');
        $majalahArtikel->halaman=  $request->get('halaman');
        $majalahArtikel->majalah_id=  $request->get('majalah_id');
        
        $majalahArtikel->save();

	if ($request->get('author_id')) $this->insertConnectorTableData($id, 'authors', 'author_id', $request->get('author_id'), 'edit');
        
	return redirect(action('MajalahArtikelController@edit', $majalahArtikel->id))->with('status', 'Artikel dengan id '.$majalahArtikel->id.' telah berhasil diubah');
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
        $majalahArtikel = MajalahArtikel::whereId($id)->firstOrFail();
        $majalahArtikel ->delete();
        return redirect('majalahArtikel')->with('Penghapusan data berhasil dilakukan');
    }
    
    public function insertConnectorTableData($artikelId, $table, $attribute, $dataId, $tipeInput)
    {
        if($tipeInput == 'edit')
        {
            if($table == 'authors') 
            {
                MajalahAuthor::where('artikel_id', $artikelId)->delete();
                MajalahAuthor::onlyTrashed()->forceDelete();
            }
        }
        foreach ((array)$dataId as $data)
        {
            if($table == 'authors') $tableInsert = new MajalahAuthor();
            
            $tableInsert->artikel_id=  $artikelId;
            $tableInsert->$attribute=  $data;

            $tableInsert->save();
        }
    }
}
