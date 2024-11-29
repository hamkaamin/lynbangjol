@extends('layouts.app')

@section('content')
<!-- Subhead================================================== -->
  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-list icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">List <strong>LAPORAN PENELITIAN</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Laporan Penelitian</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <!-- start article 3 -->
          @foreach ($errors->all() as $error)
            <h4>{{ $error }}</h4> 
            @endforeach 
            @if (session('status')) 
            <div class="status"> 
            {{ session('status') }} 
            </div> 
            @endif 
            
          <div style="float: right;">
              @if(Auth::user()->jenis_user == 143)
              <a class="btn btn-success" style="padding: 10px 16px; font-ine-height: 30px;size: 14px; background-color: #6142d1" href="{!! action('LaporanController@report') !!}">Buat Excel</a>
              <a class="btn btn-warning" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! action('LaporanController@resetVersion') !!}">Reset Version</a>
              @endif
              <a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px; margin-left: 2px" href="{!! action('LaporanController@create') !!}">Tambah Data</a>
          </div>
          
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th>Tahun</th>
                    <th>Periode</th>
                    <th>Anggaran</th>
                    <th>Sumber Dana</th>
                    <th>Keyword</th>
                    <th>Halaman</th>
                    <th>Tipe</th>
                    <th>Dokumen</th>
                    <th>Cover</th>
                    <th>Opsi</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($laporans as $laporan)
                  <tr>
                    <td>{{ $n }}</td> 
                    <td>{{ $laporan->judul }}</td>
                    <td>
                        @if (!$laporan->jenis_penelitian) Penelitian Baru
                        @else Penelitian Lanjutan
                        @endif
                    </td>
                    <td>{{ $laporan->tahun_penelitian }}</td>
                    <td>{{ $laporan->lama }} Bulan</td>
                    <td>Rp. {{ number_format($laporan->anggaran, 0, ",", ".") }},-</td>
                    <td>{{ $laporan->sumber_dana }}</td>
                    <td>{{ $laporan->keyword }}</td>
                    <td>{{ $laporan->halaman }}</td>
                    <td>
                        @if (!$laporan->tipe) Internal
                        @else Eksternal
                        @endif
                    </td>
                    <td>
                        <div class="input-append">
                            <div class="btn-group"> 
                                <button class="btn dropdown-toggle btn-primary @if ($laporan->status_delete>0) disabled @endif" data-toggle="dropdown" style="padding: 8px 14px; font-size: 14px; width: 100px; text-align: left"> 
                                    <span class="caret"></span> Download
                                </button> 
                                <ul class="dropdown-menu"> 
                                    @if ($laporan->lapkir_filename || $laporan->eksum_filename)
                                    @if (is_file($laporan->lapkir_filename.'/lapkirWatermarked.pdf'))
                                    <li><a href="{{ $laporan->lapkir_filename.'/lapkir.pdf' }}" download> File Lapkir</a></li>
                                    <li><a href="{{ url('laporan/download/'.$laporan->id.'/abstrak') }}" download> File Abstrak</a></li>
                                    @endif
                                    @if (is_file($laporan->eksum_filename.'/eksumWatermarked.pdf'))
                                    <li><a href="{{ $laporan->lapkir_filename.'/eksum.pdf' }}" download> File Eksum</a></li>
                                    @endif
                                    @else 
                                    <li><a href="#"> File Tidak Ditemukan</a></li>
                                    @endif
                                </ul>
                            </div> 
                        </div>
                        <div class="input-append" style="margin-top: 10px">
                            <div class="btn-group"> 
                                <button class="btn dropdown-toggle btn-danger @if ($laporan->status_delete>0) disabled @endif" data-toggle="dropdown" style="padding: 8px 14px; font-size: 14px; width: 100px; text-align: left"> 
                                    <span class="caret"></span> Hapus
                                </button> 
                                <ul class="dropdown-menu"> 
                                    @if ($laporan->lapkir_filename || $laporan->eksum_filename)
                                    @if (is_file($laporan->lapkir_filename.'/lapkir.pdf'))
                                    <li><a href="{{ url('laporan/deleteFile/'.$laporan->id.'/lapkir') }}" onclick="return confirm('Konfirmasi Hapus File Laporan Akhir Berikut? {{ $laporan->judul }}');"> File Lapkir</a></li>
                                    @endif
                                    @if (is_file($laporan->eksum_filename.'/eksum.pdf'))
                                    <li><a href="{{ url('laporan/deleteFile/'.$laporan->id.'/eksum') }}" onclick="return confirm('Konfirmasi Hapus File Executive Summary Berikut? {{ $laporan->judul }}');"> File Eksum</a></li>
                                    @endif
                                    @else 
                                    <li><a href="#"> File Tidak Ditemukan</a></li>
                                    @endif
                                </ul>
                            </div> 
                        </div>
                    </td>
                    <td><a href="{{ $laporan->cover_filename }}"><img src="{{ $laporan->cover_filename }}" style="max-width: 225px"/></a></td>
                    <td>
                        @if (Auth::user()->jenis_user == 143 || ($laporan->status_delete<=0))
                        <a class="btn btn-info" style="padding: 8px 14px; font-size: 14px" href="{!! action('LaporanController@edit', $laporan->id) !!}">
                           <div class="icon">
                                <i class="icon-edit" style=""></i>
                             Edit
                            </div>
                        </a>
                        
                        <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="hapus" onsubmit="return confirm('Konfirmasi Hapus Data Berikut? {{ $laporan->judul }}');"> 
			{{ method_field("DELETE") }} 
			{{ csrf_field() }} 
                        <button class="btn btn-danger" type="submit" name="submit" style="padding: 4px 8px; font-size: 14px">
                            <i class="icon-trash" style=""></i> Hapus</button>
			</form>
                        @endif
                    </td>
                    <td>
                        @if ($laporan->status_delete)
                            @if ($laporan->status_delete>0)
                                @if(Auth::user()->jenis_user == 143)
                                    Hapus Data Diajukan oleh <div style="color: red">{{ $laporan->name }}</div><br/>
                                    <a class="btn btn-primary" style="padding: 8px 14px; font-size: 14px" href="{!! action('LaporanController@cancelDelete', $laporan->id) !!}">
                                       <div class="icon">
                                            <i class="icon-close" style=""></i>
                                            Batalkan
                                        </div>
                                    </a>
                                @else 
                                    <div style="color: red">Hapus </div>(Tunggu Konfirmasi Admin)
                                @endif
                            @else
                                <div style="color: blue">Request Hapus Data Dibatalkan</div>
                                @if(Auth::user()->jenis_user == 143)
                                <a class="btn btn-primary" style="padding: 8px 14px; font-size: 14px" href="{!! action('LaporanController@cancelDelete', $laporan->id) !!}">
                                       <div class="icon">
                                            <i class="icon-close" style=""></i>
                                            Aktifkan
                                        </div>
                                    </a>
                                @endif
                            @endif
                        @else
                            <div style="color: green">Aktif</div>
                        @endif
                    </td>
                  </tr>
                  @php ($n++)
                  @endforeach
                </tbody>
              </table>
          <!-- end article 3 -->
        </div>
      </div>
    </div>
  </section>
@endsection

@section('foot_script')
 <script type="text/javascript">

$(function() {
        $('#myTable').dataTable({
        	"processing": true,
      		"language" : {"url" : "{{ asset('DataTables-1.10.18/bahasa/Indonesian.json') }}" }
        });
    });

</script>
@endsection



