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
            <h3 style="margin-left: 50px">Edit <strong>PENULIS - BUKU</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('bukuAuthor') }}">Penulis - Buku</a><span class="divider">/</span></li>
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
            
            <form action="{{ route('bukuAuthor.update', $bukuAuthors->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="buku_id" class="control-label">Judul Buku</label>
                <select id="buku_id" class="form-control" name="buku_id" required autofocus>
                    @foreach ($bukus as $key => $buku)
                        @if( $buku->id  == $bukuAuthors->buku_id )
                        <option value="{{ $buku->id }}" selected="true">{{ $buku->judul }}</option>
                      @else
                        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="author_id" class="control-label">Penulis</label>
                <select id="author_id" class="form-control" name="author_id" required autofocus>
                    @foreach ($authors as $key => $author)
                        @if( $author->id  == $bukuAuthors->author_id )
                        <option value="{{ $author->id }}" selected="true">{{ $author->nama }}</option>
                      @else
                        <option value="{{ $author->id }}">{{ $author->nama }}</option>
                      @endif
                    @endforeach
                </select>
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('bukuAuthor') }}">
                    Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection