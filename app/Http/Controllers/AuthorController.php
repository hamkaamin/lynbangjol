<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Lembaga;
use App\Http\Requests\AuthorFormRequest; 

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authors = Author::orderBy('updated_at', 'desc');
        $authors = $authors->leftJoin('users', 'users.id', 'authors.status_delete')->select('authors.*', 'users.name');
        $authors = $authors->get();
        return view ('author.index', ['authors' => $authors]);
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
        return view ('author.create', ['lembagas' => $lembagas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorFormRequest $request)
    {
        //
        $author = new Author();
        $author->nama=  $request->get('nama');
        $author->gender=  $request->get('gender');
        $author->alamat=  $request->get('alamat');
        $author->no_telp=  $request->get('no_telp');
        $author->email=  $request->get('email');
        $author->lembaga_id=  $request->get('lembaga_id');
        $author->jabatan=  $request->get('jabatan');
            
        $author->save();

        return redirect('author');
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
        $author = Author::whereId($id)->firstOrFail();
        $lembagas = Lembaga::all();
        return view('author.edit', compact('author','lembagas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(AuthorFormRequest $request, $id)
    {
        //
        $author = Author::whereId($id)->firstOrFail();
        $author->nama=  $request->get('nama');
        $author->gender=  $request->get('gender');
        $author->alamat=  $request->get('alamat');
        $author->no_telp=  $request->get('no_telp');
        $author->email=  $request->get('email');
        $author->lembaga_id=  $request->get('lembaga_id');
        $author->jabatan=  $request->get('jabatan');
        
        $author->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('AuthorController@edit', $author->id))->with('status', 'Penulis dengan id '.$author->id.' telah berhasil diubah');
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
        $author = Author::whereId($id)->firstOrFail();
        
        $user = auth()->user();
        if($user->jenis_user == 143)
        {
            $author ->delete();
            return redirect('author')->with('Penghapusan data berhasil dilakukan');
        }
        else
        {
            $author->status_delete = $user->id;
            $author->save();
            return redirect('author')->with('Pengajuan penghapusan data dilakukan');
        }
    }
    
    public function cancelDelete($id)
    {
        //
        $author = Author::whereId($id)->firstOrFail();

        $author->status_delete = -1;
        $author->save();
        return redirect('author')->with('Pengajuan penghapusan data ditolak');

    }
    
    public function generateReport(Request $request)
    {
        $authors = Author::select('authors.id as id', 'authors.*')
            ->orderBy('authors.updated_at', 'desc');
        
        $authors = $authors->get();
        
        /*---------------------------------------*/
        if($authors)
        {
         $filename = "repository_data_penulis_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/xls");
        header("Pragma: no-cache"); 
        header("Expires: 0");

        $arrayRow = array();

        $counter = 1;
        $blnText ='';

            foreach ($authors as $baris)
            {
                if($baris->lembagas) $instansi = $baris->lembagas->nama;
                if($baris->gender) $genderText = "Laki-Laki";
                else $genderText = "Perempuan";
                
                array_push($arrayRow, array(
                    'No.' => $counter, 
                    'Nama Penulis' => $baris->nama,
                    'Jenis Kelamin' => $genderText,
                    'Alamat' => $baris->alamat,
                    'No. Telp' => '['.$baris->no_telp.']',
                    'Email' => $baris->email,
                    'Instansi' => $instansi,
                    'Jabatan' => $baris->jabatan,
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
