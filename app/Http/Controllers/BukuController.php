<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Http\Requests\BukuFormRequest;
use App\Visitor;


class BukuController extends Controller
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
        $bukus = Buku::all();
        return view ('buku.index', ['bukus' => $bukus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuFormRequest $request)
    {
        //
        $buku = new Buku();
        $buku->judul=  $request->get('judul');
        $buku->penerbit=  $request->get('penerbit');
        $buku->tgl_publikasi=  $request->get('tgl_publikasi');
        $buku->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/buku/dokumen",$fileName);
                $buku->doc_filename = 'uploads/buku/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/buku/cover",$fileName);
                $buku->cover_filename = 'uploads/buku/cover/'.$fileName;
            }
            
        $buku->save();

        return redirect('buku');
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
        $buku = Buku::whereId($id)->firstOrFail();
        return view('buku.edit', ['buku' => $buku]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BukuFormRequest $request, $id)
    {
        //
        $buku = Buku::whereId($id)->firstOrFail();
        $buku->judul=  $request->get('judul');
        $buku->penerbit=  $request->get('penerbit');
        $buku->tgl_publikasi=  $request->get('tgl_publikasi');
        $buku->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/buku/dokumen",$fileName);
                $buku->doc_filename = 'uploads/buku/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/buku/cover",$fileName);
                $buku->cover_filename = 'uploads/buku/cover/'.$fileName;
            }
        
        $buku->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('BukuController@edit', $buku->id))->with('status', 'Buku dengan id '.$buku->id.' telah berhasil diubah');
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
        $buku = Buku::whereId($id)->firstOrFail();
        $buku ->delete();
        return redirect('buku')->with('Penghapusan data berhasil dilakukan');
    }
}
