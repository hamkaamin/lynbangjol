<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurnal;
use App\Http\Requests\JurnalFormRequest; 
use App\Visitor;

class JurnalController extends Controller
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
        $jurnals = Jurnal::orderBy('updated_at', 'desc')->get();
        return view ('jurnal.index', ['jurnals' => $jurnals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('jurnal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JurnalFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurnalFormRequest $request)
    {
        //
	$jurnal = new Jurnal();
        $jurnal->nama=  $request->get('nama');
        $jurnal->penerbit=  $request->get('penerbit');
        $jurnal->volume=  $request->get('volume');
        $jurnal->tgl_publikasi=  $request->get('tgl_publikasi');
        $jurnal->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/jurnal/dokumen",$fileName);
                $jurnal->doc_filename = 'uploads/jurnal/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/jurnal/cover",$fileName);
                $jurnal->cover_filename = 'uploads/jurnal/cover/'.$fileName;
            }
            
        $jurnal->save();

        return redirect('jurnal');
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
	$jurnal = Jurnal::whereId($id)->firstOrFail();
        return view('jurnal.edit', ['jurnal' => $jurnal]);
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
	$jurnal = Jurnal::whereId($id)->firstOrFail();
        $jurnal->nama=  $request->get('nama');
        $jurnal->penerbit=  $request->get('penerbit');
        $jurnal->volume=  $request->get('volume');
        $jurnal->tgl_publikasi=  $request->get('tgl_publikasi');
        $jurnal->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/jurnal/dokumen",$fileName);
                $jurnal->doc_filename = 'uploads/jurnal/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/jurnal/cover",$fileName);
                $jurnal->cover_filename = 'uploads/jurnal/cover/'.$fileName;
            }
        
        $jurnal->save();

	return redirect(action('JurnalController@edit', $jurnal->id))->with('status', 'Jurnal dengan id '.$jurnal->id.' telah berhasil diubah');
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
	$jurnal = Jurnal::whereId($id)->firstOrFail();
        $jurnal ->delete();
        return redirect('jurnal')->with('Penghapusan data berhasil dilakukan');
    }
}
