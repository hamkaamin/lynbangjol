<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Majalah;
use App\MajalahArtikel;
use App\Author;
use App\MajalahAuthor;
use App\Kategori;
use App\MajalahKategori;
use App\Visitor;

class MajalahViewController extends Controller
{
    //
    public function index()
    {
        //
        Visitor::hit();
        $majalahs = Majalah::orderBy('created_at', 'desc')->paginate(5);
        $majalahsSide = Majalah::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('majalahView.index', compact('majalahs', 'majalahsSide', 'kategoris'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $searchVar = $request->searchVar;
        
        if($searchVar != 'penulis')
        {
            $majalahs = Majalah::orderBy('created_at', 'desc')->where($searchVar, 'like', "%".$search."%")->paginate(5);    
        }
        else 
        {
            $majalahs = Majalah::select('majalahs.id as id', 'majalahs.*')
                ->join('majalah_artikels','majalah_artikels.majalah_id', 'majalahs.id')
                ->join('majalah_authors', 'majalah_authors.artikel_id','majalah_artikels.id')
                ->join('authors', 'majalah_authors.author_id','authors.id')
                ->orderBy('majalahs.created_at', 'desc')
                ->where('authors.nama', 'like', "%".$search."%")
                ->where('majalah_artikels.deleted_at', null)
                ->where('majalah_authors.deleted_at', null)
                ->distinct()
                ->paginate(5);
        }
        
        $majalahsSide = Majalah::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('majalahView.index', compact('majalahs', 'majalahsSide' , 'kategoris'));
    }
    
    public function filter($tipe, $filterVar)
    {
        Visitor::hit();
        if($tipe == 'kategori')
        {
            $majalahs = Majalah::select('majalahs.id as id', 'majalahs.*')
                    ->join('majalah_kategoris', 'majalah_kategoris.majalah_id','majalahs.id')
                    ->orderBy('majalahs.created_at', 'desc')
                    ->where('majalah_kategoris.kategori_id', $filterVar)
                    ->paginate(5);
        }
        
        else
        {
            $majalahs = Majalah::orderBy('majalahs.created_at', 'desc')->where('majalahs.'.$tipe, $filterVar)->paginate(5);
        }
        
        $majalahsSide = Majalah::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('majalahView.index', compact('majalahs', 'majalahsSide', 'kategoris'));
    }
}
