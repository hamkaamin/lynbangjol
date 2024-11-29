@extends('layouts.app')
  <!-- Subhead================================================== -->
@section('content')
<section id="subintro">

    <div class="container-fluid">
      <div class="row-fluid" style="margin-bottom: 0px">
        <div class="span4">
            <div class="icon">
                <i class="icon-bg-light icon-circled icon-list icon-2x active" style="position: absolute; font-size: 20px !important; width: 40px !important; height: 40px !important; line-height: 40px !important;"></i>
            </div>
            <h3 style="margin-left: 50px">List <strong>KATEGORI - JURNAL</strong></h3>
        </div>
        <div class="span8">
          <ul class="breadcrumb notop">
            <li><a href="{{ url('home') }}">Home</a><span class="divider">/</span></li>
            <li class="active">Kategori - Jurnal</li>
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
          
          <div style="float: right;"><a class="btn btn-primary" style="padding: 10px 16px; font-ine-height: 30px;size: 14px" href="{!! action('JurnalKategoriController@create') !!}">Tambah Data</a></div>
          
              <table id="myTable" class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Jurnal</th>
                    <th>Kategori</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($n=1)
                  @foreach ($jurnalKategoris as $jurnalKategori)
                  <tr>
                    <td>{{ $n }}</td> 
                    <td>{{ $jurnalKategori->jurnals->nama }}</td>
                    <td>{{ $jurnalKategori->kategoris->nama }}</td>
                    <td>
                        <a class="btn btn-info" style="padding: 4px 19px; font-size: 14px" href="{!! action('JurnalKategoriController@edit', $jurnalKategori->id) !!}">
                            Edit
                        </a>
                        
                        <form action="{{ route('jurnalKategori.destroy', $jurnalKategori->id) }}" method="POST" class="hapus" onsubmit="return confirm('Konfirmasi Hapus Data Kategori - Artikel Jurnal');"> 
			{{ method_field("DELETE") }} 
			{{ csrf_field() }} 
                        <input class="btn btn-danger" type="submit" value="Hapus" name="submit"/>
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