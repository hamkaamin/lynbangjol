<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Majalah;
use App\Visitor;
use App\Http\Requests\MajalahFormRequest; 

class MajalahController extends Controller
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
        $majalahs = Majalah::orderBy('updated_at', 'desc')->get();
        return view ('majalah.index', ['majalahs' => $majalahs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('majalah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajalahFormRequest $request)
    {
        //
	$majalah = new Majalah();
        $majalah->nama=  $request->get('nama');
        $majalah->penerbit=  $request->get('penerbit');
        $majalah->edisi=  $request->get('edisi');
        $majalah->tgl_publikasi=  $request->get('tgl_publikasi');
        $majalah->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/majalah/dokumen",$fileName);
                $majalah->doc_filename = 'uploads/majalah/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/majalah/cover",$fileName);
                $majalah->cover_filename = 'uploads/majalah/cover/'.$fileName;
            }
            
        $majalah->save();

        return redirect('majalah');
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
	$majalah = Majalah::whereId($id)->firstOrFail();
        return view('majalah.edit', ['majalah' => $majalah]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajalahFormRequest $request, $id)
    {
        //
	$majalah = Majalah::whereId($id)->firstOrFail();
        $majalah->nama=  $request->get('nama');
        $majalah->penerbit=  $request->get('penerbit');
        $majalah->edisi=  $request->get('edisi');
        $majalah->tgl_publikasi=  $request->get('tgl_publikasi');
        $majalah->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/majalah/dokumen",$fileName);
                $majalah->doc_filename = 'uploads/majalah/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/majalah/cover",$fileName);
                $majalah->cover_filename = 'uploads/majalah/cover/'.$fileName;
            }
        
        $majalah->save();

	return redirect(action('MajalahController@edit', $majalah->id))->with('status', 'Majalah dengan id '.$majalah->id.' telah berhasil diubah');
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
	$majalah = Majalah::whereId($id)->firstOrFail();
        $majalah ->delete();
        return redirect('majalah')->with('Penghapusan data berhasil dilakukan');
    }
}
