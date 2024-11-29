@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-search icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">Pencarian <strong></strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('lapPenelitian') }}">Laporan Penelitian Internal</a><span class="divider">/</span></li>
            <li class="active">Pencarian Lanjut</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
            <form action="{{ url('lapPenelitian/execAdvSearch') }}" method="GET" class="comment-form" name="comment-form">
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span5">
                <label for="judul" class="control-label">Judul</label>
                    <input id="judul" type="text" class="form-control" name="judul" placeholder="<< Judul Laporan Penelitian >>" autofocus />           
                <div class="clear"></div>
            
                <label for="kategori_penelitian" class="control-label">Kategori Penelitian</label>
                <select id="kategori_penelitian" class="form-control btn-primary" name="kategori_penelitian" >
                    <option selected value>-- Semua Kategori --</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="Swakelola Dikuasakan">Swakelola Dikuasakan</option>
                    <option value="Swakelola Kerjasama">Swakelola Kerjasama</option>
                </select>
                <div class="clear"></div>
            
                <label for="jenis_penelitian" class="control-label">Jenis Penelitian</label>
                <select id="jenis_penelitian" class="form-control btn-primary" name="jenis_penelitian" >>
                    <option selected value>-- Semua Jenis Penelitian --</option>
                    <option value="0">Baru</option>
                    <option value="1">Lanjutan</option>
                </select>
                <div class="clear"></div>
            
                <label for="tahun_penelitian" class="control-label">Tahun Penelitian</label>
                <select id="tahun_penelitian" class="form-control btn-primary" name="tahun_penelitian" >
                    <option selected value>-- Tidak Ditentukan --</option>
                    @php($curYear = date("Y"))
                    @for($i=$curYear; $i>=2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="clear"></div>
            
                <label for="lama" class="control-label">Periode Penelitian</label>
                <select id="lama" class="form-control btn-primary" name="lama" >
                    <option selected value>-- Tidak Ditentukan --</option>
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}">{{ $i." Bulan" }}</option>
                    @endfor
                </select>
                <div class="clear"></div>

                <label for="keyword" class="control-label">Keyword</label>
                <textarea row-fluids = 1 id="keyword" type="text" class="form-control" name="keyword" placeholder="<< Isikan Kata Kunci >>"  /></textarea>
                <div class="clear"></div>
                
                <label for="halaman" class="control-label">Jumlah Halaman Laporan</label>
                <input id="halaman" type="text" class="form-control" name="halaman" placeholder="<< Isikan Jumlah Halaman Laporan Penelitian>>" />
                <div class="clear"></div>
            
            </div>
                
                <!--=====================================================-->
            
            <div class="span1"></div>
            
                <!--================= RIGhT SIDE =======================-->
            <div class="span5">
                <!--================= PELAKSANA =======================-->
                <label for="lembaga_id" class="control-label">Pelaksana Penelitian</label>
                <select id="lembaga_id" name="lembaga_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="-- Semua Instansi --">
                    @foreach ($lembagas as $key => $lembaga)
                        <option value="{{ $lembaga->id }}">{{ $lembaga->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= TIM =======================-->            
                <label for="peneliti_id" class="control-label">Peneliti</label>
                <select id="peneliti_id" name="peneliti_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="-- Semua Peneliti --">
                    @foreach ($authors as $key => $author)
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
                <!--================= BIDANG =======================-->
                <label for="kategori_id" class="control-label">Bidang Penelitian</label>
                <select id="kategori_id" name="kategori_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="-- Semua Bidang --">
                    @foreach ($kategoris as $key => $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= LOKASI =======================-->
                <label for="lokasi_id" class="control-label">Lokasi</label>
                <select id="lokasi_id" name="lokasi_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="-- Semua Lokasi --">
                    @foreach ($lokasis as $key => $lokasi)
                        <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--===================================================-->
                
                <label for="anggaran" class="control-label">Anggaran Dana Penelitian</label>
                <input id="anggaran" type="text" class="form-control" name="anggaran" placeholder="<< Tulis Angka, Tanpa Tanda Titik (.) atau Koma (,)  >>"  />
                <div class="clear"></div>

                <label for="sumber_dana" class="control-label">Sumber Dana Penelitian</label>
                <input id="sumber_dana" type="text" class="form-control" name="sumber_dana" placeholder="<< Sumber Dana Penelitian >>"  />
                <div class="clear"></div>
            </div>
            
            <div class="span11" style="text-align: center; margin-top: 20px">
                <button type="submit" class="btn btn-info" style="padding: 12px 18px; font-size: 16px; font-weight: bold;">
                    Cari
                </button>
            </div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection