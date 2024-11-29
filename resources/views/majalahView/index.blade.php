@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
          <h3><strong>Majalah</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Majalah</li>
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
              <form class="form-search" action="{{ url('majalahView/search') }}" method="GET">
                  <select id="searchVar" class="form-control btn dropdown-toggle btn btn-primary" name="searchVar" style="width: auto">
                    <option value="nama">Nama</option>
                    <option value="penulis">Penulis</option>
                    <option value="penerbit">Penerbit</option>
                </select>
                  <input placeholder="Tulis Disini" type="text" class="input-medium search-query" name="search" value="{{ old('search') }}" style="font-size: 14px; height: 32px; border: solid 1px">
                <button type="submit" class="btn btn-flat btn-color" >Cari</button>
              </form>
            </div>
            <div class="widget">
              <h4>Majalah Terbaru</h4>
              <ul class="recent-posts">
                @php ($num = 0)
                @foreach ($majalahsSide as $majalah)
                    <li><a href="{{ url('majalahView/filter/id/'.$majalah->id) }}"><img src="{{ asset($majalah->cover_filename) }}" alt="" style="max-width: 50px"/> {{ $majalah->nama }}</a>
                        <div class="clear">
                        </div>
                        <span class="date"><i class="icon-calendar"></i> {{ Carbon\Carbon::parse($majalah->tgl_publikasi)->format('d M Y') }}</span>
                    </li>
                    @php ($num++)
                    @if ($num > 3) 
                        @break
                    @endif
                @endforeach
              </ul>
            </div>  
<!--            <div class="widget">
              <h4>Kategori</h4>
              <ul class="unstyled">
                @foreach ($kategoris as $kategori)
                <li><a href="{{ url('majalahView/filter/kategori/'.$kategori->id) }}">{{ $kategori->nama }}</a></li>
                @endforeach
              </ul>
            </div>      -->
          </aside>
        </div>
        <div class="span8">
           @foreach ($majalahs as $majalah)
           <article class="blog-post">
            <div class="row-fluid">
              <div class="span8">
                <div class="row-fluid">
                    <div class="span8">
                     <div class="post-heading" style="margin-bottom: 30px">
                        <h3 style="margin-bottom: 0"><a href="#">{{ $majalah->nama }}</a></h3>
                        <h6>Edisi {{ $majalah->edisi }}</h6>
                    </div>
                    <div class="clear"></div>
                    <ul class="post-meta">
                      <img src="{{ asset($majalah->cover_filename) }}" alt=""/>
                    </ul>
                    <div class="clear"></div>
                    <ul class="post-meta">
                      <li class="first"><i class="icon-calendar"></i><span>{{ Carbon\Carbon::parse($majalah->tgl_publikasi)->format('Y') }}</span></li>
                      <li><i class="icon-list-alt"></i><span><a href="#">{{ $majalah->halaman }} halaman</a></span></li>
                      <li class="last"><i class="icon-tags"></i><span>
                              @php ($count = 0)
                              @foreach ($majalah->majalahKategoris as $majalahKategori)
                                @if($count != 0)
                                , 
                                @endif
                                <a href="{{ url('majalahView/filter/kategori/'.$majalahKategori->kategoris->id) }}">{{ $majalahKategori->kategoris->nama }}</a> 
                                @php ($count++)
                              @endforeach
                          </span></li>
                          <br/>
                          Diterbitkan oleh <a href="{{ url('majalahView/filter/penerbit/'.$majalah->penerbit) }}"><strong>{{ $majalah->penerbit }} </strong></a>
                    </ul>
                    </div>
                </div>
		<div class="clear"></div>
                <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        <i class="icon-caret-down"></i> Daftar Isi </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <div class="row-fluid" style="margin-bottom: 0; border-bottom: 3px solid #eeeeee">
                        <div class="span5">
                            <strong>Artikel</strong>
                        </div>
                        <div class="span2">
                            <strong>Penulis</strong>
                        </div>
                    </div>
                    @foreach ($majalah->majalahArtikels as $majalahArtikel)
                    <div class="row-fluid">
                        <div class="span5">
                            Halaman {{ $majalahArtikel->halaman }}<br/>
                            <strong>{{ $majalahArtikel->judul }}</strong><br/>
                        </div>
                        <div class="span2">
                            <br/>
                            @foreach ($majalahArtikel->majalahAuthors as $majalahAuthor)
                            {{ $majalahAuthor->authors->nama }}<br/>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    </div>
                  </div>
                </div>
              </div>
		<div class="clear"></div>
                <a href="{{ asset($majalah->doc_filename) }}" download class="btn btn-color btn-rounded" style="margin-top: 10px">Unduh File</a>
              </div>
            </div>
          </article>
           @endforeach
          <!-- end article 4 -->
          <div class="row-fluid">
            <div class="span3">
                @php
                
                $countStart = ($majalahs->currentPage() - 1) * ($majalahs->perPage()) + 1;
                $countEnd = $countStart + $majalahs->perPage() - 1;
                
                if($countStart > $majalahs->total()) $countStart = $majalahs->total();
                if($countEnd > $majalahs->total()) $countEnd = $majalahs->total();
                
                echo "Menampilkan ".$countStart." sampai ".$countEnd." dari ".$majalahs->total()." data";
                
                @endphp
            </div>
            <div class="span5" style="text-align: right">
              <div class="pagination">
                  <ul>
                    <li>{{ $majalahs->links() }}</li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection