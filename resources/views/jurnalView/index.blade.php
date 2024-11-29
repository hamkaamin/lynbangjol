@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
          <h3><strong>Jurnal</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Jurnal</li>
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
              <form class="form-search" action="{{ url('jurnalView/search') }}" method="GET">
                  <select id="searchVar" class="form-control btn dropdown-toggle btn btn-primary" name="searchVar" style="width: auto">
                    <option value="nama">Nama</option>
                    <option value="penulis">Penulis</option>
                    <option value="penerbit">Penerbit</option>
                    <option value="keyword">Keyword</option>
                </select>
                  <input placeholder="Tulis Disini" type="text" class="input-medium search-query" name="search" value="{{ old('search') }}" style="font-size: 14px; height: 32px; border: solid 1px">
                <button type="submit" class="btn btn-flat btn-color" >Cari</button>
              </form>
            </div>
            <div class="widget">
              <h4>Jurnal Terbaru</h4>
              <ul class="recent-posts">
                @php ($num = 0)
                @foreach ($jurnalsSide as $jurnal)
                    <li><a href="{{ url('jurnalView/filter/id/'.$jurnal->id) }}"><img src="{{ asset($jurnal->cover_filename) }}" alt="" style="max-width: 50px"/> {{ $jurnal->nama }}</a>
                        <div class="clear">
                        </div>
                        <span class="date"><i class="icon-calendar"></i> {{ Carbon\Carbon::parse($jurnal->tgl_publikasi)->format('d M Y') }}</span>
                    </li>
                    @php ($num++)
                    @if ($num > 3) 
                        @break
                    @endif
                @endforeach
              </ul>
            </div>  
 <!--           <div class="widget">
              <h4>Kategori</h4>
              <ul class="unstyled">
                @foreach ($kategoris as $kategori)
                <li><a href="{{ url('jurnalView/filter/kategori/'.$kategori->id) }}">{{ $kategori->nama }}</a></li>
                @endforeach
              </ul>
            </div>      -->
          </aside>
        </div>
        <div class="span8">
           @foreach ($jurnals as $jurnal)
           <article class="blog-post">
            <div class="row-fluid">
              <div class="span8">
                <div class="row-fluid">
                    <div class="span8">
                     <div class="post-heading" style="margin-bottom: 30px">
                        <h3 style="margin-bottom: 0"><a href="#">{{ $jurnal->nama }}</a></h3>
                        <h6>Volume {{ $jurnal->volume }}</h6>
                    </div>
                    <div class="clear"></div>
                    <ul class="post-meta">
                      <img src="{{ asset($jurnal->cover_filename) }}" alt=""/>
                    </ul>
                    <div class="clear"></div>
                    <ul class="post-meta">
                      <li class="first"><i class="icon-calendar"></i><span>{{ Carbon\Carbon::parse($jurnal->tgl_publikasi)->format('Y') }}</span></li>
                      <li><i class="icon-list-alt"></i><span><a href="#">{{ $jurnal->halaman }} halaman</a></span></li>
                      <li class="last"><i class="icon-tags"></i><span>
                              @php ($count = 0)
                              @foreach ($jurnal->jurnalKategoris as $jurnalKategori)
                                @if($count != 0)
                                , 
                                @endif
                                <a href="{{ url('jurnalView/filter/kategori/'.$jurnalKategori->kategoris->id) }}">{{ $jurnalKategori->kategoris->nama }}</a> 
                                @php ($count++)
                              @endforeach
                          </span></li>
                          <br/>
                          Diterbitkan oleh <a href="{{ url('jurnalView/filter/penerbit/'.$jurnal->penerbit) }}"><strong>{{ $jurnal->penerbit }} </strong></a>
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
                    @foreach ($jurnal->jurnalArtikels as $jurnalArtikel)
                    <div class="row-fluid">
                        <div class="span5">
                            Halaman [{{ $jurnalArtikel->halaman }}]<br/>
                            <strong>{{ $jurnalArtikel->judul }}</strong><br/>
                            Keyword : {{ $jurnalArtikel->keyword }}<br/>
                        </div>
                        <div class="span2">
                            <br/>
                            @foreach ($jurnalArtikel->jurnalAuthors as $jurnalAuthor)
                            {{ $jurnalAuthor->authors->nama }}<br/>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    </div>
                  </div>
                </div>
              </div>
                
		<div class="clear"></div>
                <a href="{{ asset($jurnal->doc_filename) }}" download class="btn btn-color btn-rounded" style="margin-top: 10px">Unduh File</a>
              </div>
            </div>
          </article>
           @endforeach
          <!-- end article 4 -->
          <div class="row-fluid">
            <div class="span3">
                @php
                
                $countStart = ($jurnals->currentPage() - 1) * ($jurnals->perPage()) + 1;
                $countEnd = $countStart + $jurnals->perPage() - 1;
                
                if($countStart > $jurnals->total()) $countStart = $jurnals->total();
                if($countEnd > $jurnals->total()) $countEnd = $jurnals->total();
                
                echo "Menampilkan ".$countStart." sampai ".$countEnd." dari ".$jurnals->total()." data";
                
                @endphp
            </div>
            <div class="span5" style="text-align: right">
              <div class="pagination">
                  <ul>
                    <li>{{ $jurnals->links() }}</li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

