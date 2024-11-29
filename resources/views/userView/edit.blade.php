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
            <h3 style="margin-left: 50px">Edit <strong>PENULIS</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li><a href="{{ url('user') }}">User</a><span class="divider">/</span></li>
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
          
            <!-- start article 3 -->
          @foreach ($errors->all() as $error)
            <h4>{{ $error }}</h4> 
            @endforeach 
            @if (session('status')) 
            <div class="status"> 
            {{ session('status') }} 
            </div> 
            @endif 
            
            <form action="{{ route('userView.update', $user->id) }}" method="post" enctype="multipart/form-data" class="comment-form" name="comment-form" onsubmit="return confirm('Konfirmasi Perubahan Data');"> 
            {{ method_field("PUT") }} 
            {!! csrf_field() !!}
            
            <div class="span6">
                <label for="name" class="control-label">Nama</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required />
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="email" class="control-label">Email</label>
                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required=""/>
            </div>
            <div class="clear"></div>
            
            <div class="span6">
                <label for="password" class="control-label">Password Baru</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="<< Tulis Password Baru >>"/>
            </div>
            <div class="clear"></div>

            <div class="span6" style="text-align: center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 16px; font-size: 14px">
                Simpan Data
                </button>
                <a class="btn btn-color" style="line-height: 30px; font-size: 14px" href="{{ url('userView') }}">
                    Kembali</a>
            </div>
            <div class="clear"></div>
                
            </form>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('foot_script')

@endsection