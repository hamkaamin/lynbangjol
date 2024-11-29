<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanAuthor;
use App\Author;
use App\Laporan;
use App\Http\Requests\LaporanAuthorFormRequest; 
use App\Visitor;

class LaporanAuthorController extends Controller
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
        $laporanAuthors = LaporanAuthor::orderBy('updated_at', 'desc')->get();
        return view ('laporanAuthor.index', ['laporanAuthors' => $laporanAuthors]);
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
        $laporans = Laporan::all();
        return view ('laporanAuthor.create', ['authors' => $authors],['laporans' => $laporans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanAuthorFormRequest $request)
    {
        //
        $laporanAuthor = new LaporanAuthor();
        $laporanAuthor->laporan_id=  $request->get('laporan_id');
        $laporanAuthor->author_id=  $request->get('author_id');
        $laporanAuthor->jabatan=  $request->get('jabatan');
            
        $laporanAuthor->save();

        return redirect('laporanAuthor');
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
        $laporanAuthors = LaporanAuthor::whereId($id)->firstOrFail();
        $laporans = Laporan::All();
        $authors = Author::All();
        return view('laporanAuthor.edit', compact('laporanAuthors','laporans', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanAuthorFormRequest $request, $id)
    {
        //
        $laporanAuthor = LaporanAuthor::whereId($id)->firstOrFail();
        $laporanAuthor->laporan_id=  $request->get('laporan_id');
        $laporanAuthor->author_id=  $request->get('author_id');
        $laporanAuthor->jabatan=  $request->get('jabatan');
        
        $laporanAuthor->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LaporanAuthorController@edit', $laporanAuthor->id))->with('status', 'Penulis - Laporan dengan id '.$laporanAuthor->id.' telah berhasil diubah');
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
        $laporanAuthor = LaporanAuthor::whereId($id)->firstOrFail();
        $laporanAuthor ->delete();
        return redirect('laporanAuthor')->with('Penghapusan data berhasil dilakukan');
    }
    
    public function getAuthorByLaporanId($id)
    {
        //
        $authors = Author::join('laporanAuthors', 'laporanAuthors.author_id', 'id')->select('authors.nama')->where('laporanAuthors.laporan_id', $id)->get();
    }
}
