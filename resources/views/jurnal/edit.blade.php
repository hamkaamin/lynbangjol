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
            <h3 style="margin-left: 50px">Edit <strong>JURNAL</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('jurnal') }}">Jurnal</a><span class="divider">/</span></li>
            <li class="active">Ubah Data</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

@if(Auth::user()->jenis_user == 143)
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
            
            <form action="{{ route('jurnal.update', $jurnal->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="nama" class="control-label">Nama</label>
                <input id="nama" type="text" class="form-control" name="nama" value="{{ $jurnal->nama }}" required autofocus />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="penerbit" class="control-label">Penerbit</label>
                <input id="penerbit" type="text" class="form-control" name="penerbit" value="{{ $jurnal->penerbit }}" required />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="volume" class="control-label">Volume</label>
                <input id="volume" type="text" class="form-control" name="volume" value="{{ $jurnal->volume }}" required />
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="tgl_publikasi" class="control-label">Tenggal Publikasi</label>
                <input id="tgl_publikasi" type="date" class="form-control" name="tgl_publikasi" value="{{ $jurnal->tgl_publikasi }}" />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="halaman" class="control-label">Jumlah Halaman</label>
                <input id="halaman" type="text" class="form-control" name="halaman" value="{{ $jurnal->halaman}}" />
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="doc_filename" class="control-label">Upload Dokumen</label>
                <input id="doc_filename" type="file" class="form-control" name="doc_filename" value="{{ $jurnal->doc_filename }}" />
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="cover_filename" class="control-label">Upload Cover</label>
                <input id="cover_filename" type="file" class="form-control" name="cover_filename" value="{{ $jurnal->cover_filename }}" />
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('jurnal') }}">
                    Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>
@else
  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <!-- start article 3 -->
          <div style="text-align: center"><strong>Anda tidak dapat mengakses halaman ini</strong></div>
          <!-- end article 3 -->
        </div>
      </div>
    </div>
  </section>
@endif
@endsection