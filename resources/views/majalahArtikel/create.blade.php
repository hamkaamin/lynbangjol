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
            <h3 style="margin-left: 50px">Input <strong>ARTIKEL - MAJALAH</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('majalahArtikel') }}">Artikel Majalah</a><span class="divider">/</span></li>
            <li class="active">Tambah Data</li>
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
            <div class="btn-success">
                <strong style="margin-left: 6px">
              {{ session('status') }} 
              </strong>
            </div> 
            @endif
            
            <form action="{{ url('majalahArtikel') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            <div class="span5">
                <label for="majalah_id" class="control-label">Nama Majalah</label>
                <select id="majalah_id" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" name="majalah_id" required autofocus>
                    @if (!isset($majalahSelected))
                        <option hidden disabled selected value>Pilih Majalah</option>
                    @endif
                    @foreach ($majalahs as $key => $majalah)
                        @if( isset($majalahSelected) && $majalah->id == $majalahSelected->id )
                        <option value="{{ $majalah->id }}" selected="true">{{ $majalah->nama }} - Edisi {{ $majalah->edisi }}</option>
                        @else
                        <option value="{{ $majalah->id }}">{{ $majalah->nama }} - Edisi {{ $majalah->edisi }}</option>
                        @endif
                    @endforeach
                </select>
            <div class="clear"></div>
            
                <label for="judul" class="control-label">Judul Artikel</label>
                <input id="judul" type="text" class="form-control" name="judul" placeholder="<< Judul Artikel >>" required />
            <div class="clear"></div>

                <label for="halaman" class="control-label">Halaman pada Majalah</label>
                <input id="halaman" type="text" class="form-control" name="halaman" placeholder="<< Isikan Letak Artikel pada Majalah >>" />
            </div>
            
            <div class="span5">       
                <!--================= TIM =======================-->            
                <label for="author_id" class="control-label">Penulis</label>
                <select id="author_id" name="author_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Penulis Artikel">
                    @foreach ($authors as $key => $author)
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                    @endforeach
                </select>
                <div class="clear"></div>
                <!--================================================-->
            </div>
            <div class="clear"></div>

            <div class="span11" style="text-align: center; margin-top: 20px">
                <button type="submit" class="btn btn-info" style="padding: 12px 18px; font-size: 16px; font-weight: bold;">
                    Simpan Data
                </button>
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