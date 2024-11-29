<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Author;
use App\BukuAuthor;
use App\Kategori;
use App\BukuKategori;
use App\Visitor;


class BukuViewController extends Controller
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
        $bukus = Buku::orderBy('created_at', 'desc')->paginate(5);
        $bukusSide = Buku::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        $bukuAuthors = BukuAuthor::join('authors', 'authors.id', 'author_id')->get();
        $bukuKategoris = BukuKategori::join('kategoris', 'kategoris.id', 'kategori_id')->get();
        
        return view('bukuView.index', compact('bukus', 'bukusSide' ,'bukuAuthors', 'kategoris', 'bukuKategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $searchVar = $request->searchVar;
        
        if($searchVar != 'penulis')
        {
            $bukus = Buku::orderBy('created_at', 'desc')->where($searchVar, 'like', "%".$search."%")->paginate(5);    
        }
        else 
        {
            $bukus = Buku::select('bukus.id as id', 'bukus.*')
                ->join('buku_authors', 'buku_authors.buku_id','bukus.id')
                ->join('authors', 'buku_authors.author_id','authors.id')
                ->orderBy('bukus.created_at', 'desc')
                ->where('authors.nama', 'like', "%".$search."%")
                ->where('buku_authors.deleted_at', null)
                ->where('authors.deleted_at', null)
                ->distinct()
                ->paginate(5);
        }
        
        $bukusSide = Buku::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('bukuView.index', compact('bukus', 'bukusSide', 'kategoris'));
    }
    
    public function filter($tipe, $id)
    {
        //$kategoriId = $this->kategoriId;
        
        if($tipe == 'kategori')
        {
            $bukus = Buku::select('bukus.id as id', 'bukus.*')->join('buku_kategoris', 'buku_kategoris.buku_id','bukus.id')->orderBy('bukus.created_at', 'desc')->where('buku_kategoris.kategori_id', $id)->paginate(5);
        }
        
        else if ($tipe == 'id')
        {
            $bukus = Buku::orderBy('bukus.created_at', 'desc')->where('bukus.id', $id)->paginate(5);
        }
        //$bukus = Buku::all();
        
        $bukusSide = Buku::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('bukuView.index', compact('bukus', 'bukusSide', 'kategoris'));
    }
}
