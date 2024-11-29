<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeSlide;
use App\Http\Requests\HomeSlideFormRequest; 

class HomeSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $homeSlides = HomeSlide::orderBy('updated_at', 'desc')->get();
        return view ('homeSlide.index', ['homeSlides' => $homeSlides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('homeSlide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeSlideFormRequest $request)
    {
        //
        $homeSlide = new HomeSlide();
        
        $image_file= $request->file('image_filename');
        $fileName = $image_file->getClientOriginalName();
        $request->file('image_filename')->move("uploads/home/slide",$fileName);
        $homeSlide->image_filename = 'uploads/home/slide/'.$fileName;
                
        $homeSlide->keterangan=  $request->get('keterangan');
        $homeSlide->isAktif=  $request->get('isAktif');
            
        $homeSlide->save();

        return redirect('homeSlide');
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
        $homeSlide = HomeSlide::whereId($id)->firstOrFail();
        return view('homeSlide.edit', ['homeSlide' => $homeSlide]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(HomeSlideFormRequest $request, $id)
    {
        //
        $homeSlide = HomeSlide::whereId($id)->firstOrFail();
        
        $image_file= $request->file('image_filename');
        $fileName = $image_file->getClientOriginalName();
        $request->file('image_filename')->move("uploads/home/slide",$fileName);
        $homeSlide->image_filename = 'uploads/home/slide/'.$fileName;
                
        $homeSlide->keterangan=  $request->get('keterangan');
        $homeSlide->isAktif=  $request->get('isAktif');
        
        $homeSlide->save();

	return redirect(action('HomeSlideController@edit', $homeSlide->id))->with('status', 'Data dengan id '.$homeSlide->id.' telah berhasil diubah');
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
        $homeSlide = HomeSlide::whereId($id)->firstOrFail();
        $homeSlide ->delete();
        return redirect('homeSlide')->with('Penghapusan data berhasil dilakukan');
    }
    
    public function ubahAktif($id)
    {
        $homeSlide = HomeSlide::whereId($id)->firstOrFail();
        if($homeSlide->isAktif) $homeSlide->isAktif = false;
        else $homeSlide->isAktif = true;
        $homeSlide->save();
        return redirect('homeSlide')->with('Perubahan Status Data Berhasil Dilakukan');
    }
}
