<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>LYNBANGJOL - Badan Penelitian dan Pengembangan Provinsi Jawa Timur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  <meta name="description" content="Clean responsive bootstrap website template">	-->
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- styles -->
    <!-- -----------CSS--------------- -->
    @include('css_script.css')
    <!-- ----------------------------- -->

    <!-- =======================================================
          Theme Name: Plato
          Theme URL: https://bootstrapmade.com/plato-responsive-bootstrap-website-template/
          Author: BootstrapMade.com
          Author URL: https://bootstrapmade.com
        ======================================================= -->
</head>

<body>
    <header>
        <!-- Navbar
            ================================================== -->
        <div class="cbp-af-header" style="background: #4D869C">
            <div class=" cbp-af-inner">
                <div class="container-fluid">
                    <div class="row-fluid">

                        <div class="span4">
                            <!-- logo -->
                            <div class="logo" style="margin-top: -14px">
                                <!--  <h1><a href="{{ url('home') }}">Repository</a></h1> -->
                                <a href="{{ url('home') }}">
                                    <img src="{{ asset('img/myAsset/Logo SISFOLITBANG_new-03-03 (2).png') }}"
                                        alt="BALITBANG" />
                                </a>
                            </div>
                            <!-- end logo -->
                        </div>

                        <div class="span8">
                            <!-- top menu -->
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <nav>
                                        <ul class="nav topnav">
                                            <li class="dropdown">
                                                <a style="padding:2px 20px" href="{{ url('home') }} "><i class="icon-home icon-white"></i>&ensp;
                                                    HOME</a>
                                            </li>

                                            <li class="dropdown">
                                                <a  style=" padding:2px 4px" href="#"><i class="icon-comments icon-white"></i>&ensp; LAYANAN </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('icp') }}">Konsultasi ICP</a></li>
                                                    <li><a href="http://e-nikibang.balitbang.jatimprov.go.id/" target="_blank">Konsultasi HKI</a></li>
                                                    <li><a href="{{ asset('doc/SOP Penyusunan ICP dan TOR.pdf') }}">SOP ICP & TOR</a></li>

                                                </ul>
                                            </li>

                                            <li class="dropdown">
                                                <a  style=" padding:2px 4px" href="#"><i class="icon-file-text icon-white"></i>&ensp; PRODUK
                                                    LITBANG</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('lapPenelitian') }}">Laporan Penelitian
                                                            Internal</a></li>
                                                    <li><a href="{{ url('lapPenelitianEks') }}">Laporan Penelitian
                                                            Eksternal</a></li>
                                                    <!-- <li><a href="{{ url('jurnalView') }}">Jurnal Cakrawala</a></li> -->
                                                    <li><a href="http://cakrawalajournal.org/" target="_blank">Jurnal Cakrawala</a></li>
                                                    <li><a href="{{ url('majalahView') }}">Majalah Teropong</a></li>
                                                    <li><a href="{{ url('policyBrief') }}">Policy Brief</a></li>
                                                </ul>
                                            </li>
                                            @if (!Auth::check())
                                            <li class="dropdown">
                                                <a  style=" padding:2px 4px" href="{{route('login')}}"><i class="icon-user icon-white"></i>&ensp; LOGIN </a>
                                            </li>
                                            <li class="dropdown">
                                                <a  style=" padding:2px 4px" href="{{url('register_user')}}"><i class="icon-edit icon-white"></i>&ensp; Register </a>
                                            </li>
                                            @endif
                                            @if (Auth::check())
                                                @if(Auth::user()->jenis_user != 99)
                                            <li class="dropdown">
                                                <a  style=" padding:2px 4px" href="#"><i class="icon-ellipsis-vertical icon-white"></i>&ensp; MENU
                                                    ADMIN</a>
                                                <ul class="dropdown-menu">
                                                    @if(Auth::user()->jenis_user == 143)
                                                    <li class="dropdown"><a href="{{ url('laporan') }}">
                                                            << Laporan Penelitian >>
                                                        </a>
                                                        <ul class="dropdown-menu sub-menu">
                                                            <li><a href="{{ url('laporan') }}">Laporan Penelitian</a>
                                                            </li>
                                                            <li><a href="{{ url('laporanAuthor') }}">Peneliti -
                                                                    Laporan</a></li>
                                                            <li><a href="{{ url('laporanKategori') }}">Kategori -
                                                                    Laporan</a></li>
                                                            <li><a href="{{ url('laporanLokasi') }}">Lokasi -
                                                                    Laporan</a></li>
                                                            <li><a href="{{ url('laporanLembaga') }}">Pelaksana -
                                                                    Laporan</a></li>
                                                        </ul>
                                                    </li>
                                                    @else
                                                    <li class="dropdown"><a href="{{ url('laporan') }}"> Laporan
                                                            Penelitian </a>
                                                        @endif
                                                        @if(Auth::user()->jenis_user == 143)
                                                    <li class="dropdown"><a href="{{ url('jurnal') }}">
                                                            << Jurnal >>
                                                        </a>
                                                        <ul class="dropdown-menu sub-menu">
                                                            <li><a href="{{ url('jurnal') }}">Jurnal</a></li>
                                                            <li><a href="{{ url('jurnalArtikel') }}">Artikel -
                                                                    Jurnal</a></li>
                                                            <li><a href="{{ url('jurnalAuthor') }}">Penulis - Jurnal</a>
                                                            </li>
                                                            <!--        <li><a href="{{ url('jurnalKategori') }}">Kategori - Jurnal</a></li>        -->
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown"><a href="{{ url('majalah') }}">
                                                            << Majalah >>
                                                        </a>
                                                        <ul class="dropdown-menu sub-menu">
                                                            <li><a href="{{ url('majalah') }}">Majalah</a></li>
                                                            <li><a href="{{ url('majalahArtikel') }}">Artikel -
                                                                    Majalah</a></li>
                                                            <li><a href="{{ url('majalahAuthor') }}">Penulis -
                                                                    Majalah</a></li>
                                                            <!--        <li><a href="{{ url('majalahKategori') }}">Kategori - Majalah</a></li>  -->
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown"><a href="{{ url('policy') }}">
                                                            << Policy Brief >>
                                                        </a>
                                                        <!--<ul class="dropdown-menu sub-menu">
                                                            <li><a href="{{ url('policy') }}">Majalah</a></li>
                                                            <li><a href="{{ url('majalahArtikel') }}">Artikel -
                                                                    Majalah</a></li>
                                                            <li><a href="{{ url('majalahAuthor') }}">Penulis -
                                                                    Majalah</a></li>
                                                                    <li><a href="{{ url('majalahKategori') }}">Kategori - Majalah</a></li>  
                                                        </ul> -->
                                                    </li>
                                                    <!--      <li class="dropdown"><a href="{{ url('buku') }}"><< Buku >></a>
                                                          <ul class="dropdown-menu sub-menu">
                                                              <li><a href="{{ url('buku') }}">Buku</a></li>
                                                              <li><a href="{{ url('bukuAuthor') }}">Penulis - Buku</a></li>
                                                              <li><a href="{{ url('bukuKategori') }}">Kategori - Buku</a></li>
                                                          </ul>
                                                        </li>         -->
                                                    @endif
                                                    <li><a href="{{ url('author') }}">Penulis / Peneliti</a></li>
                                                    <li><a href="{{ url('kategori') }}">Kategori</a></li>
                                                    <li><a href="{{ url('lokasi') }}">Lokasi</a></li>
                                                    <li><a href="{{ url('lembaga') }}">Instansi</a></li>
                                                    <li><a href="{{ url('icp/panel') }}">Konsultasi ICP</a></li>
                                                </ul>
                                            </li>
                                            @endif

                                            <li class="dropdown" style="border-left: 1px solid #D3D3D3;">
                                                @if (Auth::check())
                                                <a href="#"><i class="icon-user icon-white">&ensp;</i>
                                                    {{ Auth::user()->name }}</a>
                                                <ul class="dropdown-menu">
                                                    @if(Auth::user()->jenis_user == 143)
                                                    <li class="dropdown"><a href="{{ url('#') }}">Pengaturan</a>
                                                        <ul class="dropdown-menu sub-menu">
                                                            <li><a href="{{ url('userView') }}">User</a></li>
                                                            <li><a href="{{ url('homeSlide') }}">Slide</a></li>
                                                        </ul>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                                            Logout</a>
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </li>
                                                </ul>

                                                @else
                                                <!--		<a href="#"><i class="icon-user icon-white"></i> Menu User</a>
                                                    <ul class="dropdown-menu">
                                                      <li><a href="{{ route('login') }}">Login</a></li>
                                                      <li><a href="{{ route('register') }}">Registrasi</a></li>
                                                    </ul>       -->
                                                    @endif
                                                @endif

                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- end menu -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- -----------ISI--------------- -->
    @yield('content')
    <!-- ----------------------------- -->

    <a href="https://wa.me/6282229341993" target="_blank" style="position: fixed; right: 0px; bottom: 0px;"> <img alt="Chat on WhatsApp" src="{{ asset('img/WhatsappButton.png') }}" style="width: 150px; height: 150px;" />
    <a />

    <!-- Footer
   ================================================== -->
    <footer class="footer" style="background: #4D869C">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span8">
                    <div class="widget">
                        <!-- logo -->
                        <div class="footerlogo">
                            <h6 style="font-weight:">Alamat Kantor</h6>
                            <!--<h5>Alamat Kantor</h5> -->
                            <!-- <img src="assets/img/logo.png" alt="" /> -->
                        </div>
                        <!-- end logo -->
                        <address style="color: white">
                            Jl. Gayung Kebonsari No.56, Surabaya 60235 <br>
                            Jawa Timur, Indonesia<br>
                            <div style="margin-top:6px"><i class="icon-bg-light icon-phone icon-circled icon-3qx"></i>
                                <span style="font-weight: "> (031) 829 0738 / (031) 829 0719 &nbsp; |&emsp; </span><i
                                    class="icon-bg-light icon-envelope icon-circled icon-3qx"></i> <span
                                    style="font-weight: "> balitbangjatim@gmail.com</span></div>
                            <!-- <div style="margin-top:4px"><i class="icon-bg-light icon-envelope icon-circled icon-3qx"></i> <span style="font-weight: bold"> litbangjatim@yahoo.com</span></div> -->
                        </address>
                    </div>
                </div>
                <!--    <div class="span3">
                          <div class="widget">
                            <h5>Brow-fluidse pages</h5>
                            <ul class="list list-ok">
                              <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                              <li><a href="#">Tamquam ponderum at eum, nibh dicta offendit mei</a></li>
                              <li><a href="#">Vix no vidisse dolores intellegam</a></li>
                              <li><a href="#">Est virtute feugiat accommodare eu</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="span3">
                          <div class="widget">
                            <h5>Flickr photostream</h5>
                            <div class="flickr_badge">
                              <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=34178660@N03"></script>
                            </div>
                            <div class="clear"></div>
                          </div>
                        </div>		-->
                <div class="span4">
                    <div class="widget">
                        <h6> Kunjungi Sosial Media Kami</h6>
                        <ul class="social-network">
                            <!-- <li><a href="#"><i class="icon-bg-light icon-facebook icon-circled icon-1x"></i></a></li> -->
                            <li><a href="https://www.instagram.com/bridajatim/" title="Instagram"><i
                                        class="icon-bg-light fa-instagram icon-circled icon-1x"></i>&emsp; &emsp; </a>
                            </li>
                            <li><a href="#" title="Twitter"><i
                                        class="icon-bg-light icon-twitter icon-circled icon-1x "></i></a></li>
                            <!-- <li><a href="#" title="Linkedin"><i class="icon-bg-light icon-linkedin icon-circled icon-1x"></i></a></li> -->
                            <!--<li><a href="#" title="Pinterest"><i class="icon-bg-light icon-pinterest icon-circled icon-1x"></i></a></li> -->
                            <!-- <li><a href="#" title="Google plus"><i class="icon-bg-light icon-google-plus icon-circled icon-1x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span8">
                    <div class="widget">
                        <!-- logo -->
                        <div class="footerlogo">

                        </div>
                        <!-- end logo -->
                        <address style="color: white">
                        </address>
                    </div>
                </div>
                <!--    <div class="span3">
                          <div class="widget">
                            <h5>Brow-fluidse pages</h5>
                            <ul class="list list-ok">
                              <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                              <li><a href="#">Tamquam ponderum at eum, nibh dicta offendit mei</a></li>
                              <li><a href="#">Vix no vidisse dolores intellegam</a></li>
                              <li><a href="#">Est virtute feugiat accommodare eu</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="span3">
                          <div class="widget">
                            <h5>Flickr photostream</h5>
                            <div class="flickr_badge">
                              <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=34178660@N03"></script>
                            </div>
                            <div class="clear"></div>
                          </div>
                        </div>		-->
                <div class="span4">
                    <div class="widget">
                        <h6> STATISTIK PENGUNJUNG</h6>
                        @php
                        $jumlah_pengunjung_hari_ini = App\Visitor::count_pengunjung_hari_ini();
                        $jumlah_pengunjung_kemarin = App\Visitor::count_pengunjung_kemarin();
                        $jumlah_total_pengunjung = App\Visitor::count_total_pengunjung();
                        @endphp
                        <table style="color:white">
                            <tr>
                                <td style="width: 200px"> Hari Ini </td>
                                <td> : {{$jumlah_pengunjung_hari_ini}}</td>
                            </tr>
                            <tr>
                                <td> Pengunjung Kemaren </td>
                                <td> : {{$jumlah_pengunjung_kemarin}} </td>
                            </tr>
                            <tr>
                                <td>Total Pengunjung</td>
                                <td> : {{$jumlah_total_pengunjung}} </td>
                            <tr>
                        </table>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
        <div class="subfooter" style="border-top:5px solid #01403c;">
            <div class="container-fluid">

            </div>
        </div>
    </footer>



</body>

<!-- -----------SCRIPT--------------- -->
@include('css_script.script')
<!-- -------------------------------- -->

<!-- -----------ISI SCRIPT--------------- -->
@yield('foot_script')
<!-- ------------------------------------ -->

</html>