@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-plus icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">Input <strong>LAPORAN PENELITIAN</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('laporan') }}">Laporan Penelitian</a><span class="divider">/</span></li>
            <li class="active">Tambah Data</li>
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
            
            <form action="{{ url('laporan') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            
                <!--================= LEFt SIDE =======================-->
            <div class="span5">
                <label for="judul" class="control-label">Judul</label>
                    <input id="judul" type="text" class="form-control" name="judul" placeholder="<< Judul Laporan Penelitian >>" required autofocus />           
                <div class="clear"></div>
            
                <label for="kategori_penelitian" class="control-label">Kategori Penelitian</label>
                <select id="kategori_penelitian" class="form-control btn-primary" name="kategori_penelitian" >
                    <option value="Mandiri">Mandiri</option>
                    <option value="Swakelola Dikuasakan">Swakelola Dikuasakan</option>
                    <option value="Swakelola Kerjasama">Swakelola Kerjasama</option>
                </select>
                <div class="clear"></div>
            
                <label for="jenis_penelitian" class="control-label">Jenis Penelitian</label>
                <select id="jenis_penelitian" class="form-control btn-primary" name="jenis_penelitian" >>
                    <option value="0">Baru</option>
                    <option value="1">Lanjutan</option>
                </select>
                <div class="clear"></div>
            
                <label for="tahun_penelitian" class="control-label">Tahun Penelitian</label>
                <select id="tahun_penelitian" class="form-control btn-primary" name="tahun_penelitian" >
                    @php($curYear = date("Y"))
                    @for($i=$curYear; $i>=2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="clear"></div>
            
                <label for="lama" class="control-label">Periode Penelitian</label>
                <select id="lama" class="form-control btn-primary" name="lama" >
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}">{{ $i." Bulan" }}</option>
                    @endfor
                </select>
                <div class="clear"></div>
                
    <!--            <label for="abstrak" class="control-label">Abstrak</label>
                <textarea row-fluids = 8 id="abstrak" type="text" class="form-control" name="abstrak" placeholder="<< Isikan Abstraksi >>"  /></textarea>
                </div>
                <div class="clear"></div>       -->

                <label for="keyword" class="control-label">Keyword</label>
                <textarea row-fluids = 4 id="keyword" type="text" class="form-control" name="keyword" placeholder="<< Isikan Kata Kunci >>"  /></textarea>
                <div class="clear"></div>
                
                <label for="halaman" class="control-label">Jumlah Halaman Laporan</label>
                <input id="halaman" type="number" class="form-control" name="halaman" placeholder="<< Isikan Jumlah Halaman Laporan Penelitian>>" />
                <div class="clear"></div>
            
            </div>
                
                <!--=====================================================-->
            
            <div class="span1"></div>
            
                <!--================= RIGhT SIDE =======================-->
            <div class="span5">
                <!--================= PELAKSANA =======================-->
                <label for="lembaga_id" class="control-label">Pelaksana Penelitian</label>
                <select id="lembaga_id" name="lembaga_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Pelaksana Penelitian">
                    @foreach ($lembagas as $key => $lembaga)
                        <option value="{{ $lembaga->id }}">{{ $lembaga->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= TIM =======================-->
                <label for="ketua_id" class="control-label">Ketua Tim Peneliti</label>
                <select id="ketua_id" name="ketua_id" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" >
                    <option hidden  disabled selected value>Pilih Ketua Tim Penelitian</option>
                    @foreach ($authors as $key => $author)
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div
                <!--================================================-->
            
                <!--================= TIM =======================-->            
                <label for="anggota_id" class="control-label">Anggota Tim Peneliti</label>
                <select id="anggota_id" name="anggota_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Anggota Tim Penelitian">
                    @foreach ($authors as $key => $author)
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
                <!--================= BIDANG =======================-->
                <label for="kategori_id" class="control-label">Bidang Penelitian</label>
                <select id="kategori_id" name="kategori_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false">
                    <option hidden disabled selected value> Pilih Bidang Penelitian </option>
                    @foreach ($kategoris as $key => $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
            
                <!--================= LOKASI =======================-->
                <label for="lokasi_id" class="control-label">Lokasi</label>
                <select id="lokasi_id" name="lokasi_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Lokasi Penelitian">
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
                
                <label for="tipe" class="control-label">Tipe Penelitian</label>
                <select id="tipe" class="form-control btn-primary" name="tipe" >
                    <option value="0">Internal</option>
                    <option value="1">Eksternal</option>
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
                <label for="lapkir_filename" class="control-label">Upload Laporan Akhir</label>
                <input id="lapkir_filename" type="file" accept=".doc,.docx,.pdf" class="form-control" name="lapkir_filename" />
                <div class="clear">Format : .doc, .docx, .pdf</div>
            
                <label for="eksum_filename" class="control-label">Upload Executive Summary</label>
                <input id="eksum_filename" type="file" accetp=".doc,.docx,.pdf" class="form-control" name="eksum_filename" />
                <div class="clear">Format : .doc, .docx, .pdf</div>

                <label for="cover_filename" class="control-label">Upload Cover Laporan</label>
                <input id="cover_filename" type="file" accep=".jpg,.jpeg,.png" class="form-control" name="cover_filename" />
                <div class="clear">Format : .jpg, .jpeg, .png</div>
            </div>
            <div class="span1"></div>
            
            <div class="span5">
                <label for="halaman_show" class="control-label">Jumlah Halaman Ditampilkan untuk Umum</label>
                <input id="halaman_show" type="number" class="form-control" name="halaman_show" placeholder="<< Isikan Jumlah Halaman yang Akan Ditampilkan >>" />
                <div class="clear"></div>
                
                <label for="tahun_watermark" class="control-label">Label Watermark (Tahun)</label>
                <select id="tahun_watermark" class="form-control btn-primary" name="tahun_watermark" >
                    <option hidden disabled selected value> ( Sama Dengan Tahun Penelitian ) </option>
                    @php($curYear = date("Y"))
                    @for($i=$curYear+5; $i>=2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="clear"></div>
                
                <label for="halaman_abstrak" class="control-label">Halaman Awal Abstraksi</label>
                <input id="halaman_abstrak" type="number" class="form-control" name="halaman_abstrak" placeholder="<< Isikan Nomor Halaman Letak Abstraksi >>" />
                <div class="clear"></div>
                
                <label for="halaman_abstrak_num" class="control-label">Jumlah Halaman Abstraksi</label>
                <select id="halaman_abstrak_num" class="form-control btn-primary" name="halaman_abstrak_num" >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <div class="clear"></div>
            </div>
            
            <div class="span11" style="text-align: center; margin-top: 20px">
                <button type="submit" class="btn btn-info" style="padding: 12px 18px; font-size: 16px; font-weight: bold;">
                    Simpan Data
                </button>
            </div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('foot_script')
<script type="text/javascript">
    
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
