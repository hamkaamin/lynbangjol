<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MajalahAuthor;
use App\MajalahArtikel;
use App\Author;
use App\Http\Requests\MajalahAuthorFormRequest; 
use App\Visitor;

class MajalahAuthorController extends Controller
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
        $majalahAuthors = MajalahAuthor::orderBy('updated_at', 'desc')->get();
        return view ('majalahAuthor.index', ['majalahAuthors' => $majalahAuthors]);
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
        $majalahArtikels = MajalahArtikel::all();
        return view ('majalahAuthor.create', ['authors' => $authors],['majalahArtikels' => $majalahArtikels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajalahAuthorFormRequest $request)
    {
        //
        $majalahAuthor = new MajalahAuthor();
        $majalahAuthor->artikel_id=  $request->get('artikel_id');
        $majalahAuthor->author_id=  $request->get('author_id');
            
        $majalahAuthor->save();

        return redirect('majalahAuthor');
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
        $majalahAuthors = MajalahAuthor::whereId($id)->firstOrFail();
        $majalahArtikels = MajalahArtikel::All();
        $authors = Author::All();
        return view('majalahAuthor.edit', compact('majalahAuthors','majalahArtikels', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajalahAuthorFormRequest $request, $id)
    {
        //
        $majalahAuthor = MajalahAuthor::whereId($id)->firstOrFail();
        $majalahAuthor->artikel_id=  $request->get('artikel_id');
        $majalahAuthor->author_id=  $request->get('author_id');
        
        $majalahAuthor->save();

	return redirect(action('MajalahAuthorController@edit', $majalahAuthor->id))->with('status', 'Penulis - Majalah dengan id '.$majalahAuthor->id.' telah berhasil diubah');
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
        $majalahAuthor = MajalahAuthor::whereId($id)->firstOrFail();
        $majalahAuthor ->delete();
        return redirect('majalahAuthor')->with('Penghapusan data berhasil dilakukan');
    }
}
