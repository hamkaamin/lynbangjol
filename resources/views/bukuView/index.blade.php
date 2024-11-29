@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
          <h3><strong>Buku</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Buku</li>
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
              <form class="form-search" action="{{ url('bukuView/search') }}" method="GET">
                  <select id="searchVar" class="form-control btn dropdown-toggle btn btn-primary" name="searchVar" style="width: auto">
                    <option value="judul">Judul</option>
                    <option value="penulis">Penulis</option>
                    <option value="penerbit">Penerbit</option>
                </select>
                  <input placeholder="Tulis Disini" type="text" class="input-medium search-query" name="search" value="{{ old('search') }}" style="font-size: 14px; height: 32px; border: solid 1px">
                <button type="submit" class="btn btn-flat btn-color" >Cari</button>
              </form>
            </div>
            <div class="widget">
              <h4>Buku Terbaru</h4>
              <ul class="recent-posts">
                @php ($num = 0)
                @foreach ($bukusSide as $buku)
                    <li><a href="{{ url('bukuView/filter/id/'.$buku->id) }}"><img src="{{ asset($buku->cover_filename) }}" alt="" style="max-width: 50px"/> {{ $buku->judul }}</a>
                        <div class="clear">
                        </div>
                        <span class="date"><i class="icon-calendar"></i> {{ Carbon\Carbon::parse($buku->tgl_publikasi)->format('d M Y') }}</span>
                    </li>
                    @php ($num++)
                    @if ($num > 3) 
                        @break
                    @endif
                @endforeach
              </ul>
            </div>  
            <div class="widget">
              <h4>Kategori</h4>
              <ul class="cat">
                @foreach ($kategoris as $kategori)
                <li><a href="{{ url('bukuView/filter/kategori/'.$kategori->id) }}">{{ $kategori->nama }}</a></li>
                @endforeach
              </ul>
            </div>
          </aside>
        </div>
        <div class="span8">
           @foreach ($bukus as $buku)
           <article class="blog-post">
            <div class="row-fluid">
              <div class="span3">
                <ul class="post-meta">
                  <img src="{{ asset($buku->cover_filename) }}" alt=""/>
                </ul>
                <div class="clear"></div>
              </div>
              <div class="span5">
                  <div class="post-heading">
                      <h3><a href="#">{{ $buku->judul }}</a></h3>
                  </div>
                <ul class="post-meta">
                  <li class="first"><i class="icon-calendar"></i><span>{{ Carbon\Carbon::parse($buku->tgl_publikasi)->format('Y') }}</span></li>
                  <li><i class="icon-list-alt"></i><span><a href="#">{{ $buku->halaman }} halaman</a></span></li>
                  <li class="last"><i class="icon-tags"></i><span>
                          @php ($count = 0)
                          @foreach ($buku->bukuKategoris as $bukuKategori)
                              @if($count != 0)
                              , 
                              @endif
                              <a href="{{ url('bukuView/filter/kategori/'.$bukuKategori->kategoris->id) }}">{{ $bukuKategori->kategoris->nama }}</a> 
                              @php ($count++)
                          @endforeach
                      </span></li>
                </ul>
		<div class="clear"></div>
                <div class="span1" style="margin-left: 0"><strong>Penulis</strong></div>
                <div class="span4">: 
                        @php ($count = 0)
                        @foreach ($buku->bukuAuthors as $bukuAuthor)
                            @if($count != 0)
                                ;
                            @endif
                            {{ $bukuAuthor->authors->nama }}
                            @php ($count++)
                      @endforeach
                </div>
                <div class="span1" style="margin-left: 0"><strong>Penerbit</strong></div>
                <div class="span4">: {{ $buku->penerbit }}</div>
		<div class="clear"></div>
                <a href="{{ asset($buku->doc_filename) }}" download class="btn btn-color btn-rounded" style="margin-top: 10px">Unduh File</a>
              </div>
            </div>
          </article>
           @endforeach
          <!-- end article 4 -->
          <div class="row-fluid">
            <div class="span3">
                @php
                
                $countStart = ($bukus->currentPage() - 1) * ($bukus->perPage()) + 1;
                $countEnd = $countStart + $bukus->perPage() - 1;
                
                if($countStart > $bukus->total()) $countStart = $bukus->total();
                if($countEnd > $bukus->total()) $countEnd = $bukus->total();
                
                echo "Menampilkan ".$countStart." sampai ".$countEnd." dari ".$bukus->total()." data";
                
                @endphp
            </div>
            <div class="span5" style="text-align: right">
              <div class="pagination">
                  <ul>
                    <li>{{ $bukus->links() }}</li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection