<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PolicyBrief;
use App\Visitor;

class PolicyBriefViewController extends Controller
{
    //
    public function index()
    {
        //
        Visitor::hit();
        $policys = PolicyBrief::orderBy('created_at', 'desc')->paginate(5);
        //$majalahsSide = PolicyBrief::orderBy('created_at', 'desc')->get();
        //$kategoris = Kategori::orderBy('nama', 'asc')->get();
        //dd($kategoris);
        
        return view('policyBriefView.index', compact('policys'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $searchVar = $request->searchVar;
        
        if($searchVar != 'penulis')
        {
            $policys = PolicyBrief::orderBy('created_at', 'desc')->where($searchVar, 'like', "%".$search."%")->paginate(5);    
        }
        else 
        {
            $policys = PolicyBrief::select('policys.id as id', 'policys.*')
                //->join('majalah_artikels','majalah_artikels.majalah_id', 'policys.id')
                //->join('majalah_authors', 'majalah_authors.artikel_id','majalah_artikels.id')
                //->join('authors', 'majalah_authors.author_id','authors.id')
                ->orderBy('policys.created_at', 'desc')
                ->where('policys.nama', 'like', "%".$search."%")
                ->where('policys.deleted_at', null)
                ->distinct()
                ->paginate(5);
        }
        
        //$majalahsSide = PolicyBrief::orderBy('created_at', 'desc')->get();
        //$kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('policyBriefView.index', compact('policys'));
    }
    
    public function filter($tipe, $filterVar)
    {
        Visitor::hit();
        if($tipe == 'kategori')
        {
            $policys = PolicyBrief::select('policys.id as id', 'policys.*')
                    ->join('majalah_kategoris', 'majalah_kategoris.majalah_id','majalahs.id')
                    ->orderBy('policys.created_at', 'desc')
                    ->where('majalah_kategoris.kategori_id', $filterVar)
                    ->paginate(5);
        }
        
        else
        {
            $policys = PolicyBrief::orderBy('policys.created_at', 'desc')->where('policys.'.$tipe, $filterVar)->paginate(5);
        }
        
        $policysSide = PolicyBrief::orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('policyBriefView.index', compact('policys', 'policysSide', 'kategoris'));
    }
}
