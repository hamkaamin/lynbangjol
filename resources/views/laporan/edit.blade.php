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
            <div class="status"> 
            {{ session('status') }} 
            </div> 
            @endif 
            
            <form action="{{ route('laporan.update', $laporan->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
             <!--================= LEFt SIDE =======================-->
            <div class="span5">
                <label for="judul" class="control-label">Judul</label>
                    <input id="judul" type="text" class="form-control" name="judul" value="{{ $laporan->judul }}" required autofocus />           
                <div class="clear"></div>
            
                <label for="kategori_penelitian" class="control-label">Kategori Penelitian</label>
                <select id="kategori_penelitian" class="form-control btn-primary" name="kategori_penelitian" >
                    <option value="Mandiri" @if($laporan->kategori_penelitian == 'Mandiri') selected="true" @endif>Mandiri</option>
                    <option value="Swakelola Dikuasakan" @if($laporan->kategori_penelitian == 'Swakelola Dikuasakan') selected="true" @endif>Swakelola Dikuasakan</option>
                    <option value="Swakelola Kerjasama" @if($laporan->kategori_penelitian == 'Swakelola Kerjasama') selected="true" @endif>Swakelola Kerjasama</option>
                </select>
                <div class="clear"></div>
            
                <label for="jenis_penelitian" class="control-label">Jenis Penelitian</label>
                <select id="jenis_penelitian" class="form-control btn-primary" name="jenis_penelitian" >>
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
                <div class="clear"></div>
            
                <label for="tahun_penelitian" class="control-label">Tahun Penelitian</label>
                <select id="tahun_penelitian" class="form-control btn-primary" name="tahun_penelitian" >
                    @php($curYear = date("Y"))
                    @for($i=$curYear; $i>=2000; $i--)
                        @if( $laporan->tahun_penelitian == $i )
                        <option value="{{ $i }}" selected="true">{{ $i }}</option>
                        @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                </select>
                <div class="clear"></div>
            
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
                <div class="clear"></div>
                
    <!--            <label for="abstrak" class="control-label">Abstrak</label>
                <textarea row-fluids = 8 id="abstrak" type="text" class="form-control" name="abstrak" placeholder="<< Isikan Abstraksi >>"  /></textarea>
                </div>
                <div class="clear"></div>       -->

                <label for="keyword" class="control-label">Keyword</label>
                <textarea row-fluids = 4 id="keyword" type="text" class="form-control" name="keyword" />{{ $laporan->keyword }}</textarea>
                <div class="clear"></div>
                
                <label for="halaman" class="control-label">Jumlah Halaman Laporan</label>
                <input id="halaman" type="number" class="form-control" name="halaman" value="{{ $laporan->halaman}}" />
                <div class="clear"></div>
            
            </div>
                
                <!--=====================================================-->
            
            <div class="span1"></div>
            
                <!--================= RIGhT SIDE =======================-->
            <div class="span5">
                <!--================= PELAKSANA =======================-->
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
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= TIM =======================-->
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
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= TIM =======================-->            
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
                <div class="clear"></div>
                <!--================================================-->
                <!--================= BIDANG =======================-->
                <label for="kategori_id" class="control-label">Bidang Penelitian</label>
                <select id="kategori_id" name="kategori_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false">
                    <option hidden disabled selected value>Pilih Bidang Penelitian</option>
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
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= LOKASI =======================-->
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
                <div class="clear"></div>
                <!--===================================================-->
                
                <label for="anggaran" class="control-label">Anggaran Dana Penelitian</label>
                <input id="anggaran" type="text" class="form-control" name="anggaran" value="{{ $laporan->anggaran }}"  />
                <div class="clear"></div>

                <label for="sumber_dana" class="control-label">Sumber Dana Penelitian</label>
                <input id="sumber_dana" type="text" class="form-control" name="sumber_dana" value="{{ $laporan->sumber_dana }}"  />
                <div class="clear"></div>
                
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
                <div class="clear"></div>
            </div>
            
                <!--===================SECTION DOKUMEN===================-->
            <div class="clear"></div>
            <div class="span11" style="margin-top:20px; margin-bottom: 10px">
                <div class="btn-primary btn-block" style="text-align: center; font-weight: bold; padding: 14px; background-color: #09828c">DOKUMEN</div>
            </div>
            <div class="clear"></div>
            
            <div class="span5">
                <label for="lapkir_filename" class="control-label">Upload Laporan Akhir @if($laporan->lapkir_version) {{'(Revisi ke-'.$laporan->lapkir_version.')'}} @endif</label>
                <input id="lapkir_filename" type="file" class="form-control" name="lapkir_filename" />
                <div class="clear"></div>
            
                <label for="eksum_filename" class="control-label">Upload Executive Summary @if($laporan->eksum_version) {{'(Revisi ke-'.$laporan->eksum_version.')'}} @endif</label>
                <input id="eksum_filename" type="file" class="form-control" name="eksum_filename" />
                <div class="clear"></div>

                <label for="cover_filename" class="control-label">Upload Cover Laporan</label>
                <input id="cover_filename" type="file" accept=".jpg,.jpeg,.png" class="form-control" name="cover_filename" />
                <div class="clear"></div>
            </div>
            <div class="span1"></div>
            
            <div class="span5">
                <label for="halaman_show" class="control-label">Jumlah Halaman Ditampilkan untuk Umum</label>
                <input id="halaman_show" type="number" class="form-control" name="halaman_show" value="{{ $laporan->halaman_show }}" />
                <div class="clear"></div>
                
                <label for="tahun_watermark" class="control-label">Label Watermark (Tahun)</label>
                <select id="tahun_watermark" class="form-control btn-primary" name="tahun_watermark" >
                    <option hidden disabled selected value>Sama Dengan Tahun Penelitian</option>
                    @php($curYear = date("Y"))
                    @for($i=$curYear; $i>=2000; $i--)
                        @if( $laporan->tahun_watermark == $i )
                        <option value="{{ $i }}" selected="true">{{ $i }}</option>
                        @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                </select>
                <div class="clear"></div>
                
                <label for="halaman_abstrak" class="control-label">Halaman Awal Abstraksi</label>
                <input id="halaman_abstrak" type="number" class="form-control" name="halaman_abstrak" value="{{ $laporan->halaman_abstrak }}" />
                <div class="clear"></div>
                
                <label for="halaman_abstrak_num" class="control-label">Jumlah Halaman Abstrak</label>
                <select id="halaman_abstrak_num" class="form-control btn-primary" name="halaman_abstrak_num" >
                    @for($i=1; $i<=5; $i++)
                        @if( $laporan->halaman_abstrak_num == $i )
                        <option value="{{ $i }}" selected="true">{{ $i }}</option>
                        @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                </select>
                <div class="clear"></div>
            </div>

            <div class="span11" style="text-align: center; margin-top: 20px">
                <button type="submit" class="btn btn-info" style="padding: 12px 18px; font-size: 16px; font-weight: bold;">
                    Simpan Data
                </button>
                <a class="btn btn-danger" style="padding: 12px 18px; font-size: 16px; font-weight: bold;" href="{{ url('laporan') }}">
                Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('foot_script')
<script type="text/javascript">
    
    $(window).on('load',function(){
        var anggaran = document.getElementById('anggaran');
        if(anggaran.value == 0) anggaran.value = null; 
        anggaran.value = formatRupiah(anggaran.value, 'Rp. ');
    });
    
    $("#anggaran").change(function(){
        //// tambahkan 'Rp.' pada saat form di ketik
        //// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        var anggaran = document.getElementById('anggaran');
        anggaran.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
       if(ribuan){
           separator = sisa ? '.' : '';
           rupiah += separator + ribuan.join('.');
       }
   
       rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
       return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
   }
   
</script>
@endsection
