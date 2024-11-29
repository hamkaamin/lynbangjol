<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lokasi;
use App\Http\Requests\LokasiFormRequest;
use app\Visitor;

class LokasiController extends Controller
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
        $lokasis = Lokasi::orderBy('updated_at', 'desc')->get();
        return view ('lokasi.index', ['lokasis' => $lokasis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LokasiFormRequest $request)
    {
        //
        $lokasi = new Lokasi();
        $lokasi->nama=  $request->get('nama');
            
        $lokasi->save();

        return redirect('lokasi');
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
        $lokasi = Lokasi::whereId($id)->firstOrFail();
        return view('lokasi.edit', ['lokasi' => $lokasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LokasiFormRequest $request, $id)
    {
        //
        $lokasi = Lokasi::whereId($id)->firstOrFail();
        $lokasi->nama=  $request->get('nama');
        
        $lokasi->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LokasiController@edit', $lokasi->id))->with('status', 'Penulis dengan id '.$lokasi->id.' telah berhasil diubah');
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
        $lokasi = Lokasi::whereId($id)->firstOrFail();
        $lokasi ->delete();
        return redirect('lokasi')->with('Penghapusan data berhasil dilakukan');
    }
    
    public function generateReport(Request $request)
    {
        $lokasis = Lokasi::select('lokasis.id as id', 'lokasis.*')
            ->orderBy('lokasis.updated_at', 'desc');
        
        $lokasis = $lokasis->get();
        
        /*---------------------------------------*/
        if($lokasis)
        {
         $filename = "repository_data_lokasi_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/xls");
        header("Pragma: no-cache"); 
        header("Expires: 0");

        $arrayRow = array();

        $counter = 1;
        $blnText ='';

            foreach ($lokasis as $baris)
            {                
                array_push($arrayRow, array(
                    'No.' => $counter, 
                    'Lokasi' => $baris->nama
                    ));
                
                $counter++;
            }

            $this->outputArray = $arrayRow;

            $flag = false;
            foreach($arrayRow as $row) {
              if(!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
              }
              echo implode("\t", array_values($row)) . "\r\n";
            }
        exit;   
        }
    /*---------------------------------------*/  
    }
}
