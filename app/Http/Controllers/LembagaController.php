<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lembaga;
use App\Http\Requests\LembagaFormRequest; 
use App\Visitor;

class LembagaController extends Controller
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
        $lembagas = Lembaga::orderBy('updated_at', 'desc');
        $lembagas = $lembagas->leftJoin('users', 'users.id', 'lembagas.status_delete')->select('lembagas.*', 'users.name');
        $lembagas = $lembagas->get();
        return view ('lembaga.index', ['lembagas' => $lembagas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('lembaga.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LembagaFormRequest $request)
    {
        //
        $lembaga = new Lembaga();
        $lembaga->nama=  $request->get('nama');
        $lembaga->alamat=  $request->get('alamat');
        $lembaga->no_telp=  $request->get('no_telp');
            
        $lembaga->save();

        return redirect('lembaga');
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
        $lembaga = Lembaga::whereId($id)->firstOrFail();
        return view('lembaga.edit', ['lembaga' => $lembaga]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(LembagaFormRequest $request, $id)
    {
        //
        $lembaga = Lembaga::whereId($id)->firstOrFail();
        $lembaga->nama=  $request->get('nama');
        $lembaga->alamat=  $request->get('alamat');
        $lembaga->no_telp=  $request->get('no_telp');
        
        $lembaga->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LembagaController@edit', $lembaga->id))->with('status', 'Penulis dengan id '.$lembaga->id.' telah berhasil diubah');
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
        $lembaga = Lembaga::whereId($id)->firstOrFail();
        
        $user = auth()->user();
        if($user->jenis_user == 143)
        {
            $lembaga ->delete();
            return redirect('lembaga')->with('Penghapusan data berhasil dilakukan');
        }
        else
        {
            $lembaga->status_delete = $user->id;
            $lembaga->save();
            return redirect('lembaga')->with('Pengajuan penghapusan data dilakukan');
        }
    }
    
    public function cancelDelete($id)
    {
        //
        $lembaga = Lembaga::whereId($id)->firstOrFail();

        $lembaga->status_delete = -1;
        $lembaga->save();
        return redirect('lembaga')->with('Pengajuan penghapusan data ditolak');

    }
    
    public function generateReport(Request $request)
    {
        $lembagas = Lembaga::select('lembagas.id as id', 'lembagas.*')
            ->orderBy('lembagas.updated_at', 'desc');
        
        $lembagas = $lembagas->get();
        
        /*---------------------------------------*/
        if($lembagas)
        {
         $filename = "repository_data_instansi_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/xls");
        header("Pragma: no-cache"); 
        header("Expires: 0");

        $arrayRow = array();

        $counter = 1;
        $blnText ='';

            foreach ($lembagas as $baris)
            {                
                array_push($arrayRow, array(
                    'No.' => $counter, 
                    'Nama Instansi' => $baris->nama,
                    'Alamat' => $baris->alamat,
                    'No. Telp' => '['.$baris->no_telp.']',
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
