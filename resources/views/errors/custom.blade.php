@extends('layouts.app')

@section('content')
  <section id="intro" style="margin-top: 50px">

    

  </section>

  <section id="maincontent">
     <div class="row-fluid">
         <div class="span12" style="margin-bottom: 60px">
             <div class="center">
             <h1>UPS !</h1>
             <h4 style="color: red">Sistem menemukan error dalam pemrosesan</h4>
             <img src="{{ asset('img/myAsset/sad-emoji.png') }}" alt="" style="max-height: 300px"/>
             <h4>Silakan kembali ke halaman <a href="{{ url('home') }}">Utama</a></h4>
             Jika anda kembali menemukan error berkelanjutan, mohon menghubungi administrator untuk bantuan
             </div>
         </div>
     </div>
  </section>
@endsection

