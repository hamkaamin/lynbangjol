<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurnal;
use App\JurnalArtikel;
use App\Author;
use App\JurnalAuthor;
use App\Kategori;
use App\JurnalKategori;
use App\Visitor;

class JurnalViewController extends Controller
{
    //
    public function index()
    {
        //
        Visitor::hit();
        $jurnals = Jurnal::orderBy('created_at', 'desc')->paginate(5);
        $jurnalsSide = Jurnal::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('jurnalView.index', compact('jurnals', 'jurnalsSide', 'kategoris'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $searchVar = $request->searchVar;

        if($searchVar == 'penulis')
        {
            $jurnals = Jurnal::select('jurnals.id as id', 'jurnals.*')
                ->join('jurnal_artikels','jurnal_artikels.jurnal_id', 'jurnals.id')
                ->join('jurnal_authors', 'jurnal_authors.artikel_id','jurnal_artikels.id')
                ->join('authors', 'jurnal_authors.author_id','authors.id')
                ->orderBy('jurnals.created_at', 'desc')
                ->where('authors.nama', 'like', "%".$search."%")
                ->where('jurnal_artikels.deleted_at', null)
                ->where('jurnal_authors.deleted_at', null)
                ->where('authors.deleted_at', null)
                ->distinct()
                ->paginate(5);
        }
        else if($searchVar == 'keyword')
        {
            $jurnals = Jurnal::select('jurnals.id as id', 'jurnals.*')
                ->join('jurnal_artikels','jurnal_artikels.jurnal_id', 'jurnals.id')
                ->orderBy('jurnals.created_at', 'desc')
                ->where('jurnal_artikels.keyword', 'like', "%".$search."%")
                ->where('jurnal_artikels.deleted_at', null)
                ->distinct()
                ->paginate(5);
        }
        else
        {
            $jurnals = Jurnal::orderBy('created_at', 'desc')->where($searchVar, 'like', "%".$search."%")->paginate(5);    
        }
        
        $jurnalsSide = Jurnal::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('jurnalView.index', compact('jurnals', 'jurnalsSide' , 'kategoris'));
    }
    
    public function filter($tipe, $filterVar)
    {
        if($tipe == 'kategori')
        {
            $jurnals = Jurnal::select('jurnals.id as id', 'jurnals.*')->join('jurnal_kategoris', 'jurnal_kategoris.jurnal_id','jurnals.id')->orderBy('jurnals.created_at', 'desc')->where('jurnal_kategoris.kategori_id', $filterVar)->paginate(5);
        }
        
        else
        {
            $jurnals = Jurnal::orderBy('jurnals.created_at', 'desc')->where('jurnals.'.$tipe, $filterVar)->paginate(5);
        }
        
        $jurnalsSide = Jurnal::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('jurnalView.index', compact('jurnals', 'jurnalsSide', 'kategoris'));
    }
}
