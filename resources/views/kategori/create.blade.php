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
            <h3 style="margin-left: 50px">Input <strong>KATEGORI</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('kategori') }}">Kategori</a><span class="divider">/</span></li>
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
            <div> 
              {{ session('status') }} 
            </div> 
            @endif
            
            <form action="{{ url('kategori') }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form"> 
            {!! csrf_field() !!} 
            <div class="span6">
                <label for="nama" class="control-label">Nama</label>
                <input id="nama" type="text" class="form-control" name="nama" placeholder="<< Nama Kategori >>" required autofocus />
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