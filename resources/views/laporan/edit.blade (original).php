@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-pencil icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">Edit <strong>LAPORAN PENELITIAN</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('laporan') }}">Laporan Penelitian</a><span class="divider">/</span></li>
            <li class="active">Ubah Data</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          
            @foreach ($errors->all() as $error)
            <h4>{{ $error }}</h4> 
            @endforeach 
            @if (session('status')) 
            <div> 
            {{ session('status') }} 
            </div> 
            @endif 
            
            <form action="{{ route('laporan.update', $laporan->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="judul" class="control-label">Judul</label>
                <input id="judul" type="text" class="form-control" name="judul" value="{{ $laporan->judul }}" required autofocus />
            </div>
            <div class="clear"></div>
            
            <!--================= PELAKSANA =======================-->
            <div class="span6">
                <label for="lembaga_id" class="control-label">Pelaksana Penelitian</label>
                <select id="lembaga_id" name="lembaga_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Pelaksana Penelitian">
                    @php($arrTemp = array())
                    @foreach($lembagaSelected as $laporanLembaga)
                    @php($arrTemp[] = $laporanLembaga->lembaga_id)
                    @endforeach
                    
                    @foreach ($lembagas as $key => $lembaga)
                        @if( in_array($lembaga->id, $arrTemp) )
                        <option value="{{ $lembaga->id }}" selected="true">{{ $lembaga->nama }}</option>
                        @else
                        <option value="{{ $lembaga->id }}">{{ $lembaga->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            <!--================================================-->
            
            <!--================= TIM =======================-->
            <div class="span6">
                <label for="ketua_id" class="control-label">Ketua Tim Peneliti</label>
                <select id="ketua_id" name="ketua_id" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" >
                    <option hidden  disabled selected value>Pilih Ketua Tim Penelitian</option>
                    @php($arrTemp = array())
                    @foreach($ketuaSelected as $laporanAuthor)
                    @php($arrTemp[] = $laporanAuthor->author_id)
                    @endforeach
                    
                    @foreach ($authors as $key => $author)
                        @if( in_array($author->id, $arrTemp) )
                        <option value="{{ $author->id }}" selected="true">{{ $author->nama }}</option>
                        @else
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="anggota_id" class="control-label">Anggota Tim Peneliti</label>
                <select id="anggota_id" name="anggota_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Anggota Tim Penelitian">
                    @php($arrTemp = array())
                    @foreach($anggotaSelected as $laporanAuthor)
                    @php($arrTemp[] = $laporanAuthor->author_id)
                    @endforeach
                    
                    @foreach ($authors as $key => $author)
                        @if( in_array($author->id, $arrTemp) )
                        <option value="{{ $author->id }}" selected="true">{{ $author->nama }}</option>
                        @else
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            <!--================================================-->
            
            <!--================= BIDANG =======================-->
            <div class="span6">
                <label for="kategori_id" class="control-label">Bidang Penelitian</label>
                <select id="kategori_id" name="kategori_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Bidang Penelitian">
                    @php($arrTemp = array())
                    @foreach($kategoriSelected as $laporanKategori)
                    @php($arrTemp[] = $laporanKategori->kategori_id)
                    @endforeach
                    
                    @foreach ($kategoris as $key => $kategori)
                        @if( in_array($kategori->id, $arrTemp) )
                        <option value="{{ $kategori->id }}" selected="true">{{ $kategori->nama }}</option>
                        @else
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            <!--================================================-->
            
            <!--================= KATEGORI PENELITIAN =======================-->
            
            <!--================================================-->
            
            <div class="span2">
                <label for="jenis_penelitian" class="control-label">Jenis Penelitian</label>
                <select id="jenis_penelitian" class="form-control btn-primary" name="jenis_penelitian" >
                    @for($i=0; $i<=1; $i++)
                        @if(!$i) @php($tipe_text = "Baru")
                        @else @php($tipe_text = "Lanjutan")
                        @endif
                        @if( $laporan->jenis_penelitian  == $i )
                        <option value="{{ $i }}" selected="true">{{ $tipe_text }}</option>
                        @else
                        <option value="{{ $i }}">{{ $tipe_text }}</option>
                      @endif
                    @endfor
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span2">
                <label for="tahun_penelitian" class="control-label">Tahun Penelitian</label>
                <select id="tahun_penelitian" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" name="tahun_penelitian" >
                    @php($curYear = date("Y"))
                    @for($i=$curYear; $i>=2000; $i--)
                        @if( $laporan->tahun_penelitian == $i )
                        <option value="{{ $i }}" selected="true">{{ $i }}</option>
                        @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span2">
                <label for="lama" class="control-label">Periode Penelitian</label>
                <select id="lama" class="form-control btn-primary" name="lama" >
                    @for($i=1; $i<=12; $i++)
                        @if( $laporan->lama == $i )
                        <option value="{{ $i }}" selected="true">{{ $i." Bulan" }}</option>
                        @else
                        <option value="{{ $i }}">{{ $i." Bulan" }}</option>
                      @endif
                    @endfor
                </select>
            </div>
            <div class="clear"></div>
            
            <!--================= LOKASI =======================-->
            <div class="span6">
                <label for="lokasi_id" class="control-label">Lokasi</label>
                <select id="lokasi_id" name="lokasi_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Lokasi Penelitian">
                    @php($arrTemp = array())
                    @foreach($lokasiSelected as $laporanLokasi)
                    @php($arrTemp[] = $laporanLokasi->lokasi_id)
                    @endforeach
                    
                    @foreach ($lokasis as $key => $lokasi)
                        @if( in_array($lokasi->id, $arrTemp) )
                        <option value="{{ $lokasi->id }}" selected="true">{{ $lokasi->nama }}</option>
                        @else
                        <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            <!--===================================================-->
            
            <div class="span6">
                <label for="anggaran" class="control-label">Anggaran Dana Penelitian</label>
                <input id="anggaran" type="text" class="form-control" name="anggaran" value="{{ $laporan->anggaran }}" />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="sumber_dana" class="control-label">Sumber Dana Penelitian</label>
                <input id="sumber_dana" type="text" class="form-control" name="sumber_dana" value="{{ $laporan->sumber_dana }}" />
            </div>
            <div class="clear"></div>

    <!--        <div class="span6">
                <label for="abstrak" class="control-label">Abstrak</label>
                <textarea row-fluids = 8 id="abstrak" type="text" class="form-control" name="abstrak"  />{{ $laporan->abstrak }}</textarea>
            </div>
            <div class="clear"></div>       -->

            <div class="span6">
                <label for="keyword" class="control-label">Keyword</label>
                <input id="keyword" type="text" class="form-control" name="keyword" value="{{ $laporan->keyword }}"  />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="halaman" class="control-label">Jumlah Halaman</label>
                <input id="halaman" type="text" class="form-control" name="halaman" value="{{ $laporan->halaman}}" />
            </div>
            <div class="clear"></div>
            
            <div class="span2">
                <label for="tipe" class="control-label">Tipe Penelitian</label>
                <select id="tipe" class="form-control btn-primary" name="tipe" >
                    @for($i=0; $i<=1; $i++)
                        @if(!$i) @php($tipe_text = "Internal")
                        @else @php($tipe_text = "Eksternal")
                        @endif
                        @if( $laporan->tipe  == $i )
                        <option value="{{ $i }}" selected="true">{{ $tipe_text }}</option>
                        @else
                        <option value="{{ $i }}">{{ $tipe_text }}</option>
                      @endif
                    @endfor
                </select>
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="doc_filename" class="control-label">Upload Dokumen</label>
                <input id="doc_filename" type="file" class="form-control" name="doc_filename" value="{{ $laporan->doc_filename }}" />
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="cover_filename" class="control-label">Upload Cover</label>
                <input id="cover_filename" type="file" class="form-control" name="cover_filename" value="{{ $laporan->cover_filename }}" />
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('laporan') }}">
                    Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection