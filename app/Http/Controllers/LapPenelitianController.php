<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;
use App\Author;
use App\Kategori;
use App\Lokasi;
use App\Lembaga;
use App\LaporanAuthor;
use App\LaporanKategori;
use App\Visitor;

class LapPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Visitor::hit();
        //
        //$laporans = LaporanAuthor::with(['laporan', 'author'])->get();
        $laporans = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->paginate(5);
        $laporansSide = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('lapPenelitian.index', compact('laporans', 'laporansSide' , 'kategoris'));
	//return view('lapPenelitian.index', ['laporans' => $laporans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    /*public function edit($id)
    {
        //
    }*/
    
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
        if(!strcasecmp($search, "baru")) $jenisSearch = 0;
        else if(!strcasecmp($search, "lanjutan")) $jenisSearch = 1;
        else $jenisSearch = "none";
        
            $laporans = Laporan::select('laporans.id as id', 'laporans.*')
                    
                    ->orderBy('laporans.tahun_penelitian', 'desc')
                    ->orderBy('laporans.updated_at', 'desc')
                    ->where('laporans.tipe', 0)
                    ->where(function ($query) use ($search, $jenisSearch){
                        $query->where('laporans.judul', 'like', "%".$search."%")
                            ->orWhere('laporans.kategori_penelitian', 'like', "%".$search."%")
                            ->orWhere('laporans.keyword', 'like', "%".$search."%")
                            ->orWhere('laporans.tahun_penelitian', 'like', "%".$search."%")
                            ->orWhere('laporans.lama', 'like', "%".$search."%")
                            ->orWhere('laporans.anggaran', 'like', "%".$search."%")
                            ->orWhere('laporans.sumber_dana', 'like', "%".$search."%")
                            ->orWhere('laporans.halaman', 'like', "%".$search."%")
                            ->orWhere('laporans.jenis_penelitian', 'like', "%".$jenisSearch."%");
                        })
                    ->paginate(5)->appends(request()->query());
        
        $laporansSide = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('lapPenelitian.index', compact('laporans', 'laporansSide', 'kategoris'));
    }
    
    public function filter($tipe, $filterVar)
    {
        //$kategoriId = $this->kategoriId;
          
        Visitor::hit();
        if($tipe == 'kategori')
        {
            $laporans = Laporan::select('laporans.id as id', 'laporans.*')->join('laporan_kategoris', 'laporan_kategoris.laporan_id','laporans.id')->orderBy('laporans.updated_at', 'desc')->where('laporan_kategoris.kategori_id', $filterVar)->where('laporans.tipe', 0)->paginate(5)->appends(request()->query());
        }
        
        else
        {
            $laporans = Laporan::orderBy('laporans.updated_at', 'desc')->where('laporans.'.$tipe, $filterVar)->where('laporans.tipe', 0)->paginate(5)->appends(request()->query());
        }
        //$laporans = Laporan::all();
        
        $laporansSide = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('lapPenelitian.index', compact('laporans', 'laporansSide' , 'kategoris'));
    }
    
    public function filterKategori($id, $tahun)
    {
        Visitor::hit();
        $laporans = Laporan::select('laporans.id as id', 'laporans.*')
                ->join('laporan_kategoris', 'laporan_kategoris.laporan_id','laporans.id')
                ->orderBy('laporans.updated_at', 'desc')
                ->where('laporan_kategoris.kategori_id', $filterVar)
                ->where('laporans.tipe', 0)
                ->where('laporans.tahun_penelitian', $tahun)
                ->paginate(5)->appends(request()->query());
                
        $laporansSide = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('lapPenelitian.index', compact('laporans', 'laporansSide' , 'kategoris'));
    }
    
    public function detail($id)
    {
        // 
        Visitor::hit();
        //$laporans = LaporanAuthor::with(['laporan', 'author'])->get();
        $laporans = Laporan::where('id', $id)->where('tipe', 0)->get();
        $laporansSide = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('lapPenelitian.detail', compact('laporans', 'laporansSide' , 'kategoris'));
    }
    
   //==============================================================================//
    public function advSearch()
    {
        //
        $authors = Author::orderBy('nama', 'asc')->get();
        $kategoris = Kategori::all();
        $lokasis = Lokasi::all();
        $lembagas = Lembaga::orderBy('nama', 'asc')->get();
        return view('lapPenelitian.search', compact('authors', 'kategoris' , 'lembagas', 'lokasis'));
    }
    
    public function ExecAdvSearch(Request $request)
    {
        Visitor::hit();
        $judul=  $request->get('judul');
        $kategori_penelitian=  $request->get('kategori_penelitian');
        $jenis_penelitian=  $request->get('jenis_penelitian');
        $tahun_penelitian=  $request->get('tahun_penelitian');
        $lama=  $request->get('lama');
        $anggaran=  $request->get('anggaran');
        $sumber_dana=  $request->get('sumber_dana');
        $keyword=  $request->get('keyword');
        $halaman=  $request->get('halaman');
        $lembaga_id=  $request->get('lembaga_id');
        $peneliti_id=  $request->get('peneliti_id');
        $kategori_id=  $request->get('kategori_id');
        $lokasi_id=  $request->get('lokasi_id');
        
        $laporans = Laporan::select('laporans.id as id', 'laporans.*')
            ->orderBy('laporans.updated_at', 'desc')
            ->where('laporans.tipe', 0);
        
        if($judul) {
            $laporans = $laporans->where('laporans.judul', 'like', "%".$judul."%");
        }
        if($kategori_penelitian) {
            $laporans = $laporans->where('laporans.kategori_penelitian', 'like', "%".$kategori_penelitian."%");
        }
        if($keyword) {
            $laporans = $laporans->where('laporans.keyword', 'like', "%".$search."%");
        }
        if($tahun_penelitian) {
            $laporans = $laporans->where('laporans.tahun_penelitian', 'like', "%".$tahun_penelitian."%");
        }
        if($lama) {
            $laporans = $laporans->orWhere('laporans.lama', 'like', "%".$lama."%");
        }
        if($anggaran) {
            $laporans = $laporans->where('laporans.anggaran', 'like', "%".$anggaran."%");
        }
        if($sumber_dana) {
            $laporans = $laporans->where('laporans.sumber_dana', 'like', "%".$search."%");
        }
        if($halaman){
            $laporans = $laporans->where('laporans.halaman', 'like', "%".$search."%");
        }
        if($jenis_penelitian){
            $jenisSearch = 'NULL';
            if(!strcasecmp($jenis_penelitian, "baru")) $jenisSearch = 0;
            else if(!strcasecmp($jenis_penelitian, "lanjutan")) $jenisSearch = 1;
            $laporans = $laporans->where('laporans.jenis_penelitian', 'like', "%".$jenisSearch."%");
        }
        
        if($lembaga_id){
            $laporans = $laporans->join('laporan_lembagas', 'laporan_lembagas.laporan_id','laporans.id');
            $laporans = $laporans->whereIn('laporan_lembagas.lembaga_id', $lembaga_id);
        }
        
        if($peneliti_id){
            $laporans = $laporans->join('laporan_authors', 'laporan_authors.laporan_id','laporans.id');
            $laporans = $laporans->whereIn('laporan_authors.author_id', $peneliti_id);
        }
        
        if($kategori_id){
            $laporans = $laporans->join('laporan_kategoris', 'laporan_kategoris.laporan_id','laporans.id');
            $laporans = $laporans->whereIn('laporan_kategoris.kategori_id', $kategori_id);
        }
        
        if($lokasi_id){
            $laporans = $laporans->join('laporan_lokasis', 'laporan_lokasis.laporan_id','laporans.id');
            $laporans = $laporans->whereIn('laporan_lokasis.lokasi_id', $lokasi_id);
        }
        
        $laporans = $laporans->distinct()->paginate(5)->appends(request()->query());
        
        $laporansSide = Laporan::orderBy('updated_at', 'desc')->where('tipe', 0)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        return view('lapPenelitian.index', compact('laporans', 'laporansSide', 'kategoris'));
    }
    //==============================================================================//
    
}
