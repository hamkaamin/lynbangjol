@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span6">
          <h3><strong>Laporan Penelitian Internal BALITBANG</strong></h3>
        </div>
        <div class="span6">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Laporan Penelitian Internal</li>
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
              <form class="form-search" action="{{ url('lapPenelitian/search') }}" method="GET">
   <!--               <select id="searchVar" class="form-control btn dropdown-toggle btn btn-primary" name="searchVar" style="width: auto">
                    <option value="judul">Judul</option>
                    <option value="penulis">Penulis</option>
                    <option value="keyword">Keyword</option>
                </select>       -->
                  <input placeholder="Tulis Disini" type="text" class="input-medium search-query" name="search" value="{{ old('search') }}" style="font-size: 14px; height: 32px; border: solid 1px">
                <button type="submit" class="btn btn-flat btn-color" style="height: 40px; width: 60px; font-size: 14px" >Cari</button>
              </form>
              <a href="{{ url('lapPenelitian/advSearch/') }}"> >> Pencarian Lanjut</a>
            </div>
            <div class="widget">
              <h4>Laporan Penelitian Terbaru</h4>
              <ul class="recent-posts">
                @php ($num = 0) @endphp
                @foreach ($laporansSide as $laporan)
                    <li><a href="{{ url('lapPenelitian/filter/id/'.$laporan->id) }}"><img src="{{ asset($laporan->cover_filename) }}" alt="" style="max-width: 50px"/> {{ $laporan->judul }}</a>
                        <div class="clear">
                        </div>
                        <span class="date"><i class="icon-calendar"></i> {{ $laporan->tahun_penelitian }} </span>
                        <!--{{ Carbon\Carbon::parse($laporan->tgl_publikasi)->format('d M Y') }} -->
                    </li>
                    @php ($num++) @endphp
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
                <li><a href="{{ url('lapPenelitian/filter/kategori/'.$kategori->id) }}">{{ $kategori->nama }}</a></li>
                @endforeach
              </ul>
            </div>
          </aside>
        </div>
        <div class="span8">
           @foreach ($laporans as $laporan)
           <article class="blog-post">
            <div class="post-heading">
              <h3><a href="#">{{ $laporan->judul }}</a></h3>
              <h6>
                  @php ($count = 0) @endphp
                  @foreach ($laporan->laporanAuthors as $laporanAuthor)
                        @if($count != 0)
                            ;
                        @endif
                        {{ $laporanAuthor->authors->nama }}
                        @php ($count++) @endphp
                  @endforeach
              </h6>
            </div>
            <div class="row-fluid">
              <div class="span3">
                <ul class="post-meta">
                  <img src="{{ asset($laporan->cover_filename) }}" alt=""/>
                </ul>
                <div class="clear"></div>
              </div>
              <div class="span5">
                <ul class="post-meta">
                  <li class="first"><i class="icon-calendar"></i><span> {{ $laporan->tahun_penelitian }}</span></li>
                  <li><i class="icon-list-alt"></i><span><a href="#">{{ $laporan->halaman }} halaman</a></span></li>
                  <li class="last"><i class="icon-tags"></i><span>
                          @php ($count = 0) @endphp
                          @foreach ($laporan->laporanKategoris as $laporanKategori)
                              @if($count != 0)
                              , 
                              @endif
                              <a href="{{ url('lapPenelitian/filter/kategori/'.$laporanKategori->kategoris->id) }}">{{ $laporanKategori->kategoris->nama }}</a> 
                              @php ($count++) @endphp
                          @endforeach
                      </span></li>
                </ul>
		<div class="clear"></div>
		<p style="text-align: justify">
                {{ $laporan->abstrak }}
                </p>
		<div style="text-align: justify"><strong>Key Words: {{ $laporan->keyword }}</strong></div>
		<div class="clear"></div>
                <a href="{{ url('lapPenelitian/detail/'.$laporan->id) }}" class="btn btn-color btn-rounded" style="margin-top: 10px">Detail</a>
<!--                <a href="{{ asset($laporan->doc_filename) }}" download class="btn btn-color btn-rounded" style="margin-top: 10px">Unduh File</a>    -->
              </div>
            </div>
          </article>
           @endforeach
          <!-- end article 4 -->
          <div class="row-fluid">
            <div class="span3">
                @php
                
                $countStart = ($laporans->currentPage() - 1) * ($laporans->perPage()) + 1;
                $countEnd = $countStart + $laporans->perPage() - 1;
                
                if($countStart > $laporans->total()) $countStart = $laporans->total();
                if($countEnd > $laporans->total()) $countEnd = $laporans->total();
                
                echo "Menampilkan ".$countStart." sampai ".$countEnd." dari ".$laporans->total()." data";
                
                @endphp
            </div>
            <div class="span5" style="text-align: right">
              <div class="pagination">
                  <ul>
                    <li>{{ $laporans->links() }}</li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection