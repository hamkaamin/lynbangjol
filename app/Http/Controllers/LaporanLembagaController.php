<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanLembaga;
use App\Lembaga;
use App\Laporan;
use App\Http\Requests\LaporanLembagaFormRequest; 
use App\Visitor;
class LaporanLembagaController extends Controller
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
        $laporanLembagas = LaporanLembaga::orderBy('updated_at', 'desc')->get();
        return view ('laporanLembaga.index', ['laporanLembagas' => $laporanLembagas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lembagas = Lembaga::all();
        $laporans = Laporan::all();
        return view ('laporanLembaga.create', ['lembagas' => $lembagas],['laporans' => $laporans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanLembagaFormRequest $request)
    {
        //
        $laporanLembaga = new LaporanLembaga();
        $laporanLembaga->laporan_id=  $request->get('laporan_id');
        $laporanLembaga->lembaga_id=  $request->get('lembaga_id');
            
        $laporanLembaga->save();

        return redirect('laporanLembaga');
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
        $laporanLembagas = LaporanLembaga::whereId($id)->firstOrFail();
        $laporans = Laporan::All();
        $lembagas = Lembaga::All();
        return view('laporanLembaga.edit', compact('laporanLembagas','laporans', 'lembagas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanLembagaFormRequest $request, $id)
    {
        //
        $laporanLembaga = LaporanLembaga::whereId($id)->firstOrFail();
        $laporanLembaga->laporan_id=  $request->get('laporan_id');
        $laporanLembaga->lembaga_id=  $request->get('lembaga_id');
        
        $laporanLembaga->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LaporanLembagaController@edit', $laporanLembaga->id))->with('status', 'Penulis - Laporan dengan id '.$laporanLembaga->id.' telah berhasil diubah');
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
        $laporanLembaga = LaporanLembaga::whereId($id)->firstOrFail();
        $laporanLembaga ->delete();
        return redirect('laporanLembaga')->with('Penghapusan data berhasil dilakukan');
    }
    
    public function getLembagaByLaporanId($id)
    {
        //
        $lembagas = Lembaga::join('laporanLembagas', 'laporanLembagas.lembaga_id', 'id')->select('lembagas.nama')->where('laporanLembagas.laporan_id', $id)->get();
    }
}
