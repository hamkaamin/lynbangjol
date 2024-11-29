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
            <h3 style="margin-left: 50px">Edit <strong>ARTIKEL - JURNAL</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('jurnalArtikel') }}">Artikel - Jurnal</a><span class="divider">/</span></li>
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
            
            <form action="{{ route('jurnalArtikel.update', $jurnalArtikels->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span5">
                <label for="jurnal_id" class="control-label">Nama Jurnal</label>
                <select id="jurnal_id" class="form-control" name="jurnal_id" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" required autofocus>
                    @foreach ($jurnals as $key => $jurnal)
                        @if( $jurnal->id  == $jurnalArtikels->jurnal_id )
                        <option value="{{ $jurnal->id }}" selected="true">{{ $jurnal->nama }} - Volume {{ $jurnal->volume }}</option>
                      @else
                        <option value="{{ $jurnal->id }}">{{ $jurnal->nama }} - Volume {{ $jurnal->volume }}</option>
                      @endif
                    @endforeach
                </select>
            <div class="clear"></div>
            
                <label for="judul" class="control-label">Judul</label>
                <input id="judul" type="text" class="form-control" name="judul" value="{{ $jurnalArtikels->judul }}" required />
            <div class="clear"></div>
  
                <label for="keyword" class="control-label">Keyword</label>
                <input id="keyword" type="text" class="form-control" name="keyword" value="{{ $jurnalArtikels->keyword }}"  />
            <div class="clear"></div>
            
                <label for="halaman" class="control-label">Halaman pada Jurnal</label>
                <input id="halaman" type="text" class="form-control" name="halaman" value="{{ $jurnalArtikels->halaman}}" />
            </div>
            
            <div class="span5">       
                <!--================= TIM =======================-->            
                <label for="author_id" class="control-label">Penulis</label>
                <select id="author_id" name="author_id[]" class="selectpicker form-control" data-style="btn-primary" data-live-search="true" data-dropup-auto="false" data-selected-text-format="count > 2" multiple title="Pilih Anggota Tim Penelitian">
                    @php($arrTemp = array())
                    @foreach($authorSelected as $jurnalAuthor)
                    @php($arrTemp[] = $jurnalAuthor->author_id)
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
                
                <label for="abstrak" class="control-label">Abstrak</label>
                <textarea row-fluids = 8 id="abstrak" type="text" class="form-control" name="abstrak" />{{ $jurnalArtikels->abstrak }}</textarea>
            <div class="clear"></div>
                
            </div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('jurnalArtikel') }}">
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