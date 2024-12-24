<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;
use App\Author;
use App\Kategori;
use App\Lokasi;
use App\Lembaga;
use App\LaporanAuthor;
use App\LaporanKategori;
use App\LaporanLembaga;
use App\LaporanLokasi;
use App\Http\Requests\LaporanFormRequest;
use App\Visitor;

use App\Classes\vendor\WatermarkPDF;
use App\Classes\vendor\pdfExtend;
use App\Classes\vendor\PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Classes\vendor\PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        if (class_exists(\App\Classes\vendor\WatermarkPDF::class)) {
            dd ('Class exists!');
        } else {
            dd ('Class does not exist.');
        }*/

        Visitor::hit();
        $laporans = Laporan::orderBy('laporans.updated_at', 'desc');
        $user = auth()->user();
        if($user->jenis_user != 143)
        {
            $laporans = $laporans->join('laporan_kategoris', 'laporans.id', 'laporan_kategoris.laporan_id')
                    ->where('laporan_kategoris.kategori_id', $user->kategori_id)
                    ->select('laporans.*');
        }
        else
        {
            $laporans = $laporans->leftJoin('users', 'users.id', 'laporans.status_delete')->select('laporans.*', 'users.name');
        }
        $laporans = $laporans->get();
        return view ('laporan.index', ['laporans' => $laporans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $authors = Author::orderBy('nama', 'asc')->get();
        $lokasis = Lokasi::all();
        $lembagas = Lembaga::orderBy('nama', 'asc')->get();
        
        $user = auth()->user();
        if($user->jenis_user != 143)
        {
            $kategoris = Kategori::where('id', $user->kategori_id)->get();
        }
        else $kategoris = Kategori::all();
        return view ('laporan.create', compact('authors', 'kategoris' , 'lembagas', 'lokasis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LaporanFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanFormRequest $request)
    {
        //
        $laporan = new Laporan();
        $laporan->judul=  $request->get('judul');
        $laporan->kategori_penelitian=  $request->get('kategori_penelitian');
        $laporan->jenis_penelitian=  $request->get('jenis_penelitian');
        $laporan->tahun_penelitian=  $request->get('tahun_penelitian');
        $laporan->lama=  $request->get('lama');
        if($request->get('anggaran'))$laporan->anggaran= preg_replace("/([^0-9\\,])/i", "", $request->get('anggaran'));
        $laporan->sumber_dana=  $request->get('sumber_dana');
        //$laporan->abstrak=  $request->get('abstrak');
        $laporan->halaman_abstrak=  $request->get('halaman_abstrak');
        $laporan->halaman_abstrak_num=  $request->get('halaman_abstrak_num');
        $laporan->keyword=  $request->get('keyword');
        $laporan->halaman=  $request->get('halaman');
        $laporan->tipe=  $request->get('tipe');
        if($request->get('halaman_show')) $laporan->halaman_show=  $request->get('halaman_show');
        else $laporan->halaman_show= 10;
        $laporan->tahun_watermark=  $request->get('tahun_watermark');
                
        //======================= GENERATE WATERMARK LAPKIR & EKSUM=============================//
        if($request->get('tahun_watermark')) $watermarkTahun = $request->get('tahun_watermark');
        else if($request->get('tahun_penelitian')) $watermarkTahun = $request->get('tahun_penelitian');
        else $watermarkTahun = date("Y");
            
        $lapkir_file= $request->file('lapkir_filename');
        if($lapkir_file != ''){
            $newAddress = "uploads/laporan/dokumen/".$request->get('judul');
            $laporan->lapkir_filename = $this->fileUploads($lapkir_file, 'lapkir', $newAddress, $watermarkTahun);
            $laporan->lapkir_version = 1;
        }
        
        $eksum_file= $request->file('eksum_filename');
        if($eksum_file != ''){
            $newAddress = "uploads/laporan/dokumen/".$request->get('judul');
            $laporan->eksum_filename = $this->fileUploads($eksum_file, 'eksum', $newAddress, $watermarkTahun);
            $laporan->eksum_version = 1;
        }
        //=============================================================================//
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/laporan/cover",$fileName);
                $laporan->cover_filename = 'uploads/laporan/cover/'.$fileName;
            }
            
        /*-------------------------------------*/
        if($lapkir_file)
        {   
            //======================= GENERATE ABSTRAK & Cover=============================//
/*            $pagecount = 4; // SET HALAMAN ABSTRAK
            for ($i = 1; $i <= $pagecount+1; $i++) {
                    if($i <= $pagecount ) $new_pdf = new pdfExtend();
                    $new_pdf->AddPage();
                    $new_pdf->setSourceFile($laporan->lapkir_filename.'/lapkirWatermarked.pdf');
                    $new_pdf->useTemplate($new_pdf->importPage($i));
                    
                    if($i == 1)
                    {
                        $new_filename = $laporan->lapkir_filename.'/cover.jpg';
                        $new_pdf->Output($new_filename, "F");
                    }
            }
            $new_filename = $laporan->lapkir_filename.'/abstrak.pdf';
            $new_pdf->Output($new_filename, "F");
            
            $new_pdf->close();
            //====================================================================//
            
            //=================== GENERATE VIEW UTK UMUM =========================//
            if($laporan->halaman_show) $pageViewNum = $laporan->halaman_show; // SET HALAMAN ABSTRAK
            else $pageViewNum = 10;
            $pdfView = new pdfExtend();
            for ($i = 1; $i <= $pageViewNum; $i++) {
                    $pdfView->AddPage();
                    $pdfView->setSourceFile($laporan->lapkir_filename.'/lapkirWatermarked.pdf');
                    $pdfView->useTemplate($pdfView->importPage($i));
            }
            $new_filename = $laporan->lapkir_filename.'/view.pdf';
            $pdfView->Output($new_filename, "F");
            $pdfView->close();
            //====================================================================//    */
        }
        
        $laporan->save();
        $id = $laporan->id;
        if ($request->get('ketua_id')) $this->insertTimPeneliti($id, $request->get('ketua_id'), 'Ketua', 'edit');
        if ($request->get('anggota_id')) $this->insertTimPeneliti($id, $request->get('anggota_id'), 'Anggota', 'edit');
        
        if ($request->get('lembaga_id')) $this->insertConnectorTableData($id, 'lembagas', 'lembaga_id', $request->get('lembaga_id'), 'edit');
        if ($request->get('kategori_id')) $this->insertConnectorTableData($id, 'kategoris', 'kategori_id', $request->get('kategori_id'), 'edit');
        if ($request->get('lokasi_id')) $this->insertConnectorTableData($id, 'lokasis', 'lokasi_id', $request->get('lokasi_id'), 'edit');
        
        return redirect('laporan')->with('status', 'Data "'.$laporan->judul.'" berhasil ditambahkan');
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
        $laporan = Laporan::whereId($id)->firstOrFail();
        $authors = Author::orderBy('nama', 'asc')->get();
        $user = auth()->user();
        if($user->jenis_user != 143)
        {
            $kategoris = Kategori::where('id', $user->kategori_id)->get();
        }
        else $kategoris = Kategori::all();
        $lokasis = Lokasi::all();
        $lembagas = Lembaga::orderBy('nama', 'asc')->get();
        
        $ketuaSelected = LaporanAuthor::where('laporan_id', $id)->where('jabatan', 'Ketua')->get();
        $anggotaSelected = LaporanAuthor::where('laporan_id', $id)->where('jabatan', 'Anggota')->get();
        $kategoriSelected = LaporanKategori::where('laporan_id', $id)->get();
        $lokasiSelected = LaporanLokasi::where('laporan_id', $id)->get();
        $lembagaSelected = LaporanLembaga::where('laporan_id', $id)->get();
                
        return view ('laporan.edit', compact('laporan','authors', 'kategoris' , 'lembagas', 'lokasis', 'ketuaSelected', 'anggotaSelected', 'kategoriSelected', 'lokasiSelected', 'lembagaSelected'));
        //return view('laporan.edit', ['laporan' => $laporan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanFormRequest $request, $id)
    {
        //
        $laporan = Laporan::whereId($id)->firstOrFail();
        $laporan->judul=  $request->get('judul');
        $laporan->kategori_penelitian=  $request->get('kategori_penelitian');
        $laporan->jenis_penelitian=  $request->get('jenis_penelitian');
        $laporan->tahun_penelitian=  $request->get('tahun_penelitian');
        $laporan->lama=  $request->get('lama');
        if($request->get('anggaran'))$laporan->anggaran= preg_replace("/([^0-9\\,])/i", "", $request->get('anggaran'));
        $laporan->sumber_dana=  $request->get('sumber_dana');
        //$laporan->abstrak=  $request->get('abstrak');
        $laporan->halaman_abstrak=  $request->get('halaman_abstrak');
        $laporan->halaman_abstrak_num=  $request->get('halaman_abstrak_num');
        $laporan->keyword=  $request->get('keyword');
        $laporan->halaman=  $request->get('halaman');
        $laporan->tipe=  $request->get('tipe');
        $laporan->halaman_show=  $request->get('halaman_show');
        $laporan->tahun_watermark=  $request->get('tahun_watermark');
        
        //======================= GENERATE WATERMARK LAPKIR & EKSUM=============================//
        if($request->get('tahun_watermark')) $watermarkTahun = $request->get('tahun_watermark');
        else if($request->get('tahun_penelitian')) $watermarkTahun = $request->get('tahun_penelitian');
        else $watermarkTahun = date("Y");
            
        $lapkir_file= $request->file('lapkir_filename');
        if($lapkir_file != ''){
            $newAddress = "uploads/laporan/dokumen/".$request->get('judul');
            $laporan->lapkir_filename = $this->fileUploads($lapkir_file, 'lapkir', $newAddress, $watermarkTahun);
            if(!$laporan->lapkir_version) $laporan->lapkir_version = 1;
            else $laporan->lapkir_version = $laporan->lapkir_version + 1;
        }
        
        $eksum_file= $request->file('eksum_filename');
        if($eksum_file != ''){
            $newAddress = "uploads/laporan/dokumen/".$request->get('judul');
            $laporan->eksum_filename = $this->fileUploads($eksum_file, 'eksum', $newAddress, $watermarkTahun);
            if(!$laporan->eksum_version) $laporan->eksum_version = 1;
            else $laporan->eksum_version = $laporan->eksum_version + 1;
        }
        //=============================================================================//
            
        $cover_file= $request->file('cover_filename');
        if($cover_file != ''){
                $fileName = $cover_file->getClientOriginalName();
                $request->file('cover_filename')->move("uploads/laporan/cover",$fileName);
                $laporan->cover_filename = 'uploads/laporan/cover/'.$fileName;
            }
        
        $laporan->save();
        
        if ($request->get('ketua_id')) $this->insertTimPeneliti($id, $request->get('ketua_id'), 'Ketua', 'edit');
        if ($request->get('anggota_id')) $this->insertTimPeneliti($id, $request->get('anggota_id'), 'Anggota', 'edit');
        
        if ($request->get('lembaga_id')) $this->insertConnectorTableData($id, 'lembagas', 'lembaga_id', $request->get('lembaga_id'), 'edit');
        if ($request->get('kategori_id')) $this->insertConnectorTableData($id, 'kategoris', 'kategori_id', $request->get('kategori_id'), 'edit');
        if ($request->get('lokasi_id')) $this->insertConnectorTableData($id, 'lokasis', 'lokasi_id', $request->get('lokasi_id'), 'edit');

        //return redirect('jurnal')->with('data jurnal berhasil di update!'); 
	return redirect(action('LaporanController@edit', $laporan->id))->with('status', 'Laporan dengan id ['.$laporan->id.'] telah berhasil diubah');
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
        $laporan = Laporan::whereId($id)->firstOrFail();
        
        $user = auth()->user();
        if($user->jenis_user == 143)
        {
            $laporan ->delete();
            return redirect('laporan')->with('status', 'Laporan dengan judul "'.$laporan->judul.'" berhasil dihapus');
        }
        else
        {
            $laporan->status_delete = $user->id;
            $laporan->save();
            return redirect('laporan')->with('status', 'Laporan dengan judul "'.$laporan->judul.'" diajukan untuk dihapus');
        }
    }
    
    
    //=================  ORIGINAL  =====================//
    public function fileUploads($file, $tipeDokumen, $newFileLocation, $watermarkTahun)
    {
        $fileName = $file->getClientOriginalName();
        $newAddress = $newFileLocation;
        if(is_file($newAddress.'/'.$tipeDokumen.'.pdf')) unlink($newAddress.'/'.$tipeDokumen.'.pdf');
        if(is_file($newAddress.'/'.$tipeDokumen.'Watermarked.pdf')) unlink($newAddress.'/'.$tipeDokumen.'Watermarked.pdf');
        $file->move($newAddress ,$fileName);
        rename($newAddress.'/'.$fileName, $newAddress.'/'.$tipeDokumen.'.pdf');
            
        $this->watermarkGenerate($newAddress, $watermarkTahun, $tipeDokumen);
        
        return($newAddress);
    }
    
    public function downloadFile($laporanId, $tipeDokumen)
    {
        $laporan = Laporan::whereId($laporanId)->firstOrFail();
        
        if($laporan->halaman_show) $pageViewNum = $laporan->halaman_show;
        else $pageViewNum = 10;
        
        if(!$laporan->halaman_abstrak) $laporan->halaman_abstrak = 4;
        if($laporan->halaman_abstrak_num) $abstrakNum = $laporan->halaman_abstrak_num - 1;
        else $abstrakNum = 0;
        if($tipeDokumen == 'abstrak')$pageViewNum = $laporan->halaman_abstrak + $abstrakNum; // SET HALAMAN ABSTRAK
        
        $pdfView = new pdfExtend();
        //dd($pdfView);
        if($tipeDokumen == 'eksum')$pageViewNum = $pdfView->setSourceFile($laporan->eksum_filename.'/eksumWatermarked.pdf');
        for ($i = 1; $i <= $pageViewNum; $i++) {
            if($tipeDokumen == 'abstrak' &&  $i <= $pageViewNum - ($abstrakNum) ) $pdfView = new pdfExtend();
            $pdfView->AddPage();
            if($tipeDokumen == 'eksum') $pdfView->setSourceFile($laporan->eksum_filename.'/eksumWatermarked.pdf');
            else $pdfView->setSourceFile($laporan->lapkir_filename.'/lapkirWatermarked.pdf');
            $pdfView->useTemplate($pdfView->importPage($i));
        }
        $new_filename = $laporan->judul;
        $pdfView->Output($new_filename.'_'.$tipeDokumen.'.pdf', "D");
        $pdfView->close();
    }
    
    public function deleteFile($laporanId, $tipeDokumen)
    {
        $laporan = Laporan::whereId($laporanId)->firstOrFail();
        
        if($tipeDokumen == 'lapkir') $filePointer = $laporan->lapkir_filename;
        else if($tipeDokumen == 'eksum') $filePointer = $laporan->eksum_filename;
        if(is_file($filePointer.'/'.$tipeDokumen.'.pdf')) unlink($filePointer.'/'.$tipeDokumen.'.pdf');
        if(is_file($filePointer.'/'.$tipeDokumen.'Watermarked.pdf')) unlink($filePointer.'/'.$tipeDokumen.'Watermarked.pdf');
        
        if($tipeDokumen == 'lapkir') 
        {
            $laporan->lapkir_filename = null;
            $statusText = "Laporan Akhir";
        }
        else if($tipeDokumen == 'eksum') 
        {
            $laporan->eksum_filename = null;
            $statusText = "Executive Summary";
        }
        $laporan->save();
        
        return redirect('laporan')->with('status', 'File dokumen '.$statusText.' dari laporan dengan judul "'.$laporan->judul.'" berhasil dihapus');
    }
    
    public function watermarkGenerate($filename, $tahun, $tipeLaporan)
    {    
        $pdfFile = $filename.'/'.$tipeLaporan.'.pdf';
        $watermarkText = "BALITBANG ".$tahun;
        $pdf = new WatermarkPDF($pdfFile, $watermarkText);
        $pdf->AddPage();
        
        if($pdf->numPages>1) {
            for($i=2;$i<=$pdf->numPages;$i++) {
                $pdf->_tplIdx = $pdf->importPage($i);
                $pdf->AddPage();
            }
        }

        $pdf->Output($filename.'/'.$tipeLaporan.'Watermarked.pdf', 'F');
        $pdf->close();
        /*-------------------------------------*/
    }
    
    public function insertTimPeneliti($laporanId, $dataId, $jabatan, $tipeInput)
    {
        if($tipeInput == 'edit') 
        {
            LaporanAuthor::where('laporan_id', $laporanId)->where('jabatan', $jabatan)->delete();
            LaporanAuthor::onlyTrashed()->forceDelete();
        }
        foreach ((array)$dataId as $author_id)
        {
            $laporanAuthor = new LaporanAuthor();
            $laporanAuthor->laporan_id=  $laporanId;
            $laporanAuthor->author_id=  $author_id;
            $laporanAuthor->jabatan = $jabatan;

            $laporanAuthor->save();
        }
    }
    
    public function insertConnectorTableData($laporanId, $table, $attribute, $dataId, $tipeInput)
    {
        if($tipeInput == 'edit')
        {
            if($table == 'lembagas') 
            {
                LaporanLembaga::where('laporan_id', $laporanId)->delete();
                LaporanLembaga::onlyTrashed()->forceDelete();
            }
            else if($table == 'lokasis') 
            {
                LaporanLokasi::where('laporan_id', $laporanId)->delete();
                LaporanLokasi::onlyTrashed()->forceDelete();
            }
            else if($table == 'kategoris') 
            {
                LaporanKategori::where('laporan_id', $laporanId)->delete();
                LaporanKategori::onlyTrashed()->forceDelete();
            }
        }
        foreach ((array)$dataId as $data)
        {
            if($table == 'lembagas') $tableInsert = new LaporanLembaga();
            else if($table == 'lokasis') $tableInsert = new LaporanLokasi();
            else if($table == 'kategoris') $tableInsert = new LaporanKategori();
            
            $tableInsert->laporan_id=  $laporanId;
            $tableInsert->$attribute=  $data;

            $tableInsert->save();
        }
    }
    
    public function report()
    {
        $kategoris = Kategori::all();
        return view ('laporan.report', compact('kategoris'));
    }
    
    public function generateReport(Request $request)
    {
        $tipe=  $request->get('tipe');
        $tahun_penelitian=  $request->get('tahun_penelitian');
        $kategori_id=  $request->get('kategori_id');
        
        $laporans = Laporan::select('laporans.id as id', 'laporans.*')
            ->orderBy('laporans.updated_at', 'desc');
        
        if($tipe != null) {
            $laporans = $laporans->where('laporans.tipe', $tipe);
        }
        if($tahun_penelitian) {
            $laporans = $laporans->whereIn('laporans.tahun_penelitian', $tahun_penelitian);
        }
        if($kategori_id){
            $laporans = $laporans->join('laporan_kategoris', 'laporan_kategoris.laporan_id','laporans.id');
            $laporans = $laporans->whereIn('laporan_kategoris.kategori_id', $kategori_id);
        }
        
        $laporans = $laporans->get();
        
        /*---------------------------------------*/
        if($laporans)
        {
         $filename = "repository_data_laporan_" . date('Ymd') . ".xls";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/xls");
        header("Pragma: no-cache"); 
        header("Expires: 0");

        $arrayRow = array();

        $counter = 1;
        $blnText ='';

            foreach ($laporans as $baris)
            {                
                $pdfView = new pdfExtend();
                $lapkirPageNum = 0;
                $eksumPageNum = 0;
                if($baris->lapkir_filename) 
                {
                    if(is_file($baris->lapkir_filename.'/lapkir.pdf')) $lapkirPageNum = $pdfView->setSourceFile($baris->lapkir_filename.'/lapkir.pdf');
                    else $lapkirPageNum = 'File Error';
                }
                if($baris->eksum_filename) 
                {
                    if(is_file($baris->eksum_filename.'/eksum.pdf')) $eksumPageNum = $pdfView->setSourceFile($baris->eksum_filename.'/eksum.pdf');
                    else $eksumPageNum = 'File Error';
                }
                
                $bidang = "";
                foreach ($baris->laporanKategoris as $laporanKategori)
                {
                    $bidang = $laporanKategori->kategoris->nama;
                }
                
                if(!$baris->tipe) $tipeText = "Internal";
                else $tipeText = "Eksternal";

                array_push($arrayRow, array(
                    'No.' => $counter, 
                    'Judul' => $baris->judul,
                    'Tipe' => $tipeText,
                    'Tahun' => $baris->tahun_penelitian,
                    'Bidang Penelitian' => $bidang,
                    'Halaman Lapkir' => $lapkirPageNum,
                    'Halaman Eksum' => $eksumPageNum
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
    
    public function cancelDelete($id)
    {
        //
        $laporan = Laporan::whereId($id)->firstOrFail();
        $statusMsg = '';

        if($laporan->status_delete > 0)
        {
            $laporan->status_delete = -1;
            $statusMsg = 'Pengajuan penghapusan data laporan dengan judul "'.$laporan->judul.'" tidak disetujui';
        }
        
        else if($laporan->status_delete < 0)
        {
            $laporan->status_delete = 0;
            $statusMsg = 'Status data laporan dengan judul "'.$laporan->judul.'" diaktifkan';
        }
        
        $laporan->save();
        return redirect('laporan')->with('status', $statusMsg);

    }
    
    public function resetVersion()
    {
        //
        $laporans = Laporan::orderBy('updated_at', 'asc');
        
        foreach ($laporans as $laporan)
        {
            if($laporan->lapkir_filename)$laporan->lapkir_version = 1;
            if($laporan->eksum_filename)$laporan->eksum_version = 1;
            $laporan->save();
        }
        return redirect('laporan')->with('status', 'Reset versi dokumen berhasil');
    }
}
