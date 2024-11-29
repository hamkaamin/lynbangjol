@extends('layouts.app')

@section('content')
  <section id="intro" style="margin-top: 50px">

    <div class="container-fluid">
      <div class="row-fluid">
<!--        <div class="span6">
            <h2 class="fadeIn" style="animation-duration: 1.5s"><strong>Badan Penelitian dan Pengembangan</strong></h2>
            <h2 class="fadeIn" style="animation-duration: 1.5s; animation-delay: 1s; opacity: 0; animation-fill-mode: forwards"><strong><span class="highlight primary">Provinsi Jawa Timur</span></strong></h2>
            <h4 class="fadeIn" style="animation-duration: 1.5s; animation-delay: 2s; opacity: 0; animation-fill-mode: forwards"><strong>
                    Repository Penelitian dan Karya Tulis
            </strong></h4>          -->
        </div>
          <div class="testmonial_slider fadeIn" style="animation-duration: 1.5s">
            <ul class="slides">
                @foreach ($homeSlides as $homeSlide)
                <li>
                  <div class="testimonial_item" style="height:400px;">
                    <a href="{{ asset($homeSlide->image_filename) }}">
                        <img src="{{ asset($homeSlide->image_filename) }}" alt="" class="customImage" />
                    </a>
                  <!-- end testmonial -->
                </div>
              </li>
              @endforeach
              
            </ul>
        </div>
<!--          <div class="span6 fadeIn" style="animation-duration: 1.5s; animation-delay: 3s; opacity: 0; animation-fill-mode: forwards">

            <a href="#">
                    <img src="{{ asset('img/myAsset/logoBalitbang.jpeg') }}" alt="" style="height:auto; width:100%"/>
                  </a>
        </div>              -->
      </div>
    </div>

  </section>

  <section id="maincontent">
    <div class="container-fluid fadeIn" style="animation-duration: 2.2s; animation-delay: 1s; opacity: 0; animation-fill-mode: forwards" >
     
     <div class="row-fluid">
         <div class="span6">
             <div class="icon">
                 <i class="icon-bg-light icon-circled icon-book icon-2x active" style="position:absolute"></i>
            </div>
             <h6 style="padding: 10px 0 0 70px">PRODUK LITBANG TERBARU</h6>
             <div class="clear" style="border-bottom: 1px double #FFFFFF; margin: 10px"></div>
			<!--  <div class="clear" style="border-bottom: 1px double #4CDCFF; margin: 10px"></div>  -->
         </div>
     </div>

      <div class="row-fluid">
          @php
          $latestItem = [];
          foreach($laporans as $laporan)
          {
            array_push($latestItem, 
            ['updated_at' => $laporan->updated_at
            , 'id' => $laporan->id
            , 'judul' => $laporan->judul
            , 'doc_filename' => $laporan->doc_filename
            , 'cover_filename' => $laporan->cover_filename
            , 'tipe' => '1'
            , 'internal' => $laporan->tipe
            ]);
          }
          
          foreach($jurnals as $jurnal)
          {
            array_push($latestItem, 
            ['updated_at' => $jurnal->updated_at
            , 'id' => $jurnal->id
            , 'judul' => $jurnal->nama
            , 'doc_filename' => $jurnal->doc_filename
            , 'cover_filename' => $jurnal->cover_filename
            , 'tipe' => '2']);
          }
          
          foreach($majalahs as $majalah)
          {
            array_push($latestItem, 
            ['updated_at' => $majalah->updated_at
            , 'id' => $majalah->id
            , 'judul' => $majalah->nama
            , 'doc_filename' => $majalah->doc_filename
            , 'cover_filename' => $majalah->cover_filename
            , 'tipe' => '3']);
          }
          
          foreach($bukus as $buku)
          {
            array_push($latestItem, 
            ['updated_at' => $buku->updated_at
            , 'id' => $buku->id
            , 'judul' => $buku->judul
            , 'doc_filename' => $buku->doc_filename
            , 'cover_filename' => $buku->cover_filename
            , 'tipe' => '4']);
          }
          
          arsort($latestItem)
          @endphp
          
          @php ($num = 0) @endphp
          @foreach ($latestItem as $key => $val)
          <div class="span4">
            <div class="features">
                <div class="icon">
                    <a href="#"><img src="{{ $latestItem[$key]['cover_filename'] }}" alt="" style="max-width: 120px; max-height: 200px; position: absolute"/></a>
                </div>
                <div class="features_content">
                    @if($latestItem[$key]['tipe'] == 1) Laporan Penelitian
                    @elseif($latestItem[$key]['tipe'] == 2) Jurnal
                    @elseif($latestItem[$key]['tipe'] == 3) Majalah
                    @elseif($latestItem[$key]['tipe'] == 4) Buku
                    @endif
                    <h5 style="font-weight:bold; font-size: 16px; height: 90px; 
                        overflow: hidden; 
                        text-overflow: ellipsis; 
                        display: -webkit-box;
                        -webkit-box-orient: vertical;
                        -webkit-line-clamp: 4;">
                        {{ $latestItem[$key]['judul'] }}
                    </h5>

                    <div class="clear"></div>
                    @php
                    $link = "";
                    if($latestItem[$key]['tipe'] == 1) 
                    {
                        if(!$latestItem[$key]['internal']) $link = "lapPenelitian";
                        else $link = "lapPenelitianEks";
                    }
                    elseif($latestItem[$key]['tipe'] == 2) $link = "jurnalView";
                    elseif($latestItem[$key]['tipe'] == 3) $link = "majalahView";
                    elseif($latestItem[$key]['tipe'] == 4) $link = "BukuView";
                    @endphp
                    <a href="{{ url($link.'/filter/id/'.$latestItem[$key]['id']) }}" class="btn btn-color btn-rounded" style="margin-top: 12px">Selengkapnya</a>
                </div>
            </div>
          </div>
          @php ($num++)
          @if ($num > 2) 
            @break
          @endif
          @endforeach
<!--        <div class="span4">
          <div class="features">
            <div class="icon">
              <i class="icon-bg-light icon-circled icon-code icon-5x active"></i>
            </div>
            <div class="features_content">
              <h3>Valid Coding</h3>
              <p class="left">
                Dolorem adipiscing definiebas ut nec. Dolore consectetuer eu vim, elit molestie ei has, petentium imperdiet in pri mel virtute nam.
              </p>
              <a href="#" class="btn btn-color btn-rounded"><i class="icon-angle-right"></i> Read more</a>
            </div>
          </div>
        </div>
        <div class="span4">
          <div class="features">
            <div class="icon">
              <i class="icon-bg-dark icon-circled icon-bug icon-5x"></i>
            </div>
            <div class="features_content">
              <h3>Bug free</h3>
              <p class="left">
                Dolorem adipiscing definiebas ut nec. Dolore consectetuer eu vim, elit molestie ei has, petentium imperdiet in pri mel virtute nam.
              </p>
              <a href="#" class="btn btn-color btn-rounded"><i class="icon-angle-right"></i> Read more</a>
            </div>
          </div>
        </div>

      </div>

      <!-- blank divider -->
     <div class="row-fluid">
        <div class="span12">
          <div class="blank10"></div>
        </div>
      </div>

      <div class="row-fluid">
        <div class="span12">
          <div class="cta-box">
            <div class="cta-text">
              <h5> Kunjungi Website Utama BALITBANG Provinsi Jawa Timur</h5>
            </div>
            <div class="cta">
              <a class="btn btn-large btn-rounded btn-color" href="http://brida.jatimprov.go.id/" target="_blank">
					<i class="icon-chevron-right"></i> Lanjut</a>
            </div>
          </div>
          <!-- end tagline -->
      </div>
      </div>

      <div class="row-fluid">
        <div class="span6">
          <div class="icon">
                 <i class="icon-bg-light icon-circled icon-book icon-2x active" style="position:absolute"></i>
            </div>
		  <h6 style="padding: 10px 0 0 70px ">PRODUK LITBANG</h6>
		  <div class="clear" style="border-bottom: 1px double #FFFFFF; margin: 10px"></div>
		  <!--<div class="clear" style="border-bottom: 1px double #4CDCFF; margin: 10px"></div> -->
          <div class="testmonial_slider">
            <ul class="slides">
                @if (!$laporans->isEmpty())
              <li>
                <a href="{{ url('lapPenelitian/filter/id/'.$laporans[0]->id) }}">
                <div class="testimonial_item">
                  <div class="icon">
                    <img src="{{ $laporans[0]->cover_filename }}" alt="" style="max-width: 120px; max-height: 200px; position: absolute"/>
                  </div>
                  <div style=" padding-left: 150px">
                  <h5 style="font-weight:bold; font-size: 16px">
                    {{ $laporans[0]->judul }}
                  </h5>
                  <!--<span class="author">Laporan Penelitian</span>-->
                      <span class="occupation" style="margin-bottom: 25px">Laporan Penelitian</span>
                  </div>
                  <!-- end testmonial -->
                </div>
                </a>
              </li>
              @endif
              @if (!$jurnals->isEmpty())
              <li>
                <a href="{{ url('jurnalView/filter/id/'.$jurnals[0]->id) }}">
                <div class="testimonial_item">
                  <div class="icon">
                    <img src="{{ $jurnals[0]->cover_filename }}" alt="" style="max-width: 120px; max-height: 200px; position: absolute"/>
                  </div>
                  <div style=" padding-left: 150px">
                  <h5 style="font-weight:bold; font-size: 16px">
                    {{ $jurnals[0]->nama }}
                  </h5>
                  <span class="occupation" style="margin-bottom: 25px">Jurnal</span>
                  </div>
                  <!-- end testmonial -->
                </div>
                </a>
              </li>
              @endif
              @if (!$majalahs->isEmpty())
               <li>
                <a href="{{ url('majalahView/filter/id/'.$majalahs[0]->id) }}">
                <div class="testimonial_item">
                  <div class="icon">
                    <img src="{{ $majalahs[0]->cover_filename }}" alt="" style="max-width: 120px; max-height: 200px; position: absolute"/>
                  </div>
                  <div style=" padding-left: 150px">
                  <h5 style="font-weight:bold; font-size: 16px">
                    {{ $majalahs[0]->nama }}
                  </h5>
                  <span class="occupation" style="margin-bottom: 25px">Majalah</span>
                  </div>
                  <!-- end testmonial -->
                </div>
                </a>
              </li>
              @endif
              @if (!$bukus->isEmpty())
              <li>
                <a href="{{ url('bukuView/filter/id/'.$bukus[0]->id) }}">
                <div class="testimonial_item">
                  <div class="icon">
                    <img src="{{ $bukus[0]->cover_filename }}" alt="" style="max-width: 120px; max-height: 200px; position: absolute"/>
                  </div>
                  <div style=" padding-left: 150px">
                  <h5 style="font-weight:bold; font-size: 16px">
                    {{ $bukus[0]->judul }}
                  </h5>
                  <span class="occupation" style="margin-bottom: 25px">Buku</span>
                  </div>
                  <!-- end testmonial -->
                </div>
                </a>
              </li>
              @endif
            </ul>
            <div class="clear"></div>
            <!-- end testmonial slider -->
          </div>
          <div class="blank"></div>
        </div>

        <div class="span6">
			<div class="icon">
                 <i class="icon-bg-light icon-circled icon-book icon-2x active" style="position:absolute"></i>
            </div>
          <h6 style="padding: 10px 0 0 70px">KATEGORI</h6>
		  <div class="clear" style="border-bottom: 1px double #FFFFFF; margin: 10px"></div>
		  <!-- <div class="clear" style="border-bottom: 1px double #4CDCFF; margin: 10px"></div>  -->
          <ul class="clients list list-chevron-sign-right">
            @foreach ($kategoris as $kategori)
            <div class="span6" style="margin-left: 0">
            <li style="font-size: 16px; width: 100%"><a href="{{ url('lapPenelitian/filter/kategori/'.$kategori->id) }}">{{ $kategori->nama }}</a></li>
            </div>
            @endforeach
          </ul>
        </div>
      </div>



    </div>
  </section>
@endsection

