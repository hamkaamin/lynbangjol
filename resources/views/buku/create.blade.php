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
            <h3 style="margin-left: 50px">Input <strong>BUKU</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('buku') }}">Buku</a><span class="divider">/</span></li>
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
            
            <form action="{{ url('buku') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            <div class="span6">
                <label for="judul" class="control-label">Judul</label>
                <input id="judul" type="text" class="form-control" name="judul" placeholder="<< Judul Buku >>" required autofocus />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="penerbit" class="control-label">Penerbit</label>
                <input id="penerbit" type="text" class="form-control" name="penerbit" placeholder="<< Nama Penerbit >>" required/>
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="tgl_publikasi" class="control-label">Tenggal Publikasi</label>
                <input id="tgl_publikasi" type="date" class="form-control" name="tgl_publikasi" required/>
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="halaman" class="control-label">Jumlah Halaman</label>
                <input id="halaman" type="text" class="form-control" name="halaman" placeholder="<< Isikan Jumlah Halaman >>" />
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="doc_filename" class="control-label">Upload Dokumen</label>
                <input id="doc_filename" type="file" class="form-control" name="doc_filename" />
            </div>
            <div class="clear"></div>

            <div class="span6">
                <label for="cover_filename" class="control-label">Upload Cover</label>
                <input id="cover_filename" type="file" class="form-control" name="cover_filename" />
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
            </button>
            </div>
            
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection