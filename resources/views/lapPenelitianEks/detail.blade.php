@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span6">
          <h3><strong>Laporan Penelitian Eksternal</strong></h3>
        </div>
        <div class="span6">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Laporan Penelitian</li>
          </ul>
        </div>
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
          <aside>
            <div class="widget">
              <h4>Pencarian</h4>
              <form class="form-search" action="{{ url('lapPenelitianEks/search') }}" method="GET">
                  <input placeholder="Tulis Disini" type="text" class="input-medium search-query" name="search" value="{{ old('search') }}" style="font-size: 14px; height: 32px; border: solid 1px">
                <button type="submit" class="btn btn-flat btn-color" style="height: 40px; width: 60px; font-size: 14px" >Cari</button>
              </form>
              <a href="{{ url('lapPenelitianEks/advSearch/') }}"> >> Pencarian Lanjut</a>
            </div>
            <div class="widget">
              <h4>Laporan Penelitian Terbaru</h4>
              <ul class="recent-posts">
                @php ($num = 0)
                @foreach ($laporansSide as $laporan)
                    <li><a href="{{ url('lapPenelitianEks/filter/id/'.$laporan->id) }}"><img src="{{ asset($laporan->cover_filename) }}" alt="" style="max-width: 50px"/> {{ $laporan->judul }}</a>
                        <div class="clear">
                        </div>
                        <span class="date"><i class="icon-calendar"></i> {{ $laporan->tahun_penelitian }}</span>
                    </li>
                    @php ($num++)
                    @if ($num > 3) 
                        @break
                    @endif
                <div class="clear"></div>
                @endforeach
              </ul>
            </div>  
            <div class="widget">
              <h4>Kategori</h4>
              <ul class="unstyled">
                @foreach ($kategoris as $kategori)
                <li><a href="{{ url('lapPenelitianEks/filter/kategori/'.$kategori->id) }}">{{ $kategori->nama }}</a></li>
                @endforeach
              </ul>
            </div>
          </aside>
        </div>
        <div class="span8">
           @foreach ($laporans as $laporan)
           <article class="blog-post">
            <div class="row-fluid">
              <div class="span8">
                <div class="row-fluid">
                    <div class="span8">
                     <div class="post-heading" style="margin-bottom: 30px">
                        <h3 style="margin-bottom: 0"><a href="#">{{ $laporan->judul }}</a></h3>
                    </div>
                    <div class="clear"></div>
                    <ul class="post-meta">
                        <img src="{{ asset($laporan->cover_filename) }}" alt="" style="max-height: 450px"/>
                    </ul>
                    <div class="clear"></div>
                    <ul class="post-meta">
                      <li class="first"><i class="icon-calendar"></i><span> {{ $laporan->tahun_penelitian }}</span></li>
                      <li><i class="icon-list-alt"></i><span><a href="#">{{ $laporan->halaman }} halaman</a></span></li>
                      <li class="last"><i class="icon-tags"></i><span>
                              @php ($count = 0)
                              @foreach ($laporan->laporanKategoris as $laporanKategori)
                                @if($count != 0)
                                , 
                                @endif
                                <a href="{{ url('laporanView/filter/kategori/'.$laporanKategori->kategoris->id) }}">{{ $laporanKategori->kategoris->nama }}</a> 
                                @php ($count++)
                              @endforeach
                          </span></li>
                          <br/>
                    </ul>
                    </div>
                </div>
		<div class="clear"></div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Pelaksana Penelitian</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong>
                        @foreach ($laporan->laporanLembagas as $laporanLembaga)
                            {{ $laporanLembaga->lembagas->nama }}<br/>
                        @endforeach
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Tim Peneliti</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong>
                        @foreach ($laporan->laporanAuthors as $laporanAuthor)
                            {{ $laporanAuthor->authors->nama }} <strong>( {{ $laporanAuthor->jabatan }} )</strong><br/>
                        @endforeach
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Lokasi Penelitian</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong>
                        @foreach ($laporan->laporanLokasis as $laporanLokasi)
                            {{ $laporanLokasi->lokasis->nama }}<br/>
                        @endforeach
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Tahun Penelitian</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong> {{ $laporan->tahun_penelitian }}
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Jangka Waktu Penelitian</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong> {{ $laporan->lama }} bulan
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Anggaran Dana Penelitian</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong>@if($laporan->anggaran) Rp. {{ number_format($laporan->anggaran, 0, ",", ".") }},-
                        @endif
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Sumber Dana Penelitian</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong> {{ $laporan->sumber_dana }}
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2">
                        <strong>Kata Kunci</strong>
                    </div>
                    <div class="span6">
                        <strong>: </strong> {{ $laporan->keyword }}
                    </div>
                </div>
		<div class="clear"></div>
                 @if (is_file($laporan->lapkir_filename.'/lapkirWatermarked.pdf'))
                <a href="{{ url('laporan/download/'.$laporan->id.'/lapkir') }}"  class="btn btn-color btn-rounded" style="margin-top: 10px">Unduh File Laporan Akhir</a>
                <a href="{{ url('laporan/download/'.$laporan->id.'/abstrak') }}"  class="btn btn-warning btn-rounded" style="margin-top: 10px">Unduh File Abstrak</a>
                @else
                <div class="btn btn-dark btn-rounded disabled" style="margin-top: 10px">Unduh File Laporan Akhir</div>
                <div class="btn btn-dark btn-rounded disabled" style="margin-top: 10px">Unduh File Abstrak</div>
                @endif
                @if (is_file($laporan->eksum_filename.'/eksumWatermarked.pdf'))
                <a href="{{ url('laporan/download/'.$laporan->id.'/eksum') }}"  class="btn btn-primary btn-rounded" style="margin-top: 10px">Unduh File Executive Summary</a>
                @else
                <div class="btn btn-dark btn-rounded disabled" style="margin-top: 10px">Unduh File Executive Summary<</div>
                @endif
              </div>
            </div>
          </article>
           @endforeach
          <!-- end article 4 -->
        </div>
      </div>
    </div>
  </section>

@endsection