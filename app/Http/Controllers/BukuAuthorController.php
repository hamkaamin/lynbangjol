<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BukuAuthor;
use App\Author;
use App\Buku;
use App\Http\Requests\BukuAuthorFormRequest; 

class BukuAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bukuAuthors = BukuAuthor::all();
        return view ('bukuAuthor.index', ['bukuAuthors' => $bukuAuthors]);
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
        $bukus = Buku::all();
        return view ('bukuAuthor.create', ['authors' => $authors],['bukus' => $bukus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuAuthorFormRequest $request)
    {
        //
        $bukuAuthor = new BukuAuthor();
        $bukuAuthor->buku_id=  $request->get('buku_id');
        $bukuAuthor->author_id=  $request->get('author_id');
            
        $bukuAuthor->save();

        return redirect('bukuAuthor');
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
        $bukuAuthors = BukuAuthor::whereId($id)->firstOrFail();
        $bukus = Buku::All();
        $authors = Author::All();
        return view('bukuAuthor.edit', compact('bukuAuthors','bukus', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BukuAuthorFormRequest $request, $id)
    {
        //
        $bukuAuthor = BukuAuthor::whereId($id)->firstOrFail();
        $bukuAuthor->buku_id=  $request->get('buku_id');
        $bukuAuthor->author_id=  $request->get('author_id');
        
        $bukuAuthor->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('BukuAuthorController@edit', $bukuAuthor->id))->with('status', 'Penulis - Buku dengan id '.$bukuAuthor->id.' telah berhasil diubah');
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
        $bukuAuthor = BukuAuthor::whereId($id)->firstOrFail();
        $bukuAuthor ->delete();
        return redirect('bukuAuthor')->with('Penghapusan data berhasil dilakukan');
    }
}
