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
            <h3 style="margin-left: 50px">Input <strong>KATEGORI - MAJALAH</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('majalahKategori') }}">Penulis - Majalah</a><span class="divider">/</span></li>
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
          <h4 class="heading"><strong>Tambah Data</strong> Kategori - Majalah<span></span></h4>
          
            @foreach ($errors->all() as $error) 
            <h4>{{ $error }}</h4> 
            @endforeach 
            @if (session('status')) 
            <div> 
              {{ session('status') }} 
            </div> 
            @endif
            
            <form action="{{ url('majalahKategori') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            <div class="span6">
                <label for="majalah_id" class="control-label">Nama Majalah</label>
                <select id="majalah_id" class="form-control" name="majalah_id" required autofocus>
                    @foreach ($majalahs as $key => $majalah)
                        <option value="{{ $majalah->id }}">{{ $majalah->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="kategori_id" class="control-label">Kategori</label>
                <select id="kategori_id" class="form-control" name="kategori_id" required autofocus>
                    @foreach ($kategoris as $key => $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
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