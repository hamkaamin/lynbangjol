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
            <h3 style="margin-left: 50px">Edit <strong>PENELITi - LAPORAN</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('laporanAuthor') }}">Peneliti - Laporan</a><span class="divider">/</span></li>
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
            
            <form action="{{ route('laporanAuthor.update', $laporanAuthors->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="laporan_id" class="control-label">Judul Laporan</label>
                <select id="laporan_id" class="form-control" name="laporan_id" required autofocus>
                    @foreach ($laporans as $key => $laporan)
                        @if( $laporan->id  == $laporanAuthors->laporan_id )
                        <option value="{{ $laporan->id }}" selected="true">{{ $laporan->judul }}</option>
                      @else
                        <option value="{{ $laporan->id }}">{{ $laporan->judul }}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="author_id" class="control-label">Peneliti</label>
                <select id="author_id" class="form-control" name="author_id" required autofocus>
                    @foreach ($authors as $key => $author)
                        @if( $author->id  == $laporanAuthors->author_id )
                        <option value="{{ $author->id }}" selected="true">{{ $author->nama }}</option>
                      @else
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span2">
                <label for="jabatan" class="control-label">Jabatan</label>
                <select id="jabatan" class="form-control btn-primary" name="jabatan" >
                    <option value="Ketua" @if($laporanAuthors->jabatan == 'Ketua') selected="true" @endif>Ketua</option>
                    <option value="Anggota" @if($laporanAuthors->jabatan == 'Anggota') selected="true" @endif>Anggota</option>
                </select>
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('laporanAuthor') }}">
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