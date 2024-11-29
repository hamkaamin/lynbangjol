@extends('layouts.app')

@section('content')
<!-- Subhead================================================== -->
  <section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-list icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">List <strong>ARTIKEL - MAJALAH</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Artikel - Majalah</li>
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
          <!-- start article 3 -->
          
          <div style="float: right;"><a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! action('MajalahArtikelController@create') !!}">Tambah Data</a></div>
          
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Halaman</th>
                    <th>Majalah</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($majalahArtikels as $majalahArtikel)
                  <tr>
                    <td>{{ $n }}</td> 
                    <td>{{ $majalahArtikel->judul }}</td>
                    <td>{{ $majalahArtikel->halaman }}</td>
                    <td><div style="font-weight: bold">{{ $majalahArtikel->majalahs->nama }}</div> <div>Edisi {{ $majalahArtikel->majalahs->edisi }}</div></td>
                    <td>
                        <a class="btn btn-info" style="padding: 8px 14px; font-size: 14px" href="{!! action('MajalahArtikelController@edit', $majalahArtikel->id) !!}">
                           <div class="icon">
                                <i class="icon-edit" style=""></i>
                             Edit
                            </div>
                        </a>
                        
                        <form action="{{ route('majalahArtikel.destroy', $majalahArtikel->id) }}" method="POST" class="hapus" onsubmit="return confirm('Konfirmasi Hapus Data Artikel Majalah dengan Judul {{ $majalahArtikel->judul }} ');"> 
			{{ method_field("DELETE") }} 
			{{ csrf_field() }} 
                        <button class="btn btn-danger" type="submit" name="submit" style="padding: 4px 8px; font-size: 14px"><i class="icon-trash" style=""></i> Hapus</button>
			</form>
                    </td>
                  </tr>
                  @php ($n++)
                  @endforeach
                </tbody>
              </table>
          <!-- end article 3 -->
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

@section('foot_script')
 <script type="text/javascript">

$(function() {
        $('#myTable').dataTable({
        	"processing": true,
      		"language" : {"url" : "{{ asset('DataTables-1.10.18/bahasa/Indonesian.json') }}" }
        });
    });

</script>
@endsection


