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
            <h3 style="margin-left: 50px">Input <strong>ARTIKEL - JURNAL</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('jurnalArtikel') }}">Artikel Jurnal</a><span class="divider">/</span></li>
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
            
            <form action="{{ url('jurnalArtikel') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            <div class="span5">
                <label for="jurnal_id" class="control-label">Nama Jurnal</label>
                <select id="jurnal_id" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" name="jurnal_id" required autofocus>
                    @if (!isset($jurnalSelected))
                        <option hidden disabled selected value>Pilih Jurnal</option>
                    @endif
                    @foreach ($jurnals as $key => $jurnal)
                        @if( isset($jurnalSelected) && $jurnal->id == $jurnalSelected->id )
                        <option value="{{ $jurnal->id }}" selected="true">{{ $jurnal->nama }} - Volume {{ $jurnal->volume }}</option>
                        @else
                        <option value="{{ $jurnal->id }}">{{ $jurnal->nama }} - Volume {{ $jurnal->volume }}</option>
                        @endif
                    @endforeach
                </select>
            <div class="clear"></div>
            
                <label for="judul" class="control-label">Judul Artikel</label>
                <input id="judul" type="text" class="form-control" name="judul" placeholder="<< Judul Artikel >>" required />
            <div class="clear"></div>
            
                <label for="keyword" class="control-label">Keyword</label>
                <input id="keyword" type="text" class="form-control" name="keyword" placeholder="<< Keyword Artikel >>" />
            <div class="clear"></div>

                <label for="halaman" class="control-label">Halaman pada Jurnal</label>
                <input id="halaman" type="text" class="form-control" name="halaman" placeholder="<< Isikan Letak Artikel pada Jurnal >>" />
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
                
                <label for="abstrak" class="control-label">Abstrak</label>
                <textarea row-fluids = 8 id="abstrak" type="text" class="form-control" name="abstrak" placeholder="<< Isikan Abstraksi >>" /></textarea>
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