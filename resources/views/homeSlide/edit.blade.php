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
            <h3 style="margin-left: 50px">Edit <strong>Pengaturan</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('homeSlide') }}">Pengaturan</a><span class="divider">/</span></li>
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
            
            <form action="{{ route('homeSlide.update', $homeSlide->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="image_filename" class="control-label">Upload File Gambar</label>
                <input id="image_filename" type="file" class="form-control" name="image_filename" value="{{ $homeSlide->image_filename }}" required autofocus/>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="keterangan" class="control-label">Keterangan</label>
                <textarea row-fluids = 4 id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $homeSlide->keterangan }}" /></textarea>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
            <label for="isAktif" class="control-label">Tipe Penelitian</label>
                <select id="isAktif" class="form-control btn-primary" name="isAktif" >
                    @for($i=0; $i<=1; $i++)
                        @if(!$i) @php($isAktif_text = "Tidak Aktif")
                        @else @php($isAktif_text = "Aktif")
                        @endif
                        @if( $homeSlide->isAktif  == $i )
                        <option value="{{ $i }}" selected="true">{{ $isAktif_text }}</option>
                        @else
                        <option value="{{ $i }}">{{ $isAktif_text }}</option>
                      @endif
                    @endfor
                </select>
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('homeSlide') }}">
                    Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection
