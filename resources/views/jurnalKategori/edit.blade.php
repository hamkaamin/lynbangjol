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
            <h3 style="margin-left: 50px">Edit <strong>KATEGORI - JURNAL</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('jurnalKategori') }}">Kategori - Jurnal</a><span class="divider">/</span></li>
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
            
            <form action="{{ route('jurnalKategori.update', $jurnalKategoris->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="jurnal_id" class="control-label">Judul Jurnal</label>
                <select id="jurnal_id" class="form-control" name="jurnal_id" required autofocus>
                    @foreach ($jurnals as $key => $jurnal)
                        @if( $jurnal->id  == $jurnalKategoris->jurnal_id )
                        <option value="{{ $jurnal->id }}" selected="true">{{ $jurnal->nama }}</option>
                      @else
                        <option value="{{ $jurnal->id }}">{{ $jurnal->nama }}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="kategori_id" class="control-label">Penulis</label>
                <select id="kategori_id" class="form-control" name="kategori_id" required autofocus>
                    @foreach ($kategoris as $key => $kategori)
                        @if( $kategori->id  == $jurnalKategoris->kategori_id )
                        <option value="{{ $kategori->id }}" selected="true">{{ $kategori->nama }}</option>
                      @else
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('jurnalKategori') }}">
                    Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection