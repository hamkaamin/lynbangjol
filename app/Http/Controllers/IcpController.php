<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Icpkategori;
use App\Icpsatkerprov;
use App\Icprekap;
use App\Masyarakat;

class IcpController extends Controller
{

    /**
     * debug : http://localhost/2024/jatim_lynbangjol/public/icp
     */
    public function index()
    {
        if(Auth::check()) {
            return redirect('icp/panel');
        }

        $satkers = Icpsatkerprov::orderBy('namasatker', 'ASC')->get();

        return view('icp.index', ["satkers"=>$satkers]);
    }

    public function register(Request $request)
    {
        $user = Auth::user();

        $kategoris = Icpkategori::orderBy('created_at', 'DESC')->get();
        $masyakat = Masyarakat::where('id', $user->masyarakat_id)->first();
        $satker = ($masyakat->status=="pns")? Icpsatkerprov::where('id', $user->satker_id)->first(): [];

        /*

        // bila online, cek captha

        if ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != '127.0.0.1') {
            $capt = $request->input('g-recaptcha-response');
            $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Le1W9spAAAAAFlB5Ednne0AJLUXLxZ0lWz6QfRZ&response=".$capt."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

            if(!$response['success']) {
                return redirect('/icp/reg')->with('response', 'Invalid captcha');
            }
        }
        */

        return view("icp.register", [
            "nik" => $masyakat->nik,
            "nama" => $masyakat->nama,
            "satker_id" => $satker->id,
            "satker_nama" => $satker->namasatker,
            "kategoris" => $kategoris
        ]);
    }

    /**
     * debug : http://localhost/2024/jatim_lynbangjol/public/icp/regp
     */
    public function registerPost(Request $request)
    {
        $this->validate($request, ['kategori_id'=>'required', 'issue'=>'required']);

        $kategori_id = $request->input("kategori_id");

        $issue = $request->input("issue");
        $urgensi = $request->input("urgensi");
        $harapan = $request->input("harapan");
        $manfaat = $request->input("manfaat");

        $rekap = new Icprekap;

        $rekap->user_id = Auth::user()->id;
        $rekap->kategori_id = $kategori_id;
        $rekap->issue = $issue;
        $rekap->urgensi = $urgensi;
        $rekap->harapan = $harapan;
        $rekap->manfaat = $manfaat;
        if(!$rekap->save()) {
            return redirect("/icp/reg")->with('status', 'Data anda gagal disimpan');
        }

        return redirect("/icp/panel")->with('status', 'Data anda sukses tersimpan');
    }

    /**
     * panel admionistrator
     *  */

    public function panel()
    {
        $user = Auth::user()->id;

        if($user == 10) $rekaps = Icprekap::getRekaps();
        else $rekaps = Icprekap::getRekapUser($user);
            //Icprekap::where('user_id', $user)->with('owner.satker')->with('owner.masyarakat')->orderBy('updated_at', 'DESC')->get();

        //dd($rekaps);
        return view ('icp.panel', ['rekaps'=> $rekaps]);
    }

    public function panel_view($rekap_id)
    {
        return view('icp.panel_view', ['rekap'=>Icprekap::getRekap($rekap_id)->first()]);
    }

    public function panel_edit($rekap_id)
    {
        return view('icp.panel_edit', ['rekap'=>Icprekap::getRekap($rekap_id)->first()]);
    }

    /**
     * debug : http://localhost/2024/jatim_lynbangjol/public/icp/del/2
     *         untuk GET sesuaikan dengan environment
     */

    public function panel_delete(Request $request)
    {
        $id = $request->input("id");
        
        $icp = Icprekap::where("id", $id)->delete();
        $msg = ($icp)? "Sukses menghapus permohonan": "Gagal menghapus permohonan";

        return j2e(!$icp, $msg);
        // return redirect()->route("icp/panel")->with(['status'=>$msg]);
    }

    public function panel_del($rekap_id)
    {
        $icp = Icprekap::find($rekap_id);
        $msg = ($icp->delete())? "Sukses menghapus permohonan" : "Gagal menghapus permohonan";
        
        return redirect("/icp/panel")->with('status', $msg); 
    }

    public function panel_update(Request $request)
    {
        $rekap_id = $kategori_id = $request->input("id");
        $issue = $request->input("issue");
        $urgensi = $request->input("urgensi");
        $harapan = $request->input("harapan");
        $manfaat = $request->input("manfaat");

        $rekap = new Icprekap;
        $msg = ($rekap::where('id', $rekap_id)->update([
            "issue"=> $issue,
            "urgensi"=> $urgensi,
            "harapan"=> $harapan,
            "manfaat"=> $manfaat
        ]))? "Sukses": "Gagal";
        
        return redirect("/icp/panel")->with('status', "Data anda $msg terupdate");        
    }
}
