<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PolicyBrief;
use App\Visitor;
use App\Http\Requests\PolicyBriefFormRequest; 

class PolicyBriefController extends Controller
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
        $policys = PolicyBrief::orderBy('tgl_publikasi', 'desc')->get();
        return view ('policyBrief.index', ['policys' => $policys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('policyBrief.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyBriefFormRequest $request)
    {
        //
	    $policy = new PolicyBrief();
        $policy->nama=  $request->get('nama');
        $policy->penerbit=  $request->get('penerbit');
        $policy->edisi=  $request->get('edisi');
        $policy->tgl_publikasi=  $request->get('tgl_publikasi');
        $policy->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/policybrief/dokumen",$fileName);
                $policy->doc_filename = 'uploads/policybrief/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/policybrief/cover",$fileName);
                $policy->cover_filename = 'uploads/policybrief/cover/'.$fileName;
            }
            
        $policy->save();

        return redirect('policy');
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
	    $policy = PolicyBrief::whereId($id)->firstOrFail();
        return view('policyBrief.edit', ['policy' => $policy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PolicyBriefFormRequest $request, $id)
    {
        //
	    $policy = PolicyBrief::whereId($id)->firstOrFail();
        $policy->nama=  $request->get('nama');
        $policy->penerbit=  $request->get('penerbit');
        $policy->edisi=  $request->get('edisi');
        $policy->tgl_publikasi=  $request->get('tgl_publikasi');
        $policy->halaman=  $request->get('halaman');
        
        $doc_file= $request->file('doc_filename');
        if($doc_file != ''){
                $fileName = $doc_file->getClientOriginalName();
                $request->file('doc_filename')->move("uploads/policybrief/dokumen",$fileName);
                $policy->doc_filename = 'uploads/policybrief/dokumen/'.$fileName;
            }
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/policybrief/cover",$fileName);
                $policy->cover_filename = 'uploads/policybrief/cover/'.$fileName;
            }
        
        $policy->save();

	return redirect(action('PolicyBriefController@edit', $policy->id))->with('status', 'Policy Brief dengan id '.$policy->id.' telah berhasil diubah');
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
	    $policy = PolicyBrief::whereId($id)->firstOrFail();
        $policy ->delete();
        return redirect('policy')->with('Penghapusan data berhasil dilakukan');
    }
}
