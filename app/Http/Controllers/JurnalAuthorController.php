<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JurnalAuthor;
use App\JurnalArtikel;
use App\Author;
use App\Http\Requests\JurnalAuthorFormRequest; 

class JurnalAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jurnalAuthors = JurnalAuthor::orderBy('updated_at', 'desc')->get();
        return view ('jurnalAuthor.index', ['jurnalAuthors' => $jurnalAuthors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $authors = Author::all();
        $jurnalArtikels = JurnalArtikel::all();
        return view ('jurnalAuthor.create', ['authors' => $authors],['jurnalArtikels' => $jurnalArtikels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurnalAuthorFormRequest $request)
    {
        //
        $jurnalAuthor = new JurnalAuthor();
        $jurnalAuthor->artikel_id=  $request->get('artikel_id');
        $jurnalAuthor->author_id=  $request->get('author_id');
            
        $jurnalAuthor->save();

        return redirect('jurnalAuthor');
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
        $jurnalAuthors = JurnalAuthor::whereId($id)->firstOrFail();
        $jurnalArtikels = JurnalArtikel::All();
        $authors = Author::All();
        return view('jurnalAuthor.edit', compact('jurnalAuthors','jurnalArtikels', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurnalAuthorFormRequest $request, $id)
    {
        //
        $jurnalAuthor = JurnalAuthor::whereId($id)->firstOrFail();
        $jurnalAuthor->artikel_id=  $request->get('artikel_id');
        $jurnalAuthor->author_id=  $request->get('author_id');
        
        $jurnalAuthor->save();

	return redirect(action('JurnalAuthorController@edit', $jurnalAuthor->id))->with('status', 'Penulis - Jurnal dengan id '.$jurnalAuthor->id.' telah berhasil diubah');
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
        $jurnalAuthor = JurnalAuthor::whereId($id)->firstOrFail();
        $jurnalAuthor ->delete();
        return redirect('jurnalAuthor')->with('Penghapusan data berhasil dilakukan');
    }
}
