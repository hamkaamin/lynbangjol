<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserViewFormRequest;
use Illuminate\Support\Facades\Hash;

class UserViewController extends Controller
{
    //
    public function index()
    {
        //
        $users = User::orderBy('updated_at', 'desc')->get();
        return view ('userView.index', ['users' => $users]);
    }
    
    public function aktivasi($id)
    {
        $user = User::whereId($id)->firstOrFail();
        if($user->isAktif) $user->isAktif = false;
        else $user->isAktif = true;
        $user->save();
        return redirect('userView')->with('Perubahan Status Data Berhasil Dilakukan');
    }
    
    public function edit($id)
    {
        //
        $user = User::whereId($id)->firstOrFail();
        return view('userView.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserViewFormRequest $request, $id)
    {
        //
        $user = User::whereId($id)->firstOrFail();
        $user->name=  $request->get('name');
        if($request->get('password')) $user->password = Hash::make($request->get('password'));
        $user->email=  $request->get('email');
        
        $user->save();

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('UserViewController@edit', $user->id))->with('status', 'Data user dengan email '.$user->email.' telah berhasil diubah');
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
        $user = User::whereId($id)->firstOrFail();
        
        $user_active = auth()->user();
        if($user_active->jenis_user == 143)
        {
            $user ->delete();
            return redirect('userView')->with('status', 'User dengan judul "'.$user->judul.'" berhasil dihapus');
        }
        else
        {
            $user->status_delete = $user->id;
            $user->save();
            return redirect('userView')->with('status', 'User dengan judul "'.$user->judul.'" diajukan untuk dihapus');
        }
    }
}
