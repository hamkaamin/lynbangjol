<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanLokasi;
use App\Lokasi;
use App\Laporan;
use App\Http\Requests\LaporanLokasiFormRequest; 
use App\Visitor;

class LaporanLokasiController extends Controller
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
        $laporanLokasis = LaporanLokasi::orderBy('updated_at', 'desc')->get();
        return view ('laporanLokasi.index', ['laporanLokasis' => $laporanLokasis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lokasis = Lokasi::orderBy('nama', 'asc')->get();
        $laporans = Laporan::all();
        return view ('laporanLokasi.create', ['lokasis' => $lokasis],['laporans' => $laporans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanLokasiFormRequest $request)
    {
        //
        $laporanLokasi = new LaporanLokasi();
        $laporanLokasi->laporan_id=  $request->get('laporan_id');
        $laporanLokasi->lokasi_id=  $request->get('lokasi_id');
            
        $laporanLokasi->save();

        return redirect('laporanLokasi');
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
        $laporanLokasis = LaporanLokasi::whereId($id)->firstOrFail();
        $laporans = Laporan::All();
        $lokasis = Lokasi::orderBy('nama', 'asc')->get();
        return view('laporanLokasi.edit', compact('laporanLokasis','laporans', 'lokasis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanLokasiFormRequest $request, $id)
    {
        //
        $laporanLokasi = LaporanLokasi::whereId($id)->firstOrFail();
        $laporanLokasi->laporan_id=  $request->get('laporan_id');
        $laporanLokasi->lokasi_id=  $request->get('lokasi_id');
        
        $laporanLokasi->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LaporanLokasiController@edit', $laporanLokasi->id))->with('status', 'Lokasi - Laporan dengan id '.$laporanLokasi->id.' telah berhasil diubah');
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
        $laporanLokasi = LaporanLokasi::whereId($id)->firstOrFail();
        $laporanLokasi ->delete();
        return redirect('laporanLokasi')->with('Penghapusan data berhasil dilakukan');
    }
}
