<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;
use App\Jurnal;
use App\Majalah;
use App\Buku;
use App\Kategori;
use App\HomeSlide;
use App\Visitor;
use App\Masyarakat;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Icpsatkerprov;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

//	public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Visitor::hit();
        $laporans = Laporan::orderBy('updated_at', 'desc')->limit(3)->get();
        $jurnals = Jurnal::orderBy('updated_at', 'desc')->limit(3)->get();
        $majalahs = Majalah::orderBy('updated_at', 'desc')->limit(3)->get();
        $bukus = Buku::orderBy('updated_at', 'desc')->limit(3)->get();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        $homeSlides = HomeSlide::where('isAktif', 1)->get();

        return view('home', compact('laporans', 'kategoris', 'jurnals', 'majalahs', 'bukus', 'homeSlides'));
    }

    public function register_user()
    {
        //$satker = icpsatkerprov::orderBy("namasatker", "ASC")->get();
        $satkers = icpsatkerprov::GetSatkerSelect();

        // make it as sellect
        // return $satkers;
        return view('auth.register_user', ['satkers'=>$satkers]);
        // dd('a');
    }

    public function simpan_register_user(Request $request)
    {
        // dd($request->all());
        $nama = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');
        $nik = $request->get('nik');
        $alamat = $request->get('alamat');
        $no_telp = $request->get('no_telp');
        $status = $request->get('status');
        $bidang = $request->get('bidang');
        $satker_id = $request->get('satker_id');

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'unique:users,email',
            'nik' => 'unique:masyarakats,nik',
            'password_confirmation' => 'required|same:password'
        ], [
            'email.unique:users,email' => 'Data email sudah ada',
            'nik.unique:users,nik' => 'Data NIK sudah ada',
            'password.required' => 'Password harus diisi',
            're_password.same:password' => 'Password harus sama'
        ]);
        if ($validator->fails()) {
            $msg = "";
            foreach ($validator->messages()->all() as $message) {
                $msg .= $message . ".
                ";
            }
            session()->put('statusT', 'Kesalahan pengisian form tambah: ' . $msg);
        } else {
            $data_masyarakat = new Masyarakat;
            $data_masyarakat->nik = $nik;
            $data_masyarakat->nama = $nama;
            $data_masyarakat->status = $status;
            $data_masyarakat->alamat = $alamat;
            $data_masyarakat->no_telp = $no_telp;
            $data_masyarakat->bidang = $bidang;


            // dd($data_masyarakat);
            $data_masyarakat->save();
            $data = new User;
            $data->name = $nama;
            $data->jenis_user = 99;
            $data->email = $request->get('email');
            $data->password = Hash::make($request->get('password'));
            $data->masyarakat_id = $data_masyarakat->id;
            $data->isAktif = 1;

            $data->satker_id = ($status=="pns")? $satker_id: 999;

            $data->save();

            if($request->role_id == 4){
                for ($i = 0; $i < sizeof($kode_rusun); $i++) {
                    $data_user = new Rusunusers;
                    $data_user->user_id = $data->id;
                    $data_user->rusun_id = $kode_rusun[$i];
                    $data_user->save();
                }
            }
            // session()->put('status', 'User baru berhasil ditambahkan! ' );
            return view('success.register_user');
        }
    }
}